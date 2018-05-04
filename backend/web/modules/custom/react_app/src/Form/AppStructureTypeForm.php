<?php

namespace Drupal\react_app\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AppStructureTypeForm.
 */
class AppStructureTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $app_structure_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $app_structure_type->label(),
      '#description' => $this->t("Label for the App structure type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $app_structure_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\react_app\Entity\AppStructureType::load',
      ],
      '#disabled' => !$app_structure_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $app_structure_type = $this->entity;
    $status = $app_structure_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label App structure type.', [
          '%label' => $app_structure_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label App structure type.', [
          '%label' => $app_structure_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($app_structure_type->toUrl('collection'));
  }

}
