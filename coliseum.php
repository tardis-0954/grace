<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Колизей';    

include './system/h.php';  

?>

<?
 
if($user['level'] > 0) {

  $member = mysql_query('SELECT * FROM `coliseum_member` WHERE `user` = "'.$user['id'].'" ORDER BY `time` DESC LIMIT 1');
  $member = mysql_fetch_array($member);

  if($member) {

  $battle = mysql_query('SELECT * FROM `coliseum` WHERE `id` = "'.$member['battle'].'"');
  $battle = mysql_fetch_array($battle);

  }

  
  if($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 0) {

  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `dead` = "0"'),0) == 1) {
     
    mysql_query('UPDATE `coliseum` SET `end` = "1" WHERE `id` = "'.$battle['id'].'"');
  
      header('location: /coliseum/');
  
  exit;
  
  }
  
?>
  
  

<?

    if($member['dead'] == 1) {
    
?>

<div class='main' align='center'><div class='block'>
<a href='/coliseum/?' class='button'>Обновить</a>
<br/><br/>
<font color='#999'>Вы были убиты во время сражения, ожидайте окончания боя!</font>
</div>
</div>
<?

    

    }
    else
    {
  
  if($_GET['exit'] == true) {

    $log = '<img src=\'/images/icon/race/'.$user['r'].'.png\' alt=\'\'/> <b>'.$user['login'].'</b> покидает бой';    
    mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                               `user`,
                                             `object`,
                                               `text`) VALUES ("'.$battle['id'].'",
                                                                 "'.$user['id'].'",
                                                               "'.$object['id'].'",
                                                                        "'.$log.'")');

    mysql_query('UPDATE `coliseum_member` SET `dead` = "1" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');
  
      header('location: /coliseum.php');
  
  exit;
  
  }
  
  if($member['object'] == 0) {
  
    $rand_object = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `dead` = "0" AND `user` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
    $rand_object = mysql_fetch_array($rand_object);


    mysql_query('UPDATE `coliseum_member` SET `object` = "'.$rand_object['id'].'" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');

  }

if($member['object']) {

  if($_GET['last'] == true) {
  
    $rand_object = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `dead` = "0" AND `user` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
    $rand_object = mysql_fetch_array($rand_object);


    mysql_query('UPDATE `coliseum_member` SET `object` = "'.$rand_object['id'].'" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');

  header('location: /coliseum/');

  }


    $member_object = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `id` = "'.$member['object'].'"');
    $member_object = mysql_fetch_array($member_object);

    $object = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$member_object['user'].'"');
    $object = mysql_fetch_array($object);

  
  if($_GET['attack'] == true && $member_object['dead'] == 0) {
  
    $dmg = 0;
    
    $object_dmg = 0;
  
  if($user['ability_1'] > 0) {
  switch($user['ability_1']) {
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
  
  if(mt_rand(0, 100) <= $a_1_chanse) {

    $a_1 = true;

  }
  
  }

  if($user['ability_3'] > 0) {

  switch($user['ability_3']) {
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

  if(mt_rand(0, 100) <= $a_3_chanse) {

    $a_3 = true;

  }

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
  
  
      $dmg +=round(rand(($user['str']/6),($user['str']/4)));

      if($a_1 == true) {
      
        $dmg += round(($dmg / 100) * $a_1_bonus);
      
      }

$dmg -= round(rand(($object['def']/12),($object['def']/7)));

    if($dmg < 0) {
    
      $dmg = 0;
    
    }
    
    if($dmg > $object['hp']) {
    
      $dmg = $object['hp'];
    
    }
    

    if($a_3 == true) {
    
    $crit = ( (rand(1,2) * ($user['agi'] / 100) + $a_3_crit_chanse ) - (rand(1,2) * ($opponent['agi'] / 100)));
    
    }
    else
    {

    $crit = ( (rand(1,2) * ($user['agi'] / 100) ) - (rand(1,2) * ($opponent['agi'] / 100)));

    }

    if(mt_rand(0, 100) <= $crit) {
   
      $dmg *= 2;

    if($a_3 == true) {
   
      $dmg += round(($dmg / 100) * $a_3_bonus);
    
    }

  $log_crit = true;
    
    }

    $dodge = ( (rand(1,2) * ($opponent['agi'] / 100) ) - (rand(1,2) * ($user['agi'] / 100)));

    if(mt_rand(0, 100) <= $dodge) {
   
      $dmg = 0;
      
    }
    
    

    
    $dmg_time = time() - $member['time'];
    
    if($dmg_time < 2) {
    
      $dmg = 0;
    
    }
    
    if($dmg_time > 1 && $dmg_time < 4) {
    
      $dmg -= round($dmg / 2);
    
    }

    if($a_1 == true) {
    
    $log = 'Вы применили <img src=\'/images/icon/quality/'.$user['ability_1_quality'].'.png\'> <font color=\''.quality_color($user['ability_1_quality']).'\'>Ярость титана</font>';    

    mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                               `user`,
                                             `object`,
                                               `text`,
                                               `show`) VALUES ("'.$battle['id'].'",
                                                                 "'.$user['id'].'",
                                                               "0",
                                                                        "'.$log.'",
                                                                 "'.$user['id'].'")');
                                                                 
                                                                 
    $log = '<img src=\'/images/icon/race/'.$user['r'].'.png\' alt=\'\'/> <b>'.$user['login'].'</b> применил <img src=\'/images/icon/quality/'.$user['ability_1_quality'].'.png\'> <font color=\''.quality_color($user['ability_1_quality']).'\'>Ярость титана</font>';    
    mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                               `user`,
                                             `object`,
                                               `text`) VALUES ("'.$battle['id'].'",
                                                                 "'.$user['id'].'",
                                                               "0",
                                                                        "'.$log.'")');

    }

    if($a_3 == true) {
    
    $log = 'Вы применили <img src=\'/images/icon/quality/'.$user['ability_3_quality'].'.png\'> <font color=\''.quality_color($user['ability_3_quality']).'\'>Вихрь критов</font>';    

    mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                               `user`,
                                             `object`,
                                               `text`,
                                               `show`) VALUES ("'.$battle['id'].'",
                                                                 "'.$user['id'].'",
                                                               "0",
                                                                        "'.$log.'",
                                                                 "'.$user['id'].'")');

    $log = '<img src=\'/images/icon/race/'.$user['r'].'.png\' alt=\'\'/> <b>'.$user['login'].'</b> применил <img src=\'/images/icon/quality/'.$user['ability_3_quality'].'.png\'> <font color=\''.quality_color($user['ability_3_quality']).'\'>Вихрь критов</font>';    
    mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                               `user`,
                                             `object`,
                                               `text`) VALUES ("'.$battle['id'].'",
                                                                 "'.$user['id'].'",
                                                               "0",
                                                                        "'.$log.'")');

                                                                 
    }
    
    if($dmg == 0) {
      $log = 'Вы промахнулись';
    }
    else
    {
      $log = 'Вы ударили <img src=\'/images/icon/race/'.$object['r'].'.png\' alt=\'*\'/> <b>'.$object['login'].'</b> на <b>'.$dmg.'</b> '.($log_crit == true ? '(крит)':'');    
    }
    
    mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                               `user`,
                                             `object`,
                                               `text`,
                                               `show`) VALUES ("'.$battle['id'].'",
                                                                 "'.$user['id'].'",
                                                               "'.($dmg > 0 ? $object['id']:0).'",
                                                                        "'.$log.'",
                                                                 "'.$user['id'].'")');
    
    if($dmg > 0) {
      $log = '<img src=\'/images/icon/race/'.$user['r'].'.png\'/> <b>'.$user['login'].'</b> ударил Вас на <b>'.$dmg.'</b> '.($log_crit == true ? '(крит)':'');    
    mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                               `user`,
                                             `object`,
                                               `text`,
                                               `show`) VALUES ("'.$battle['id'].'",
                                                               "'.$object['id'].'",
                                                                 "'.$user['id'].'",
                                                                        "'.$log.'",
                                                               "'.$object['id'].'")');
    }

    if($dmg > 0) {
    $log = '<img src=\'/images/icon/race/'.$user['r'].'.png\' alt=\'\'/> <b>'.$user['login'].'</b> ударил <img src=\'/images/icon/race/'.$object['r'].'.png\' alt=\'*\'/> <b>'.$object['login'].'</b> на <b>'.$dmg.'</b> '.($log_crit == true ? '(крит)':'');    
    mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                               `user`,
                                             `object`,
                                               `text`) VALUES ("'.$battle['id'].'",
                                                                 "'.$user['id'].'",
                                                               "'.$object['id'].'",
                                                                        "'.$log.'")');
    }



    mysql_query('UPDATE `users` SET `hp` = "'.($object['hp'] - $dmg).'" WHERE `id` = "'.$object['id'].'"');
    mysql_query('UPDATE `coliseum_member` SET `time` = "'.time().'" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');






    if($dmg >= $object['hp']) {

      $log = 'Вы убили <img src=\'/images/icon/race/'.$object['r'].'.png\' alt=\'*\'/> <b>'.$object['login'].'</b>';        
      mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                                 `user`,
                                               `object`,
                                                 `text`,
                                                 `show`) VALUES ("'.$battle['id'].'",
                                                                   "'.$user['id'].'",
                                                                 "'.$object['id'].'",
                                                                          "'.$log.'",
                                                                   "'.$user['id'].'")');

      $log = '<img src=\'/images/icon/race/'.$user['r'].'.png\' alt=\'*\'/> <b>'.$user['login'].'</b> убил Вас';    
      mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                                 `user`,
                                               `object`,
                                                 `text`,
                                                 `show`) VALUES ("'.$battle['id'].'",
                                                                 "'.$object['id'].'",
                                                                   "'.$user['id'].'",
                                                                          "'.$log.'",
                                                                 "'.$object['id'].'")');
    
    
      $log = '<img src=\'/images/icon/rip.png\' alt=\'*\'/> <img src=\'/images/icon/race/'.$user['r'].'.png\' alt=\'*\'/> <b>'.$user['login'].'</b> убил <img src=\'/images/icon/race/'.$object['r'].'.png\' alt=\'*"\'> <b>'.$object['login'].'</b>';    
      mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                                 `user`,
                                               `object`,
                                                 `text`) VALUES ("'.$battle['id'].'", 
                                                                 "'.$user['id'].'",
                                                               "'.$object['id'].'",
                                                                        "'.$log.'")');


      mysql_query('UPDATE `coliseum_member` SET `dead` = "1" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$object['id'].'"');
      mysql_query('UPDATE `coliseum_member` SET `kills` = `kills` + 1 WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');

      $rand_object = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `dead` = "0" AND `user` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $rand_object = mysql_fetch_array($rand_object);

      mysql_query('UPDATE `coliseum_member` SET `object` = "'.$rand_object['id'].'" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');

    }

  }
