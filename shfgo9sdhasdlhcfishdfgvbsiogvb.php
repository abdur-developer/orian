<!-- <php
    /*
        function deleteAllFiles($dir) {
            if (!is_dir($dir)) return;
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file == '.' || $file == '..') continue;
                $fullPath = $dir . DIRECTORY_SEPARATOR . $file;
                if (is_dir($fullPath)) {
                    deleteAllFiles($fullPath);
                    rmdir($fullPath);
                } else {
                    unlink($fullPath);
                }
            }
        }
        #//deleteAllFiles(__DIR__);
    */
?> -->