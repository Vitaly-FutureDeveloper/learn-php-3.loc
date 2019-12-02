<?php
session_start();

$img = imageCreateFromJpeg("images/noise.jpg");
//$color = imageColorAllocate($img, mt_rand(0,150), mt_rand(0,150), mt_rand(0,150));
imageAntiAlias($img, true);

$nChars = 5;
$randStr = substr(md5(uniqid()), 0, $nChars); 
$_SESSION["randStr"] = $randStr;

$x = mt_rand(10,20); $y = 30; $deltaX = 40;
for($i=0; $i<$nChars; $i++){
    $size = rand(20,30);
    $angle = -30 + rand(0,60);

    $color = imageColorAllocate($img, mt_rand(0,150), mt_rand(0,100), mt_rand(0,150));

    imageTtfText($img, $size, $angle, $x, $y, $color, "fonts/bellb.ttf", $randStr{$i});

    $x += $deltaX;
}

header("Content-Type: image/jpg");
imageJpeg($img);