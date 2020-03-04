<?php
/**
 * Default English Lexicon Entries for OAuth2X
 *
 * @package OAuth2X
 * @subpackage lexicon
 */

$_lang['oauth2server'] = 'oauth2server';

$_lang['oauth2server.menu.manage'] = 'OAuth2Server';
$_lang['oauth2server.menu.manage_desc'] = 'Manage OAuth2 Clients and Tokens';

$_lang['oauth2server.global.search'] = 'Search';
$_lang['oauth2server.global.clear_filters'] = 'Clear Filters';


/* CLIENTS */
$_lang['oauth2server.clients.clients'] = 'Client';
$_lang['oauth2server.clients.intro_msg'] = 'Manage Clients here.';

$_lang['oauth2server.clients.client_id'] = 'Client ID';
$_lang['oauth2server.clients.client_secret'] = 'Client Secret';
$_lang['oauth2server.clients.domain_id'] = 'Domain ID';
$_lang['oauth2server.clients.base_url']  = 'Base URI';
$_lang['oauth2server.clients.login_url'] = 'Login URI';
$_lang['oauth2server.clients.is_primary'] = 'Is Primary Server';
$_lang['oauth2server.clients.token_controller_url'] = 'Token URI';
$_lang['oauth2server.clients.authorize_url'] = 'Authorize URI';


$_lang['oauth2server.clients.redirect_uri'] = 'Redirect URI';
$_lang['oauth2server.clients.grant_types'] = 'Grant Types';
$_lang['oauth2server.clients.scope'] = 'Scope';
$_lang['oauth2server.clients.user_id'] = 'User ID';
$_lang['oauth2server.clients.add'] = 'Add Client';
$_lang['oauth2server.clients.update'] = 'Update Client';
$_lang['oauth2server.clients.duplicate'] = 'Duplicate Client';
$_lang['oauth2server.clients.remove'] = 'Remove Client';
$_lang['oauth2server.clients.remove_confirm'] = 'Are you sure you want to remove this Client?';


/* ACCESS TOKENS */
$_lang['oauth2server.access_tokens.access_tokens'] = 'Access Tokens';
$_lang['oauth2server.access_tokens.intro_msg'] = 'Manage Access Tokens here.';

$_lang['oauth2server.access_tokens.client_id'] = 'Client ID';
$_lang['oauth2server.access_tokens.access_token'] = 'Access Token';
$_lang['oauth2server.access_tokens.expires'] = 'Expires';
$_lang['oauth2server.access_tokens.scope'] = 'Scope';
$_lang['oauth2server.access_tokens.user_id'] = 'User ID';
$_lang['oauth2server.access_tokens.remove'] = 'Remove Access Token';
$_lang['oauth2server.access_tokens.remove_confirm'] = 'Are you sure you want to remove this Access Token?';


/* REFRESH TOKENS */
$_lang['oauth2server.refresh_tokens.refresh_tokens'] = 'Refresh Tokens';
$_lang['oauth2server.refresh_tokens.intro_msg'] = 'Manage Refresh Tokens here.';

$_lang['oauth2server.refresh_tokens.client_id'] = 'Client ID';
$_lang['oauth2server.refresh_tokens.refresh_token'] = 'Refresh Token';
$_lang['oauth2server.refresh_tokens.expires'] = 'Expires';
$_lang['oauth2server.refresh_tokens.scope'] = 'Scope';
$_lang['oauth2server.refresh_tokens.user_id'] = 'User ID';
$_lang['oauth2server.refresh_tokens.remove'] = 'Remove Refresh Token';
$_lang['oauth2server.refresh_tokens.remove_confirm'] = 'Are you sure you want to remove this Refresh Token?';


/* ERRORS */
$_lang['oauth2server.err.clients.client_id_empty'] = 'Client ID is required.';
$_lang['oauth2server.err.clients.client_id_exists'] = 'Please select a unique Client ID';
$_lang['oauth2server.clients_err_nfs'] = 'Error saving. Cannot change client_id on update.';
$_lang['oauth2server.clients_err_ns'] = 'Error saving. Ensure client_id is not empty.';
$_lang['oauth2server.err.clients.redirect_uri_empty'] = 'Redirect URI is required.';
$_lang['oauth2server.err.clients.login_url_empty'] = 'Login URI is required.';
$_lang['oauth2server.err.clients.site_url_empty'] = 'Site URI is required.';
$_lang['oauth2server.err.clients.primary_server_exist'] = 'Another one is alreay set as primary server.Please change it first';
$_lang['oauth2server.err.clients.token_controller_uri_empty'] = 'Token URI required';
$_lang['oauth2server.err.clients.authorize_uri_empty'] = 'Authorize URI required';
                              
$_lang['oauth2server.err.item_name_ae'] = 'An Item already exists with that name.';
$_lang['oauth2server.err.item_nf'] = 'Item not found.';
$_lang['oauth2server.err.item_name_ns'] = 'Name is not specified.';
$_lang['oauth2server.err.item_remove'] = 'An error occurred while trying to remove the Item.';
$_lang['oauth2server.err.item_save'] = 'An error occurred while trying to save the Item.';


$_lang['OAuth2x.logout_success'] = 'Logged Out';
$_lang['OAuth2x.logout_failure'] = 'Token not found';