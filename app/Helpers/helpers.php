<?php 
use Illuminate\Support\Facades\File;

function generateUniqueFileName( $filename ) {
    $name = preg_replace('/\s+/', '_', $filename);
    return date('Y-m-d-H:i:s') . "-" . addslashes($name);
}

function deleteLocalImage( $imagePath ) {
    $image_path = public_path( 'images/' . $imagePath ); 
    if(File::exists($image_path)) {
        File::delete( $image_path );
    }
}