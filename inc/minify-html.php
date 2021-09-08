<?php

function minify_html($html)
{
  return remove_comments(remove_whitespaces($html));
}

function remove_whitespaces($html)
{
  return str_replace("  ", "", preg_replace("/\r|\n/", "", $html));
}

function remove_comments($html)
{
  return preg_replace("/<!--[\s\S]*?-->/", "", $html);
}