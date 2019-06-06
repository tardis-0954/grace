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
echo "<div class='main'>";
  switch($item['quality']) {
    case 0:
  $bonus = 0;
      $quality = 'Простой';
$quality_color = "#908060";
     break;
    case 1:
  $bonus = 5;
      $quality = 'Обычный';
$quality_color = "#60c030";
     break;

    case 2:
 $bonus = 10;
      $quality = 'Редкий';
$quality_color = "#6090c0";
     break;

    case 3:
 $bonus = 15;
 
      $quality = 'Эпический';
$quality_color = "#c060f0";
     break;

    case 4:
 $bonus = 20;
 
      $quality = 'Легенарный';
$quality_color = "#f06000";
     break;


    case 5:
 $bonus = 50;
      $quality = 'Божественный';
$quality_color = "#909090";
     break;


    case 6:
 $bonus = 65; 
      $quality = 'Сверх Божественный';
$quality_color = "#909090";
     break;

  }

    switch($item['w']) {
      case 1:
      $w = 'Голова';
      break;
      case 2:
      $w = 'Плечи';
      break;
      case 3:
      $w = 'Торс';
      break;
      case 4:
      $w = 'Перчатки';
      break;
      case 5:
      $w = 'Левая рука';
      break;
      case 6:
      $w = 'Правая рука';
      break;
      case 7:
      $w = 'Ноги';
      break;
      case 8:
      $w = 'Обувь';
      break;
    }

?>
<div class='block_zero'>
<table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$item['id']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt="*"/> <?=$item['name']?>, <?=$w?>
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

    $equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item['w']].'"');
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

  <div class='mini-ine'></div>
<div class='block_zero' align='center'>
<a class='btn' href='/shop/?buy_item=<?=$shop['id']?>'><span class='end'><span class='label'>Купить за <img src='/images/icon/gold.png' alt='*'/> <?=$shop['cost']?></span></span></a>

</div>

<?

  if($equip_item) {

    $i_equip_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$equip_item['item'].'"');
    $i_equip_item = mysql_fetch_array($i_equip_item);

  switch($i_equip_item['quality']) {
    case 0:
  $bonus = 0;
      $quality = 'Простой';
$quality_color = "#908060";
     break;
    case 1:
  $bonus = 5;
      $quality = 'Обычный';
$quality_color = "#60c030";
     break;

    case 2:
 $bonus = 10;
      $quality = 'Редкий';
$quality_color = "#6090c0";
     break;

    case 3:
 $bonus = 15;
 
      $quality = 'Эпический';
$quality_color = "#c060f0";
     break;

    case 4:
 $bonus = 20;
 
      $quality = 'Легенарный';
$quality_color = "#f06000";
     break;


    case 5:
 $bonus = 50;
      $quality = 'Божественный';
$quality_color = "#909090";
     break;


    case 6:
 $bonus = 65; 
      $quality = 'Сверх Божественный';
$quality_color = "#909090";
     break;

  }

    switch($i_equip_item['w']) {
      case 1:
      $w = 'Голова';
      break;
      case 2:
      $w = 'Плечи';
      break;
      case 3:
      $w = 'Торс';
      break;
      case 4:
      $w = 'Перчатки';
      break;
      case 5:
      $w = 'Левая рука';
      break;
      case 6:
      $w = 'Правая рука';
      break;
      case 7:
      $w = 'Ноги';
      break;
      case 8:
      $w = 'Обувь';
      break;
    }

?>

 <div class='title'>На вас одето</div>
  <div class='mini-line'></div>

  <div class='block_zero'>

<table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$equip_item['item']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$i_equip_item['quality']?>.png' alt="*"/> <?=$i_equip_item['name']?>, <?=$w?>
  <br/>
  <small><small>
  <font color='<?=$quality_color?>'><?=$quality?> [<?=$equip_item['bonus']?>/<?=$bonus?>]</font><br/>
    Мастерство: <img src='/images/icon/skill.png' alt='*'/> <font color='#<?=($i_equip_item['skill'] > $user['skill'] ? 'c06060':'ffffff')?>'><?=$i_equip_item['skill']?></font>
  </small></small></td>
</tr></table>
  
  </div><div class='mini-line'></div>
  <div class='block_zero'>

  <img src='/images/icon/str.png' alt='*'/> Сила:  <?=$equip_item['_str']?><br/>
  <img src='/images/icon/vit.png' alt='*'/> Жизнь: <?=$equip_item['_vit']?><br/>
  <img src='/images/icon/agi.png' alt='*'/> Удача: <?=$equip_item['_agi']?><br/>
  <img src='/images/icon/def.png' alt='*'/> Защита:<?=$equip_item['_def']?><br/>
  
  </div>

<?
  
  }
echo "</div>";
include './system/f.php';

?>