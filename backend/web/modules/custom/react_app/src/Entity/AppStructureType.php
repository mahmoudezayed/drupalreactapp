<?php

namespace Drupal\react_app\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the App structure type entity.
 *
 * @ConfigEntityType(
 *   id = "app_structure_type",
 *   label = @Translation("App structure type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\react_app\AppStructureTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\react_app\Form\AppStructureTypeForm",
 *       "edit" = "Drupal\react_app\Form\AppStructureTypeForm",
 *       "delete" = "Drupal\react_app\Form\AppStructureTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\react_app\AppStructureTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "app_structure_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "app_structure",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/app_structure_type/{app_structure_type}",
 *     "add-form" = "/admin/structure/app_structure_type/add",
 *     "edit-form" = "/admin/structure/app_structure_type/{app_structure_type}/edit",
 *     "delete-form" = "/admin/structure/app_structure_type/{app_structure_type}/delete",
 *     "collection" = "/admin/structure/app_structure_type"
 *   }
 * )
 */
class AppStructureType extends ConfigEntityBundleBase implements AppStructureTypeInterface {

  /**
   * The App structure type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The App structure type label.
   *
   * @var string
   */
  protected $label;

}
