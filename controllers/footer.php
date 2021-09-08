<?php

require_once PATH_PREFIX . '/inc/controller.php';

class FooterController extends Controller
{
  static public function run()
  {
    self::load_view('footer', [
      "scripts" => [
        "pop-up"
      ]
    ]);
  }
}
FooterController::run();