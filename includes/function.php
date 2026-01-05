<?php

function uploadFile($file, $path, $allowedExt) {
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt)) return null;

    $filename = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "", $file['name']);
    move_uploaded_file($file['tmp_name'], "$path/$filename");

    return $filename;
}

function uploadMultipleFiles($files, $path, $allowedExt) {
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $result = [];

    foreach ($files['name'] as $i => $name) {
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExt)) continue;

        $filename = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "", $name);
        move_uploaded_file($files['tmp_name'][$i], "$path/$filename");
        $result[] = $filename;
    }

    return $result;
}
