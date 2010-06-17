<?php
class AddressZipcodesController extends AddressAppController {
  var $name = 'AddressZipcodes';
  
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

        $searchOptions = array('conditions' => array('OR' => array(
                                                                       array('AddressZipcode.postal_code' => $search),
                                                                       array('AddressZipcode.postal_code' => $searchNoHiphen))
                                                            ));

        $this -> AddressZipcode -> contain('City.name', 'City.State.abbreviation', 'Neighborhood.name');
        $zipcode = $this -> AddressZipcode -> find('first',  $searchOptions);

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

  function thirdPartySearch($zipcode) {
    return array();
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
}
?>
