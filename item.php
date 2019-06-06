<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

$id = _string(_num($_GET['id']));
  $inv = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$id.'"');
  $inv = mysql_fetch_array($inv);

  if(!$inv) {
    header('location: /');
  exit;
  }
 
  $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$inv['item'].'"');
  $item = mysql_fetch_array($item);
    

  $title = $item['name'];

include './system/h.php';
echo '<div class="main">';
  switch($item['quality']) {
    case 0:
  $all_bonus = 0;
      $quality = 'Простой';
$quality_color = "#986";
     break;
    case 1:
  $all_bonus = 5;
      $quality = 'Обычный';
$quality_color = "#6c3";
     break;

    case 2:
 $all_bonus = 10;
      $quality = 'Редкий';
$quality_color = "#69c";
     break;

    case 3:
 $all_bonus = 15;
 
      $quality = 'Эпический';
$quality_color = "#c6f";
     break;

    case 4:
 $all_bonus = 20;
 
      $quality = 'Легенарный';
$quality_color = "#f60";
     break;


    case 5:
 $all_bonus = 50;
      $quality = 'Божественный';
$quality_color = "#999";
     break;


    case 6:
 $all_bonus = 65; 
      $quality = 'Сверх Божественный';
$quality_color = "#999";
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
  <td><img src='/itemImage.php?id=<?=$item['id']?>&smith=<?=$inv['smith']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt="*"/> <?=$item['name']?>, <?=$w?>
  <br/>
  <small><small>
  <font color='<?=$quality_color?>'><small><?=$quality?> [<?=$inv['bonus']?>/<?=$all_bonus?>]</font><br/>
  Мастерство: <img src='/images/icon/skill.png' alt='*'/>

<?
if($user['skill'] < $item['skill']) {
?>
<font color='#c66'>
<?
}

echo $item['skill'];

if($user['skill'] < $item['skill']) {
?>
</font>
<?
}
?>

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

    if($inv['_str'] > $equip_item['_str']) {
    
      $diff += $inv['_str'] - $equip_item['_str'];
    
?>#3c3<?  
    
    }
    else
    {

?>#c66<?
    
    }
    

?>
  
  "> <?=$inv['_str']?></font><br/>

  <img src='/images/icon/vit.png' alt='*'/> Жизнь: <font color="
  
<?

    if($inv['_vit'] > $equip_item['_vit']) {

      $diff += $inv['_vit'] - $equip_item['_vit'];

?>#3c3<?  
    
    }
    else
    {

?>#c66<?
    
    }

?>
  
  ">
  <?=$inv['_vit']?></font><br/>
  <img src='/images/icon/agi.png' alt='*'/> Удача: <font color="
  
<?

    if($inv['_agi'] > $equip_item['_agi']) {

      $diff += $inv['_agi'] - $equip_item['_agi'];

?>#3c3<?  
    
    }
    else
    {

?>#c66<?
    
    }

?>
  
  "><?=$inv['_agi']?></font><br/>
  <img src='/images/icon/def.png' alt='*'/> Защита: <font color="
  
<?

    if($inv['_def'] > $equip_item['_def']) {
      $diff += $inv['_def'] - $equip_item['_def'];
?>#3c3<?  
    }
    else
    {
?>#c66<?
    }
?>"><?=$inv['_def']?></font><br/>
<?
  
  if($user['w_'.$item['w']] != 0) {
    if($inv['_str'] > $equip_item['_str'] OR $inv['_vit'] > $equip_item['_vit'] OR $inv['_agi'] > $equip_item['_agi'] OR $inv['_def'] > $equip_item['_def']) {

?>
<img src='/images/icon/quest.png' alt='*'/> <font color='#3c3'>Лучше +<?=$diff?></font>
<?

    }
  
  }
    
    $smith = 0;
  
  if($inv['smith'] > 0) {
    $smith += 24;
  }

  if($inv['smith'] > 1) {
  
    $smith += 28;
  
  }

  if($inv['smith'] > 2) {
  
    $smith += 32;
  
  }

  if($inv['smith'] > 3) {
  
    $smith += 36;
  
  }

  if($inv['smith'] > 4) {
  
    $smith += 40;
  
  }

  if($inv['smith'] > 5) {
  
    $smith += 44;
  
  }

  if($inv['smith'] > 6) {
  
    $smith += 48;
  
  }

  if($inv['smith'] > 7) {

    $smith += 52;
  
  }

  if($inv['smith'] > 8) {
  
    $smith += 56;
  
  }

  if($inv['smith'] > 9) {
  
    $smith += 60;
  
  }

  if($inv['smith'] > 10) {
  
    $smith += 64;
  
  }

  if($inv['smith'] > 11) {
  
    $smith += 68;
  
  }

  if($inv['smith'] > 12) {
  
    $smith += 72;
  
  }

  if($inv['smith'] > 13) {
  
    $smith += 76;
  
  }

  if($inv['smith'] > 14) {
  
    $smith += 80;
  
  }

  if($inv['smith'] > 15) {
  
    $smith += 84;
  
  }

  if($inv['smith'] > 16) {
  
    $smith += 88;
  
  }

  if($inv['smith'] > 17) {
  
    $smith += 92;
  
  }

  if($inv['smith'] > 18) {
  
    $smith += 96;
  
  }

  if($inv['smith'] > 19) {
  
    $smith += 100;
  
  }
  
  
  $bonus = 0;

  
  if($inv['bonus'] > 0) {
    
  
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
      $rune_stat =  'силы'; 
       break;
      case 2:
      $rune_stat = 'жизни'; 
       break;
      case 3:
      $rune_stat = 'жизни'; 
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

    }

  $bonus = 0;
  switch($item['quality']) {
        case 0:
       $bonus = $inv['bonus'] * 0;
        break;
        case 1:
       $bonus = $inv['bonus'] * 4.8;
        break;
        case 2:
       $bonus = $inv['bonus'] * 6;
        break;
        case 3:
       $bonus = $inv['bonus'] * 6.8;
        break;
        case 4:
       $bonus = $inv['bonus'] * 8;
        break;
        case 5:
       $bonus = $inv['bonus'] * 16;
        break;
        case 6:
       $bonus = $inv['bonus'] * 16;
        break;
      }

?>
</div>
  <div class='mini-line'></div>
<div class='block_zero'>
  <img src='/images/icon/rune.png' alt='*'/> Руна: <?=($inv['rune'] ? '<img src="/images/icon/quality/'.$inv['rune'].'.png" alt="*"/> <font color="#9c9">+'.$rune_stats.'</font> '.$rune_stat:'<font color="#999">отсутствует</font>')?><br/>
  Руна - мощное усиление вещи!<br/>

<?

  if($inv['rune'] == 0 && $inv['user'] == $user['id']) {

?>

<br><a class='btn' href='/smith/runes/<?=$inv['id']?>/'><span class='end'> <span class='label'> Магазин рун</a></span></span><br>

<?

  }

?>

<br><img src='/images/cw.png' alt='*'/> Износ: <font color='#9c9'><?=$inv['iznos']?>/100</font>
<br>Когда вещь износится на 100% - она исчезнет после снятия
<br/>

  <br><img src='/images/icon/smith.png' alt='*'/> Заточка: <font color='#9c9'>+<?=$inv['smith']?></font><br/>
  <font color='#9c9'>+<?=$smith?></font> к параметрам<br/> 

<?

  if($inv['smith'] < 20 && $inv['user'] == $user['id']) {

?>

<br/>
<a class='btn' href='/smith/smith/<?=$inv['id']?>/'><span class='end'> <span class='label'>Заточка</a></span></span>

<?

  }

?>

<br><img src='/images/icon/quality/<?=$item['quality']?>.png' alt='*'/> Бонус: <?=$inv['bonus']?> из <?=$all_bonus?><br/>
<font color='#9c9'>+<?=$bonus?></font> к параметрам <br/>

<?

  if($inv['bonus'] < $all_bonus && $inv['user'] == $user['id']) {

?>

<br/>
<a class='btn' href='/smith/bonus/<?=$inv['id']?>/'><span class='end'><span class='label'>Бонус вещи</a></span></span>

<?

  }

?>
  
</div>

<?

    if($inv['user'] == $user['id']) {

      if($user['w_'.$item['w']] == $inv['id'] OR !$user['w_'.$item['w']] OR $user['w_'.$item['w']] != $inv['id']) {

?>

  <div class='mini-line'></div>
<div class='block_zero' align='center'>

<?

      if($user['w_'.$item['w']] == $inv['id']) { 
       
?>

<a class='btn' href='/inv/move/0/<?=$inv['id']?>/'><span class='end'><span class='label'>В сумку</a></span></span>

<?

if($user['chest'] == 1) {

?>

<a class='btn' href='/inv/move/1/<?=$inv['id']?>/'><span class='end'> <span class='label'>В сундук</a></span></span>

<?

}


      }

    if(!$user['w_'.$item['w']]) {

?>    

<a class='btn' href='/inv/wear/<?=$inv['id']?>/'><span class='end'><span class='label'>Надеть</a></span></span><br/>

<?
    
    }
    
    if($user['w_'.$item['w']] != $inv['id']) {

      switch($item['quality']) {
        case 0:
       $_s = 0;
       $_g = 0;
        break;
        case 1:
       $_s = 100;
       $_g = 0;
        break;
        case 2:
       $_s = 250;
       $_g = 0;
        break;
        case 3:
       $_s = 500;
       $_g = 0;
        break;
        case 4:
       $_s = 1000;
       $_g = 0;
        break;
        case 5:
       $_s = 50000;
       $_g = 0;
        break;
        case 6:
       $_s = 50000;
       $_g = 0;
        break;
      }

?>

<br/><a class='btn' href='/inv/<?=($inv['place'] == 0 ? 'bag':'chest')?>/?sell=<?=$inv['id']?>'><span class='end'><span class='label'>Продать вещь за 1000 <img src='/images/icon/silver.png'></a></span></span>

<?

    }

?>

</div>

<?

  }

  }

  if($equip_item && $inv['user'] != $user['id'] && $user['w_'.$item['w']]) {

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
echo '</div>';
include './system/f.php';

?>