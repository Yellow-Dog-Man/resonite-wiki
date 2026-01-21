<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

# Enabled skins.
wfLoadSkin( 'Vector' );
wfLoadSkin( 'Citizen' );

## Default skin: you can change the default skin. Use the internal symbolic
## names, e.g. 'vector' or 'monobook':
$wgDefaultSkin = "citizen";

// Default skin to dark mode
$wgCitizenThemeDefault = 'dark';

$wgCitizenEnableCommandPalette = true;
$wgCitizenHeaderPosition = 'left';
$wgCitizenEnableCollapsibleSections = true;

$wgCitizenSearchGateway = 'mwRestApi';

$wgSitename = "Resonite Wiki";
$wgMetaNamespace = "Resonite_Wiki";
$wgUsePrivateIPs = true;

$prefix = $finalCDNURL;

## The URL paths to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogos = [
	'1x' => "$prefix/8/8f/Resonite_Wiki-Logo1x.png",
	'icon' => "$prefix/1/11/Resonite_Wiki-Icon.png",
];



?>