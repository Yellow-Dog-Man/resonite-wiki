<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

# Define the group
$wgGroupPermissions['interface-editor'] = [];

# editinterface is a require pemission for the lower 2
$wgGroupPermissions['interface-editor']['editinterface'] = true;

# To be able to edit css and js only sitewide, no further permissions granted
$wgGroupPermissions['interface-editor']['editsitecss'] = true;
$wgGroupPermissions['interface-editor']['editsitejs'] = true;

# Allow only sysop's to assign the interface editor role to people.
$wgAddGroups['sysop'][] = 'interface-editor';
$wgRemoveGroups['sysop'][] = 'interface-editor';


?>
