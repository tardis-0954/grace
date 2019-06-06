<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';

if(!$user OR $user['level'] < 1) {

  header('location: /');
    
exit;

}


    $title = 'Умения';    

include './system/h.php';  

$id = _string(_num($_GET['id']));

  if($id && $id != $user['id']) {
    
  $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);
    
    if(!$i) {
    
      header('location: /user/');
    
    exit;
    
    }

    }
    else
    {
    
        $i = $user;

    }

  function quality_color($i) {
  
    switch($i) {
    case 0:
 
$color = "#908060";
     break;
    case 1:

$color = "#60c030";
     break;

    case 2:
 
$color = "#6090c0";
     break;

    case 3:
 
$color = "#c060f0";
     break;

    case 4:
 
$color = "#f06000";
     break;


    case 5:
 
$color = "#909090";
     break;


    case 6:
 
$color = "#909090";
     break;

  }

  return $color;
  }

?>

<div class='main'>

<div class='block _zero'>

<?

  function value($i) {
  
    switch($i) {
    case 0:
    $value = 'g';
     break;
    case 1:
    $value = 's';
     break;
    case 2:
    $value = 's';
     break;
    case 3:
    $value = 's';
     break;
    case 4:
    $value = 's';
     break;
    case 5:
    $value = 'g';
     break;
    case 6:
    $value = 's';
     break;
    case 7:
    $value = 's';
     break;
    case 8:
    $value = 's';
     break;
    case 9:
    $value = 's';
     break;
    case 10:
    $value = 'g';
     break;
    case 11:
    $value = 's';
     break;
    case 12:
    $value = 's';
     break;
    case 13:
    $value = 's';
     break;
    case 14:
    $value = 's';
     break;
    case 15:
    $value = 's';
     break;
    case 16:
    $value = 'g';
     break;
    case 17:
    $value = 's';
     break;
    case 18:
    $value = 's';
     break;
    case 19:
    $value = 's';
     break;
    case 20:
    $value = 's';
     break;
    case 21:
    $value = 'g';
     break;
    case 22:
    $value = 'g';
     break;
    case 23:
    $value = 'g';
     break;
    }
  
  return $value;
  
  }
    
  function cost($i) {
    switch($i) {
    case 0:
     $cost =  100;
     break;
    case 1:
     $cost = 2000;
     break;
    case 2:
     $cost = 4000;
     break;
    case 3:
     $cost = 6000;
     break;
    case 4:
     $cost = 8000;
     break;
    case 5:
     $cost = 300;
     break;
    case 6:
     $cost = 10000;
     break;
    case 7:
     $cost = 12000;
     break;
    case 8:
     $cost = 14000;
     break;
    case 9:
     $cost = 16000;
     break;
    case 10:
     $cost = 900;
     break;
    case 11:
     $cost = 8000;
     break;
    case 12:
     $cost = 16000;
     break;
    case 13:
     $cost = 24000;
     break;
    case 14:
     $cost = 32000;
     break;
    case 15:
     $cost = 40000;
     break;
    case 16:
     $cost = 2000;
     break;
    case 17:
     $cost = 26000;
     break;
    case 18:
     $cost = 28000;
     break;
    case 19:
     $cost = 30000;
     break;
    case 20:
     $cost = 32000;
     break;
    case 21:
     $cost = 5000;
     break;
    case 22:
     $cost = 20000;
     break;
    case 23:
     $cost = 30000;
     break;
  }
  
  return $cost;
   
  }

  switch($i['ability_1']) {
    case 0:
    $a_1_bonus = 25;
   $a_1_chanse = 5;
     break;
    case 1:
    $a_1_bonus = 25;
   $a_1_chanse = 5;
     break;
    case 2:
    $a_1_bonus = 30;
   $a_1_chanse = 5;
     break;
    case 3:
    $a_1_bonus = 35;
   $a_1_chanse = 5;
     break;
    case 4:
    $a_1_bonus = 40;
   $a_1_chanse = 5;
     break;
    case 5:
    $a_1_bonus = 45;
   $a_1_chanse = 5;
     break;
    case 6:
    $a_1_bonus = 45;
   $a_1_chanse = 8;
     break;
    case 7:
    $a_1_bonus = 50;
   $a_1_chanse = 8;
     break;
    case 8:
    $a_1_bonus = 55;
   $a_1_chanse = 8;
     break;
    case 9:
    $a_1_bonus = 60;
   $a_1_chanse = 8;
     break;
    case 10:
    $a_1_bonus = 65;
   $a_1_chanse = 8;
     break;
    case 11:
    $a_1_bonus = 65;
   $a_1_chanse = 11;
     break;
    case 12:
    $a_1_bonus = 70;
   $a_1_chanse = 11;
     break;
    case 13:
    $a_1_bonus = 75;
   $a_1_chanse = 11;
     break;
    case 14:
    $a_1_bonus = 80;
   $a_1_chanse = 11;
     break;
    case 15:
    $a_1_bonus = 85;
   $a_1_chanse = 11;
     break;
    case 16:
    $a_1_bonus = 85;
   $a_1_chanse = 14;
     break;
    case 17:
    $a_1_bonus = 90;
   $a_1_chanse = 14;
     break;
    case 18:
    $a_1_bonus = 95;
   $a_1_chanse = 14;
     break;
    case 19:
    $a_1_bonus = 100;
   $a_1_chanse = 14;
     break;
    case 20:
    $a_1_bonus = 105;
   $a_1_chanse = 14;
     break;
    case 21:
    $a_1_bonus = 105;
   $a_1_chanse = 17;
     break;
    case 22:
    $a_1_bonus = 145;
   $a_1_chanse = 20;
     break;
    case 23:
    $a_1_bonus = 165;
   $a_1_chanse = 23;
     break;
    case 24:
    $a_1_bonus = 165;
   $a_1_chanse = 23;
     break;
  }

  switch($i['ability_2']) {
    case 0:
    $a_2_bonus = 25;
   $a_2_chanse = 5;
     break;
    case 1:
    $a_2_bonus = 25;
   $a_2_chanse = 5;
     break;
    case 2:
    $a_2_bonus = 30;
   $a_2_chanse = 5;
     break;
    case 3:
    $a_2_bonus = 35;
   $a_2_chanse = 5;
     break;
    case 4:
    $a_2_bonus = 40;
   $a_2_chanse = 5;
     break;
    case 5:
    $a_2_bonus = 45;
   $a_2_chanse = 5;
     break;
    case 6:
    $a_2_bonus = 45;
   $a_2_chanse = 8;
     break;
    case 7:
    $a_2_bonus = 50;
   $a_2_chanse = 8;
     break;
    case 8:
    $a_2_bonus = 55;
   $a_2_chanse = 8;
     break;
    case 9:
    $a_2_bonus = 60;
   $a_2_chanse = 8;
     break;
    case 10:
    $a_2_bonus = 65;
   $a_2_chanse = 8;
     break;
    case 11:
    $a_2_bonus = -65;
   $a_2_chanse = 11;
     break;
    case 12:
    $a_2_bonus = 70;
   $a_2_chanse = 11;
     break;
    case 13:
    $a_2_bonus = 75;
   $a_2_chanse = 11;
     break;
    case 14:
    $a_2_bonus = 80;
   $a_2_chanse = 11;
     break;
    case 15:
    $a_2_bonus = 85;
   $a_2_chanse = 11;
     break;
    case 16:
    $a_2_bonus = 85;
   $a_2_chanse = 14;
     break;
    case 17:
    $a_2_bonus = 90;
   $a_2_chanse = 14;
     break;
    case 18:
    $a_2_bonus = 95;
   $a_2_chanse = 14;
     break;
    case 19:
    $a_2_bonus = 100;
   $a_2_chanse = 14;
     break;
    case 20:
    $a_2_bonus = 105;
   $a_2_chanse = 14;
     break;
    case 21:
    $a_2_bonus = 105;
   $a_2_chanse = 17;
     break;
    case 22:
    $a_2_bonus = 145;
   $a_2_chanse = 20;
     break;
    case 23:
    $a_2_bonus = 165;
   $a_2_chanse = 23;
     break;
    case 24:
    $a_2_bonus = -165;
   $a_2_chanse = 23;
     break;
  }

  switch($i['ability_3']) {
    case 0:
      $a_3_bonus = 5;
$a_3_crit_chanse = 5;
     $a_3_chanse = 20;
     break;
    case 1:
      $a_3_bonus = 5;
$a_3_crit_chanse = 5;
     $a_3_chanse = 20;
     break;
    case 2:
      $a_3_bonus = 8;
$a_3_crit_chanse = 5;
     $a_3_chanse = 20;
     break;
    case 3:
      $a_3_bonus = 11;
$a_3_crit_chanse = 5;
     $a_3_chanse = 20;
     break;
    case 4:
      $a_3_bonus = 14;
$a_3_crit_chanse = 5;
     $a_3_chanse = 20;
     break;
    case 5:
      $a_3_bonus = 17;
$a_3_crit_chanse = 5;
     $a_3_chanse = 20;
     break;
    case 6:
      $a_3_bonus = 17;
$a_3_crit_chanse = 7;
     $a_3_chanse = 25;
     break;
    case 7:
      $a_3_bonus = 20;
$a_3_crit_chanse = 7;
     $a_3_chanse = 25;
     break;
    case 8:
      $a_3_bonus = 23;
$a_3_crit_chanse = 7;
     $a_3_chanse = 25;
     break;
    case 9:
      $a_3_bonus = 26;
$a_3_crit_chanse = 7;
     $a_3_chanse = 25;
     break;
    case 10:
      $a_3_bonus = 29;
$a_3_crit_chanse = 7;
     $a_3_chanse = 25;
     break;
    case 11:
      $a_3_bonus = 29;
$a_3_crit_chanse = 9;
     $a_3_chanse = 30;
     break;
    case 12:
      $a_3_bonus = 32;
$a_3_crit_chanse = 9;
     $a_3_chanse = 30;
     break;
    case 13:
      $a_3_bonus = 35;
$a_3_crit_chanse = 9;
     $a_3_chanse = 30;
     break;
    case 14:
      $a_3_bonus = 38;
$a_3_crit_chanse = 9;
     $a_3_chanse = 30;
     break;
    case 15:
      $a_3_bonus = 41;
$a_3_crit_chanse = 9;
     $a_3_chanse = 30;
     break;
    case 16:
      $a_3_bonus = 41;
$a_3_crit_chanse = 11;
     $a_3_chanse = 35;
     break;
    case 17:
      $a_3_bonus = 44;
$a_3_crit_chanse = 11;
     $a_3_chanse = 35;
     break;
    case 18:
      $a_3_bonus = 47;
$a_3_crit_chanse = 11;
     $a_3_chanse = 35;
     break;
    case 19:
      $a_3_bonus = 50;
$a_3_crit_chanse = 11;
     $a_3_chanse = 35;
     break;
    case 20:
      $a_3_bonus = 53;
$a_3_crit_chanse = 11;
     $a_3_chanse = 35;
     break;
   case 21:
      $a_3_bonus = 53;
$a_3_crit_chanse = 13;
     $a_3_chanse = 40;
     break;
    case 22:
      $a_3_bonus = 77;
$a_3_crit_chanse = 15;
     $a_3_chanse = 45;
     break;
    case 23:
      $a_3_bonus = 89;
$a_3_crit_chanse = 17;
     $a_3_chanse = 50;
     break;
    case 24:
      $a_3_bonus = 89;
$a_3_crit_chanse = 17;
     $a_3_chanse = 50;
     break;

  }

  switch($i['ability_4']) {
    case 0:
      $a_4_bonus = 20;
     $a_4_chanse = 5;
     break;
    case 1:
      $a_4_bonus = 20;
     $a_4_chanse = 5;
     break;
    case 2:
      $a_4_bonus = 22;
     $a_4_chanse = 5;
     break;
    case 3:
      $a_4_bonus = 24;
     $a_4_chanse = 5;
     break;
    case 4:
      $a_4_bonus = 26;
     $a_4_chanse = 5;
     break;
    case 5:
      $a_4_bonus = 28;
     $a_4_chanse = 5;
     break;
    case 6:
      $a_4_bonus = 28;
     $a_4_chanse = 10;
     break;
    case 7:
      $a_4_bonus = 30;
     $a_4_chanse = 10;
     break;
    case 8:
      $a_4_bonus = 32;
     $a_4_chanse = 10;
     break;
    case 9:
      $a_4_bonus = 34;
     $a_4_chanse = 10;
     break;
    case 10:
      $a_4_bonus = 36;
     $a_4_chanse = 10;
     break;
    case 11:
      $a_4_bonus = 36;
     $a_4_chanse = 15;
     break;
    case 12:
      $a_4_bonus = 38;
     $a_4_chanse = 15;
     break;
    case 13:
      $a_4_bonus = 40;
     $a_4_chanse = 15;
     break;
    case 14:
      $a_4_bonus = 42;
     $a_4_chanse = 15;
     break;
    case 15:
      $a_4_bonus = 44;
     $a_4_chanse = 15;
     break;
    case 16:
      $a_4_bonus = 44;
     $a_4_chanse = 20;
     break;
    case 17:
      $a_4_bonus = 46;
     $a_4_chanse = 20;
     break;
    case 18:
      $a_4_bonus = 48;
     $a_4_chanse = 20;
     break;
    case 19:
      $a_4_bonus = 50;
     $a_4_chanse = 20;
     break;
    case 20:
      $a_4_bonus = 52;
     $a_4_chanse = 20;
     break;
    case 21:
      $a_4_bonus = 52;
     $a_4_chanse = 25;
     break;
    case 22:
      $a_4_bonus = 68;
     $a_4_chanse = 30;
     break;
    case 23:
      $a_4_bonus = 76;
     $a_4_chanse = 35;
     break;
    case 24:
      $a_4_bonus = 76;
     $a_4_chanse = 35;
     break;
  }


  $a_1_progress = round(100 / (24 / $i['ability_1'] ));

  $a_2_progress = round(100 / (24 / $i['ability_2'] ));

  $a_3_progress = round(100 / (24 / $i['ability_3'] ));

  $a_4_progress = round(100 / (24 / $i['ability_4'] ));

  $a_5_progress = round(100 / (24 / $i['ability_5'] ));


