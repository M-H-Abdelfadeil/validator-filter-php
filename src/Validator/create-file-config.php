<?php
$file_config="config/validator-filter-config.php";
if(!file_exists($file_config)){
    if(!is_dir('config')){
        mkdir('config');
    }
    $content_config=file_get_contents(__DIR__."/config.php");
    $handle_file = fopen($file_config, "w");
    fwrite($handle_file,$content_config);
    echo "create file config ";
}
