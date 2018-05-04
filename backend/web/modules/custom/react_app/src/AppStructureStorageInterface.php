<?php

namespace Drupal\react_app;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface AppStructureStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of App structure revision IDs for a specific App structure.
   *
   * @param \Drupal\react_app\Entity\AppStructureInterface $entity
   *   The App structure entity.
   *
   * @return int[]
   *   App structure revision IDs (in ascending order).
   */
  public function revisionIds(AppStructureInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as App structure author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   App structure revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\react_app\Entity\AppStructureInterface $entity
   *   The App structure entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(AppStructureInterface $entity);

  /**
   * Unsets the language for all App structure with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
