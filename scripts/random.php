<?php
session_start();

    if ( !empty($_SESSION['rand_code']) )
    {
        unset($_SESSION['rand_code']);
    }   

    if (empty($_SESSION['rand_code']))
    {
        $str = "";
	    $a = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        for ($i = 0; $i <= 3; $i++)
        {
            $str.= $a[rand(0, 61)];
        }
    
    $_SESSION['rand_code'] = $str;
}
header ('Content-Type: image/png');
$im = imagecreatetruecolor(120, 30);
$color_texto = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 10, 5, 5,$str, $color_texto);
imagepng($im);
imagedestroy($im);
?>