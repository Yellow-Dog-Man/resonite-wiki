<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

# Enabled skins.
wfLoadSkin( 'Vector' );
wfLoadSkin( 'Citizen' );

## Default skin: you can change the default skin. Use the internal symbolic
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

// See: https://www.mediawiki.org/wiki/Manual:Footer

// $skin->msg( 'test-page' )->inContentLanguage()->text() # some sort of I18N, todo.

use MediaWiki\Html\Html;
use MediaWiki\Title\Title;

function createExternalLink(string $href, string $text) {
	return Html::rawElement( 'a', 
		[
			'href' => $href,
			'rel' => 'noreferrer noopener'
		], 
		$text
	);
}

function createInternalLink(string $page, string $text) {
	return Html::rawElement( 'a', 
		[
			'href' => Title::newFromText($page)->getFullURL()
		], 
		$text
	);
}

$wgHooks['SkinAddFooterLinks'][] = function ( Skin $skin, string $key, array &$footerlinks ) {
	if ( $key === 'places' ) {
		$footerlinks['github'] =  createExternalLink('https://github.com/Yellow-Dog-Man/resonite-wiki', 'GitHub');
		$footerlinks['website'] = createExternalLink('https://resonite.com', 'Main Website');
		$footerlinks['steam'] =   createExternalLink('https://store.steampowered.com/app/2519830/Resonite/', 'Steam');
		$footerlinks['policies']= createExternalLink('https://resonite.com/policies', 'Resonite Policies');
	};
};
?>