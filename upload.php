<?php
function slugify($string)
{
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    return $slug;
}

if (isset($_FILES['files'])) {
    $errors = array();
    $uploaded_files = array();

    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['files']['name'][$key];
        $files = explode('.', $file_name);
        $file_tmp = $_FILES['files']['tmp_name'][$key];
        $slug = slugify($files[0]);
        $file_path = 'uploads/' . $slug . '.' . $files[1];

        if (move_uploaded_file($file_tmp, $file_path)) {
            $uploaded_files[] = $file_path;
        } else {
            $errors[] = "Failed to upload $file_name";
        }
    }

    if (count($errors) > 0) {
        echo implode('<br>', $errors);
    }

    if (count($uploaded_files) > 0) {
        echo "Uploaded files:<br>" . implode('<br>', $uploaded_files);
    }
}
