<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Рейтинг игроков';    

include './system/h.php';  
echo '<div class="main">';
?>
<div class='block_zero'>
<?

$sort = _string($_GET['sort']);



    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users`'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;


  if($page == 1) {
  
    $i = $page - 1;
  
  }
  elseif($page == 2) {
    
    $i = ($page + 9);
  
  }
  else
  {
  
    $i = ($page * 10) - 9;
  
  }

switch($sort) {
    default:
$q = mysql_query('SELECT * FROM `users` ORDER BY `str`+`vit`+`agi`+`def` DESC LIMIT '.$start.', '.$max.'');
      break;
case 'duel':
$q = mysql_query('SELECT * FROM `users` ORDER BY `duel_rating` DESC LIMIT '.$start.', '.$max.'');
      break;
case 'coliseum':
$q = mysql_query('SELECT * FROM `users` ORDER BY `coliseum_rating` DESC LIMIT '.$start.', '.$max.'');
      break;
}

  while($row = mysql_fetch_array($q)) {

  $i++;

    if($i == 1) {

    $w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$row['id'].'" AND `id` = "'.$row['w_1'].'"');
    $w_1 = mysql_fetch_array($w_1);


if(!$w_1) {

$w_1['item'] = 0;

}

    $w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$row['id'].'" AND `id` = "'.$row['w_2'].'"');
    $w_2 = mysql_fetch_array($w_2);

if(!$w_2) {

$w_2['item'] = 0;

}


    $w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$row['id'].'" AND `id` = "'.$row['w_3'].'"');
    $w_3 = mysql_fetch_array($w_3);

if(!$w_3) {

$w_3['item'] = 0;

}


    $w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$row['id'].'" AND `id` = "'.$row['w_4'].'"');
    $w_4 = mysql_fetch_array($w_4);

if(!$w_4) {

$w_4['item'] = 0;

}


    $w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$row['id'].'" AND `id` = "'.$row['w_5'].'"');
    $w_5 = mysql_fetch_array($w_5);

if(!$w_5) {

$w_5['item'] = 0;

}


    $w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$row['id'].'" AND `id` = "'.$row['w_6'].'"');
    $w_6 = mysql_fetch_array($w_6);

if(!$w_6) {

$w_6['item'] = 0;

}


    $w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$row['id'].'" AND `id` = "'.$row['w_7'].'"');
    $w_7 = mysql_fetch_array($w_7);

if(!$w_7) {

$w_7['item'] = 0;

}


    $w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$row['id'].'" AND `id` = "'.$row['w_8'].'"');
    $w_8 = mysql_fetch_array($w_8);

if(!$w_8) {

$w_8['item'] = 0;

}

switch($sort) {
     default:

?>

Самый сильный<br/>

<?

      break;
case 'duel':

?>

Чемпион дуэлей<br/>

<?

      break;

case 'coliseum':

?>

Чемпион колизея<br/>


<?

break;

    }

?>

<table cellpadding='0' cellspacing='0'>
  <tr>
  <td><a href='/user/<?=$row['id']?>/'><img src='/manekenImage/<?=$row['sex']?>/<?=$w_1['item']?>/<?=$w_2['item']?>/<?=$w_3['item']?>/<?=$w_4['item']?>/<?=$w_5['item']?>/<?=$w_6['item']?>/<?=$w_7['item']?>/<?=$w_8['item']?>/' alt='*'/></a>
 </td>
  <td valign='top' style='padding-left: 5px;'>
  <img src='/images/icon/race/<?=$row['r'].($row['online'] > time() - 86400 ? '':'-off')?>.png' alt='*'/> <?=$row['login']?><br/><br/>
    <img src='/images/icon/str.png' alt='*'/> Сила:   <?=$row['str']?><br/>
    <img src='/images/icon/vit.png' alt='*'/> Жизни:  <?=$row['vit']?><br/>
    <img src='/images/icon/agi.png' alt='*'/> Удача:  <?=$row['agi']?><br/>
    <img src='/images/icon/def.png' alt='*'/> Защита: <?=$row['def']?>
 </td>
 </tr></table>

<?

    }
    else
    {

?>

<img src='/images/icon/race/<?=$row['r'].($row['online'] > time() - 86400 ? '':'-off')?>.png' alt='*'> <a href='/user/<?=$row['id']?>/'><?=$row['login']?></a>

<?

switch($sort) {
     default:

?>

<b><?=($row['str']+($row['vit'] * 2) +$row['agi']+$row['def'])?></b>

<?

       break;
 case 'duel':

?>

<b><?=$row['duel_rating']?></b>

<?

      break;
    
case 'coliseum':

?>

<img src='/images/icon/rage.png' alt='*'/> <b><?=$row['coliseum_rating']?></b>


<?

      break;
    
    }
?>

<br/>

<?

    }
  
  }
  
?>
</div></div><div class="main"><div class="block">
<?=pages('/rating/'.$sort.'/?');?>

</div>

<div class='menuList'>
  <li><a href='/rating/'><img src='/images/icon/str.png' alt='*'/> По сумме параметров</a></li>
  <li><a href='/rating/coliseum/'><img src='/images/icon/rage.png' alt='*'/> Рейтинг колизея</a></li>
  <li><a href='/rating/duel/'><img src='/images/icon/sumstat.png' alt='*'/> Дуэли</a></li>
</div>
</div>
<?
  
include './system/f.php';

?>