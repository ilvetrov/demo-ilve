<?php

require_once PATH_PREFIX . '/inc/array-remove-last.php';

function get_php_files(String $dir_path)
{
  $files_names = get_php_files_names($dir_path);

  $files = [];
  foreach ($files_names as $file_name) {
    $code_name = remove_extension($file_name);
    $files[$code_name] = require(PATH_PREFIX . "$dir_path/$file_name");
  }

  return $files;
}

function get_php_files_names(String $dir_path)
{
  return array_diff(scandir(PATH_PREFIX . $dir_path), ['.', '..']);
}

function get_php_files_names_without_extension(String $dir_path)
{
  $files_names = get_php_files_names($dir_path);
  $files_names_without_extension = [];
  foreach ($files_names as $file_name) {
    $files_names_without_extension[] = remove_extension($file_name);
  }
  return $files_names_without_extension;
}

function remove_extension(String $file_name)
{
  return implode('.', array_remove_last(explode('.', $file_name)));
}