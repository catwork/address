<?php
class AddressZipcodesController extends AddressAppController {
  var $name = 'Zipcodes';
  var $scaffold;
  
  var $uses = array('Address.AddressZipcode');
  
  public function index() {
    $this -> paginate['AddressZipcode']['recursive'] = 3;
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

    $this -> set('zipcode', $zipcode);
  }

  function thirdPartySearch($zipcode) {
    return array();
  }
}
?>
