<?php
/**
 * Link Conductor
 * Simple URL redirect platform with manager
 * @author Jeffrey Wang (jeffw16)
 * @license MIT License
*/

$redirects = json_decode( file_get_contents(__DIR__ . '/redirects.json') , true);
$requested = $_GET['r'];
if ( array_key_exists ( $requested, $redirects ) ) {
    header('Location:' . $redirects[$requested]);
} else {
    echo("Link not found: " . $requested);
}
