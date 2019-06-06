<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

$id = _string(_num($_GET['id']));
  if($id && $id != $user['id']) {
    $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $i = mysql_fetch_array($i);
    if(!$i) {    
      header('location: /user/');
    exit; 
    }
    $title = 'Снаряжение '.$i['login'];
    }
    else
    {
        $i = $user;
    $title = 'Снаряжение';
    }
    

include './system/h.php';  

?>

<div class='main'>

<?

    for($w = 1; $w < 9; $w++) {
      
    switch($w) {
      case 1:
      $w_name = 'Голова';
      break;
      case 2:
      $w_name = 'Плечи';
      break;
      case 3:
      $w_name = 'Торс';
      break;
      case 4:
      $w_name = 'Перчатки';
      break;
      case 5:
      $w_name = 'Левая рука';
      break;
      case 6:
      $w_name = 'Правая рука';
      break;
      case 7:
      $w_name = 'Ноги';
      break;
      case 8:
      $w_name = 'Обувь';
      break;
    }

?>

<div class='block_zero'>
<table cellpadding='0' cellspacing='0'>
<tr>
  
<?

        if($i['w_'.$w]) {
        
    $inv = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$i['w_'.$w].'"');      
    $inv = mysql_fetch_array($inv);

        $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$inv['item'].'"');
        $item = mysql_fetch_array($item);

  switch($item['quality']) {
    case 0:
  $bonus = 0;
      $quality = 'Простой';
$quality_color = "#986";
     break;
    case 1:
  $bonus = 5;
      $quality = 'Обычный';
$quality_color = "#6c3";
     break;

    case 2:
 $bonus = 10;
      $quality = 'Редкий';
$quality_color = "#69c";
     break;

    case 3:
 $bonus = 15;
 
      $quality = 'Эпический';
$quality_color = "#c6f";
     break;

    case 4:
 $bonus = 20;
 
      $quality = 'Легенарный';
$quality_color = "#f60";
     break;


    case 5:
 $bonus = 50;
      $quality = 'Божественный';
$quality_color = "#999";
     break;


    case 6:
 $bonus = 65; 
      $quality = 'Сверх Божественный';
$quality_color = "#999";
     break;

  }  
?>
  <td><img src='/itemImage.php?id=<?=$inv['item']?>&smith=<?=$inv['smith']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt='*'/> <a href='/item/<?=$inv['id']?>/'><?=$item['name']?></a>
<?
    if($inv['smith'] > 0) {
?>
<font color='#9c9'>+<?=$inv['smith']?></font>
<?
    }
?>
  <br/>
  <small><small>
  <font color="<?=$quality_color?>"><?=$quality?> [<?=$inv['bonus']?>/<?=$bonus?>]</font>
<?

    if($user['w_'.$item['w']] != 0) {
      
      $equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item['w']].'"');
      $equip_item = mysql_fetch_array($equip_item);        
    
      if(($inv['_str']+$inv['_vit']+$inv['_agi']+$inv['_def']) - ($equip_item['_str']+$equip_item['_vit']+$equip_item['_agi']+$equip_item['_def']) > 0) {
    
?>

  <font color='#3c3'>+<?=($inv['_str']+$inv['_vit']+$inv['_agi']+$inv['_def']) - ($equip_item['_str']+$equip_item['_vit']+$equip_item['_agi']+$equip_item['_def'])?></font>

<?

      }

  
    }
    else
    {

?>

  <font color="#3c3">+<?=($inv['_str']+$inv['_vit']+$inv['_agi']+$inv['_def'])?></font>

<?

    }


  if($inv['rune']) {
  
    switch($inv['rune']) {
      case 1:
      $rune_stats = 75; 
       break;
      case 2:
      $rune_stats = 150; 
       break;
      case 3:
      $rune_stats = 250; 
       break;
      case 4:
      $rune_stats = 600; 
       break;
      case 5:
      $rune_stats = 1000; 
       break;
    }
    
    switch($item['w']) {
      case 1:
      $rune_stat = 'силы'; 
       break;
      case 2:
      $rune_stat ='жизни'; 
       break;
      case 3:
      $rune_stat ='брони'; 
       break;
      case 4:
      $rune_stat ='удачи'; 
       break;
      case 5:
      $rune_stat = 'силы'; 
       break;
      case 6:
      $rune_stat = 'силы'; 
       break;
      case 7:
      $rune_stat ='брони'; 
       break;
      case 8:
      $rune_stat ='жизни'; 
       break;
    }

?>

  <br/>
  <img src='/images/icon/quality/<?=$inv['rune']?>.png' alt='*'/> <font color='#90c090'>+<?=$rune_stats?></font> <?=$rune_stat?>

<?
  
  }

?>

  </small></small>
  </td>

<?

  }
  else
  {
        
?>
  <td><img src='/images/item_null.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=$w_name?></td>
<?
        
  }

?>
</tr></table>
</div>
<?
    if($i < 8) {
?>
<?
    }

  }
  echo '</div>';
include './system/f.php';

?>