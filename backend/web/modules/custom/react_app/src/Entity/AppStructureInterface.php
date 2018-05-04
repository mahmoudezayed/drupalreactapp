<?php

namespace Drupal\react_app\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining App structure entities.
 *
 * @ingroup react_app
 */
interface AppStructureInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the App structure name.
   *
   * @return string
   *   Name of the App structure.
   */
  public function getName();

  /**
   * Sets the App structure name.
   *
   * @param string $name
   *   The App structure name.
   *
   * @return \Drupal\react_app\Entity\AppStructureInterface
   *   The called App structure entity.
   */
  public function setName($name);

  /**
   * Gets the App structure creation timestamp.
   *
   * @return int
   *   Creation timestamp of the App structure.
   */
  public function getCreatedTime();

  /**
   * Sets the App structure creation timestamp.
   *
   * @param int $timestamp
   *   The App structure creation timestamp.
   *
   * @return \Drupal\react_app\Entity\AppStructureInterface
   *   The called App structure entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the App structure published status indicator.
   *
   * Unpublished App structure are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the App structure is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a App structure.
   *
   * @param bool $published
   *   TRUE to set this App structure to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\react_app\Entity\AppStructureInterface
   *   The called App structure entity.
   */
  public function setPublished($published);

  /**
   * Gets the App structure revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the App structure revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\react_app\Entity\AppStructureInterface
   *   The called App structure entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the App structure revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the App structure revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\react_app\Entity\AppStructureInterface
   *   The called App structure entity.
   */
  public function setRevisionUserId($uid);

}
