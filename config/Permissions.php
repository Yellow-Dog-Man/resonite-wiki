<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

# Limit account creation to 3 per day from the same IP Address
# https://www.mediawiki.org/wiki/Manual:$wgAccountCreationThrottle
$wgAccountCreationThrottle = [ [
	'count' => 6,
	'seconds' => 86400,
] ];

# *giggles* - Prime
$wgSpamRegex = ["/".                        # The "/" is the opening wrapper
                "s-e-x|zoofilia|sexyongpin|grusskarte|geburtstagskarten|".
                "(animal|hardcore|lesbian|voyeur)sex|sex(cam|chat)|adult(chat|live)|".
                "adult(porn|video|web.)|(hardcore|teen|xxx)porn|".
                "live(girl|nude|video)|camgirl|".
                "spycam|casino-online|online-casino|kontaktlinsen|cheapest-phone|".
                "laser-eye|eye-laser|fuelcellmarket|lasikclinic|cragrats|parishilton|".
                "paris-(hilton|tape)|2large|fuel(ing)?-dispenser|huojia|".
                "jinxinghj|telemati[ck]sone|a-mortgage|diamondabrasives|".
                "reuterbrook|sex-(with|plugin|zone)|lazy-stars|eblja|liuhecai|".
                "buy-viagra|-cialis|-levitra|boy-and-girl-kissing|". # These match spammy words
                "dirare\.com|".           # This matches dirare.com a spammer's domain name
                "overflow\s*:\s*auto|".   # This matches against overflow:auto (regardless of whitespace on either side of the colon)
                "height\s*:\s*[0-4]px|".  # This matches against height:0px (most CSS hidden spam) (regardless of whitespace on either side of the colon)
                "==<center>\[|".          # This matches some recent spam related to starsearchtool.com and friends
		"\bsolirax\b|".
		"\bKarel\b|".
		"\btowing\b".
                "/i"];                     # The "/" ends the regular expression and the "i" switch which follows makes the test case-insensitive
                                          # The "\s" matches whitespace
                                          # The "*" is a repeater (zero or more times)
                                          # The "\s*" means to look for 0 or more amount of whitespace

?>