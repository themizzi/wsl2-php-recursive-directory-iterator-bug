<?php

$filesPath = __DIR__.'/files';
if (file_exists($filesPath)) {
    $files = glob($filesPath . '/*');
    foreach ($files as $index => $file) {
        $message = sprintf("removing %s\n", $index);
        echo $message;
        if (is_file($file)) {
            unlink($file);
        }
    }
    rmdir($filesPath);
}

if (!mkdir($filesPath) && !is_dir($filesPath)) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', 'files'));
}

$max = 1;
$stop = 5000;

foreach(range(1, $max) as $index) {
    $message = sprintf("creating %s\n", $index);
    echo $message;
    file_put_contents(__DIR__ . '/files/file' . $index, '');
}

do {
    $message = sprintf("trying file count %s\n", $max);
    echo $message;
    $iterator = new \RecursiveDirectoryIterator($filesPath);
    $array1 = iterator_to_array($iterator);
    $array2 = scandir($filesPath);
    ++$max;
    file_put_contents(__DIR__ . '/files/file' . $max, '');
} while (count($array1) === count($array2) && $max <= $stop);

$message = sprintf("found files %s vs %s\n", count($array1), count($array2));
echo $message;
