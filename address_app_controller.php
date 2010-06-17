<?php

class AddressAppController extends AppController {

  public function formjs($id) {
    if ($this->params['url']['ext'] != 'js') {
      exit;
    }

    $this->layout = 'gen';
    $this->ext = '.js';

    $this->set("cacheDuration", '1 hour');
  }

  public function indexjs($id) {
    if ($this->params['url']['ext'] != 'js') {
      exit;
    }

    $this->layout = 'gen';
    $this->ext = '.js';

    $this->set("cacheDuration", '1 hour');
  }

  public function elementjs($id) {
    if ($this->params['url']['ext'] != 'js') {
      exit;
    }

    $this->layout = 'gen';
    $this->ext = '.js';

    $this->set("cacheDuration", '1 hour');
  }
}
?>