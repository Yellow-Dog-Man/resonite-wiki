<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

# Enable subpages in the main namespace
$wgNamespacesWithSubpages[NS_MAIN] = true;

// Namespaces
$BASE_NAMESPACE_ID = 3000;

// Components e.g. Components:AxisAligner
define("NS_COMPONENT", $BASE_NAMESPACE_ID++);
define("NS_COMPONENT_TALK", $BASE_NAMESPACE_ID++);
$wgExtraNamespaces[NS_COMPONENT] = "Component";
$wgExtraNamespaces[NS_COMPONENT_TALK] = "Component_talk";
$wgContentNamespaces[] = NS_COMPONENT;
$wgNamespacesToBeSearchedDefault[NS_COMPONENT] = true;

// ProtoFlux e.g. ProtoFlux:ZeroOne
define("NS_PROTOFLUX", $BASE_NAMESPACE_ID++);
define("NS_PROTOFLUX_TALK", $BASE_NAMESPACE_ID++);
$wgExtraNamespaces[NS_PROTOFLUX] = "ProtoFlux";
$wgExtraNamespaces[NS_PROTOFLUX_TALK] = "ProtoFlux_talk";
$wgContentNamespaces[] = NS_PROTOFLUX;
$wgNamespacesToBeSearchedDefault[NS_PROTOFLUX] = true;

define("NS_TYPE", $BASE_NAMESPACE_ID++);
define("NS_TYPE_TALK", $BASE_NAMESPACE_ID++);
$wgExtraNamespaces[NS_TYPE] = "Type";
$wgExtraNamespaces[NS_TYPE_TALK] = "Type_talk";
$wgContentNamespaces[] = NS_TYPE;
$wgNamespacesToBeSearchedDefault[NS_TYPE] = true;

define("NS_MOD", $BASE_NAMESPACE_ID++);
define("NS_MOD_TALK", $BASE_NAMESPACE_ID++);
$wgExtraNamespaces[NS_MOD] = "Mod";
$wgExtraNamespaces[NS_MOD_TALK] = "Mod_talk";
$wgContentNamespaces[] = NS_MOD;
$wgNamespacesToBeSearchedDefault[NS_MOD] = true;

define("NS_DIAGRAM", $BASE_NAMESPACE_ID++);
define("NS_DIAGRAM_TALK", $BASE_NAMESPACE_ID++);
$wgExtraNamespaces[NS_DIAGRAM] = "Diagram";
$wgExtraNamespaces[NS_DIAGRAM_TALK] = "Diagram_talk";
$wgContentNamespaces[] = NS_MOD;
// Searching diagrams is a little weird turn off for now
//$wgNamespacesToBeSearchedDefault[NS_MOD] = true;

define("NS_TUTORIAL", $BASE_NAMESPACE_ID++);
define("NS_TUTORIAL_TALK", $BASE_NAMESPACE_ID++);
$wgExtraNamespaces[NS_TUTORIAL] = "Tutorial";
$wgExtraNamespaces[NS_TUTORIAL_TALK] = "Tutorial_talk";
$wgContentNamespaces[] = NS_TUTORIAL;
$wgNamespacesToBeSearchedDefault[NS_TUTORIAL] = true;

define("NS_ANOMALY", $BASE_NAMESPACE_ID++);
define("NS_ANOMALY_TALK", $BASE_NAMESPACE_ID++);
$wgExtraNamespaces[NS_ANOMALY] = "Anomaly";
$wgExtraNamespaces[NS_ANOMALY_TALK] = "Anomaly_talk";
$wgContentNamespaces[] = NS_ANOMALY;
$wgNamespacesToBeSearchedDefault[NS_ANOMALY] = false; #By default, don't search satirical content


?>