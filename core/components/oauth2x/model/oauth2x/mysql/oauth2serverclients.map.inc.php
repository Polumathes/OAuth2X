<?php
/**
 * @package OAuth2X
 */
$xpdo_meta_map['OAuth2ServerClients']= array (
  'package' => 'OAuth2X',
  'version' => '0.1',
  'table' => 'oauth2server_clients',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'client_id' => '',
    'client_secret' => NULL,
    'domain_id'=> '',
    'base_url'=> '',
    'login_url'=> '',
    'redirect_uri' => '',
    'token_controller_url' => '',
    'authorize_url' => '',
    'grant_types' => NULL,
    'scope' => NULL,
    'user_id' => NULL,
    'is_primary' => 'No'
  ),
  'fieldMeta' => 
  array (
    'client_id' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '80',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'pk',
    ),
    'client_secret' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '80',
      'phptype' => 'string',
    ),
    'domain_id' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
    ),
    'base_url' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
    ),
    'login_url' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
    ),
    'redirect_uri' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '2000',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'token_controller_url' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'authorize_url' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'grant_types' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '80',
      'phptype' => 'string',
    ),
    'scope' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
    ),
    'user_id' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '80',
      'phptype' => 'string',
    ),

   'is_primary' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'default' => 'No',

    ),
  ),
);
