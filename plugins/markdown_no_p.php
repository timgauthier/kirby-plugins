<?
// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

function markdown_no_p($text) {
  return str_replace(array('<p>', '</p>'), '', markdown($text));
}

?>
