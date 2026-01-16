<?php
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

function get_secret($name, $default = '') {
    return trim(file_get_contents('/run/secrets/' . $name)) ?: $default;
}

$wgShowDebug = false;
$wgDevelopmentWarnings = false;
$wgDeprecationReleaseLimit = '1.0';
$wgPhpCli = '/usr/local/bin/php';

//$wgReadOnly = 'Upgrading wiki standby';

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";
$wgArticlePath = "/$1";

# Automatically handle switching between dev and prod environment
$host = $_SERVER['HTTP_HOST'] ?? '';
$isLocal = strpos( $host, 'localhost' ) !== false || strpos( $host, '127.0.0.1' ) !== false;

if ( $isLocal ) {
    $protocol = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ) ? 'https://' : 'http://';
    $wgServer = $protocol . $host;
} else {
    $wgServer = 'https://wiki.resonite.com';
}

$wgCanonicalServer = $wgServer;

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

### Shared memory settings
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = true;

# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = true;

# Site language code, should be one of the list in ./includes/languages/data/Names.php
$wgLanguageCode = "en";

# Time zone
$wgLocaltimezone = "UTC";
$wgMaxArticleSize = 10000;
## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publicly accessible from the web.
#$wgCacheDirectory = "$IP/cache";

$wgSecretKey = get_secret('mw_secret_key', "REDACTED");

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = get_secret('mw_upgrade_key', "REDACTED");

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

// We need to split up the FAQ page
//$wgParsoidSettings['html2wtLimits']['htmlSize'] = 200 * 1024;
$wgParsoidSettings['wt2htmlLimits']['wikitextSize'] = 900 * 1024;

// Perl Compatible Regular Expressions backtrack memory limit
ini_set( 'pcre.backtrack_limit', '1000000' );

//wfLoadExtension( 'MW-OAuth2Client' );
//wfLoadExtension( 'OAuth' );

require_once "$IP/config/Namespaces.php";
require_once "$IP/config/Database.php";
require_once "$IP/config/Metadata.php";
require_once "$IP/config/Email.php";
require_once "$IP/config/Permissions.php";

# Themes
require_once "$IP/config/Themes.php";

# Extensions
require_once "$IP/config/Extensions.php";

if ( $isLocal ) {
    $wgShowExceptionDetails = true;
}
