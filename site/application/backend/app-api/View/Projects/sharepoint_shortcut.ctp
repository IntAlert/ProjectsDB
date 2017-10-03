<?php
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');

echo '[InternetShortcut]' . PHP_EOL;
echo 'URL=' . $url;
