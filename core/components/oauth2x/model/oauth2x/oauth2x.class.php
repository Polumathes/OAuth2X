<?php
/**
 * CMP class file for OAuth2X extra
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


 class OAuth2X {
    /** @var $modx modX */
    public $modx;
    /** @var $props array */
    public $config;

    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;
        $corePath = $modx->getOption('oauth2x.core_path',null,
            $modx->getOption('core_path').'components/oauth2x/');
        $assetsUrl = $modx->getOption('oauth2x.assets_url',null,
            $modx->getOption('assets_url').'components/oauth2x/');

        $this->config = array_merge(array(
            'corePath' => $corePath,
            'chunksPath' => $corePath.'elements/chunks/',
            'modelPath' => $corePath.'model/',
            'processorsPath' => $corePath.'processors/',
            'templatesPath' => $corePath . 'templates/',

            'assetsUrl' => $assetsUrl,
            'connector_url' => $assetsUrl.'connector.php',
            'cssUrl' => $assetsUrl.'css/',
            'jsUrl' => $assetsUrl.'js/',
        ),$config);

        $this->modx->addPackage('oauth2x',$this->config['modelPath']);
        if ($this->modx->lexicon) {
            $this->modx->lexicon->load('oauth2x:default');
        }
    }

    /**
     * Initializes OAuth2X based on a specific context.
     *
     * @access public
     * @param string $ctx The context to initialize in.
     * @return string The processed content.
     */
    public function initialize($ctx = 'mgr') {
        $output = '';
        switch ($ctx) {
            case 'mgr':
                if (!$this->modx->loadClass('oauth2x.request.OAuth2XControllerRequest',
                    $this->config['modelPath'],true,true)) {
                        return 'Could not load controller request handler.';
                }
                $this->request = new OAuth2XControllerRequest($this);
                $output = $this->request->handleRequest();
                break;
        }
        return $output;
    }
}