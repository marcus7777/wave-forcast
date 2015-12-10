<?php
ini_set('memory_limit', '1024K');
/* Do not modify above this line. */
$user_agent = 'AnyOrigin/1.0; Public API';
$user_domain = 'http://46.101.40.191/';
/* It is recommended that you keep this value to prevent requests looking like they are all from you if hosting multiple sites */
$incoming_headers = parseRequestHeaders();
$incoming_type = "";
$ao_user_origin = "";
if (isset($incoming_headers["origin"])) {
        $ao_user_origin = $incoming_headers["origin"];
        $incoming_type = "origin";
} else if (isset($incoming_headers["x-requested-with"])) {
        $ao_user_origin = $incoming_headers["x-requested-with"];
        $incoming_type = "x-requested-with";
}
$allowed_hosts = array('*');
/* Do not modify below this line */
$user_agent_full = "$user_agent ($user_domain)";
$client_url = $_GET['u'];
$client_allowed = 1000;
/* Check for POST data for any-origin. Please note all POST data passes. */
$ao_post = "";
$ao_post_active = 0;
if ($_POST) {
        $ao_post_active = 1;
        $ao_post = http_build_query($_POST);
}
/* Continue with any-origin request */
header('Access-Control-Allow-Origin: *');
/* Safety Feature */
header('Content-Type: text/plain');
/* Continue */
print  _get_data('http://magicseaweed.com/api/?' . urldecode($client_url) );
function _get_data ($url) {
  return file_get_contents($url);
}
function parseRequestHeaders() {
        $headers = array();
        foreach($_SERVER as $key => $value) {
                if (substr($key, 0, 5) <> 'HTTP_') {
                        continue;
                }
                $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
                $headers[strtolower($header)] = $value;
        }
        return $headers;
}
