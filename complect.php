<?

    include './system/common.php';
    
 include './system/functions.php';
         
      include './system/user.php';
    
if(!$user) {

  header('location: /');
  exit;

}

      $id = _string(_num($_GET['id']));
$complect = mysql_fetch_array(mysql_query('SELECT * FROM `complects` WHERE `id` = \''.$id.'\''));
 
  if(!$complect) {

    header('location: /');
    exit;

  }
    

$title = $complect['name'];

include './system/h.php';
echo '<div class=\'main\'>
<div class=\'block_zero\'>
  <img src=\'/manekenImage/'.$user['sex'].'/'.$complect['w_1'].'/'.$complect['w_2'].'/'.$complect['w_3'].'/'.$complect['w_4'].'/'.$complect['w_5'].'/'.$complect['w_6'].'/'.$complect['w_7'].'/'.$complect['w_8'].'/\'/>
</div>
<div class=\'mini-line\'></div>';

$cost = 0;

for($w = 1; $w < 9; $w++) {

  $itemshop = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `id` = \''.$complect['w_'.$w].'\''));

  $cost += $itemshop['cost'];

}

echo '<div class=\'menuList\'>
  <li><a href=\'/shop/?buy_complect='.$complect['id'].'\'><img src=\'/images/icon/arrow.png\' alt=\'*\'/> Купить весь комплект за <img src=\'/images/icon/gold.png\' alt=\'*\'/> '.$cost.' золота</a></li>
</div>
<div class=\'mini-line\'></div>';

for($w = 1; $w < 9; $w++) {

  echo '<div class=\'block_zero\'>
  <table cellpadding=\'0\' cellspacing=\'0\'><tr>';

  $itemshop = mysql_fetch_array(mysql_query('SELECT * FROM `shop`  WHERE `id` = \''.$complect['w_'.$w].'\''));
  $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$complect['w_'.$w].'\''));

  $itemquality = array('Простой', 'Обычный', 'Редкий', 'Эпический', 'Легендарный', 'Божественный', 'Сверх Божественный');
  $quality_col = array('#908060', '#60c030', '#6090c0', '#c060f0', '#f06000', '#909090', '#909090');
  $itembonus   = array(0,5,10,15,20,50,65);

  echo '<td><img src=\'/itemImage.php?id='.$itemshop['id'].'\' alt=\'*\'/></td>
  <td valign=\'top\' style=\'padding-left: 5px;\'><img src=\'/images/icon/quality/'.$itemshop['quality'].'.png\' alt=\'*\'/> <a href=\'/itemshop/'.$itemshop['id'].'/\'>'.$item['name'].'</a><br/>
  <small><small><font color=\''.$quality_col[$itemshop['quality']].'\'>'.$itemquality[$itemshop['quality']].' ['.$itemshop['bonus'].'/'.$itembonus[$itemshop['quality']].']</font> ';

  if($user['w_'.$item['w']]) {

    $equipitem = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$user['w_'.$item['w']].'\''));      
    
    if( ($itemshop['_str'] + $itemshop['_vit'] + $itemshop['_agi'] + $itemshop['_def']) - ($equipitem['_str'] + $equipitem['_vit'] + $equipitem['_agi'] + $equipitem['_def']) > 0) echo '<font color=\'#30c030\'>+'.(($itemshop['_str'] + $itemshop['_vit'] + $itemshop['_agi'] + $itemshop['_def']) - ($equipitem['_str'] + $equipitem['_vit'] + $equipitem['_agi'] + $equipitem['_def'])).'</font>';
    
  }
  else
  {
    
    echo '<font color=\'#30c030\'>+'.($itemshop['_str'] + $itemshop['_vit'] + $itemshop['_agi'] + $itemshop['_def']).'</font>';

  }
  
  echo '</small></small></td>
  </tr></table>
  
  <div align=\'center\'>

   
<a href=\'/shop/?buy_item='.$itemshop['id'].'\' class=\'btn\'><span class=\'end\'><span class=\'label\'><span class=\'white\'> Купить за <img src=\'/images/icon/gold.png\' alt=\'*\'/> '.$itemshop['cost'].' золота</a></span></span></span></div>
</div>
<div class=\'mini-line\'></div>';

}

echo '<div class=\'menuList\'>
  <li><a href=\'/shop/'.$complect['quality'].'/\'><img src=\'/images/icon/equip.png\' alt=\'*\'/> Комплекты</a></li>
  <li><a href=\'/shop/\'><img src=\'/images/icon/equip.png\' alt=\'*\'/> Магазин снаряжения</a></li>
</div>';
echo '</div>';
include './system/f.php';

?>