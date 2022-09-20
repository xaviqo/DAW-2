<?php

// crear imagen
$imagen = imagecreatetruecolor(1000, 1000);

// asignar algunos colores
$blanco      = imagecolorallocate($imagen, 0xFF, 0xFF, 0xFF);
$gris        = imagecolorallocate($imagen, 0xC0, 0xC0, 0xC0);
$gris_oscuro = imagecolorallocate($imagen, 0x90, 0x90, 0x90);
$azul_marino = imagecolorallocate($imagen, 0x00, 0x00, 0x80);
$azul_marino_oscuro = imagecolorallocate($imagen, 0x00, 0x00, 0x50);
$rojo        = imagecolorallocate($imagen, 0xFF, 0x00, 0x00);
$rojo_oscuro = imagecolorallocate($imagen, 0x90, 0x00, 0x00);

$fuente = './font.ttf';

// hacer el efecto 3D
for ($i = 0; $i < 360; $i+=20) {
   imagefilledarc($imagen, 500, 500, 1000, 1000, $i, $i+10, $gris_oscuro, IMG_ARC_CHORD);
   imagefilledarc($imagen, 500, 500, 1000, 1000, $i+10, $i+20, $rojo, IMG_ARC_CHORD);
}

for ($k=0; $k < 36; $k++) { // 1 . tamaño fuente - 
   imagettftext($imagen, 12, 0, 11, 21, $blanco, $fuente, $k);
}


// volcar imagen
header('Content-type: image/png');
imagepng($imagen);
imagedestroy($imagen);
?>