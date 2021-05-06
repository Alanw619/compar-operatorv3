<?php

function loadClass($class_name) {
  require 'class/'. $class_name . '.php'; 
}

spl_autoload_register('loadClass');