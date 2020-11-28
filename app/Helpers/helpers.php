<?php 

function generateUniqueFileName( $filename ) {
    $name = preg_replace('/\s+/', '_', $filename);
    return date('Y-m-d-H:i:s') . "-" . $name;
}