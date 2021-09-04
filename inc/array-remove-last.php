<?php

function array_remove_last(Array $array)
{
  return array_slice($array, 0, count($array) - 1);
}