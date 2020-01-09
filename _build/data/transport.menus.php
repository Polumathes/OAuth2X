<?php
/**
 * menus transport file for OAuth2X extra
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
/* @var xPDOObject[] $menus */


$menus[1] = $modx->newObject('modMenu');
$menus[1]->fromArray( array (
  'text' => 'oauth2server.menu.manage',
  'parent' => 'components',
  'description' => 'oauth2server.menu.manage_desc',
  'icon' => '',
  'menuindex' => 0,
  'params' => '',
  'handler' => '',
  'permissions' => '',
  'action' => 'manage',
  'namespace' => 'oauth2server',
  'id' => 1,
), '', true, true);

return $menus;
