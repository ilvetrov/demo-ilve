<?php
require PATH_PREFIX . '/core-config.php';
require PATH_PREFIX . '/config.php';

require PATH_PREFIX . '/inc/errors.php';
require PATH_PREFIX . '/inc/html-inside.php';

require PATH_PREFIX . '/languages/index.php';
Languages::set_current(Languages::get_requested_name());

require PATH_PREFIX . '/inc/controllers.php';
Controllers::run_current_controller();