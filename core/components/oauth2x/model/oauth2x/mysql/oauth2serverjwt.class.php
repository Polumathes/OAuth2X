<?php
/**
 * @package OAuth2X
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/oauth2serverjwt.class.php');
class OAuth2ServerJwt_mysql extends OAuth2ServerJwt {}
?>