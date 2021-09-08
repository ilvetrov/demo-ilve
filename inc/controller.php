<?php

require_once PATH_PREFIX . '/inc/minify-html.php';
require_once PATH_PREFIX . '/inc/add-wrapper.php';

class Controller
{
  static private $default_variables = [];
  static private $development_variables = [];
  static public function init()
  {
    self::$default_variables = [
      "lang_name" => Languages::get_current_name(),
      "main_domain" => CONFIG['production'] ? CONFIG['main_domain'] : CONFIG['dev_domain']
    ];
    self::$development_variables = [];
  }

  static protected function load_view(String $name, Array $variables = [])
  {
    $variables = self::set_default_variables($variables);

    extract($variables, EXTR_OVERWRITE);
    ob_start();
    require PATH_PREFIX . "/views/$name.php";
    $html = minify_html(ob_get_clean());
    if (@$variables['with_wrapper']) {
      $html = add_wrapper($html);
    }
    echo $html;
  }
  static private function set_default_variables(Array $variables = [])
  {
    return array_merge(self::$default_variables, $variables);
  }
  static protected function check_request_property(String $property_name, $checked_value = 'true')
  {
    return $_GET[$property_name] === $checked_value
    || $_POST[$property_name] === $checked_value;
  }
  static protected function get_request_property(String $property_name)
  {
    return $_REQUEST[$property_name];
  }
  static protected function get_style(String $name, Array $variables = [])
  {
    $text = file_get_contents(PATH_PREFIX . "/public/assets/css/$name.css");
    return "<style type='text/css'>" . self::insert_variables($text, $variables) . "</style>";
  }
  static protected function get_script(String $name, Array $variables = [])
  {
    $text = file_get_contents(PATH_PREFIX . "/public/assets/js/$name.js");
    return '<script type="text/javascript">' . self::insert_variables($text, $variables) . "</script>";
  }
  static protected function insert_variables(String $text, Array $variables = [])
  {
    $output = $text;
    foreach ($variables as $key => $value) {
      $reg_exp = "/" . preg_quote("$key", '/') . "/";
      $output = preg_replace($reg_exp, $value, $output);
    }
    return $output;
  }
}
Controller::init();