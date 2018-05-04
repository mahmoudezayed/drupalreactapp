<?php

namespace Drupal\react_app;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the App structure entity.
 *
 * @see \Drupal\react_app\Entity\AppStructure.
 */
class AppStructureAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\react_app\Entity\AppStructureInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished app structure entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published app structure entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit app structure entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete app structure entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add app structure entities');
  }

}
