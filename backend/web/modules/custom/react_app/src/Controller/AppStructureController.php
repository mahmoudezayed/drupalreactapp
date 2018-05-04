<?php

namespace Drupal\react_app\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\react_app\Entity\AppStructureInterface;

/**
 * Class AppStructureController.
 *
 *  Returns responses for App structure routes.
 */
class AppStructureController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a App structure  revision.
   *
   * @param int $app_structure_revision
   *   The App structure  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($app_structure_revision) {
    $app_structure = $this->entityManager()->getStorage('app_structure')->loadRevision($app_structure_revision);
    $view_builder = $this->entityManager()->getViewBuilder('app_structure');

    return $view_builder->view($app_structure);
  }

  /**
   * Page title callback for a App structure  revision.
   *
   * @param int $app_structure_revision
   *   The App structure  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($app_structure_revision) {
    $app_structure = $this->entityManager()->getStorage('app_structure')->loadRevision($app_structure_revision);
    return $this->t('Revision of %title from %date', ['%title' => $app_structure->label(), '%date' => format_date($app_structure->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a App structure .
   *
   * @param \Drupal\react_app\Entity\AppStructureInterface $app_structure
   *   A App structure  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(AppStructureInterface $app_structure) {
    $account = $this->currentUser();
    $langcode = $app_structure->language()->getId();
    $langname = $app_structure->language()->getName();
    $languages = $app_structure->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $app_structure_storage = $this->entityManager()->getStorage('app_structure');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $app_structure->label()]) : $this->t('Revisions for %title', ['%title' => $app_structure->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all app structure revisions") || $account->hasPermission('administer app structure entities')));
    $delete_permission = (($account->hasPermission("delete all app structure revisions") || $account->hasPermission('administer app structure entities')));

    $rows = [];

    $vids = $app_structure_storage->revisionIds($app_structure);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\react_app\AppStructureInterface $revision */
      $revision = $app_structure_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $app_structure->getRevisionId()) {
          $link = $this->l($date, new Url('entity.app_structure.revision', ['app_structure' => $app_structure->id(), 'app_structure_revision' => $vid]));
        }
        else {
          $link = $app_structure->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => Url::fromRoute('entity.app_structure.revision_revert', ['app_structure' => $app_structure->id(), 'app_structure_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.app_structure.revision_delete', ['app_structure' => $app_structure->id(), 'app_structure_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['app_structure_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