$ability = _string(_num($_GET['ability']));

  if($ability && $ability < 6 && $user['ability_'.$ability.'_quality'] < 6) {
      
    if($user[value($user['ability_'.$ability])] >= cost($user['ability_'.$ability])) {
    
      mysql_query('UPDATE `users` SET `'.value($user['ability_'.$ability]).'` = "'.($user[value($user['ability_'.$ability])] - cost($user['ability_'.$ability])).'" WHERE `id` = "'.$user['id'].'"');
      
            
      if($user['ability_'.$ability] == 5 OR $user['ability_'.$ability] == 10 OR $user['ability_'.$ability] == 16 OR $user['ability_'.$ability] == 16 OR $user['ability_'.$ability] == 21 OR $user['ability_'.$ability] == 22 OR $user['ability_'.$ability] == 23) {
  
        mysql_query('UPDATE `users` SET `ability_'.$ability.'_quality` = "'.($user['ability_'.$ability.'_quality'] + 1).'" WHERE `id` = "'.$user['id'].'"');
  
      }

        mysql_query('UPDATE `users` SET `ability_'.$ability.'` = `ability_'.$ability.'` + 1 WHERE `id` = "'.$user['id'].'"');

        header('location: /ability/'.$user['id'].'/');
        
    }
    
  }

