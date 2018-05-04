<?php

/**
 * @file
 * Contains app_structure.page.inc.
 *
 * Page callback for App structure entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for App structure templates.
 *
 * Default template: app_structure.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_app_structure(array &$variables) {
  // Fetch AppStructure Entity Object.
  $app_structure = $variables['elements']['#app_structure'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
