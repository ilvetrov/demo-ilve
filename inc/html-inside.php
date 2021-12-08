<?php

function echo_array_if(Array $blocks)
{
  $true_blocks = [];
  foreach ($blocks as $block => $expression) {
    if ($expression) {
      $true_blocks[] = $block;
    }
  }
  echo implode(' ', $true_blocks);
}