?>

  <table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/images/ability/1.<?=$i['ability_1_quality']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$user['ability_1_quality']?>.png' alt='*'/> <font color='<?=quality_color($user['ability_1_quality'])?>'>Ярость титана</font>
  <small><br/>
  <font color='#9bc'>Бонус:</font> <font color='#9c9'><?=$a_1_bonus?>%</font> к урону<br/>
  <font color='#9bc'>Шанс срабатывания:</font> <font color='#9c9'><?=$a_1_chanse?>%</font></small></td>
  </tr></table>

  

<?

if($user['ability_1'] == 0     && $i['id'] == $user['id']) {

?>

<br/><div align='center'>
<a href='/ability/<?=$id?>/1/' class='btn'><span class='end'><span class='label'><span class='white'> Купить за <img src='/images/icon/gold.png' alt='*'/> 100</a></span></span></span>
</div>

<?

}
elseif($user['ability_1'] < 24 && $i['id'] == $user['id']) {

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px; width: 97%;'>
<div style='background: #fc3; height: 4px; width: <?=$a_1_progress?>%;'></div>
</div>

<br/><div align='center'>
<a href='/ability/<?=$i['id']?>/1/' class='btn'><span class='end'><span class='label'><span class='white'>Улучшить за <img src='/images/icon/<?=(value($user['ability_1']) == 'g' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['ability_1'])?></a></span></span></span>
</div>

<?

}

