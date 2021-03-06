<?php
/**
 * Update a OAuth2Server Client
 * 
 * @package OAuth2Server
 * @subpackage processors
 */

class OAuth2ServerClientsUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'OAuth2ServerClients';
    public $languageTopics = array('oauth2server:default');
    public $primaryKeyField = 'client_id';
    public $objectType = 'oauth2server.clients';
    /** @var OAuth2ServerClients */
    public $object;
        
    public function beforeSet() {

        $clientId = $this->getProperty('client_id');
        if (empty($clientId)) {
            $this->addFieldError('client_id', $this->modx->lexicon('oauth2server.err.clients.client_id_empty'));
        }
        
        $clientSecret = $this->getProperty('client_secret');
        if (empty($clientSecret)) {
            $bytes = openssl_random_pseudo_bytes(20);
            $hex   = bin2hex($bytes);
            $this->setProperty('client_secret', $hex);
        }
        
        $redirectUri = $this->getProperty('redirect_uri');
        if (empty($redirectUri)) {
            $this->addFieldError('redirect_uri', $this->modx->lexicon('oauth2server.err.clients.redirect_uri_empty'));
        }
        
        $grantTypes = $this->getProperty('grant_types');
        if (empty($grantTypes)) {
            $this->setProperty('grant_types', NULL);
        }
        
        $scope = $this->getProperty('scope');
        if (empty($scope)) {
            $this->setProperty('scope', NULL);
        }
        $tokenControllerUrl = $this->getProperty('token_controller_url');
        if (empty($tokenControllerUrl)) {
            $this->addFieldError('token_controller_url', $this->modx->lexicon('oauth2server.err.clients.token_controller_uri_empty'));
        }
        $authorizeUrl = $this->getProperty('authorize_url');
        if (empty($authorizeUrl)) {
            $this->addFieldError('authorize_url', $this->modx->lexicon('oauth2server.err.clients.authorize_uri_empty'));
        }

        $isPrimary = $this->getProperty('is_primary');

        if($isPrimary){
            $this->setProperty('is_primary', 'Yes');
        }else{
            $this->setProperty('is_primary', 'No');
        }
        
        return parent::beforeSet();
        
    }

    public function afterSave()
    {
        /** @var xPDOFileCache $provider */
        $provider = $this->modx->cacheManager->getCacheProvider('oauth2server');
        $provider->flush();

        return parent::afterSave();
    }
    function random_strings($length_of_string) 
    { 
        // String of all alphanumeric character 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
        // Shufle the $str_result and returns substring 
        // of specified length 
        return substr(str_shuffle($str_result),0,$length_of_string);   

    } 
    
}
return 'OAuth2ServerClientsUpdateProcessor';
