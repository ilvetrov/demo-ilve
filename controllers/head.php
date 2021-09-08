<?php

require_once PATH_PREFIX . '/inc/controller.php';

class HeadController extends Controller
{
  static public function run()
  {
    self::load_view('head', [
      "styles" => [
        "pop-up"
      ]
    ]);
  }
}
HeadController::run();