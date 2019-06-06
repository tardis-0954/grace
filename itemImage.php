<?

include './system/functions.php';


    header('content-type: image/jpeg');
         
       $id = _string(_num($_GET['id']));
       
    $image = imageCreateFromPng('./images/items/'.$id.'.png');
    
    $smith = _string(_num($_GET['smith']));
    
    /*
    if($smith) {

    if($smith > 0 && $smith < 4) {
      $_smith = 1;
    }

    if($smith == 20) {
      $_smith = 7;
    }
    
    $smith_image
           = imageCreateFromPng('./images/items/smith/'.$_smith.'.png');
              
             imagecopy($image, $smith_image, 0, 0, 0, 0, 50, 50);

    }*/
    
    imageJpeg($image);

?>