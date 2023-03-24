<?php

/**
 * This method compares the value passed from the navbar styles class.
 * This is used for the current page indicator in the navbar.
 * It adds the 'current' class which indicates the page the
 * user is currently on.
 */
function currentNav($value)
{
  return $_SERVER['REQUEST_URI'] === $value ? 'current' : '';
}
