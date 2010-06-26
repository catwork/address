<?php
/**
 * AddressPluginTables Migration
 *
 * @since 24/06/2010 16:48:32
 */
class AddressPluginTables extends AppMigration {
  var $tables = array(
          'address_addresses' => array(
                          'number' => array('type' => 'string', 'length' => 11),
                          'more' => array('type' => 'string', 'length' => 255),
                          'neighborhood' = array('type' => 'string', 'length' => 128),
                          'street' = array('type' => 'string', 'length' => 128),
                          'zipcode_id' => array('type' => 'integer', 'null' => false)
          ),
          'address_zipcodes' => array(
                          'neighborhood_id' => array('type' => 'integer', 'null' => true),
                          'city_id' => array('type' => 'integer', 'null' => false),
                          'postal_code' => array('type' => 'string', 'null' => false, 'length' => 10),
                          'street' => array('type' => 'string', 'length' => 128)
          ),
          'address_states' => array(
                          'name' => array('type' => 'string', 'length' => 64, 'null' => false),
                          'abbreviation' => array('type' => 'string', 'length' => 3),
                          'country_id' => array('type' => 'integer', 'null' => false)
          ),
          'address_cities' => array(
                          'name' => array('type' => 'string', 'length' => 128, 'null' => false),
                          'state_id' => array('type' => 'integer', 'null' => false)
          ),
          'address_countries' => array(
                          'name' => array('type' => 'string', 'length' => 128, 'null' => false),
                          'abbreviation' => array('type' => 'string', 'length' => 3),
          ),
          'address_neighborhoods' => array(
                          'name' => array('type' => 'string', 'length' => 128, 'null' => false),
                          'city_id' => array('type' => 'integer', 'null' => false)
          )
  );

  /**
   * Up Method - Creating Tables
   */
  function up() {
    foreach ($this -> tables as $name => $schema) {
      $this -> createTable($name, $schema);
    }
  }

  /**
   * Down Method - Dropping Tables
   */
  function down() {
    foreach ($this -> tables as $name => $schema) {
      $this -> dropTable($name);
    }
  }
}

?>