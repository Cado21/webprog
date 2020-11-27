<?php 

function generateUniqueFileName( $filename ) {
    return date('Y-m-d-H:i:s') . "-" . $filename;
}