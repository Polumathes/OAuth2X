<?php
/**
 * Resolver for OAuth2X extra
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
 * @package oauth2x
 * @subpackage build
 */

/* @var $object xPDOObject */
/* @var $modx modX */

/* @var array $options */

if ($object->xpdo) {
    $modx =& $object->xpdo;
    $modelPath = $modx->getOption('core_path').'components/oauth2x/model/';
    $modx->addPackage('oauth2x',$modelPath);
    $manager = $modx->getManager();
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $manager->createObjectContainer('OAuth2ServerClients');
            $manager->createObjectContainer('OAuth2ServerAccessTokens');
            $manager->createObjectContainer('OAuth2ServerAuthorizationCodes');
            $manager->createObjectContainer('OAuth2ServerRefreshTokens');
            $manager->createObjectContainer('OAuth2ServerScopes');
            $manager->createObjectContainer('OAuth2ServerJwt');
            break;

        case xPDOTransport::ACTION_UPGRADE:
            $manager->addField('OAuth2ServerClients','domain_id');
            $manager->addField('OAuth2ServerClients','base_url');
            $manager->addField('OAuth2ServerClients','login_url');
            $manager->addField('OAuth2ServerClients','authorize_url');
            $manager->addField('OAuth2ServerClients','token_controller_url');
            $manager->addField('OAuth2ServerClients','is_primary');

            $modx->cacheManager->refresh(array(
                'lexicon_topics' => array(
                    'lexicon' => array(
                        array(
                            'en' => ['default']
                        )))));
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}

return true;