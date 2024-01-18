<?php

// Set the width and height of the image
$img_w = 100;
$img_h = 30;
// Create a true-color image
$img = imagecreatetruecolor($img_w, $img_h);
// Set the background color
$bg_color = imagecolorallocate($img,0xcc,0xcc,0xcc);
imagefill($img,0,0,$bg_color);

// Set the number of characters in the captcha cod
$count = 4;
// Define the character set for the captcha
$charset = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$charset_len = strlen($charset)-1;
$code = '';

// Generate a random captcha code
for($i=0; $i<$count; ++$i) {
    $code .= $charset[mt_rand(0,$charset_len)];
}

// Start a session and store the captcha code
session_start();
$_SESSION['captcha'] = $code;

// Set font-related parameters
$fontSize = 16;
$fontStyle = './fonts/SourceCodePro-Bold.ttf';
// Add characters to the image using TrueType fonts
for($i=0; $i<$count; ++$i){
    $fontColor = imagecolorallocate($img,mt_rand(0,100),mt_rand(0,50),mt_rand(0,255));
    imagettftext (
        $img,
        $fontSize,
        mt_rand(0,20) - mt_rand(0,25), 
        $fontSize*$i+20,mt_rand($img_h/2,$img_h),
        $fontColor,
        $fontStyle,
        $code[$i]
        );
}

// Add random pixels to the image
for($i=0; $i<300; ++$i){
    $color = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    imagesetpixel($img,mt_rand(0,$img_w),mt_rand(0,$img_h),$color);
}

// Add random lines to the image
for($i=0; $i<10; ++$i){
    $color = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    imageline($img,mt_rand(0,$img_w),0,mt_rand(0,$img_h*5),$img_h,$color);
}

// Set the content type to display the image
header('Content-Type: image/gif');
// Output the image as GIF
imagegif($img);