<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$autoload['packages'] = array();
$autoload['libraries'] = array("database","datetime","Dates");
$autoload['drivers'] = array();
$autoload['helper'] = array("form","inflector","login","string","url","terbilang","datetime");
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array("User","Setting");
