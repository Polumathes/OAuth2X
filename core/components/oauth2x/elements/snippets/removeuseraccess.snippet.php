<?php
/**
 * Logout a user by removing their access token.
 */

//responses
$successResponse = $modx->lexicon('OAuth2x.logout_success');
$failureResponse = $modx->lexicon('OAuth2x.logout_failure');
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

$token = $server->getAccessTokenData($request);

$tokenobj = $modx->getObject('OAuth2ServerAccessTokens',array('access_token' => $token['access_token']));
if(!empty($tokenobj)){
    $tokenobj->remove();
    return $successResponse; //'Logged out';
} else {
    return $failureResponse; //'Token not found';
}
return;