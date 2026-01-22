<?php

// https://www.mediawiki.org/wiki/Extension:AWS
// Reminder R2 has an S3 API.

wfLoadExtension('AWS');

$wgAWSRegion = 'auto';
$wgAWSBucketName = getenv('R2_IMAGES_BUCKET_NAME'); 
$s3ApiEndpoint = get_secret('r2_endpoint', "REDACTED"); //.eu.rs.cloudflarestorage.com
$wgAWSBucketDomain = 'media.wiki.resonite.com';

$wgAWSCredentials = [
    'key' => get_secret('r2_access_key_id', "REDACTED"),
    'secret' => get_secret('r2_secret_access_key', "REDACTED"),
];

// Use S3 as the file backend
$wgFileBackends['s3'] = [
    'class' => 'AmazonS3FileBackend',
    'endpoint' => "https://". $s3ApiEndpoint,
    'name' => 's3',
    'lockManager' => 'nullLockManager',
    'use_path_style_endpoint' => true,
    'containerPaths' => [
        'local-public' => "$wgAWSBucketName",
        'local-thumb' => "$wgAWSBucketName/thumb",
        'local-deleted' => "$wgAWSBucketName/deleted",
        'local-temp' => "$wgAWSBucketName/temp",
    ],
];

// https://github.com/edwardspec/mediawiki-aws-s3?tab=readme-ov-file#migrating-images
$wgAWSRepoHashLevels = '2'; # Default 0
# 2 means that S3 objects will be named a/ab/Filename.png (same as when MediaWiki stores files in local directories)
$wgAWSRepoDeletedHashLevels = '3'; # Default 0
# 3 for naming a/ab/abc/Filename.png (same as when MediaWiki stores deleted files in local directories)

$finalCDNURL = 'https://media.wiki.resonite.com';

// CNAME in CF => R2 Bucket
$wgLocalFileRepo = [
    'class' => 'LocalRepo',
    'name' => 'local',
    'backend' => 's3',
    'url' => $finalCDNURL,
    'hashLevels' => 2,
    'thumbScriptUrl' => false,
    'transformVia404' => false,
    'deletedHashLevels' => 3,
];
// Disable local file caching
$wgUploadDirectory = false;
$wgUploadPath = false;

?>