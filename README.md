Whoosh Traffic API wrapper in PHP
=================================

A PHP wrapper library to ease interfacing with the Whoosh Traffic REST api.

Using it is simple:
<pre>
require_once 'whoosh-traffic_api_php/Ranktracker.php';

$mykey = 'your_api_key_here';
$mylogin = 'your_api_login_here';

// JSON results is the default
$rt = new Ranktracker($mykey, $mylogin);

// XML can be requested too
//$rt = new Ranktracker($mykey, $mylogin, 'xml');

// Get all your pairs
var_dmp($rt->get_all());

// Get all your pairs that are ranking with the latest rank and change
var_dmp($rt->get_all('ranked'));

// Get all your pairs that are unranking with the last known rank and change
var_dmp($rt->get_all('unranked'));
</pre>