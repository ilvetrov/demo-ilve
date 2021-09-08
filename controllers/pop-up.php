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

    $demo_text = self::get_request_property('site-deleted') ? lang('demo_text_of_deleted') : lang('demo_text');
    self::load_view('pop-up', [
      "pop_up_name" => "demo-hello",
      "with_wrapper" => true,
      "hidden" => self::get_request_property('shown'),
      "shimmering" => true,
      "link" => self::get_request_property('link'),
      "data_pop_up_do_not_show_scroll_bar_on_hide" => self::get_request_property('data-pop-up-do-not-show-scroll-bar-on-hide'),
      "closing_cross" => false,
      "with_logo" => true,
      "title" => lang('demo_site'),
      "demo_text" => $demo_text,
    ]);
    self::load_view('pop-up', [
      "pop_up_name" => "demo-error",
      "with_wrapper" => true,
      "hidden" => true,
      "link" => self::get_request_property('link'),
      "data_pop_up_do_not_show_scroll_bar_on_hide" => self::get_request_property('data-pop-up-do-not-show-scroll-bar-on-hide-for-error'),
      "closing_cross" => false,
      "with_logo" => false,
      "title" => lang('stop') . '!',
      "demo_text" => lang('demo_error_text'),
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