<?php

/**
 * This function compares the value passed from the navbar to the current route.
 * This is used for the current page indicator in the navbar.
 * It adds the 'current' class which indicates the page the
 * user is currently on.
 */
function currentNav($value)
{
  return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $value ? 'current' : '';
}
