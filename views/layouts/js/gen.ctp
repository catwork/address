<?php

header("content-type: application/x-javascript");

echo $content_for_layout;

$this->data = null;
Configure::write('debug', 0);
?>