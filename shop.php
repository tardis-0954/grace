<?
    include './system/common.php';
    
 include './system/functions.php';
         
      include './system/user.php';

if(!$user) {
  header('location: /');
  exit;
}

$title = 'Магазин снаряжения';    

include './system/h.php';  
echo "<div class='main'>";
$buy_complect = _string(_num($_GET['buy_complect']));

    if($buy_complect) {

    if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = "0" AND `user` = "'.$user['id'].'" AND `equip` = "0"'),0) + 8 > 20) {
      header('location: /shop/');
    exit;
    }
    
    $complect = mysql_query('SELECT * FROM `complects` WHERE `id` = "'.$buy_complect.'"');
    $complect = mysql_fetch_array($complect);
    
    switch($complect['quality']) {
      case 1:
      $complect_quality_skill =   1;
       break;
      case 2:
      $complect_quality_skill =  10;
       break;
      case 3:
      $complect_quality_skill =  24;
       break;
      case 4:
      $complect_quality_skill =  48;
       break;
      case 5:
      $complect_quality_skill = 200;
       break;
      case 6:
      $complect_quality_skill = 250;
       break;
    }
    
    if(!$complect OR $complect_quality_skill > $user['skill']) {
      header('location: /shop');
    exit;
    }
    
    $cost = 0;
    
    for($w = 1; $w < 9; $w++) {
      $shop = mysql_query('SELECT * FROM `shop` WHERE `id` = "'.$complect['w_'.$w].'"');
      $shop = mysql_fetch_array($shop);
    $cost +=$shop['cost'];
    }
    
    $cost -= round(($cost / 100) * 25);
    
    if($user['g'] < $cost) {
      header('location: /shop/');
    exit;
    }

    mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $cost).'" WHERE `id` = "'.$user['id'].'"');

    for($w = 1; $w < 9; $w++) {
    
      $shop = mysql_query('SELECT * FROM `shop` WHERE `id` = "'.$complect['w_'.$w].'"');
      $shop = mysql_fetch_array($shop);
    
    
      mysql_query('INSERT INTO `inv` (`user`,
                                      `item`,
                                     `bonus`,
                                      `_str`,
                                      `_vit`,
                                      `_agi`,
                                      `_def`) VALUES ("'.$user['id'].'",
                                                      "'.$shop['id'].'",
                                                   "'.$shop['bonus'].'",
                                                    "'.$shop['_str'].'",
                                                    "'.$shop['_vit'].'",
                                                    "'.$shop['_agi'].'",
                                                    "'.$shop['_def'].'")');
    
    }
    
      header('location: /inv/bag/');
    
    }






$buy_item = _string(_num($_GET['buy_item']));
if($buy_item) {

  $itemshop = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `id` = \''.$buy_item.'\''));
  
  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = \'0\' AND `user` = \''.$user['id'].'\' AND `equip` = \'0\''),0) + 1 > 20) $errors[] = 'Ваша сумка заполнена';
  
  if($itemshop['cost'] > $user['g']) $errors[] = 'Не хватает <img src=\'/images/icon/g.png\' alt=\'*\'/> '.($itemshop['cost'] - $user['g']).' золота<div class=\'separ\'></div>
