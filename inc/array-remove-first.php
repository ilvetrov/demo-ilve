<?php

function array_remove_first(Array $array)
{
  return array_slice($array, 1, count($array) - 1);
}