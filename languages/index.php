<?php

require_once PATH_PREFIX . '/inc/array-remove-last.php';
require_once PATH_PREFIX . '/inc/get-php-files.php';

class Languages
{
  static private $default = 'ru';
  static private $current = 'ru';

  static private $dictionaries_files_names = [];
  static private $dictionaries = [];
  static public function init()
  {
    self::$dictionaries_files_names = get_php_files_names('/languages/dictionaries');
    self::$dictionaries = get_php_files('/languages/dictionaries');
  }

  static public function set_current(String $code_name)
  {
    self::$current = self::validate($code_name);
  }
  static public function validate(String $raw_code_name_for_validating)
  {
    $code_name_for_validating = trim($raw_code_name_for_validating);
    foreach (self::$dictionaries as $code_name => $dictionary) {
      if ($code_name === $code_name_for_validating || in_array($code_name_for_validating, $dictionary['_aliases'])) {
        return $code_name;
      }
    }
    return self::$default;
  }
  static public function get(String $code_name)
  {
    return self::$dictionaries[$code_name];
  }
  static public function get_current()
  {
    return self::get(self::$current);
  }
  static public function get_current_name()
  {
    return self::$current;
  }
  static public function get_default()
  {
    return self::get(self::$default);
  }
  static public function get_default_name()
  {
    return self::$default;
  }
  static public function text(String $text)
  {
    return self::get_current()[$text] ?? self::get_default()[$text] ?? $text;
  }
  static public function get_requested_name()
  {
    if (@$_GET['demo-lang']) return self::validate($_GET['demo-lang']);
    return false;
  }
}
Languages::init();

function lang(String $text)
{
  return Languages::text($text);
}