<?php


// $wgPluggableAuth_EnableAutoLogin = true; // This causes Anon access to be disabled, no want.
$wgPluggableAuth_EnableLocalLogin = true; // Disable when OAuth Fully Ready? Probably not for awhile?

// Requirement for Pluggable Auth: 
// https://www.mediawiki.org/wiki/Extension:PluggableAuth#Installation
// https://www.mediawiki.org/wiki/Manual:User_rights#List_of_permissions
$wgGroupPermissions['*']['autocreateaccount'] = true; 

wfLoadExtension( 'PluggableAuth' );
wfLoadExtension( 'WSOAuth' );


$wgPluggableAuth_Config['Resonite'] = [
    'plugin' => 'WSOAuth',
    'data' => [
        'type'         => 'resonite',
        'clientId'     => '193d0d3a-8e63-492b-a882-9837487a6e1c',
        'clientSecret' => get_secret('oauth_secret', "REDACTED"),
        'redirectUri'  => 'https://wiki.resonite.com/Special:PluggableAuthLogin' // Replace with your actual wiki URL
    ],
    'groupsyncs' => [
        'resonite_roles' => [
            'type' => 'mapped',
            'map'  => [
                // MediaWiki Group => [ 'tags' => 'Resonite Tag' ]
                'sysop'      => [ 'tags' => 'platform admin' ],
                'bureaucrat' => [ 'tags' => 'team member' ]
            ]
        ]
    ]
];

// Give each user an automatic group
// $wgOAuthAutoPopulateGroups = [ 'user' ]; 

?>