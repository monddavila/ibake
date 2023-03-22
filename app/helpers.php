<?php

// Add html class for current navigation in navbar
function currentNav($value)
{
  return $_SERVER['REQUEST_URI'] === $value ? 'current' : '';
}
