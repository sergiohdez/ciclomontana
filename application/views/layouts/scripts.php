<?php
if (isset($files)) {
    if (is_array($files)) {
        foreach ($files as $file) {
            echo script_tag('assets/' . $file);
        }
    }
    else {
        echo script_tag('assets/' . $files);
    }
}