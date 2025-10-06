<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

$wgSitename = "Resonite Wiki";
$wgMetaNamespace = "Resonite_Wiki";
$wgUsePrivateIPs = true;

## The URL paths to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogos = [
	'1x' => "/images/8/8f/Resonite_Wiki-Logo1x.png",
	'icon' => "/images/1/11/Resonite_Wiki-Icon.png",
];

?>