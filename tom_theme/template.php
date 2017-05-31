<?php

/**
 * @file
 * template.php
 */

/**
 * Implements hook_theme().
 *
 * Hook to override default theme pages
 * copy '<modules>/obiba_mica_study/templates/' files in current theme
 * 'templates/' path, you can modify default display of listed page by
 * rearrange block field, don't forget to clear the theme registry.
 */


function tom_theme_theme($existing, $type, $theme, $path) {
  $theme_array = array();

  $destination_path = file_exists($path . '/templates/obiba_mica_study_detail.tpl.php');
  if (!empty($destination_path)) {
    $theme_array['obiba_mica_study_detail'] = array(
      'template' => 'obiba_mica_study_detail',
      'path' => $path . '/templates',
    );
  }

  $destination_path = file_exists($path . '/templates/obiba_mica_study-population-content-detail.tpl.php');
  if (!empty($destination_path)) {
    $theme_array['mica_population_content_detail'] = array(
      'template' => 'obiba_mica_study-population-content-detail',
      'path' => $path . '/templates',
    );
  }

  return $theme_array;

}

