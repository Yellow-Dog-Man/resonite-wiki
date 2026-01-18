<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}
require_once "$IP/config/extensions/Translation.php";

wfLoadExtension( 'ShortDescription' );
$wgCitizenSearchDescriptionSource = 'wikidata';

wfLoadExtension( 'EmbedVideo' );
$wgGroupPermissions['sysop']['deleterevision'] = true;
$wgGroupPermissions['sysop']['deletelogentry'] = true;
$wgGroupPermissions['user']['writeapi'] = true;

wfLoadExtension( 'CategoryTree' );

// Scripting
wfLoadExtension( 'Scribunto' );
wfLoadExtension( 'ParserFunctions' );
$wgScribuntoDefaultEngine = 'luastandalone';
$wgPFEnableStringFunctions = true;

wfLoadExtension( 'Cite' );

wfLoadExtension( 'HeaderFooter' );

wfLoadExtension( 'Math' );
wfLoadExtension( 'VisualEditor' );
wfLoadExtension( 'DiscussionTools' );
wfLoadExtension( 'SyntaxHighlight_GeSHi' );

wfLoadExtension('EmailDNSValidate');

//wfLoadExtension( 'OpenGraphMeta' );

wfLoadExtension( 'Discord' );
$wgDiscordUseEmojis = true;
$wgDiscordUseEmojis = true;
$wgDiscordWebhookURL = [ get_secret('discord_webhook', "REDACTED") ];

$wgDiscordEmojis = array(
    "PageContentSaveComplete" => ":pencil2:",
    "PageSaveComplete" => ":pencil2:",
    "PageDeleteComplete" => ":wastebasket:",
    "ArticleUndelete" => ":wastebasket:",
    "ArticleRevisionVisibilitySet" => ":spy:",
    "ArticleProtectComplete" => ":lock:",
    "PageMoveComplete" => ":truck:",
    "LocalUserCreated" => ":wave:",
    "BlockIpComplete" => ":no_entry_sign:",
    "UnblockUserComplete" => ":no_entry_sign:",
    "UserGroupsChanged" => ":people_holding_hands:",
    "UploadComplete" => ":inbox_tray:",
    "FileDeleteComplete" => ":wastebasket:",
    "FileUndeleteComplete" => ":wastebasket:",
    "AfterImportPage" => ":books:",
    "ArticleMergeComplete" => ":card_box:",
    "ApprovedRevsRevisionApproved" => ":white_check_mark:",
    "ApprovedRevsRevisionUnapproved" => ":white_check_mark:",
    "ApprovedRevsFileRevisionApproved" => ":white_check_mark:",
    "ApprovedRevsFileRevisionUnapproved" => ":white_check_mark:",
    "RenameUserComplete" => ":people_holding_hands:"
);
// See: https://www.mediawiki.org/wiki/Extension_default_namespaces
$wgDiscordDisabledNS = [1198, 1199]; // Translations

// Need to update to MediaWiki 1.42 +
//wfLoadExtension( 'AdvancedSearch' );

wfLoadExtension( 'NativeSvgHandler' );
wfLoadExtension( 'InlineSVG' );

// Add several file types to the default array
$wgFileExtensions = array_merge(
    $wgFileExtensions, [
        'svg'
    ]
);

wfLoadExtension( 'DynamicPageList4' );

// CUT PDF for new release, its complex and the rest of the plugins are not. TODO
//https://www.mediawiki.org/wiki/Extension:Mpdf
//wfLoadExtension( 'Mpdf' );
//$wgMpdfSimpleOutput = true;

// mediawiki 1.42
wfLoadExtension( 'CharInsert' );
wfLoadExtension( 'WikiEditor' );
wfLoadExtension( 'TemplateStyles' );

// Dumps
//wfLoadExtension( 'DumpsOnDemand' );

$wgGroupPermissions['user']['dumpsondemand'] = false;
$wgGroupPermissions['sysop']['dumpsondemand'] = true;
$wgGroupPermissions['sysop']['dumpsondemand-limit-exempt'] = true;
$wgGroupPermissions['sysop']['dumprequestlog'] = true;

// Limit on dumps, in seconds
$wgDumpsOnDemandRequestLimit = 1 * 60 * 60 * 2; // 2 hours

// use default queue
$wgDumpsOnDemandUseDefaultJobQueue = true;

wfLoadExtension( 'Mermaid' );
$mermaidgDefaultTheme = 'dark';

wfLoadExtension( 'PageImages' );
$wgPageImagesNamespaces = [NS_MAIN, NS_COMPONENT, NS_PROTOFLUX];

wfLoadExtension( 'UserFunctions' );

// I dont know which namespaces have an alias and which dont so some are numeric sorry
// https://www.mediawiki.org/wiki/Manual:Namespace
$wgUFEnableSpecialContexts = true;
$standardNamespaces = array_fill( 0, 20, true );
$customNamespaces = array_fill(2999, 3015, true);

$wgUFAllowedNamespaces = array_merge($standardNamespaces, $customNamespaces);
$wgUFAllowedNamespaces[-2] = true;

# https://github.com/wikimedia/mediawiki/blob/master/maintenance/Maintenance.php#L14
# Do not load moderation, if in maintenance script
if ( !defined( 'RUN_MAINTENANCE_IF_MAIN' ) ) {
    // Load this at the bottom, due to comments in documentation asking for that
    require_once "$IP/config/extensions/Moderation.php";
}

?>
