<?php

require_once PATH_PREFIX . '/inc/controller.php';

class ErrorController extends Controller
{
  static public function run()
  {
    http_response_code(404);
    self::load_view('404');
  }
}
ErrorController::run();