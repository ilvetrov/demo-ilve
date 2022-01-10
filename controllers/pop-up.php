<?php

require_once PATH_PREFIX . '/inc/controller.php';

class PopUpController extends Controller
{
  static public function run()
  {
    if (self::check_request_property('test')) {
      self::load_view('head', [
        "styles" => [
          "pop-up"
        ]
      ]);
    }

    $demo_text = !self::get_request_property('mode')
      ? lang('demo_text')
      : (
        Languages::check('demo_text_' . self::get_request_property('mode'))
          ? lang('demo_text_' . self::get_request_property('mode'))
          : lang('demo_text')
      );
    self::load_view('pop-up', [
      "pop_up_name" => "demo-hello",
      "with_wrapper" => true,
      "hidden" => self::get_request_property('shown'),
      "shimmering" => true,
      "link" => self::get_request_property('link'),
      "tags" => self::get_request_property('tags') ?? [],
      "closing_cross" => false,
      "with_logo" => true,
      "title" => lang('demo_site'),
      "demo_text" => $demo_text,
      "ignore_esc" => true,
    ]);
    self::load_view('pop-up', [
      "pop_up_name" => "demo-error",
      "with_wrapper" => true,
      "hidden" => true,
      "link" => self::get_request_property('link'),
      "tags" => self::get_request_property('tags') ?? [],
      "closing_cross" => false,
      "with_logo" => false,
      "title" => lang('stop') . '!',
      "demo_text" => lang('demo_error_text'),
      "clicked" => true
    ]);

    if (self::check_request_property('test')) {
      self::load_view('footer', [
        "scripts" => [
          "pop-up"
        ]
      ]);
    }
  }
}
PopUpController::run();