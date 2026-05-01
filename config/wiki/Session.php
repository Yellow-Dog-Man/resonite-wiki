<?php
# Session and Cookie Configuration

// Set login cookie to last for 7 days (7 days * 24 hours * 60 mins * 60 secs)
$wgCookieExpiration = 7 * 86400;

// "Keep me logged in" box used? Congrats! You get 30 days of cookie!
$wgExtendedLoginCookieExpiration = 30 * 86400;

// Have you not logged in at least once every in 14 days (Idle)? Login once again!
$wgObjectCacheSessionExpiry = 14 * 86400;

// Store the session cookies in the database, rather then inside of the filesystem.
$wgSessionCacheType = CACHE_DB;

?>