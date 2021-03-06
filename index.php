<?php
function differenza_colore($colore, $colorToMatch, $colorePixel){
    return abs($colorToMatch[$colore] - $colorePixel[$colore]);
}

function get_color($imageHandle, $x, $y){
    $rgb = imagecolorat($imageHandle, $x, $y);
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;
    return array('r' => $r, 'g' => $g, 'b' => $b);
}

function select($x, $y, $colorToMatch, $imageHandle, $tolleranza){
    if($x < 0 || $y < 0){
        return false;
        exit();
    }
    $colorePixel = get_color($imageHandle, $x, $y);
    $colori = array('r', 'g', 'b');
    $tolleranza *= 255;
    foreach($colori as $colore){
        $differenza = differenza_colore($colore, $colorToMatch, $colorePixel);
        if($differenza > $tolleranza){
            return false;
            break;
            exit();
        }
    }
    return true;
}

function magicWand($x, $y, $tolleranza, $imageHandle){
    $livello = 0;
    $colorToMatch = get_color($imageHandle, $x, $y);
    echo "Colore pixel: ";
    print_r($colorToMatch);
    $toDo[$livello][] = array('x' => $x, 'y' => $y);
    $colore = imagecolorallocate($imageHandle, 255, 0, 168); 
    while(true){
        $count = count($toDo[$livello]);
        $livello1 = $livello + 1;
        if($count == 0){
            break;
        }
        $array = $toDo[$livello];
        for($i = 0; $i < count($toDo[$livello]); $i++){
            if(select($array[$i]['x'], $array[$i]['y'], $colorToMatch, $imageHandle, $tolleranza)){
                if(!$fatti[$array[$i]['x'] + 1][$array[$i]['y']]){
                    $toDo[$livello1][] = array('x' => $array[$i]['x'] + 1, 'y' => $array[$i]['y']);
                    $fatti[$array[$i]['x'] + 1][$array[$i]['y']] = true;
                }
                if(!$fatti[$array[$i]['x'] - 1][$array[$i]['y']]){
                    $toDo[$livello1][] = array('x' => $array[$i]['x'] - 1, 'y' => $array[$i]['y']);
                    $fatti[$array[$i]['x'] - 1][$array[$i]['y']] = true;
                }
                if(!$fatti[$array[$i]['x']][$array[$i]['y'] + 1]){
                    $toDo[$livello1][] = array('x' => $array[$i]['x'], 'y' => $array[$i]['y'] + 1);
                    $fatti[$array[$i]['x']][$array[$i]['y'] + 1] = true;
                }
                if(!$fatti[$array[$i]['x']][$array[$i]['y'] - 1]){
                    $toDo[$livello1][] = array('x' => $array[$i]['x'], 'y' => $array[$i]['y'] - 1);
                    $fatti[$array[$i]['x']][$array[$i]['y'] - 1] = true;
                }
		imagesetpixel($imageHandle, $array[$i]['x'], $array[$i]['y'], $colore);
             }
        }
        unset($toDo[$livello]);
        $livello++;
    }
}

$im = imagecreatefrompng($_GET['image']);
echo magicWand(0, 0, 0.12, $im);
imagepng($im);
imagedestroy($im);
?>
