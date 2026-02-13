<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

// Disabled as experiment
//wfLoadExtension( 'Moderation' );

// DDOS
wfLoadExtension( 'DisableSpecialPages' );
$wgDisabledSpecialPages = [
	'Recentchangeslinked',
    'RecentChangesLinked'
];
wfLoadExtension( 'CrawlerProtection' );

$wgGroupPermissions['moderator']['userrights'] = false;
$wgAddGroups['moderator'][] = 'automoderated';
$wgRemoveGroups['moderator'][] = 'automoderated';

$wgGroupPermissions['moderator']['rollback'] = true;

$wgGroupPermissions['automoderated']['skip-move-moderation'] = true;

# This doesn't work right now we'll take a look later.
//wfLoadExtension( 'TorBlock' );

wfLoadExtension( 'Nuke' );
$wgGroupPermissions['bureaucrat']['nuke'] = true;

//wfLoadExtension( 'ReplaceText' );
$wgGroupPermissions['bureaucrat']['replacetext'] = true;

//$wgGroupPermissions['user']['delete'] = true;

wfLoadExtension( 'MaintenanceShell' );
$wgGroupPermissions['sysop']['maintenanceshell'] = true;

$wgGroupPermissions['bureaucrat']['deletebatch'] = false;
$wgGroupPermissions['sysop']['deletebatch'] = true;

wfLoadExtension( 'CleanChanges' );
$wgCCTrailerFilter = true;
$wgCCUserFilter = false;
$wgDefaultUserOptions['usenewrc'] = 1;

wfLoadExtensions([ 'ConfirmEdit', 'ConfirmEdit/QuestyCaptcha' ]);

// Add your questions in LocalSettings.php using this format:
$wgCaptchaQuestions = [
    'What application is this wiki about?' => 'resonite',
    'What company made the application this wiki is about?' => ['yellow dog man', 'yellow dog man studios','frooxius', 'ydms', 'yellowdogmanstudios', 'yellow dog man studios s.r.o.'],
];

$wgCaptchaTriggers['edit'] = false;
$wgCaptchaTriggers['create'] = false;
$wgCaptchaTriggers['sendemail'] = false;
$wgCaptchaTriggers['addurl'] = false;
$wgCaptchaTriggers['badlogin'] = false;
$wgCaptchaTriggers['createaccount'] = true;
$wgCaptchaTriggers['badloginperuser'] = true;

// TODO: move this, not moderation
wfLoadExtension( 'DataDump' );

$wgDataDumpDirectory = "$IP/{$wgDBname}/";

$wgDataDump = [
    'xml' => [
        'file_ending' => '.xml.gz',
        'generate' => [
            'type' => 'mwscript',
            'script' => "$IP/maintenance/dumpBackup.php",
            'options' => [
                '--full',
                '--output',
                "gzip:{$wgDataDumpDirectory}" . '${filename}',
            ],
        ],
        'limit' => 10,
        'permissions' => [
            'view' => 'view-dump',
            'generate' => 'generate-dump',
            'delete' => 'delete-dump',
        ],
    ],
    'image' => [
        'file_ending' => '.zip',
        'generate' => [
            'type' => 'script',
            'script' => '/usr/bin/zip',
            'options' => [
                '-r',
                "{$wgDataDumpDirectory}" . '${filename}',
                "$IP/images/"
            ],
        ],
        'limit' => 10,
        'permissions' => [
            'view' => 'view-dump',
            'generate' => 'view-image-dump',
            'delete' => 'delete-dump',
        ],
    ],
];

$wgAvailableRights[] = 'view-dump';
$wgAvailableRights[] = 'view-image-dump';
$wgAvailableRights[] = 'generate-dump';
$wgAvailableRights[] = 'delete-dump';

$wgGroupPermissions['sysop']['view-dump'] = true;
$wgGroupPermissions['user']['view-dump'] = true;

$wgGroupPermissions['*']['view-image-dump'] = true;
$wgGroupPermissions['*']['view-dump'] = true;

$wgGroupPermissions['sysop']['view-image-dump'] = true;
$wgGroupPermissions['sysop']['generate-dump'] = true;
$wgGroupPermissions['sysop']['delete-dump'] = true;

?>
