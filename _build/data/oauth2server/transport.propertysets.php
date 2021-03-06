<?php
/**
 * propertySets transport file for OAuth2X extra
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
/* @var xPDOObject[] $propertySets */


$propertySets = array();

$propertySets[1] = $modx->newObject('modPropertySet');
$propertySets[1]->fromArray(array (
  'id' => 1,
  'name' => 'VerifyOAuth2Context',
  'description' => 'Properties for VerifyOAuth2Context Plugin',
), '', true, true);
return $propertySets;
