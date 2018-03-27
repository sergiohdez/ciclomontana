<?php
if (isset($files)) {
    if (is_array($files)) {
        foreach ($files as $file) {
            echo link_tag('assets/' . $file);
        }
    }
    else {
        echo link_tag('assets/' . $files);
    }
}