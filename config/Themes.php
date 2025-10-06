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

?>