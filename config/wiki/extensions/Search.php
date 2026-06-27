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

// Weights: These are the default settings, but presented here for commentary/docs reasons
// $wgCirrusSearchWeights = [
//     'title'          => 20,
//     'redirect'       => 15,
//     'category'       => 8,
//     'heading'        => 5,
//     'opening_text'   => 3,
//     'text'           => 1,
//     'auxiliary_text' => 0.5,
//     'file_text'      => 0.5,
// ];

// The following settings are based on information from: https://gerrit.wikimedia.org/g/mediawiki/extensions/CirrusSearch/%2B/HEAD/docs/settings.txt
// And Prime reading each of the files, his head hurt reading them :'(

// This switches the query builder profile to the "perfield_builder" one, which can score and rank each field separately.
// E.g. title gets its own score, text gets its own, before they were flattened together
// See: /CirrusSearch/profiles/FullTextQueryBuilderProfiles.config.php for more info, but I barely understand it - PRIME
$wgCirrusSearchFullTextQueryBuilderProfile = 'perfield_builder';

# TMP
#$wgDisableSearchUpdate = true;
?>