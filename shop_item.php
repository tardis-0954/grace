<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

$id = _string(_num($_GET['id']));
 
  $shop = mysql_query('SELECT * FROM `shop` WHERE `id` = "'.$id.'"');
    
  $shop = mysql_fetch_array($shop);
 
  if(!$shop) {

    header('location: /');
    
  exit;

  }
 
  $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$shop['id'].'"');
    
  $item = mysql_fetch_array($item);
    

  $title = $item['name'];

include './system/h.php';
 echo '<div class="main">';
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
<div class='block_zero'>
<table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$item['id']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt="*"/> <?=$item['name']?>
  <br/>
  <small><small>
  <font color='<?=$quality_color?>'><?=$quality?> [<?=$shop['bonus']?>/<?=$bonus?>]</font><br/> 
  Мастерство: <img src='/images/icon/skill.png' alt='*'/> <font color='#<?=($item['skill'] > $user['skill'] ? 'c06060':'ffffff')?>'><?=$item['skill']?></font>
  </small></small></td>
</tr></table>
</div>
  <div class='mini-line'></div>
<div class="block_zero">
<?

    $equip_item = mysql_query('SELECT * FROM `bag` WHERE `id` = "'.$user['w_'.$item['w']].'"');
      
    $equip_item = mysql_fetch_array($equip_item);

    $diff = 0;

?>

  <img src='/images/icon/str.png' alt='*'/> Сила: <font color="
  
<?

    if($shop['_str'] > $equip_item['_str']) {
    
    $diff += $shop['_str'] - $equip_item['_str'];
    
?>#3c3<?  
    
    }
    else
    {

?>#c66<?
    
    }
    

?>
  
  "> <?=$shop['_str']?></font><br/>

  <img src='/images/icon/vit.png' alt='*'/> Жизнь: <font color="
  
<?

    if($shop['_vit'] > $equip_item['_vit']) {

    $diff += $shop['_vit'] - $equip_item['_vit'];

?>#3c3<?  
    
    }
    else
    {

?>#c66<?
    
    }

?>
  
  ">
  <?=$shop['_vit']?></font><br/>
  <img src='/images/icon/agi.png' alt='*'/> Удача: <font color="
  
<?

    if($shop['_agi'] > $equip_item['_agi']) {

    $diff += $shop['_agi'] - $equip_item['_agi'];

?>#3c3<?  
    
    }
    else
    {

?>#c66<?
    
    }

?>
  
  "><?=$shop['_agi']?></font><br/>
  <img src='/images/icon/def.png' alt='*'/> Защита: <font color="
  
<?

    if($shop['_def'] > $equip_item['_def']) {

    $diff += $shop['_def'] - $equip_item['_def'];

?>#3c3<?  
    
    }
    else
    {

?>#c66<?
    
    }

?>
  
  "><?=$shop['_def']?></font><br/>
<?
  
  if($user['w_'.$item['w']]) {
  
    if($item['_str'] > $myitem['_str'] OR $item['_vit'] > $myitem['_vit'] OR $item['_agi'] > $myitem['_agi'] OR $item['_def'] > $myitem['_def']) {

?>

<img src='/images/icon/quest.png' alt='*'/> <font color='#3c3'>Лучше +<?=$diff?></font>

<?

    }
  
  }
  
?>
</div>

  <div class='mini-line'></div>
<div class='block_zero' align='center'>

<a class='btn' href='/shop/?buy_item=<?=$shop['id']?>'><span class='end'><span class='label'>Купить за <img src='/images/icon/gold.png' alt='*'/> <?=$shop['cost']?> золота</a></span></span>

</div>

<?
echo '</div>';
include './system/f.php';

?>