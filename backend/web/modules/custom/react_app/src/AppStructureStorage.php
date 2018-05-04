<?php

namespace Drupal\react_app;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\react_app\Entity\AppStructureInterface;

/**
 * Defines the storage handler class for App structure entities.
 *
 * This extends the base storage class, adding required special handling for
 * App structure entities.
 *
 * @ingroup react_app
 */
class AppStructureStorage extends SqlContentEntityStorage implements AppStructureStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(AppStructureInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {app_structure_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {app_structure_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(AppStructureInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {app_structure_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('app_structure_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
