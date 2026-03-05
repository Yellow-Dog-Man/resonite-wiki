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

// Editor Stuff
wfLoadExtension( 'VisualEditor' );

// This is courtesy of: https://www.mediawiki.org/wiki/Extension:Linter
wfLoadExtension( 'Linter' );

wfLoadExtension(
    'Parsoid',
	"$IP/vendor/wikimedia/parsoid/extension.json"
);

$wgParsoidSettings = [
    'useSelser' => true,
    'linting' => true
];

$wgVisualEditorParsoidAutoConfig = false; // to make linting work

// TODO: THIS IS WRONG and I don't know what it is
// $wgVirtualRestConfig = [
// 	'paths' => [],
// 	'modules' => [
// 		'parsoid' => [
// 			'url' => 'https://www.mysite.wiki/w/rest.php',
// 			'domain' => 'www.mysite.wiki',
// 			'forwardCookies' => true,
// 			'restbaseCompat' => false,
// 			'timeout' => 30
// 		],
// 	],
// 	'global' => [
// 		'timeout' => 360,
// 		'forwardCookies' => false,
// 		'HTTPProxy' => null
// 	]
// ];

wfLoadExtension( 'DiscussionTools' );

wfLoadExtension( 'SyntaxHighlight_GeSHi' );

wfLoadExtension('EmailDNSValidate');

//wfLoadExtension( 'OpenGraphMeta' );

if (isset($_ENV['DISCORD_ENABLED'])) {
    wfLoadExtension( 'Discord' );
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
    // https://www.mediawiki.org/wiki/Extension_default_namespaces#1190%E2%80%931199:_Translate
    $wgDiscordDisabledNS = [1198, 1199]; // Translations
}

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
wfLoadExtension( 'TemplateStylesExtender' );

// Dumps, disabled till new infra stable
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

wfLoadExtension( 'Gadgets' );

// I don't know which namespaces have an alias and which don't so some are numeric sorry
// https://www.mediawiki.org/wiki/Manual:Namespace
$wgUFEnableSpecialContexts = true;
$standardNamespaces = array_fill( 0, 20, true );
$customNamespaces = array_fill(2999, 3015, true);

$wgUFAllowedNamespaces = array_merge($standardNamespaces, $customNamespaces);
$wgUFAllowedNamespaces[-2] = true;

// #38, Tech Tree Images are massive, increase the max image area to handle them due to "Error creating thumbnail: File with dimensions greater than 12.5 MP".
$wgMaxImageArea = 4.9e7; // 49 megapixels

# Only Included when ENV set.
if (isset($_ENV['OPENSEARCH_ENABLED'])) {
    require_once "$IP/config/extensions/Search.php";
}

# https://github.com/wikimedia/mediawiki/blob/master/maintenance/Maintenance.php#L14
# Do not load moderation, if in maintenance script
if ( !defined( 'RUN_MAINTENANCE_IF_MAIN' ) ) {
    // Load this at the bottom, due to comments in documentation asking for that
    require_once "$IP/config/extensions/Moderation.php";
}

?>
