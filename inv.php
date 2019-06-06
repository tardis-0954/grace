<?

    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';    
if(!$user) {

  header('location: /');
    
exit;

}

$place = _string(_num($_GET['place']));

switch($place) {

  default: case 0:

  $title = 'Сумка';

  break;

  case 1:

  if($user['chest'] == 0) {

    header('location: /inv/bag/');

    exit;

  }

  $title = 'Сундук';

  break;

}

include './system/h.php';  
echo '<div class="main">';
$wear = _string(_num($_GET['wear']));

if($wear) {

  $query = mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$wear.'\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');
    $inv = mysql_fetch_array($query);    

  if($inv) {
    
    $query = mysql_query('SELECT * FROM `items` WHERE `id` = \''.$inv['item'].'\'');
     $item = mysql_fetch_array($query);
    
    if($user['w_'.$item['w']]) $errors[] = 'На вас уже что-то одето';
      
    if($user['skill'] < $item['skill']) $errors[] = 'Не хватает мастерства';
      
    if($errors) {
      
      echo '<div class=\'block\' align=\'center\'>';
        
      foreach($errors as $error) {
          
        echo $error.'';
          
      }
      
      echo '</div>';
      
    }
    else
    {
    
      mysql_query('UPDATE `users` SET `str` = `str` + '.$inv['_str'].',
        
                                      `vit` = `vit` + '.$inv['_vit'].',
        
                                      `agi` = `agi` + '.$inv['_agi'].',
        
                                      `def` = `def` + '.$inv['_def'].',
      
                         `w_'.$item['w'].'` = \''.$inv['id'].'\' WHERE `id` = \''.$user['id'].'\'');
      
      
      mysql_query('UPDATE `inv` SET `equip` = \'1\' WHERE `id` = \''.$inv['id'].'\'');

    
      header('location: /inv/'.($inv['place'] == 0 ? 'bag':'chest').'/');

   }
  
  }
        
}




$unwear = _string(_num($_GET['unwear']));

if($unwear) {

  $query = mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$unwear.'\' AND `user` = \''.$user['id'].'\'');
    $inv = mysql_fetch_array($query);

  if($inv) {
    
    $query = mysql_query('SELECT * FROM `items` WHERE `id` = \''.$inv['item'].'\'');
     $item = mysql_fetch_array($query);

    if($user['w_'.$item['w']] && $user['w_'.$item['w']] == $inv['id']) {
    
      if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = \''.$place.'\' AND `user` = \''.$user['id'].'\' AND `equip` = \'0\''),0) + 1 > 20) $errors[] = 'Сумка заполнена';

      if($errors) {
      
        echo '<div class=\'block\' align=\'center\'>';
        
        foreach($errors as $error) {
          
          echo $error.'';
          
        }
      
        echo '</div>';
      
      }
      else
      {


      mysql_query('UPDATE `users` SET `str` = `str` - '.$inv['_str'].',
                                      
                                      `vit` = `vit` - '.$inv['_vit'].',
                                      
                                      `agi` = `agi` - '.$inv['_agi'].',
                                      
                                      `def` = `def` - '.$inv['_def'].',
                                      
                         `w_'.$item['w'].'` = \'0\' WHERE `id` = \''.$user['id'].'\'');

      if($place == 1 && $user['chest'] == 0) $place = 0;
    
      mysql_query('UPDATE `inv` SET `equip` = \'0\',
      
                                    `place` = \''.$place.'\' WHERE `id` = \''.$inv['id'].'\'');


      header('location: /equip/');
    
      }
    
    }
    else
    {

      if($place == 1 && $user['chest'] == 0) $place = 0;
    
      mysql_query('UPDATE `inv` SET `place` = \''.$place.'\' WHERE `id` = \''.$inv['id'].'\'');

      header('location: /inv/'.($place == 0 ? 'bag':'chest').'/');
    
    }
        
  }       

}


    
$sell = _string(_num($_GET['sell']));
    
if($sell) {


  $query = mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$sell.'\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');
    $inv = mysql_fetch_array($query);
  
  if($inv) {
          
    $_sell = array(0, 100, 250, 500, 1000, 50000, 50000);
  
    mysql_query('UPDATE `users` SET `s` = `s` + 1000 WHERE `id` = \''.$user['id'].'\'');

    mysql_query('DELETE FROM `inv` WHERE `id` = \''.$inv['id'].'\'');

    header('location: /inv/'.($place == 0 ? 'bag':'chest').'/');

  }

}

if($place == 0) {

  if($user['chest'] == 0) {

    if($_GET['buy_chest'] == true) {
  
      if($user['g'] < $config['chest']) $errors[] = 'Не хватает <img src=\'/images/icon/gold.png\'> '.($config['chest'] - $user['g']).' золота';
  
        if($errors) {

          echo '<div class=\'block\' align=\'center\'>';
          
          foreach($errors as $error) {
            
            echo $error.'';
            
          }
        
          echo '</div>';

        }
        else
        {
  
          mysql_query('UPDATE `users` SET `g` = `g` - 100,
          
                                         `chest` = \'1\' WHERE `id` = \''.$user['id'].'\'');
  
          header('location: /inv/chest/');
      
        }
  
    }

  }

}

echo '
<div class=\'menuList\'>
  <li><a href=\''.($place == 0 ? ( ($user['chest'] == 0) ? '/inv/bag/?buy_chest=true':'/inv/chest/'):'/inv/bag/').'\'><img src=\'/images/icon/bag.png\' alt=\'*\'/> '.($place == 0 ? ( ($user['chest'] == 0) ? 'Купить cундук за <img src=\'/images/icon/gold.png\' alt=\'*\'/> 100 золота':'Открыть cундук'):'Открыть cумку').'</a></li>
