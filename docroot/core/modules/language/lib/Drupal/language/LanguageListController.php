<?php
/**
 * @file
 * Contains \Drupal\language\Form\LanguageListController.
 */

namespace Drupal\language;

use Drupal\Core\Config\Entity\DraggableListController;
use Drupal\Core\Entity\EntityInterface;

/**
 * User interface for the language overview screen.
 */
class LanguageListController extends DraggableListController {

  /**
   * {@inheritdoc}
   */
  protected $entitiesKey = 'languages';

  /**
   * {@inheritdoc}
   */
  public function load() {
    $entities = $this->storage->loadByProperties(array('locked' => FALSE));

    // Sort the entities using the entity class's sort() method.
    // See \Drupal\Core\Config\Entity\ConfigEntityBase::sort().
    uasort($entities, array($this->entityType->getClass(), 'sort'));
    return $entities;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'language_admin_overview_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getOperations(EntityInterface $entity) {
    $operations = parent::getOperations($entity);
    $default = language_default();

    // Deleting the site default language is not allowed.
    if ($entity->id() == $default->id) {
      unset($operations['delete']);
    }

    return $operations;
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $this->getLabel($entity);
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $form = parent::buildForm($form, $form_state);
    $form[$this->entitiesKey]['#languages'] = $this->entities;
    $form['actions']['submit']['#value'] = t('Save configuration');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    parent::submitForm($form, $form_state);

    $language_manager = \Drupal::languageManager();
    $language_manager->reset();
    if ($language_manager instanceof ConfigurableLanguageManagerInterface) {
      $language_manager->updateLockedLanguageWeights();
    }

    drupal_set_message(t('Configuration saved.'));
  }

}