?>





  <table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/images/ability/2.<?=$i['ability_2_quality']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$user['ability_2_quality']?>.png' alt='*'/> <font color='<?=quality_color($user['ability_2_quality'])?>'>Крепкая броня</font>
  <small><br/>
  <font color='#9bc'>Бонус:</font> <font color='#9c9'><?=$a_2_bonus?>%</font> к урону врага<br/>
  <font color='#9bc'>Шанс срабатывания:</font> <font color='#9c9'><?=$a_2_chanse?>%</font></small></td>
  </tr></table>

<?

if($user['ability_2'] == 0     && $i['id'] == $user['id']) {

?>

<br/>
<div align='center'><a href='/ability/<?=$i['id']?>/2/' class='btn'><span class='end'><span class='label'><span class='white'>Купить за <img src='/images/icon/gold.png' alt='*'/> 100</a></span></span></span></div>

<?

}
elseif($user['ability_2'] < 24 && $i['id'] == $user['id'])
{

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px; width: 97%;'>
<div style='background: #fc3; height: 4px; width: <?=$a_2_progress?>%;'></div>
</div>

<br/><div align='center'>
<a href='/ability/<?=$i['id']?>/2/' class='btn'><span class='end'><span class='label'><span class='white'>Улучшить за <img src='/images/icon/<?=(value($user['ability_2']) == 'g' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['ability_2'])?></a></span></span></span>
</div>


<?

}

