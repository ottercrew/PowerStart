<?php
/**
 * WordPress Router for PHP Built-in server
 */

$root = $_SERVER['DOCUMENT_ROOT'];
$path = '/'. ltrim( parse_url( urldecode( $_SERVER['REQUEST_URI'] ) )['path'], '/' );

if ( file_exists( $root.$path ) ) {
	if ( is_dir( $root.$path ) && substr( $path, -1 ) !== '/' ) {
		header( "Location: $path/" );
		exit;
	}

	if ( strpos( $path, '.php' ) !== false ) {
		chdir( dirname( $root.$path ) );
		require_once $root.$path;
	} else {
		return false;
	}
} else {
	chdir( $root );
	require_once 'index.php';
}