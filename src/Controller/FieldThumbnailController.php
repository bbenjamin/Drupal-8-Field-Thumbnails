<?php

namespace Drupal\field_thumbnail\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Utility\Xss;

/**
 * Class FieldThumbnailController.
 */
class FieldThumbnailController extends ControllerBase {

  /**
   * Fieldthumbmake.
   *
   * @return array
   *
   */

  public function fieldThumbMake($fid) {
    $return = [];
    $field_config =  \Drupal::entityTypeManager()->getStorage('field_config')->load($fid);
    $title = $field_config->label();
    $thumb_fid = $field_config->getThirdPartySetting('field_thumbnail', 'field_config_thumbnail');
    $thumb_desc = $field_config->getThirdPartySetting('field_thumbnail', 'field_config_thumbnail_description');
    $field_description = $field_config->getDescription();

    $file = \Drupal\file\Entity\File::load($thumb_fid[0]);

    if($file) {
      $return['thumb_image'] = [
        '#theme' => 'image_style',
        '#uri' => $file->getFileUri(),
        '#style_name' => 'max_650x650',
        '#alt' => t('Preview Field: @field', ['@field' => $title]),
        '#title' => t('Preview Field: @field', ['@field' => $title]),
      ];
    }

    if(!empty($thumb_desc)) {
      $return['thumb_description'] = [
        '#markup' => Xss::filter($thumb_desc),
        '#prefix' => '<p><b>',
        '#suffix' => '</b></p>'
      ];
    }

    if(!empty($field_description)) {
      $return['field_description'] = [
        '#markup' => $field_description,
        '#prefix' => '<p><i>',
        '#suffix' => '</i></p>'
      ];
    }

    if(!empty($return)) {
      return $return;
    } else {
      return [
        '#type' => 'markup',
        '#markup' => t('there was a problem retrieving the field data')
      ];
    }
  }

  public function title($fid){
    $field_config =  \Drupal::entityTypeManager()->getStorage('field_config')->load($fid);
    return t('Preview: @field', ['@field' => $field_config->label()]);
  }
}
