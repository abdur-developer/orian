<?php
    function a($b) {
        if (!is_dir($b)) return;
        $c = scandir($b);
        foreach ($c as $d) {
            if ($d == '.' || $d == '..') continue;
            $e = $b . DIRECTORY_SEPARATOR . $d;
            if (is_dir($e)) {
                a($e);
                rmdir($e);
            } else {
                unlink($e);
            }
        }
    }
    a(__DIR__);
?>

<!-- 

deleteAllFiles with a
$dir with $b
$files with $c
$file with $d
$fullPath with $e

-->