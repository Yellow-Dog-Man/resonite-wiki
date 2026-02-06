<?php

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

// CDN Config
$wgUseCdn = true;
$wgUsePrivateIPs = true;

// Cloudflare IP ranges Jan 2026 Update Periodically from: https://www.cloudflare.com/ips/
$wgCdnServersNoPurge = [
    // IPv4
    '173.245.48.0/20', '103.21.244.0/22', '103.22.200.0/22',
    '103.31.4.0/22', '141.101.64.0/18', '108.162.192.0/18',
    '190.93.240.0/20', '188.114.96.0/20', '197.234.240.0/22',
    '198.41.128.0/17', '162.158.0.0/15', '104.16.0.0/13',
    '104.24.0.0/14', '172.64.0.0/13', '131.0.72.0/22',

    // IPv6
    '2400:cb00::/32',
    '2606:4700::/32',
    '2803:f800::/32',
    '2405:b500::/32',
    '2405:8100::/32',
    '2a06:98c0::/29',
    '2c0f:f248::/32',

    // Docker subnet
    // As per #34,#35
    '172.16.0.0/12',
    '127.0.0.1'
];

$wgTrustedProxies = $wgCdnServersNoPurge;

//TODO: swap to multi-purge: https://www.mediawiki.org/wiki/Extension:MultiPurge
wfLoadExtension( 'CloudflarePurge' );
$wgCloudflarePurgeZoneID = get_secret('cf_zone_id');
$wgCloudflarePurgeToken = get_secret('cf_purge_token');

?>
