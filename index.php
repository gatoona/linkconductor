<?php
/**
 * Link Conductor
 * Simple URL redirect platform with manager
 * @author Jeffrey Wang (jeffw16)
 * @license MIT License
*/

$r = json_decode( file_get_contents(__DIR__ . '/redirects.json') , true);
if ( in_array ( $_REQUEST['r'], $r ) ) {
    header('Location:' . $r[$_REQUEST['r']]);
} else {
    echo "Link not found";
}