<a class=\'btn\' href=\'/trade\'><span class=\'end\'><span class=\'label\'>Купить золото</span></span></a>  ';
  
  if($errors) {
      
        echo '<div class=\'block_zero\' align=\'center\'>';
        
        foreach($errors as $error) {
          
          echo $error.'<br/>';
          
        }
      
        echo '</div>
<div class=\'mini-line\'></div>';
      
  }
  else
  {

    mysql_query('UPDATE `users` SET `g` = `g` - '.$itemshop['cost'].' WHERE `id` = \''.$user['id'].'\'');
  
    mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                  `quality`,
                                   `bonus`,
                                    `_str`,
                                    `_vit`,
                                    `_agi`,
                                    `_def`,
                                   `place`) VALUES (\''.$user['id'].'\',
                                                \''.$itemshop['id'].'\',
                                           \''.$itemshop['quality'].'\',
                                             \''.$itemshop['bonus'].'\',
                                              \''.$itemshop['_str'].'\',
                                              \''.$itemshop['_vit'].'\',
                                              \''.$itemshop['_agi'].'\',
                                              \''.$itemshop['_def'].'\',
                                                                  \'0\')');

    header('location: /inv/bag/');
  
  }
  
}
$quality = _string(_num($_GET['quality']));
if($quality) {

  if($quality == 1 && $user['skill'] < 1 OR $quality == 2 && $user['skill'] < 10 OR $quality == 3 && $user['skill'] < 24 OR $quality == 4 && $user['skill'] < 48 OR $quality == 5 && $user['skill'] < 200) {
    
      header('location: /shop/');
      exit;
    
  }

  $q = mysql_query('SELECT * FROM `complects` WHERE `quality` = \''.$quality.'\'');    
  while($row = mysql_fetch_array($q)) {

    echo '<div class=\'menuList\'>
  <li><a href=\'/complect/'.$row['id'].'/\'><img src=\'/images/icon/quality/'.$row['quality'].'.png\' alt=\'*\'/> '.$row['name'].'</a></li>
  <div class=\'block_zero\' align=\'center\'>
    <a href=\'/complect/'.$row['id'].'/\'><img src=\'/manekenImage/'.$user['sex'].'/'.$row['w_1'].'/'.$row['w_2'].'/'.$row['w_3'].'/'.$row['w_4'].'/'.$row['w_5'].'/'.$row['w_6'].'/'.$row['w_7'].'/'.$row['w_8'].'/\'/></a>
  </div>
</div><div class=\'mini-line\'></div>';
      
  }

  echo '<div class=\'menuList\'>
  <li><a href=\'/shop/\'><img src=\'/images/icon/equip.png\' alt=\'*\'/> Магазин снаряжения</a></li>
</div>';

}
else
{
 
  echo '<div class=\'block_zero\' align=\'center\'>
  
  
<img src=\'/rusalc/torg.jpg\' width=\'100%\' alt=\'*\'/></center><br/>
</div>
<div class=\'mini-line\'></div>';

  if($user['skill'] > 199) {

    echo '<div class=\'block_zero\'>
  <img src=\'/images/icon/quality/5.png\'/> <a href=\'/shop/5/\'><font color=\'#909090\'>Божественные вещи</font></a><br/>
  <small><small>Мастерство: <img src=\'/images/icon/skill.png\' alt=\'*\'/> 200</small></small>
</div>
<div class=\'mini-line\'></div>';

  }

  if($user['skill'] > 47) {

    echo '<div class=\'block_zero\'>
  <img src=\'/images/icon/quality/4.png\'/> <a href=\'/shop/4/\'><font color=\'#f06000\'>Легендарные вещи</font></a><br/>
  <small><small>Мастерство: <img src=\'/images/icon/skill.png\' alt=\'*\'/> 48</small></small>
</div>
<div class=\'mini-line\'></div>';

  }

  if($user['skill'] > 23) {
    
    echo '<div class=\'block_zero\'>
  <img src=\'/images/icon/quality/3.png\'/> <a href=\'/shop/3/\'><font color=\'#c060f0\'>Эпические вещи</font></a><br/>
  <small><small>Мастерство: <img src=\'/images/icon/skill.png\' alt=\'*\'/> 24</small></small>
</div>
<div class=\'mini-line\'></div>';

  }

  if($user['skill'] > 9) {

    echo '<div class=\'block_zero\'>
  <img src=\'/images/icon/quality/2.png\'/> <a href=\'/shop/2/\'><font color=\'#6090c0\'>Редкие вещи</font></a><br/>
  <small><small>Мастерство: <img src=\'/images/icon/skill.png\' alt=\'*\'/> 10</small></small>
</div>
<div class=\'mini-line\'></div>';

  }

  if($user['skill'] >= 0) {

    echo '<div class=\'block_zero\'>
  <img src=\'/images/icon/quality/1.png\'/> <a href=\'/shop/1/\'><font color=\'#60c030\'>Обычные вещи</font></a><br/>
  <small><small>Мастерство: <img src=\'/images/icon/skill.png\' alt=\'*\'/> 1</small></small>
</div>
<div class=\'mini-line\'></div>';

  }

  echo '<div class=\'block_zero\'>
  <img src=\'/images/icon/skill.png\' alt=\'*\'/> Мастерство: '.$user['skill'].'</div>';

}
  echo "</div>";
include './system/f.php';

?>