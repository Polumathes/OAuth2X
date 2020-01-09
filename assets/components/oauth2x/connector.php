<?php
/**
* Connector file for OAuth2X extra
*
* Copyright 2019 by Grey Sky Media support@greyskymedia.com
* Created on 01-08-2020
*
 * OAuth2X is free software; You may use or change the software for your own personal
 * or commercial use. However, you may not sell or distribute in whole or in part this software.
 *
 * OAuth2X is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE.
*
* @package oauth2x
*/
/* @var $modx modX */

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$oauth2xCorePath = $modx->getOption('oauth2x.core_path', null, $modx->getOption('core_path') . 'components/oauth2x/');
require_once $oauth2xCorePath . 'model/oauth2x/oauth2x.class.php';
$modx->oauth2x = new OAuth2X($modx);

$modx->lexicon->load('oauth2x:default');

/* handle request */
$path = $modx->getOption('processorsPath', $modx->oauth2x->config, $oauth2xCorePath . 'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));