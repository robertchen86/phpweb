<?php
header("content-type:image/png");
$image = imagecreate(70,21) or die($imagecreateerror);
$backgroudcolor = imagecolorallocate($image,255,255,255);
$textcolor = imagecolorallocate($image,0,0,0);
$str = array("a","b","c","d","e","f","g","h","i","j","k","m","n","p","q","r","s","t","u","v","w","x","y",
        "A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","V","W","X","Y",
        "2","3","4","5","6","7","8","9");
$strlen = count($str);
for($i = 0 ; $i < 5; $i++){
    $d = rand(0,$strlen-1);
    imagestring($image,10,(8+ $i * 12),5,$str[$d],$textcolor);
    $strcheck[$i] = $str[$d];
}
for($i = 0; $i < 100; $i++){ 
		$randcolor = ImageColorallocate($image,rand(0,255),rand(0,255),rand(0,255));
		imagesetpixel($image, rand()%90 , rand()%30 , $randcolor);
} 
imagepng($image);
imagedestroy($image);
$_SESSION['checkstr'] = strtolower(implode($strcheck,""));