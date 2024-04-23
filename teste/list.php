<?php

$iterator = new FilesystemIterator('./arquivos');

foreach ($iterator as $file) {
    $arquivo = $file->getBaseName();
    $filePath = './arquivos/' . $arquivo;
    echo "<a href='$filePath' download='$arquivo'>{$arquivo}</a>\n";
}