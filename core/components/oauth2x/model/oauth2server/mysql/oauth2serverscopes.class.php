<?php
/**
 * @package OAuth2X
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/oauth2serverscopes.class.php');
class OAuth2ServerScopes_mysql extends OAuth2ServerScopes {}
?>