if($object['id'] == 0) {
header('location: ?');
}
?>  

<div class='main'><div class='block'>Противник: <img src='/images/icon/race/<?=$object['r']?>.png' alt='*'/> <b><?=$object['login']?></b> <img src='/images/icon/health.png' alt='*'/> <?=$object['hp']?>

<?

  if($a_1 == true OR $a_2 == true OR $a_3 == true OR $a_4 == true OR $a_5 == true) {
  
?>

  <div class='separ'></div>

<?

  if($a_1 == true) echo ' <img src=\'/images/ability/1.'.$user['ability_1_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_2 == true) echo ' <img src=\'/images/ability/2.'.$user['ability_2_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_3 == true) echo ' <img src=\'/images/ability/3.'.$user['ability_3_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_4 == true) echo ' <img src=\'/images/ability/4.'.$user['ability_4_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_5 == true) echo ' <img src=\'/images/ability/5.'.$user['ability_5_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';

  }

?>

</div>
</div>
<?

  }

?>

<div class='main' align='center'>
<div class='block'>
<a class='btn' href='/coliseum/?attack=true'><span class='end'><span class='label'>Атаковать</span></span></a>
<br/>
<a class='btn' href='/coliseum/?last=true'><span class='end'><span class='label'>Другой противник</span></span></a>

</div>
</div>
<?

  }


  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_log` WHERE `battle` = "'.$battle['id'].'"'),0);

if($count > 0) {

?>

<div class='mini-line'></div>

<div class='main'>

<?

$q = mysql_query('SELECT * FROM `coliseum_log` WHERE `battle` = "'.$battle['id'].'" ORDER BY `id` DESC LIMIT 15');

  while($row = mysql_fetch_array($q)) {

    if($row['user'] == $user['id'] && $row['show'] == $user['id'] OR $row['object'] == $user['id'] && $row['show'] == $user['id']) {
  
      echo '<font color=\'#'.($row['object'] == 0 ? 'ffffff':'c06060').'\'>'.$row['text'].'</font><br/>';
  
    }
    elseif($row['show'] == 0)
    {
    
    if($row['user'] == $user['id']) {
        

    }
    else
    {

    if($row['object'] == $user['id']) {
    
    }
    else
    {
    
      echo $row['text'].'<br/>';
  
    }
  
    }
  
    }

  }
  
?>

</div>

<?
  
  }

  if($member['dead'] == 0) {

?>

  <div class='mini-line'></div>
<div class='main menuList'>
  <li><a href='/coliseum/?exit=true'><img src='/images/icon/arrow.png' alt='*'/> Покинуть бой</a></li>
</div>

<?

  }
  
  }
  else
  {

  if($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 1) {

$q = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" ORDER BY `kills` DESC  LIMIT '.mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0).'');

  while($row = mysql_fetch_array($q)) {
  
  $i++;
  
  if($i == 1) {
    
    $best = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
    $best = mysql_fetch_array($best);
  
  }
  
  if($row['user'] == $user['id']) {
  
      $place = $i;
  
  }

  }

    $_s = round(rand(1,100) + (100 / $place) + (100* $member['kills']));

  $_exp = round(rand(1,100) + (100 / $place) + (50 * $member['kills']));
    
    if($clan_memb && $clan_memb['v'] > 0) {
    
      $_exp += round($_exp/100) * $_clan_memb['v'];
    
    }

  if($premium) {
  
  $_exp+= round($_exp/ 100) * 50;
  
  }

  mysql_query('UPDATE `users` SET `s` =   `s` + '.$_s.',
                                `exp` = `exp` + '.$_exp.' WHERE `id` = "'.$user['id'].'"');


      if($clan) {
        
       mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.' WHERE `id` = "'.$clan['id'].'"');
       mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');

      }

?>
  <div class='main'>
  <div class='block center'>
  
  <img src='/images/icon/2hit.png' alt='*'/> <font color='#90c090'><b>Бой окончен!</b></font> <img src='/images/icon/2hit.png' alt='*'/>
  <div class='separ'></div>
  
  <font color='#90b0c0'>Награда за <b><?=$place?></b> место:</font><br/>
  <img src='/images/icon/silver.png' alt='*'/> <?=$_s?> серебра <img src='/images/icon/exp.png' alt='*'/> <?=$_exp?> опыта
  
 </div> </div> <div class='main'>

  <div class='block center'>

  <img src='/images/icon/premium.png' alt='*'/> <b>Лучший: <img src='/images/icon/race/<?=$best['r']?>.png' alt='*'/> <?=$best['login']?></b> <img src='/images/icon/premium.png' alt='*'/>
  <div class='separ'></div>
  <b>Итог боя:</b><br/>

<?

$q = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" ORDER BY `kills` DESC LIMIT '.mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0).'');

  while($row = mysql_fetch_array($q)) {

    $coliseum_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
    $coliseum_user = mysql_fetch_array($coliseum_user);

  $_rating = 2 * $row['kills'];

  mysql_query('UPDATE `users` SET `coliseum_rating` = "'.($coliseum_user['coliseum_rating'] + $_rating).'" WHERE `id` = "'.$coliseum_user['id'].'"');

?>

<img src='/images/icon/race/<?=$coliseum_user['r']?>.png' alt='*'/> <a href='/user.php?id=<?=$coliseum_user['id']?>'><?=$coliseum_user['login']?></a> - <?=$_rating?> к рейтингу<br/>

<?

  }

?>

  </div> </div>

<?

    mysql_query('UPDATE `coliseum_member` SET `exit` = "1" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');

  }
  else
  {

?>

 <div class='mini-line'></div>

<?
  
  }


if(mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum` WHERE `start` = "0"'),0) == 0) {

  mysql_query('INSERT INTO `coliseum` (`start`,
                                         `end`,
                                        `time`) VALUES ("0",
                                                        "0",
                                        "'.(time() + 60).'")');

}

  $battle = mysql_query('SELECT * FROM `coliseum` WHERE `start` = "0"');
  $battle = mysql_fetch_array($battle);  

?>
<div class=\'block_zero\' align=\'center\'>
  
  
<img src='/rusalc/kol.jpg' width='100%' alt='*'/></center><br/>
</div>
<div class='main'>
<div class='block_zero' align='center'>
<img src='/images/icon/race/0.png' alt='*'/><img src='/images/icon/race/1.png' alt='*'/> Подано заявок: <b><?=mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0)?></b> из <b>2</b><br/>
<img src='/images/icon/rage.png' alt='*'/> Ваш рейтинг: <b><?=$user['coliseum_rating']?></b><br>

<?

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0) < 2 && mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"'),0) == 0) {

    if($user['hp'] > (($user['vit'] / 100) * 10) && $_GET['enter'] == true && mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0) < 2) {
    
      mysql_query('INSERT INTO `coliseum_member` (`battle`,
                                                    `user`,
                                                    `time`) VALUES ("'.$battle['id'].'",
                                                                      "'.$user['id'].'",
                                                                           "'.time().'")');
    
        header('location: /coliseum/');
    
    exit;
    
   }

