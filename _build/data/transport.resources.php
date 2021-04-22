<?php
/**
 * resources transport file for OAuth2X extra
 *
 * Copyright 2019 by Grey Sky Media support@greyskymedia.com
 * Created on 01-08-2020
 *
 * @package oauth2x
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $resources */


$resources = array();

$resources[1] = $modx->newObject('modResource');
$resources[1]->fromArray(array (
  'id' => 1,
  'pagetitle' => 'OAuth2 Token Controller',
  'alias' => 'tokens',
  'template' => 0,
  'content_type' => 7,
  'published' => 1,
  'hidemenu' => 1,
  'cacheable' => 0,
  'richtext' => 0,
  'class_key' => 'modDocument',
  'searchable' => '1',
  'context_key' => 'web',
), '', true, true);
$resources[1]->setContent(file_get_contents($sources['data'].'resources/oauth2_token_controller.content.html'));

$resources[2] = $modx->newObject('modResource');
$resources[2]->fromArray(array (
  'id' => 2,
  'pagetitle' => 'OAuth2 Authorization',
  'alias' => 'auth',
  'template' => 0,
  'published' => 1,
  'hidemenu' => 1,
  'cacheable' => 0,
  'richtext' => 0,
  'class_key' => 'modDocument',
  'searchable' => '1',
  'context_key' => 'web',
), '', true, true);
$resources[2]->setContent(file_get_contents($sources['data'].'resources/oauth2_authorization.content.html'));

$resources[3] = $modx->newObject('modResource');
$resources[3]->fromArray(array (
  'id' => 3,
  'pagetitle' => 'OAuth2 Verification Example',
  'alias' => 'verify',
  'template' => 0,
  'content_type' => 7,
  'published' => 1,
  'hidemenu' => 1,
  'cacheable' => 0,
  'richtext' => 0,
  'class_key' => 'modDocument',
  'searchable' => '1',
  'context_key' => 'web',
), '', true, true);
$resources[3]->setContent(file_get_contents($sources['data'].'resources/oauth2_verification_example.content.html'));

$resources[4] = $modx->newObject('modResource');
$resources[4]->fromArray(array (
    'id' => 4,
    'pagetitle' => 'OAuth2 User Logout',
    'alias' => 'logout',
    'template' => 0,
    'content_type' => 7,
    'published' => 1,
    'hidemenu' => 1,
    'cacheable' => 0,
    'richtext' => 0,
    'class_key' => 'modDocument',
    'searchable' => '1',
    'context_key' => 'web',
), '', true, true);
$resources[4]->setContent(file_get_contents($sources['data'].'resources/oauth2_user_logout.content.html'));

return $resources;
