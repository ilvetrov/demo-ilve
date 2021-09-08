<?php

require_once PATH_PREFIX . '/inc/get-php-files.php';

class Controllers
{
  static private $error_controller_name = '404';

  static private $controllers_names = [];
  static public function init()
  {
    self::$controllers_names = get_php_files_names_without_extension('/controllers');
  }
  
  static public function run_controller(String $name)
  {
    if (in_array($name, self::$controllers_names)) {
      require(PATH_PREFIX . "/controllers/$name.php");
      return;
    }
    require(PATH_PREFIX . "/controllers/" . self::$error_controller_name . ".php");
  }

  static public function run_current_controller()
  {
    $route = explode('?', $_SERVER['REQUEST_URI'])[0];
    $controller_name = $route === '/' ? 'home' : ltrim($route, '/');

    self::run_controller($controller_name);
  }
}
Controllers::init();
