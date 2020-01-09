<?php
/**
 * @package OAuth2X
 */
$xpdo_meta_map['OAuth2ServerRefreshTokens']= array (
  'package' => 'OAuth2X',
  'version' => '0.1',
  'table' => 'oauth2server_refresh_tokens',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'refresh_token' => '',
    'client_id' => '',
    'user_id' => NULL,
    'expires' => 'CURRENT_TIMESTAMP',
    'scope' => NULL,
  ),
  'fieldMeta' => 
  array (
    'refresh_token' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '40',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'pk',
    ),
    'client_id' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '80',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'user_id' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
    ),
    'expires' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'null' => false,
      'default' => 'CURRENT_TIMESTAMP',
      'attributes' => 'ON UPDATE CURRENT_TIMESTAMP',
    ),
    'scope' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '2000',
      'phptype' => 'string',
    ),
  ),
);
