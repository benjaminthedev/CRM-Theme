<?php

/* =============== gincludes php files by folder path =============== */

function __autoload($folder_path)
{
    foreach (glob($folder_path . '/*.php') as $filename) {
        require_once $filename;
    }
}

/* =============== get asset helper =============== */

function get_image_dir_uri()
{
    return get_template_directory_uri() . "/assets/src/images/";
}

function get_public_dir_uri()
{
    return get_template_directory_uri() . "/public/";
}

function get_font_dir_uri()
{
    return get_public_dir_uri() . "fonts/";
}

function get_img($name, $alt = '', $internal = true)
{
    $url = $internal ? get_image_dir_uri() . $name : $name;
    return '<img src="' . $url . '" alt="' . $alt . '" />';
}


/* =============== print a object and style with pre =============== */

function print_object($o, $js = false)
{
    if (!$js) {
        echo '<pre>' . print_r($o, true) . '</pre>';
    } else {
        echo '<script type="text/javascript">console.log(' . json_encode($o) . ');</script>';
    }
}


?>