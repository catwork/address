<?php

class PhpInJsHelper extends AppHelper {
  function set($name, $value) {
    if (!empty($this->params['controller'])) {
      $controller = $this->params['controller'];
      $_SESSION['PhpInJs'][$controller][$name] = $value;
      return $value;
    }

    return null;
  }

  function get($name) {
    if (isset($_SESSION['PhpInJs'][$this->params['controller']][$name])) {
      return $_SESSION['PhpInJs'][$this->params['controller']][$name];
    }
  }
}

?>