?>
<a class='btn' href='?enter=true'><span class='end'><span class='label'>Отправить заявку</span></span></a>

<?

}
else
{

  if($_GET['exit'] == true && mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0) < 2) {

    mysql_query('DELETE FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');
   
        header('location: /coliseum/');
    
    exit;

  }
  
  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0) > 1) {
  
  if($battle['time'] > time()) {
  
?>

<font color='#909090'>До начала боя: <?=($battle['time'] - time())?> секунд</font><br/>

<?
  
  }
  else
  {

    mysql_query('UPDATE `coliseum` SET `start` = "1" WHERE `id` = "'.$battle['id'].'"');
  
  header('location: /coliseum/');
  
  }
  
  }
  else
  {
  
  if($battle['time'] < time()) {
  
    mysql_query('UPDATE `coliseum` SET `time` = "'.(time() + 30).'" WHERE `id` = "'.$battle['id'].'"');
  
  }
  
  }

?>

<a class='btn' href='/coliseum/?exit=true'><span class='end'><span class='label'>Отменить заявку</span></span></a>




<?

}

?>

</div></div>

<?
  

  }

?>

<?

 }
 else
 {
 
?>

<div class='main' align='center'>
<div class='block'>
Для участия в <img src='/images/icon/coliseum.png' alt='*'/> Колизее требуется <img src='/images/icon/level.png' alt='*'/> 1 уровень
</div></div>

<?
 
 }
  
include './system/f.php';

?>