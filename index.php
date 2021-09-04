<?php
require 'languages/index.php';

Languages::set_current('ru');
echo Languages::get_current()['text'];

echo Languages::check('ru');