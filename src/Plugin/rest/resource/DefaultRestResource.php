<?php

namespace Drupal\custom_site_information\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Drupal\node\Entity\Node;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "default_rest_resource",
 *   label = @Translation("Default rest resource"),
 *   uri_paths = {
 *     "canonical" = "/custom-api/node/{sitekey}/{id}"
 *   }
 * )
 */
class DefaultRestResource extends ResourceBase {

  /**
   * Responds to GET requests.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity object.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The HTTP response object.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get($sitekey = NULL, $id = NULL) {

    $savedsitekey = \Drupal::config('system.site')->get('siteapikey');
    $node = Node::load($id);
    $type_name = $node->type->entity->label();
    if ($savedsitekey == $sitekey && $type_name == "Basic page") {
      //$response = ['message' => 'Hello, this is a rest service and parameter is: ' . $sitekey . " and " . $type_name];
      return new ResourceResponse($node, 200);
    }
    else {
      throw new AccessDeniedHttpException("Access Denied.");
    }
  }

}
