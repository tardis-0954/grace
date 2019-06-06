<?

   include './system/common.php';

include './system/functions.php';


    header('content-type: image/jpeg');
         
        $g = _string(_num($_GET['g']));
       
    $image = imageCreateFromPng('./images/maneken/'.$g.'.png');
    
      $w_7 = _string(_num($_GET['w_7']));
    
$w_7_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_7.'"');
$w_7_item = mysql_fetch_array($w_7_item);

    if($w_7 && is_file('./images/maneken/'.$g.'/'.$w_7.'.png') && $w_7_item['w'] == 7) {
        
 $w_7_image = imageCreateFromPng('./images/maneken/'.$g.'/'.$w_7.'.png');
              
             imagecopy($image, $w_7_image, 0, 0, 0, 0, 120, 160);
    
    }
    
      $w_8 = _string(_num($_GET['w_8']));

$w_8_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_8.'"');
$w_8_item = mysql_fetch_array($w_8_item);

    if($w_8 && is_file('./images/maneken/'.$g.'/'.$w_8.'.png') && $w_8_item['w'] == 8) {
        
$w_8_image = imageCreateFromPng('./images/maneken/'.$g.'/'.$w_8.'.png');
              
             imagecopy($image, $w_8_image, 0, 0, 0, 0, 120, 160);
    
    }

      $w_3 = _string(_num($_GET['w_3']));

$w_3_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_3.'"');
$w_3_item = mysql_fetch_array($w_3_item);

    if($w_3 && is_file('./images/maneken/'.$g.'/'.$w_3.'.png') && $w_3_item['w'] == 3) {
        
$w_3_image = imageCreateFromPng('./images/maneken/'.$g.'/'.$w_3.'.png');
              
             imagecopy($image, $w_3_image, 0, 0, 0, 0, 120, 160);
    
    }

      $w_1 = _string(_num($_GET['w_1']));

$w_1_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_1.'"');
$w_1_item = mysql_fetch_array($w_1_item);

    if($w_1 && is_file('./images/maneken/'.$g.'/'.$w_1.'.png') && $w_1_item['w'] == 1) {
        
$w_1_image = imageCreateFromPng('./images/maneken/'.$g.'/'.$w_1.'.png');
              
             imagecopy($image, $w_1_image, 0, 0, 0, 0, 120, 160);
    
    }

      $w_2 = _string(_num($_GET['w_2']));

$w_2_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_2.'"');
$w_2_item = mysql_fetch_array($w_2_item);
   
    if($w_2 && is_file('./images/maneken/'.$g.'/'.$w_2.'.png') && $w_2_item['w'] == 2) {
        
$w_2_image = imageCreateFromPng('./images/maneken/'.$g.'/'.$w_2.'.png');
              
             imagecopy($image, $w_2_image, 0, 0, 0, 0, 120, 160);
    
    }

      $w_4 = _string(_num($_GET['w_4']));

$w_4_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_4.'"');
$w_4_item = mysql_fetch_array($w_4_item);

    if($w_4 && is_file('./images/maneken/'.$g.'/'.$w_4.'.png') && $w_4_item['w'] == 4) {
        
$w_4_image = imageCreateFromPng('./images/maneken/'.$g.'/'.$w_4.'.png');
              
             imagecopy($image, $w_4_image, 0, 0, 0, 0, 120, 160);
    
    }

      $w_6 = _string(_num($_GET['w_6']));

$w_6_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_6.'"');
$w_6_item = mysql_fetch_array($w_6_item);
    
    if($w_6 && is_file('./images/maneken/'.$g.'/'.$w_6.'.png') && $w_6_item['w'] == 6) {
        
$w_6_image = imageCreateFromPng('./images/maneken/'.$g.'/'.$w_6.'.png');
              
             imagecopy($image, $w_6_image, 0, 0, 0, 0, 120, 160);
    
    }

      $w_5 = _string(_num($_GET['w_5']));
    
$w_5_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_5.'"');
$w_5_item = mysql_fetch_array($w_5_item);

    if($w_5 && is_file('./images/maneken/'.$g.'/'.$w_5.'.png') && $w_5_item['w'] == 5) {
        
        $w_5_image = imageCreateFromPng('./images/maneken/'.$g.'/'.$w_5.'.png');
              
              imagecopy($image, $w_5_image, 0, 0, 0, 0, 120, 160);
    
    }    
    
    imageJpeg($image);

?>