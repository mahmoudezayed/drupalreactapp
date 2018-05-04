<?php

namespace Drupal\react_app\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for App structure entities.
 */
class AppStructureViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
