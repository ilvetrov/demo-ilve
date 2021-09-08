<?php

require_once PATH_PREFIX . '/inc/array-remove-last.php';
require_once PATH_PREFIX . '/inc/get-php-files.php';

class Languages
{
  static private $current = 'en';

  static private $dictionaries_files_names = [];
  static private $dictionaries = [];
  static public function init()
  {
    self::$dictionaries_files_names = array_diff(scandir('languages/dictionaries'), ['.', '..']);
    foreach (self::$dictionaries_files_names as $dictionary_file_name) {
      $code_name = implode('.', array_remove_last(explode('.', $dictionary_file_name)));
      self::$dictionaries[$code_name] = require("dictionaries/$dictionary_file_name");
    }
  }

  static public function set_current(String $code_name)
  {
    self::$current = $code_name;
  }
  static public function get(String $code_name)
  {
    return self::$dictionaries[$code_name];
  }
  static public function get_current()
  {
    return self::get(self::$current);
  }
  static public function check(String $code_name)
  {
    $file_name = "$code_name.php";
    return in_array($file_name, self::$dictionaries_files_names);
  }
}
Languages::init();
