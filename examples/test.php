<?php
require_once __DIR__ . "/../vendor/autoload.php";
use Waljqiang\Qrcode\Qrcode;

//普通二维码示例
$now = time();
//二维码内容
$value = json_encode([
	"jgid" => "35",
	"date" => date("Y-m-d H:i:s",$now-10*60) . "." . $now % 1000
]);
//容错级别
$level = "L";
//生成图片大小
$size = 5;
//二维码图片存放位置
$filename = __DIR__ . "/../images/test.png";
//生成二维码图片
Qrcode::png($value,$filename,$level,$size,2);

$QR = imagecreatefromstring(file_get_contents($filename));
//输出图片
imagepng($QR,__DIR__ . "/../images/qrcode.png");
imagedestroy($QR);
echo '<img src="../images/qrcode.png" alt="扫码">';



//带logo的二维码示例
$now = time();
//二维码内容
$value = json_encode([
	"jgid" => "35",
	"date" => date("Y-m-d H:i:s",$now-10*60) . "." . $now % 1000
]);
//容错级别
$level = "L";
//生成图片大小
$size = 5;
//二维码图片存放位置
$filename = __DIR__ . "/../images/testlogo.png";
//生成二维码图片
Qrcode::png($value,$filename,$level,$size,2);

//logo图片
$logoname = __DIR__ . "/../images/logo.png";
$qr = imagecreatefromstring(file_get_contents($filename));//目标图形连接资源
$logo = imagecreatefromstring(file_get_contents($logoname));//源图像连接资源
$qr_width = imagesx($qr);//二维码图片宽度
$qr_height = imagesy($qr);//二维码图片高度
$logo_width = imagesx($logo);//logo图片宽度
$logo_height = imagesy($logo);//logo图片高度
$logo_qr_width = $qr_width / 4;//组合之后logo的宽度(占二维码的1/5)
$scale = $logo_width / $logo_qr_width;//logo宽度的缩放比
$logo_qr_height = $logo_height / $scale;//组合之后logo的高度
$from_width = ($qr_width - $logo_qr_width) / 2;//组合之后logo左上角所在的坐标点
//重新组合图片并调整大小
//imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中
imagecopyresampled($qr,$logo,$from_width,$from_width,0,0,$logo_qr_width,$logo_qr_height,$logo_width,$logo_height);

imagepng($qr, __DIR__ . "/../images/qrcodelogo.png");  
imagedestroy($qr);
imagedestroy($logo);
echo '<img src="../images/qrcodelogo.png" alt="扫码">';   