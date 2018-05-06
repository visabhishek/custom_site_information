<?php

namespace Drupal\custom_site_information\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

/**
 * Class DefaultForm.
 */
class DefaultForm extends SiteInformationForm {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'system.site',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'system_site_information_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Retrieve the system.site configuration
    $config = $this->config('system.site');

    // Get the original form from the class we are extending
    $form = parent::buildForm($form, $form_state);
    $form['custom_settings'] = [
      '#type' => 'details',
      '#title' => t('Custom Settings'),
      '#open' => TRUE,
    ];
    $form['custom_settings']['siteapikey'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site API Key'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => ($config->get('siteapikey')) ?: $this->t('No API Key yet'),
      '#description' => $this->t('Here we can add Site API Key.'),
    ];
    $form['actions']['submit']['#value'] = $this->t('Update Configuration');

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    // We can write validation function here if we have to validate our API Key.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    if (trim($form_state->getValue('siteapikey')) !== 'No API Key yet') {
      $this->config('system.site')
          ->set('siteapikey', $form_state->getValue('siteapikey'))
          ->save();
      if (empty($form_state->getValue('siteapikey'))) {
        drupal_set_message($this->t('Your Site API Key is deleted seccessfully'));
      }
      else {
        drupal_set_message($this->t('Your Site API Key is submitted seccessfully : @sitekey', array('@sitekey' => $form_state->getValue('siteapikey'))));
      }
    }
  }

}
