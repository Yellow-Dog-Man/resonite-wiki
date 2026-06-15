<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

wfLoadExtension( 'UniversalLanguageSelector' );
wfLoadExtension( 'Translate' );

$wgGroupPermissions['user']['translate'] = true;
$wgGroupPermissions['user']['translate-messagereview'] = true;
$wgGroupPermissions['user']['translate-import'] = true;
$wgGroupPermissions['user']['pagetranslation'] = true;
$wgGroupPermissions['user']['skip-move-moderation'] = true;

// Not used
$wgGroupPermissions['user']['translate-groupreview'] = true;

$wgGroupPermissions['sysop']['pagetranslation'] = true;
$wgGroupPermissions['sysop']['translate-manage'] = true;
$wgGroupPermissions['sysop']['translate-publish'] = true;

// Documentation of messages
$wgTranslateDocumentationLanguageCode = 'qqq';
$wgExtraLanguageNames['qqq'] = 'Message documentation'; # No linguistic content. Used for documenting messages
$wgTranslatePageTranslationULS = true;

// TODO: I dont know why this is here
$wgPFEnableStringFunctions = true;

wfLoadExtension( 'Babel' );

wfLoadExtension( 'cldr' );

$wgUsePigLatinVariant = false;

?>
