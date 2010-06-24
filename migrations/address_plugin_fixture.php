<?php
/**
 * AddressPluginFixture Migration
 *
 * @since 24/06/2010 16:48:32
 */
class AddressPluginFixture extends AppMigration {

 var $estados = array(
          'AC' => 'Acre',
          'AL' => 'Alagoas',
          'AP' => 'Amapá',
          'AM' => 'Amazonas',
          'BA' => 'Bahia',
          'CE' => 'Ceará',
          'DF' => 'Distrito Federal',
          'ES' => 'Espírito Santo',
          'GO' => 'Goiás',
          'MA' => 'Maranhão',
          'MT' => 'Mato Grosso',
          'MS' => 'Mato Grosso do Sul',
          'MG' => 'Minas Gerais',
          'PA' => 'Pará',
          'PB' => 'Paraíba',
          'PE' => 'Pernambuco',
          'PI' => 'Piauí',
          'PR' => 'Paraná',
          'RJ' => 'Rio de Janeiro',
          'RN' => 'Rio Grande do Norte',
          'RS' => 'Rio Grande do Sul',
          'RO' => 'Rondônia',
          'RR' => 'Roraima',
          'SC' => 'Santa Catarina',
          'SP' => 'São Paulo',
          'SE' => 'Sergipe',
          'TO' => 'Tocantins'
  );

  var $capitais = array(
          'AC' => 'Rio Branco',
          'AL' => 'Maceió',
          'AP' => 'Macapá',
          'AM' => 'Manaus',
          'BA' => 'Salvador',
          'CE' => 'Fortaleza',
          'DF' => 'Brasília',
          'ES' => 'Vitória',
          'GO' => 'Goiânia',
          'PA' => 'Belém',
          'PB' => 'João Pessoa',
          'PR' => 'Curitiba',
          'PE' => 'Recife',
          'PI' => 'Teresina',
          'MA' => 'São Luís',
          'MT' => 'Cuiabá',
          'MS' => 'Campo Grande',
          'MG' => 'Belo Horizonte',
          'RJ' => 'Rio de Janeiro',
          'RN' => 'Natal',
          'RS' => 'Porto Alegre',
          'RO' => 'Porto Velho',
          'RR' => 'Boa Vista',
          'SC' => 'Florianópolis',
          'SP' => 'São Paulo',
          'SE' => 'Aracaju',
          'TO' => 'Palmas'
  );

  var $uses = array('Address.AddressCountry', 'Address.AddressState', 'Address.AddressCity', 'Address.AddressNeighborhood');

/**
 * Up Method
 *
 */
	function up() {
		$this -> {'Address.AddressCountry'} -> create();
    $this -> {'Address.AddressCountry'} -> save(array('name' => 'Brasil', 'abbreviation' => 'BRA'));

    $brasilId = $this -> {'Address.AddressCountry'} -> id;

    foreach ($this -> estados as $abbrev => $name) {
      $this -> {'Address.AddressState'} -> create();
      $this -> {'Address.AddressState'} -> save(array(  'country_id' => $brasilId,
                                                        'abbreviation' => $abbrev,
                                                        'name' => $name
                                               ));

      $this -> {'Address.AddressCity'} -> create();

      $this -> {'Address.AddressCity'} -> save(array(  'state_id' =>  $this -> {'Address.AddressState'} -> id,
                                                       'name' => $this -> capitais[$abbrev]
                                               ));

      $this -> {'Address.AddressNeighborhood'} -> create();
      $this -> {'Address.AddressNeighborhood'} -> save(array(  'city_id' =>  $this -> {'Address.AddressCity'} -> id,
                                                               'name' => 'centro'
                                               ));
    }
	}

/**
 * Down Method
 *
 */
	function down() {
    $this -> Country = $this -> getModel('address_countries');
    $this -> State = $this -> getModel('address_states');
    $this -> City = $this -> getModel('address_cities');
    $this -> Neighborhood = $this -> getModel('address_neighborhoods');

    $this -> Country -> deleteAll(array('1' => '1'));
    $this -> State -> deleteAll(array('1' => '1'));
    $this -> City -> deleteAll(array('1' => '1'));
    $this -> Neighborhood -> deleteAll(array('1' => '1'));
	}
}

?>