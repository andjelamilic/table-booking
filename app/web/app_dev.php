<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;


// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
// ip_in_range
// This function takes 2 arguments, an IP address and a "range" in several
// different formats.
// Network ranges can be specified as:
// 1. Wildcard format:     1.2.3.*
// 2. CIDR format:         1.2.3/24  OR  1.2.3.4/255.255.255.0
// 3. Start-End IP format: 1.2.3.0-1.2.3.255
// The function will return true if the supplied IP is within the range.
// Note little validation is done on the range inputs - it expects you to
// use one of the above 3 formats.
function ip_in_range($ip, $range) {
    if (strpos($range, '/') !== false) {
        // $range is in IP/NETMASK format
        list($range, $netmask) = explode('/', $range, 2);
        if (strpos($netmask, '.') !== false) {
            // $netmask is a 255.255.0.0 format
            $netmask = str_replace('*', '0', $netmask);
            $netmask_dec = ip2long($netmask);
            return ( (ip2long($ip) & $netmask_dec) == (ip2long($range) & $netmask_dec) );
        } else {
            // $netmask is a CIDR size block
            // fix the range argument
            $x = explode('.', $range);
            while(count($x)<4) $x[] = '0';
            list($a,$b,$c,$d) = $x;
            $range = sprintf("%u.%u.%u.%u", empty($a)?'0':$a, empty($b)?'0':$b,empty($c)?'0':$c,empty($d)?'0':$d);
            $range_dec = ip2long($range);
            $ip_dec = ip2long($ip);

            # Strategy 1 - Create the netmask with 'netmask' 1s and then fill it to 32 with 0s
            #$netmask_dec = bindec(str_pad('', $netmask, '1') . str_pad('', 32-$netmask, '0'));

            # Strategy 2 - Use math to create it
            $wildcard_dec = pow(2, (32-$netmask)) - 1;
            $netmask_dec = ~ $wildcard_dec;

            return (($ip_dec & $netmask_dec) == ($range_dec & $netmask_dec));
        }
    } else {
        // range might be 255.255.*.* or 1.2.3.0-1.2.3.255
        if (strpos($range, '*') !==false) { // a.b.*.* format
            // Just convert to A-B format by setting * to 0 for A and 255 for B
            $lower = str_replace('*', '0', $range);
            $upper = str_replace('*', '255', $range);
            $range = "$lower-$upper";
        }

        if (strpos($range, '-')!==false) { // A-B format
            list($lower, $upper) = explode('-', $range, 2);
            $lower_dec = (float)sprintf("%u",ip2long($lower));
            $upper_dec = (float)sprintf("%u",ip2long($upper));
            $ip_dec = (float)sprintf("%u",ip2long($ip));
            return ( ($ip_dec>=$lower_dec) && ($ip_dec<=$upper_dec) );
        }

        echo 'Range argument is not in 1.2.3.4/24 or 1.2.3.4/255.255.255.0 format';
        return false;
    }

}

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', 'fe80::1', '::1'])
        || (ip_in_range(@$_SERVER['REMOTE_ADDR'], '192.168.168.0/24')
            || ip_in_range(@$_SERVER['REMOTE_ADDR'], '195.34.122.0/24')
            || ip_in_range(@$_SERVER['REMOTE_ADDR'], '192.168.0.0/24')
            || ip_in_range(@$_SERVER['REMOTE_ADDR'], '192.168.1.0/24')
            || ip_in_range(@$_SERVER['REMOTE_ADDR'], '10.0.0.0/24')
            || ip_in_range(@$_SERVER['REMOTE_ADDR'], '10.11.12.0/24')
            || ip_in_range(@$_SERVER['REMOTE_ADDR'], '10.15.20.0/24')
            || ip_in_range(@$_SERVER['REMOTE_ADDR'], '10.0.127.0/24')
            || ip_in_range(@$_SERVER['REMOTE_ADDR'], '192.168.127.0/24')
            || ip_in_range(@$_SERVER['REMOTE_ADDR'], '172.*.0.1'))

        || PHP_SAPI === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}


require __DIR__.'/../vendor/autoload.php';
Debug::enable();


$kernel = new AppKernel('dev', true);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
