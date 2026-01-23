<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}
$wgEnableEmail = true;
$wgEnableUserEmail = false;
$wgEmailConfirmToEdit = true;

$wgPasswordReminderResendTime = 1;
$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;

$wgSMTP = [
    'host'      => 'ssl://mail.yellowdogman.com', // could also be an IP address. Where the SMTP server is located. If using SSL or TLS, add the prefix "ssl://" or "tls://".
    'IDHost'    => 'resonite.com',      // Generally this will be the domain name of your website (aka mywiki.org)
    'localhost' => 'resonite.com',      // Same as IDHost above; required by some mail servers
    'port'      => 465,                // Port to use when connecting to the SMTP server
    'auth'      => true,               // Should we use SMTP authentication (true or false)
    'username'  => 'wiki@resonite.com',     // Username to use for SMTP authentication (if being used)
    'password'  => get_secret('smtp_password', 'REDACTED!!!')       // Password to use for SMTP authentication (if being used)
];
$wgEmergencyContact = "wiki@resonite.com";
$wgPasswordSender = "wiki@resonite.com";
?>
