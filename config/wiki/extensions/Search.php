<?php

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

wfLoadExtension( 'AdvancedSearch' );
wfLoadExtension( 'Elastica' );
wfLoadExtension( 'CirrusSearch' );

$wgCirrusSearchServers = [ 'resonite-wiki-opensearch'];

$wgSearchType = 'CirrusSearch';

$wgCirrusSearchIndexBaseName = 'resonite-wiki';

// Map specific namespaces to their own indexes
$wgCirrusSearchNamespaceMappings = [
    NS_COMPONENT => 'component',
    NS_PROTOFLUX => 'protoflux',
];

// When specifying additional indexes, you need to specify these next two
$wgCirrusSearchShardCount = [
    'content' => 1,      // Main, Type, Mod, Tutorial, Anomaly
    'general' => 1,      // All talk namespaces, User, MediaWiki, etc.
    'component' => 1,    // Component namespace
    'protoflux' => 1,    // ProtoFlux namespace
    'titlesuggest'=> 1
];

$wgCirrusSearchReplicas = [
    'content' => '0-2',
    'general' => '0-2',
    'component' => '0-2',
    'protoflux' => '0-2',
    'titlesuggest'=> '0-2',
];

$wgCirrusSearchUseCompletionSuggester = 'yes';

# TMP
#$wgDisableSearchUpdate = true;
?>