</div>';
echo '<div class=\'mini-line\'></div>';
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = \''.$user['id'].'\' AND `equip` = \'0\' AND `place` = \''.$place.'\''),0) > 0) {

  $i = 0;
  
  $q = mysql_query('SELECT * FROM `inv` WHERE `user` = \''.$user['id'].'\' AND `equip` = \'0\' AND `place` = \''.$place.'\' ORDER BY `id` DESC');
  while($row = mysql_fetch_array($q)) {  
  
    $i++;

  
    $item        = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$row['item'].'\''));

    switch($row['quality']) {
      case 0:
        $bonus = 0;
      $quality = 'Простой';
  $quality_col = '#908060';
       break;
      case 1:
        $bonus = 5;
      $quality = 'Обычный';
  $quality_col = '#60c030';
       break;

      case 2:
        $bonus = 10;
      $quality = 'Редкий';
  $quality_col = '#6090c0';
       break;

      case 3:
        $bonus = 15;
      $quality = 'Эпический';
  $quality_col = '#c6f';
       break;

      case 4:
        $bonus = 20;
      $quality = 'Легенарный';
  $quality_col = '#f06000';
       break;


      case 5:
        $bonus = 50;
      $quality = 'Божественный';
  $quality_col = '#909090';
       break;

      case 6:
        $bonus = 65; 
      $quality = 'Сверх Божественный';
  $quality_col = '#909090';
       break;

    }
    
    if($row['new'] == 0) {
  
      mysql_query('UPDATE `inv` SET `new` = \'1\' WHERE `id` = \''.$row['id'].'\'');
  
    }
      
    echo '<div class=\'block_zero\'>
  <table cellpadding=\'0\' cellspacing=\'0\'><tr>
  <td><img src=\'/itemImage.php?id='.$row['item'].'&smith='.$row['smith'].'\' alt=\'*\'/></td>
  <td valign=\'top\' style=\'padding-left: 5px;\'><img src=\'/images/icon/quality/'.$row['quality'].'.png\' alt=\'*\'/> <a href=\'/item/'.$row['id'].'/\'>'.$item['name'].'</a> '.($row['smith'] > 0 ? '<font color=\'#90c090\'>+'.$row['smith'].'</font>':'').'<br/>
  <small><small><font color=\''.$quality_col.'\'>'.$quality.' ['.$row['bonus'].'/'.$bonus.']</font> ';
  
    if($user['w_'.$item['w']]) {
      
      $equipitem = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$user['w_'.$item['w']].'\''));
      
      if( ( $row['_str'] + $row['_vit'] + $row['_agi'] + $row['_def'] ) - ( $equipitem['_str'] + $equipitem['_vit'] + $equipitem['_agi'] + $equipitem['_def'] ) > 0) echo '<font color=\'#30c030\'>+'.(( $row['_str'] + $row['_vit'] + $row['_agi'] + $row['_def'] ) - ( $equipitem['_str'] + $equipitem['_vit'] + $equipitem['_agi'] + $equipitem['_def'] )).'</font>';
   
    }
    else
    {
      
      echo '<font color=\'#30c030\'>+'.( $row['_str'] + $row['_vit'] + $row['_agi'] + $row['_def'] ).'</font>';

    }

    echo '<br/>
<font color=\'#'.(($user['skill'] < $item['skill']) ? 'c06060':'ffffff').'\'>Мастерство: '.$item['skill'].'</font>';

    if($row['rune']) {
      
    switch($row['rune']) {
    
      case 1:
      $rune_stats =   75;
      break;
      
      case 2:
      $rune_stats =  150;
      break;

      case 3:
      $rune_stats =  250;
      break;

      case 4:
      $rune_stats =  600;
      break;

      case 5:
      $rune_stats = 1000;
      break;
      
    }
    
    switch($item['w']) {
      
      case 1:
      $rune_stat =  'силы';
      break;

      case 2:
      $rune_stat = 'жизни';
      break;

      case 3:
      $rune_stat = 'брони';
      break;

      case 4:
      $rune_stat = 'удачи';
      break;

      case 5:
      $rune_stat =  'силы';
      break;

      case 6:
      $rune_stat =  'силы';
      break;

      case 7:
      $rune_stat = 'брони';
      break;

      case 8:
      $rune_stat = 'жизни';
      break;

    }
    
      echo '<br/>
<img src=\'/images/icon/quality/'.$row['rune'].'.png\' alt=\'*\'/> <font color=\'#90c090\'>+'.$rune_stats.'</font> '.$rune_stat.'<br/>';

    }

    echo '</small></small></td>
</tr></table>
<div align=\'center\'>';

    if(!$user['w_'.$item['w']]) echo ' <a class=\'btn\' href=\'/inv/wear/'.$row['id'].'/\'><span class=\'end\'><span class=\'label\'>Надеть</a></span></span>';

             if($user['chest']) echo ' <a class=\'btn\' href=\'/inv/move/'.($place == 0 ? 1:0).'/'.$row['id'].'/\'><span class=\'end\'><span class=\'label\'>В '.($place == 0 ? 'сундук':'сумку').'</a></span></span>';
 
    echo '</div>
</div>';


    if($i < mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = \''.$user['id'].'\' AND `equip` = \'0\' AND `place` = \''.$place.'\''),0))echo '<div class=\'mini-line\'></div>';

  }

}
else
{

  echo '<div class=\'block_zero\'>
  <font color=\'#909090\'>'.($place == 0 ? 'Сумка пуста':'Сундук пуст').'</font>
</div>';

}
echo '</div>';
include './system/f.php';

?>