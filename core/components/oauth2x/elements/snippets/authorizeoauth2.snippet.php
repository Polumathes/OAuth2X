<?php
/**
 * authorizeOAuth2
 *
 * OAuth2 Authorization endpoint for MODX
 * Filters requests on the User's MODX User Group Membership,
 * but also exposes the Manager URL for login! Recommended:
 * call this snippet in a Login snippet logoutTpl to implement
 * custom login page.
 *
 * @package OAuth2Server
 * @author @sepiariver <yj@modx.com>
 * Copyright 2015 by YJ Tso
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 **/

/**
 * @param int $userauth Set to 1 if using UserCredential grant type.
 */
/*
 * Only for authorization code grand type
 */
$is_app =  $_REQUEST['is_app'];

if($_REQUEST['response_type']=='code'){

    $urldata      = explode('-gsmsaas-',base64_decode($_REQUEST['entrystate'],true));
    // 'login_context' => $modx->getOption('oauth2server_login_context',null,'web'),
    //TODO :pass the context in url and check the user have permission for the context
    $context = $domain = $urldata[2];
    $status  = $urldata[3];
    $urldatastg = !empty($status )?'&is_default='.$status:'';
    $properties   = array(
        'login_context' => 'web',
        'add_contexts'  => '',
        'username'      =>  $urldata[0],
        'password'      =>  $urldata[1],
        'returnUrl'     => '',
        'rememberme'    => ''
    );
    $response = $modx->runProcessor('security/login', $properties);
    if($response->isError()) {
        return $response->getMessage();
    }
}
$user_id = '';
$user = $modx->getUser();

if( $user->get('id')){

    $userauth = 0;
    $user_id  = $user->get('id');
    $profile  = $user->getOne('Profile');
    if (!$profile) return '';
    $user_email = $profile->get('email');
}
if(!$userauth){

    // Check User TODO: best way to handle manager login without exposing manager_url?
    if (!$modx->user) {
        $modx->sendRedirect($modx->getOption('manager_url'));
    }
    ////if(!$modx->user->isMember('Administrator')) return 'Only Administrators can authorize OAuth2 requests.';
    // Options
    $authTpl = $modx->getOption('authTpl', $scriptProperties, 'oauth2server_auth_tpl');
    $authKey = $modx->getOption('authKey', $scriptProperties, 'authorize');
}

// Paths
$oauth2Path = $modx->getOption('oauth2x.core_path', null, $modx->getOption('core_path') . 'components/oauth2x/');
$oauth2Path .= 'model/oauth2x/';

// Get Class
if (file_exists($oauth2Path . 'oauth2server.class.php')) $oauth2 = $modx->getService('oauth2server', 'OAuth2Server', $oauth2Path, $scriptProperties);
if (!($oauth2 instanceof OAuth2Server)) {

    $modx->log(modX::LOG_LEVEL_ERROR, '[authorizeOAuth2] could not load the required class!');
    return;
}

// We need these
$server = $oauth2->createServer();
$request = $oauth2->createRequest();
$response = $oauth2->createResponse();
if (!$server || !$request || !$response) {

    $modx->log(modX::LOG_LEVEL_WARN, '[verifyOAuth2]: could not create the required OAuth2 Server objects.');
    return;

}

// Validate the authorization request

if (!$server->validateAuthorizeRequest($request, $response)) {
    return 'The authorization request was invalid.';
}

// Display an authorization form
$post = modX::sanitize($_POST, $modx->sanitizePatterns);
//if($is_app == true){$is_authorized =true;
//}else{
    if (empty($post) && !$userauth) {
        return $modx->getChunk($authTpl, array('auth_key' => $authKey));
    }
    // Redirect to stored redirect_uri for this client, if authorized
    $is_authorized = $userauth ? true : ($post[$authKey] === 'yes');
//}
$server->handleAuthorizeRequest($request, $response, $is_authorized,$user_id);

//For identifying the domain
if(!empty($domain)){

    $headerWithDomain = $response->getHttpHeaders()['Location']."&email=".base64_encode($domain.'-gsmsaas-'.$user_email).$urldatastg ;
    $response->setHttpHeaders(array('Location'=>$headerWithDomain));
}
if($is_app == true)return json_encode($response->getHttpHeaders());

$response->send();