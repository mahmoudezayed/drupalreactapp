<?php

namespace Drupal\react_app\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DefaultForm.
 */
class DefaultForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'react_app.default',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'default_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('react_app.default');
    $form['basic_information'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Basic Information'),
      '#description' => $this->t('App basic information'),
    ];
    $form['service_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Service Url'),
      '#maxlength' => 255,
      '#size' => 255,
      '#default_value' => $config->get('service_url'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('react_app.default')
      ->set('basic_information', $form_state->getValue('basic_information'))
      ->set('service_url', $form_state->getValue('service_url'))
      ->save();
  }

}
