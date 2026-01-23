<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

wfLoadExtension( 'UniversalLanguageSelector' );
wfLoadExtension( 'Translate' );

// Prevent users who are not automoderated from translating 
$wgGroupPermissions['user']['translate'] = false;
$wgGroupPermissions['user']['translate-messagereview'] = false;
$wgGroupPermissions['user']['translate-import'] = false;
$wgGroupPermissions['user']['pagetranslation'] = false;

// Allow automoderated users to translate
$wgGroupPermissions['automoderated']['translate'] = true;
$wgGroupPermissions['automoderated']['translate-messagereview'] = true;
$wgGroupPermissions['automoderated']['translate-import'] = true;
$wgGroupPermissions['automoderated']['pagetranslation'] = true;

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
