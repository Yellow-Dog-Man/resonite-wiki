<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}
## Database settings
$wgDBtype = "mysql";
$wgDBserver = "resonite-wiki-database";
$wgDBname = "wiki_db";
$wgDBuser = get_secret('db_user', "REDACTED");
$wgDBpassword = get_secret('db_password', "REDACTED");

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Shared database table
# This has no effect unless $wgSharedDB is also set.
$wgSharedTables[] = "actor";

?>