?>






  <table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/images/ability/3.<?=$i['ability_3_quality']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$user['ability_3_quality']?>.png' alt='*'/> <font color='<?=quality_color($user['ability_3_quality'])?>'>Вихрь критов</font>
  <small><br/>
  <font color='#9bc'>Бонус:</font> <font color='#9c9'><?=$a_3_bonus?>%</font> к урону крита <font color='#9c9'><?=$a_3_crit_chanse?>%</font> к шансу крита<br/>
  <font color='#9bc'>Шанс срабатывания:</font> <font color='#9c9'><?=$a_3_chanse?>%</font></small></td>
  </tr></table>

<?

    if($user['ability_3'] == 0 && $i['id'] == $user['id']) {

?>

<br/>
<div align='center'><a href='/ability/<?=$i['id']?>/3/' class='btn'><span class='end'><span class='label'><span class='white'> Купить за <img src='/images/icon/gold.png' alt='*'/> 100</a></span></span></span></div>

<?

}
elseif($user['ability_3'] < 24 && $i['id'] == $user['id']) {

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px; width: 97%;'>
<div style='background: #fc3; height: 4px; width: <?=$a_3_progress?>%;'></div>
</div>

<br/><div align='center'>
<a href='/ability/<?=$i['id']?>/3/' class='btn'><span class='end'><span class='label'><span class='white'>Улучшить за <img src='/images/icon/<?=(value($user['ability_3']) == 'g' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['ability_3'])?></a></span></span</span>
</div>


<?

}

?>  
 







  <table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/images/ability/4.<?=$i['ability_4_quality']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$user['ability_4_quality']?>.png' alt='*'/> <font color='<?=quality_color($user['ability_4_quality'])?>'>Защитная стойка</font>
  <small><br/>
  <font color='#9bc'>Бонус:</font> <font color='#9c9'>-<?=$a_4_bonus?>%</font> снижение урона от крит удара<br/>
  <font color='#9bc'>Шанс срабатывания:</font> <font color='#9c9'><?=$a_4_chanse?>%</font></small></td>
  </tr></table>

<?

if($user['ability_4'] == 0     && $i['id'] == $user['id']) {
  
?>

<br/>
<div align='center'><a href='/ability/<?=$i['id']?>/4/' class='btn'><span class='end'><span class='label'><span class='white'>Купить за <img src='/images/icon/gold.png' alt='*'/> 100</a></span></span></span></div>

<?

}
elseif($user['ability_4'] < 24 && $i['id'] == $user['id'])
{

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px; width: 97%;'>
<div style='background: #fc3; height: 4px; width: <?=$a_4_progress?>%;'></div>
</div>

<br/><div align='center'>
<a href='/ability/<?=$i['id']?>/4/' class='btn'><span class='end'><span class='label'><span class='white'>Улучшить за <img src='/images/icon/<?=(value($user['ability_4']) == 'g' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['ability_4'])?></a></span></span></span>
</div>


<?

}

?>

 

</div>
</div>

<?
  
include './system/f.php';

?>