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
$systemSettings[2] = $modx->newObject('modSystemSetting');
$systemSettings[2]->fromArray(array (
    'key' => 'authorizeUrl',
    'name' => 'Authorize URL',
    'description' => 'OAuth2X Authorize URL',
    'namespace' => 'oauth2x',
    'xtype' => 'textfield',
    'value' => '',
    'area' => '',
), '', true, true);
$systemSettings[3] = $modx->newObject('modSystemSetting');
$systemSettings[3]->fromArray(array (
    'key' => 'oauth2server_login_context',
    'name' => 'Login Context',
    'description' => 'OAuth2X Login Context',
    'namespace' => 'oauth2x',
    'xtype' => 'modx-combo-context',
    'value' => '',
    'area' => '',
), '', true, true);
$systemSettings[4] = $modx->newObject('modSystemSetting');
$systemSettings[4]->fromArray(array (
    'key' => 'tokenControllerUrl',
    'name' => 'Token Controller URL',
    'description' => 'Token Controller URL',
    'namespace' => 'oauth2x',
    'xtype' => 'textfield',
    'value' => '',
    'area' => '',
), '', true, true);
return $systemSettings;
