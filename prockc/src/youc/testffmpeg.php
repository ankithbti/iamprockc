<?php
$extension = "ffmpeg";
$extension_soname = $extension . "." . PHP_SHLIB_SUFFIX;
$extension_fullname = PHP_EXTENSION_DIR . "/" . $extension_soname;

echo $extension_fullname;

// load extension
// if(!extension_loaded($extension)) {
//     dl($extension_soname) or die("Can't load extension $extension_fullname\n");
// }
?>