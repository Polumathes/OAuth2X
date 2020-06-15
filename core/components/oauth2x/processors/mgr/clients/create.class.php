<?php
/**
 * Create an OAuth2Server Client
 * 
 * @package OAuth2Server
 * @subpackage processors
 */
 
class OAuth2ServerClientsCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'OAuth2ServerClients';
    public $languageTopics = array('oauth2server:default');
    public $primaryKeyField = 'client_id';
    public $objectType = 'oauth2server.clients';
    public $primaryServerId;
    /** @var OAuth2ServerClients */
    public $object;

    public function beforeSet() {
    
        $clientId = $this->getProperty('client_id');
        if (empty($clientId)) {
            $this->addFieldError('client_id', $this->modx->lexicon('oauth2server.err.clients.client_id_empty'));
        } 
        
        $exists = $this->modx->getCount('OAuth2ServerClients', array('client_id' => $clientId));
        if ($exists > 0) {
            $this->addFieldError('client_id', $this->modx->lexicon('oauth2server.err.clients.client_id_exists'));
        }
        
        $clientSecret = $this->getProperty('client_secret');
        if (empty($clientSecret)) {
            $bytes = openssl_random_pseudo_bytes(20);
            $hex   = bin2hex($bytes);
            $this->setProperty('client_secret', $hex);
        }
        
        $clientLoginUrl = $this->getProperty('login_url');
        if (empty($clientLoginUrl)) {
            $this->addFieldError('login_url', $this->modx->lexicon('oauth2server.err.clients.login_url_empty'));
        } 
        
        $clientSiteUrl = $this->getProperty('base_url');
        if (empty($clientSiteUrl)) {
            $this->addFieldError('base_url', $this->modx->lexicon('oauth2server.err.clients.site_url_empty'));
        } 

        $redirectUri = $this->getProperty('redirect_uri');
        if (empty($redirectUri)) {
            $this->addFieldError('redirect_uri', $this->modx->lexicon('oauth2server.err.clients.redirect_uri_empty'));
        }
        $tokenControllerUrl = $this->getProperty('token_controller_url');
        if (empty($tokenControllerUrl)) {
            $this->addFieldError('token_controller_url', $this->modx->lexicon('oauth2server.err.clients.token_controller_uri_empty'));
        }
        $authorizeUrl = $this->getProperty('authorize_url');
        if (empty($authorizeUrl)) {
            $this->addFieldError('authorize_url', $this->modx->lexicon('oauth2server.err.clients.authorize_uri_empty'));
        }
        
        // $isprimary = $this->getProperty('is_primary');
        // if($isprimary == 'Yes'){
        //     $primaryExists = $this->modx->getCount('OAuth2ServerClients', array('is_primary' => 'Yes'));
        //     if($primaryExists > 0) {
        //         $this->addFieldError('is_primary', $this->modx->lexicon('oauth2server.err.clients.primary_server_exist'));
        //     }    
        // }

        $grantTypes = $this->getProperty('grant_types');
        if (empty($grantTypes)) {
            $this->setProperty('grant_types', NULL);
        }
        
        $scope = $this->getProperty('scope');
        if (empty($scope)) {
            $this->setProperty('scope', NULL);
        }

        $domainId = $this->getProperty('domain_id');
        if(empty($domainId)){
            $domainIdVal = $this->random_strings(10);
           // $this->setProperty('is_primary','Yes');
        }else{
            $domainIdVal = $domainId;
           // $this->setProperty('is_primary','No');
        }
        $this->setProperty('domain_id', $domainIdVal);

        $isPrimary = $this->getProperty('is_primary');

        if($isPrimary){
            $this->setProperty('is_primary', 'Yes');
        }else{
            $this->setProperty('is_primary', 'No');
        }

        $userId   = $this->getProperty('user_id');
        $modxUser = $this->modx->user->get('id');
        if (empty($userId)) {

            $this->setProperty('user_id', $modxUser);

        }
        
        return parent::beforeSet();
    }
    /*
    public function saveObject()
    {
        $is_primary = $this->getProperty('is_primary');
        if($is_primary == 'Yes'){
            $primaryServer  = $this->modx->getObject('OAuth2ServerClients', array('is_primary' => 'Yes'));
            if(!empty($primaryServer)){
           $currentPrimaryRedirectUri =  $primaryServer->get('redirect_uri'); 
           $secServers  = $this->modx->getObject('OAuth2ServerClients', array('is_primary' => 'No'));
           foreach($secServers as $secServer){

            
           }
            }    
        }
        return parent::saveObject();
    }
    */
    public function afterSave()
    {
        /** @var xPDOFileCache $provider */
        $provider = $this->modx->cacheManager->getCacheProvider('oauth2server');
        $provider->flush();

        return parent::afterSave();
    }
    
    public function process() 
    {
        /* Run the beforeSet method before setting the fields, and allow stoppage */
        $canSave = $this->beforeSet();
        if ($canSave !== true) {
            return $this->failure($canSave);
        }
        $this->object->fromArray($this->getProperties(), '', true);
        /* run the before save logic */
        $canSave = $this->beforeSave();
        if ($canSave !== true) {
            return $this->failure($canSave);
        }
        /* run object validation */
        if (!$this->object->validate()) {
            /** @var modValidator $validator */
            $validator = $this->object->getValidator();
            if ($validator->hasMessages()) {
                foreach ($validator->getMessages() as $message) {
                    $this->addFieldError($message['field'],$this->modx->lexicon($message['message']));
                }
            }
        }
        $preventSave = $this->fireBeforeSaveEvent();
        if (!empty($preventSave)) {
            return $this->failure($preventSave);
        }
        /* save element */
        if ($this->saveObject() == false) {
            $this->modx->error->checkValidation($this->object);
            return $this->failure($this->modx->lexicon($this->objectType.'_err_save'));
        }
        $this->afterSave();
        $this->fireAfterSaveEvent();
        $this->logManagerAction();
        return $this->cleanup();
    }
    public function random_strings($length_of_string) 
    { 
        // String of all alphanumeric character 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
        // Shufle the $str_result and returns substring 
        // of specified length 
        return substr(str_shuffle($str_result),0,$length_of_string);   

    } 
    
}
return 'OAuth2ServerClientsCreateProcessor';
