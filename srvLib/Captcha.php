<?php

/* 
 * file name : 
 *	Captcha.php
 * description :
 *	專門產生驗證碼
 * start date :
 *	2015/07/15
 * author :
 *	chiping
 */

session_start();

class Captcha {
    private $fileName;
    private $img;
    public function __construct() {
	if(!isset($_SESSION['login']) || !isset($_SESSION['login']['captcha']))
	    $_SESSION['login']['captcha'] = rand(1000, 9999);
	header("Content-Type: image/png");
	$width = 45;
	$height = 25;

	$img = imagecreatetruecolor($width, $height) 
	    or die("Cannot Initialize new GD image stream");;
	$bgColor = imagecolorallocatealpha($img, 255, 255, 255, 0);
	$textColor = imagecolorallocate($img, 0, 0, 0);

	imagefilledrectangle($img, 0, 0, $width, $height, $bgColor);
	imagestring($img, 5, 5, 5, $_SESSION['login']['captcha'], $textColor);
	imagepng($img);
	$this->img = $img;
    }

    public function __destruct() {
	imagedestroy($this->img);
    }
}

$captcha = new Captcha();

?>
