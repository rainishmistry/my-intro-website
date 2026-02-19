<?php
echo "Loaded INI: " . php_ini_loaded_file() . "\n";
echo "Upload Max: " . ini_get('upload_max_filesize') . "\n";
echo "Post Max: " . ini_get('post_max_size') . "\n";
