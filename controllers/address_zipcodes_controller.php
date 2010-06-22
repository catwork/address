<?php
class AddressZipcodesController extends AddressAppController {
  var $name = 'AddressZipcodes';
  var $components = array('Address.KinghostCurl');

  var $searchOptions;
  
  public function index() {
    $this -> AddressZipcode -> recursive = 3;
    $this->set('zipcodes', $this->paginate('AddressZipcode'));
  }

   function search() {
    $zipcode = array();

    if(isset($_REQUEST['q'])) // estamos procurando por algum CEP
    {
      $search = trim($_REQUEST['q']);
      $searchNoHiphen = str_replace('-', '', $search);

      if (preg_match('/^\d\d\d\d\d\d\d\d$/', $searchNoHiphen)) {

        $this -> searchOptions = array('conditions' => array('OR' => array(
                                                                       array('AddressZipcode.postal_code' => $search),
                                                                       array('AddressZipcode.postal_code' => $searchNoHiphen))
                                                            ));

        $this -> setSearchZipcodeContain();
        $zipcode = $this -> AddressZipcode -> find('first',  $this -> searchOptions);

        if ($zipcode == false) {
          $zipcode = $this -> thirdPartySearch($search);
        }
      }
    }

    $this -> set('items', $zipcode);
  }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid Zipcode.', true),'flash_erro');
      $this->redirect(array('action'=>'index'));
    }

    $this->AddressZipcode->contain('Neighborhood.name', 'City.State.name', 'City.name', 'City.State.Country.name');
    $this->set('zipcode', $this->AddressZipcode->read(null, $id));
  }

  function add() {
    if (!empty($this->data)) {
      $this->AddressZipcode->create();

      if ($this->AddressZipcode->save($this->data)) {
        $this->Session->setFlash(__('The Zipcode has been saved', true),'flash_ok');
        $this->redirect(array('action'=>'index'));
      } else {
        $this->Session->setFlash(__('The Zipcode could not be saved. Please, try again.', true),'flash_erro');
      }
    }

    $this -> set('countries', $this -> AddressZipcode -> City -> State -> Country -> find('list'));
    $this -> set('states', $this -> AddressZipcode -> City -> State -> find('list'));
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid Zipcode', true),'flash_erro');
      $this->redirect(array('action'=>'index'));
    }

    if (!empty($this->data)) {
      if ($this->AddressZipcode->save($this->data)) {
        $this->Session->setFlash(__('The Zipcode has been saved', true),'flash_ok');
        $this->redirect(array('action'=>'index'));
      } else {
        $this->Session->setFlash(__('The Zipcode could not be saved. Please, try again.', true),'flash_erro');
      }
    }
    
    if (empty($this->data)) {
      $this->data = $this->AddressZipcode->read(null, $id);
      $this->data['AddressZipcode']['state_id'] = $this -> data['City']['state_id'];

      $this -> set('cities', $this -> AddressZipcode -> City -> find('list', array('conditions' => array('state_id' => $this -> data['City']['state_id']))));
      $this -> set('neighborhoods', $this -> AddressZipcode -> Neighborhood -> find('list', array('conditions' => array('city_id' => $this -> data['City']['id']))));
    }

    $this -> set('countries', $this -> AddressZipcode -> City -> State -> Country -> find('list'));
    $this -> set('states', $this -> AddressZipcode -> City -> State -> find('list'));
    

    $this -> render('add');
  }

  function delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Identificador Inválido', true), 'flash_erro');
      $this->redirect(array('action'=>'index'));
    }
    if ($this->AddressZipcode->delete($id)) {
      $this->Session->setFlash('CEP removido.', 'flash_ok');
      $this->redirect(array('action'=>'index'));
    }
  }

  function thirdPartySearch($zipcode, $options = array()) {
    $default = array('republicavirtual' => true);

    $options = array_merge($default, $options);

    if ($options['republicavirtual']) {
      $this -> KinghostCurl = new KinghostCurlComponent();
      return $this -> doXmlZipcodeSearch($zipcode);
    }
    else
      return array();
  }

  function doXmlZipcodeSearch($zipcode) {
    $url = "http://cep.republicavirtual.com.br/web_cep.php?cep=$zipcode&formato=xml";

    $this -> KinghostCurl = new KinghostCurlComponent();
    $result = $this -> KinghostCurl -> get($url);

    if (empty($result))
      return array();
    
    $cepKH = simplexml_load_string($result);

    if (empty($cepKH))
      return array();

    $resultadoDaConsulta = (string) $cepKH -> resultado_txt;

    if ($resultadoDaConsulta == 'sucesso - cep completo' ||$resultadoDaConsulta == 'sucesso - cep único' ) { // acho que o WS da kinghost retorna > 0 em casos de sucesso :D
      $neighborhoodName = (string) $cepKH -> bairro;
      $cityName = (string) $cepKH -> cidade;
      $stateAbbrev = (string) $cepKH -> uf;
      $streetName = '';

      if ($cepKH -> tipo_logradouro && $cepKH -> logradouro)
        $streetName = ((string) $cepKH -> tipo_logradouro) . ' ' . ((string) $cepKH -> logradouro);

      return $this -> saveZipcode($zipcode, $stateAbbrev, $cityName, $neighborhoodName, $streetName);
    }
    else
      return array();
  }

  function saveZipcode($zipcode, $stateAbbrev, $cityName, $neighborhoodName = '', $streetName = '') {

    if (empty($stateAbbrev) || empty($cityName)) {
      return array();
    }

    $this -> AddressZipcode -> City -> State -> recursive = -1;
    $state = $this -> AddressZipcode -> City -> State -> findByAbbreviation($stateAbbrev);
    
    if (empty($state['State']['id'])) {
      // fatal error
      return array();
    }

    $this -> AddressZipcode -> City -> recursive = -1;
    $city = $this -> AddressZipcode -> City -> find('first', array('conditions' => array( 'state_id' => $state['State']['id'],
                                                                                          'City.name' => trim($cityName))));

    if (empty($city['City']['id'])) {
      $this -> AddressZipcode -> City -> create();
      $city = $this -> AddressZipcode -> City -> save(array('name' => $cityName,
                                                                    'state_id' => $state['State']['id']
      ));
    }

    $neighborhoodId = '';
    
    if (!empty($neighborhoodName)) {
      $this -> AddressZipcode -> Neighborhood -> recursive = -1;
      $neighborhood = $this -> AddressZipcode -> Neighborhood -> find('first', array('conditions' => array( 'city_id' => $city['City']['id'],
                                                                                                            'Neighborhood.name' => trim($neighborhoodName))));

      if (empty($neighborhood['Neighborhood']['id'])) {
        $this -> AddressZipcode -> Neighborhood -> create();
        $neighborhood = $this -> AddressZipcode -> Neighborhood -> save(array('name' => $neighborhoodName,
                                                                              'city_id' => $city['City']['id']
        ));
      }

      $neighborhoodId = $neighborhood['Neighborhood']['id'];
    }

    $this -> AddressZipcode -> create();

    $this -> AddressZipcode -> save(array('street' => $streetName,
                                          'city_id' => $city['City']['id'],
                                          'neighborhood_id' => $neighborhoodId,
                                          'postal_code' => $zipcode
    ));

    $this -> setSearchZipcodeContain();
    $zipcode = $this -> AddressZipcode -> find('first',  $this -> searchOptions);

    return $zipcode ? $zipcode : array();
  }

  public function getneighborhoods($cityId = null) {
    $items = array();
    
    if (!empty($cityId)) {
      $this -> AddressZipcode -> Neighborhood -> recursive = 0;
      $items = $this -> AddressZipcode -> Neighborhood -> find('all', array('conditions' => array('city_id' => $cityId)));
    }

    $this -> set('items', $items);
    $this -> render('search');
  }

  public function getcities($stateId = null) {
    $items = array();

    if (!empty($stateId)) {
      $this -> AddressZipcode -> City -> recursive = 0;
      $items = $this -> AddressZipcode -> City -> find('all', array('conditions' => array('state_id' => $stateId)));
    }
    
    $this -> set('items', $items);
    $this -> render('search');
  }

  public function setSearchZipcodeContain() {
    $this -> AddressZipcode -> contain('City.name', 'City.State.abbreviation', 'Neighborhood.name');
  }

  public function get($id) {
    if(isset($this->params['requested'])) {
      $this -> AddressZipcode -> contain('City.State.Country.name', 'Neighborhood');
      $zip = $this -> AddressZipcode -> findById($id);
      $zip['Zipcode'] = $zip['AddressZipcode'];
      unset($zip['AddressZipcode']);
      return $zip;
    }
  }
}
?>
