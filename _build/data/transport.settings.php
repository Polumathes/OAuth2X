<?php
/**
 * systemSettings transport file for OAuth2X extra
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
/* @var xPDOObject[] $systemSettings */


$systemSettings = array();

$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1]->fromArray(array (
  'key' => 'oauth2server.enabled',
  'name' => 'OAuth2Server Enabled',
  'description' => 'Enable OAuth2 services',
  'namespace' => 'oauth2server',
  'xtype' => 'combo-boolean',
  'value' => '1',
  'area' => '',
), '', true, true);
return $systemSettings;
