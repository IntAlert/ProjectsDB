<?php
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');

?>[InternetShortcut]
URL=<?php echo $url;?>