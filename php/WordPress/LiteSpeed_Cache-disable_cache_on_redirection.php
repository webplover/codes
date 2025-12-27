<?php

add_filter('wp_redirect', function ($location) {
  do_action('litespeed_control_set_nocache', 'no cache on redirection');
  return $location;
});
