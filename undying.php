<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Долина бессмертных';    

include './system/h.php';  
 
if($user['level'] > 3) {


 $opponent_str = rand(10, 100);
 $opponent_vit = rand(10, 100);
 $opponent_agi = rand(10, 100);
 $opponent_def = rand(10, 100);
 $opponent_hp  = $opponent_vit * 2;

  
  $member = mysql_query('SELECT * FROM `undying_member` WHERE `user` = "'.$user['id'].'" ORDER BY `id` DESC LIMIT 1');
  $member = mysql_fetch_array($member);
  
  $battle = mysql_query('SELECT * FROM `undying` WHERE `id` = "'.$member['battle'].'"');
  $battle = mysql_fetch_array($battle);  
  
  if($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 0) {

    $titans = mysql_result(mysql_query('SELECT COUNT(*) FROM `undying_member` WHERE `dead` = "0" AND `battle` = "'.$battle['id'].'"'),0);  

  if($titans == 0 OR $battle['opponents'] == 0) {
              
    mysql_query('UPDATE `undying` SET `end` = "1" WHERE `id` = "'.$battle['id'].'"');

    header('location: /undying/');
              
    exit;

  }
  
  if($battle['time'] < time()) {
  
    mysql_query('UPDATE `undying` SET `end` = "1" WHERE `id` = "'.$battle['id'].'"');
    
  header('location: /undying/');
  
  exit;
  
  }

?>

<div class='main'>
<div class='block_zero'><font color='#ff9'><span style='float: right;'><?=_time($battle['time'] - time())?></span> Сражение</font></div></div>

<?

  if($member['dead'] == 0) {


  if($_GET['attack'] == true && $battle['opponents']) {

 if($member['time'] > time() OR $user['mp'] < 50) {
  
    header('location: /undying/');
  
  exit;
  
  }

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


  if($user['ability_2'] > 0) {
  switch($user['ability_2']) {
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
    $a_2_bonus = 65;
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
    $a_2_bonus = 165;
   $a_2_chanse = 23;
     break;
  }

  if(mt_rand(0, 100) <= $a_2_chanse) {

    $a_2 = true;

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

  if($user['ability_4'] > 0) {

  switch($user['ability_4']) {
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

  if(mt_rand(0, 100) <= $a_4_chanse) {

    $a_4 = true;

  }
  
  }


      $dmg +=round(rand(($user['str']/6),($user['str']/4)));
      
      if($a_1 == true) {
      
        $dmg += round(($dmg / 100) * $a_1_bonus);
      
      }
  
      
      $dmg -= round(rand(($opponent_def/12),($opponent_def/7)));
    if($dmg < 0) {
    
      $dmg = 0;
    
    }

    if($a_3 == true) {
    
    $crit = ( (rand(1,2) * ($user['agi'] / 100) + $a_3_crit_chanse ) - (rand(1,2) * ($opponent_agi / 100)));
    
    }
    else
    {

    $crit = ( (rand(1,2) * ($user['agi'] / 100) ) - (rand(1,2) * ($opponent_agi / 100)));

    }

    if(mt_rand(0, 100) <= $crit) {
   
      $dmg *= 2;

    if($a_3 == true) {
   
      $dmg += round(($dmg / 100) * $a_3_bonus);
    
    }

    $_crit = true;
     
    }

    $dodge = ( (rand(1,2) * ($opponent_agi/ 100) ) - (rand(1,2) * ($user['agi'] / 100)));

    if(mt_rand(0, 100) <= $dodge) {
   
      $dmg = 0;
      
    }

      $opponent_dmg +=round(rand(($opponent_str/6),($opponent_str/4)));

      if($a_2 == true) {
      
        $opponent_dmg -= round(($opponent_dmg / 100) * $a_2_bonus);
      
      }


      $opponent_dmg -= round(rand(($user['def']/12),($user['def']/7)));
    
    if($opponent_dmg < 0) {
    
      $opponent_dmg = 0;
    
    }


    $opponent_crit = ( (rand(1,2) * ($opponent_agi / 100) ) - (rand(1,2) * ($user['agi'] / 100)));

    if(mt_rand(0, 100) <= $opponent_crit) {
   
      $opponent_dmg *= 2;

    if($a_4 == true) {
    
      $opponent_dmg -= round(($opponent_dmg / 100) * $a_4_bonus);
    
    }
    
    $_opponent_crit = true;
    
    }    
    
    $opponent_dodge = ( (rand(1,2) * ($user['agi'] / 100) ) - (rand(1,2) * ($opponent_agi / 100)));

    if(mt_rand(0, 100) <= $opponent_dodge) {
   
      $opponent_dmg = 0;
      
    }
    
  if($dmg > $opponent_hp) {

    mysql_query('UPDATE `undying_member` SET `kills` = "'.($member['kills'] + 1).'" WHERE `user` = "'.$user['id'].'" AND `battle` = "'.$battle['id'].'"');

    mysql_query('UPDATE `undying` SET `opponents` = "'.($battle['opponents'] - 1).'" WHERE `id` = "'.$battle['id'].'"');

  if($battle['opponents'] - 1 == 0) {
  
    header('location: /undying/');
  
  }

  }

    mysql_query('UPDATE `undying_member` SET `time` = "'.(time() + 10).'",
                                              `dmg` = "'.($member['dmg'] + $dmg).'" WHERE `user` = "'.$user['id'].'" AND `battle` = "'.$battle['id'].'"');
  
  if($opponent_dmg > $user['hp']) {
  
    $_hp = $user['hp'];
  
  }
  else
  {
  
    $_hp = $opponent_dmg;
  
  }
  
  if($opponent_dmg > 0) {
  
    mysql_query('UPDATE `users` SET `hp` = "'.($user['hp'] - $_hp).'" WHERE `id` = "'.$user['id'].'"');
  
  }
  
  mysql_query('UPDATE `users` SET `mp` = "'.($user['mp'] - 50).'" WHERE `id` = "'.$user['id'].'"');
    
  if($opponent_dmg > $user['hp']) {
  
    mysql_query('UPDATE `undying_member` SET `dead` = "1" WHERE `user` = "'.$user['id'].'" AND `battle` = "'.$battle['id'].'"');

  if($titans - 1 == 0) {
  
    header('location: /undying/');
  
  }

  }
  
?>

<div class='main center'><img src='/images/icon/hit.png' alt='*'/><font color='#9c9'> Нанесено урона: <b><?=$dmg?></b> <?=($_crit == true ? '(крит)':'')?></font><br/>

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

?>

<?

  }

?>

<?

  if($dmg > $opponent_hp) {

?>

  <div class='separ'></div>

<img src='/images/icon/rip.png' alt='*'/> <font color='#9bc'>Вы убили <img src='/images/icon/race/bot.png' alt='*'/> врага!</font><br/>

<?

  }
  
if($opponent_dmg > 0) {

?>

<img src='/images/icon/race/bot.png' alt='*'/> <font color='#c66'>Получено урона: <b><?=$opponent_dmg?></b> <?=($_opponent_crit == true ? '(крит)':'')?></font>

<?

  }

?>

</div>

<?    
  
  }
  else
  {
  
?>

<div class='mini-line'></div>

<?

  }

?>

<div class='main'><div class='block'>
  <center>
  <img src='/images/icon/race/0.png' alt='*'/><img src='/images/icon/race/1.png' alt='*'/> Титаны: <b><?=$titans?></b> <img src='/images/icon/vs.png' alt='*'/> <img src='/images/icon/race/bot.png' alt='*'/> Враги: <b><?=$battle['opponents']?></b>
 </center>
 <center>
<?

  if($user['mp'] < ($user['mana'] / 2)) {

  if($_GET['mana'] == true) {
  
    mysql_query('UPDATE `users` SET `mp` = "'.$user['mana'].'" WHERE `id` = "'.$user['id'].'"');
  
    header('location: /undying/');
  
  }

?>
<a class='btn' href='/undying/?mana=true'><span class='end'><span class='label'>Восстановить ману</span></span></a>

<?
  
  }
  else
  {

?>

<a class='btn' href='/undying/?attack=true'><span class='end'><span class='label'>Атаковать</span></span></a>

<?
  
  }

?>

</center>


  <center>

<?

  if($member['time'] > time()) {

?>

<font color='#999'>До удара <?=($member['time'] - time())?> сек..</font>

<?
  
  }

?>

 </center>
</div>
</div>
<?

  }
  else
  {
  
?>
<div class='main'><div class='block'>
  <center>
  <img src='/images/icon/race/0.png' alt='*'/><img src='/images/icon/race/1.png' alt='*'/> Титаны: <b><?=$titans?></b> <img src='/images/icon/vs.png' alt='*'/> <img src='/images/icon/race/bot.png' alt='*'/> Враги: <b><?=$battle['opponents']?></b><br>
  <font color='#999'>Вы были убиты во время сражения, ожидайте окончания боя!</font></center>
</div>
</div>

<?

  }

  }
  else
  {

?>
<?

  if($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 1) {

?>

<div class='block center'>

<?

    $titans = mysql_result(mysql_query('SELECT COUNT(*) FROM `undying_member` WHERE `dead` = "0" `battle` = "'.$battle['id'].'"'),0);

  if($titans == 0 && $battle['opponents'] > 0 OR $battle['opponents'] > 0) {

  $_g = round($member['kills'] / 2);
  $_s = rand(1,2) * round(rand(($member['dmg'] / 100), $member['dmg']) / 2);
$_exp = rand(1,1) * round(round(round($member['dmg'] / 100) * 10) / 2);

?>

<img src='/images/icon/2hit.png' alt='*'/> <font color='#c66'><b>Поражение!</b></font> <img src='/images/icon/2hit.png' alt='*'/>

<?

  }
  else
  {

  $_g = $member['kills'];
  $_s = rand(1,5) * round(rand(($member['dmg'] / 100), $member['dmg']));
$_exp = rand(1,2) * round(round($member['dmg'] / 100) * 10);


?>

<img src='/images/icon/2hit.png' alt='*'/> <font color='#9c9'><b>Победа</b></font>     <img src='/images/icon/2hit.png' alt='*'/>

<?

  }

?>

<div class='separ'></div>  

<font color='#9bc'>Награда:</font> <img src='/images/icon/gold.png' alt='*'/> <?=$_g?> золота <img src='/images/icon/silver.png' alt='*'/> <?=$_s?> серебра <img src='/images/icon/exp.png' alt='*'/> <?=$_exp?> опыта

</div>

<?

    if($clan_memb && $clan_memb['v'] > 0) {
    
      $_exp += round($_exp/100) * $clan_memb['v'];
    
    }

  if($premium) {
  
  $_exp+= round($_exp/ 100) * 25;
  
  }

      if($clan) {
        
       mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.' WHERE `id` = "'.$clan['id'].'"');
       mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');

      }

  mysql_query('UPDATE `users` SET `g` = "'.($user['g']   + $_g).'",
                                  `s` = "'.($user['s']   + $_s).'",
                                `exp` = "'.($user['exp'] + $_exp).'" WHERE `id` = "'.$user['id'].'"');


  mysql_query('UPDATE `undying_member` SET `exit` = "1" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');

  }
  else
  {
  
?>

 <div class='mini-line'></div>

<?

  }

?>

<div class='main'>
<div class='block'>
  <center><img src='/images/barbars/<?=(($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 1) ? (($titans == 0 && $battle['opponents'] > 0 OR $battle['opponents'] > 0) ? 'immortals.jpg':'titans.png'):'enter.jpg')?>' alt='*'/></center>
  <br><center><font color='#9bc'>Бой с ордами бессмертных</font></center>
</div>
</div>
<?

  if($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 1) {

?>

<div class='block center'>

<font color='#90b0c0'><b>Ваши достижения</b></font><br/>
<img src='/images/icon/hit.png' alt='*'/> Убито врагов:   <font color='#9c9'><?=$member['kills']?></font><br/>
<img src='/images/icon/hit.png' alt='*'/> Нанесено урона: <font color='#9c9'><?=$member['dmg']?></font><br/>

</div>

<?

  }
  else
  {

?>

<?

  }
  
  $battle = mysql_query('SELECT * FROM `undying` WHERE `start` = "0"');
  $battle = mysql_fetch_array($battle);  

  if(!$battle) {
  
  $h = date('H',time());
    
  if($h > 22 && $h < 6)
  {
  
    $time = 3600 * 8;
  
  }
  else
  {

    $time = 3600 * 3;
  
  }

    
    mysql_query('INSERT INTO `undying` (`time`) VALUES ("'.(time() + $time).'")');
  
  }
  
  if($battle['time'] <= time()) {
    
    mysql_query('UPDATE `undying` SET `start` = "1", `time` = "'.(time() + (60 * 5)).'" WHERE `id` = "'.$battle['id'].'"');
  
    header('location: /undying/');
  
  }

?>

<div class='main'>
  <div class='block_zero center'><img src='/images/icon/race/0.png' alt='*'/><img src='/images/icon/race/1.png' alt='*'/> Титаны: <b><?=mysql_result(mysql_query('SELECT COUNT(*) FROM `undying_member` WHERE `battle` = "'.$battle['id'].'"'),0)?></b><br/>
  Битва начнется через: <?=_time($battle['time'] - time())?>
<?

  if($member['battle'] != $battle['id']) {
    if($_GET['enter'] == true) {
      
      mysql_query('INSERT INTO `undying_member` (`battle`,
                                                   `user`,
                                                   `time`) VALUES ("'.$battle['id'].'",
                                                                     "'.$user['id'].'",
                                                                          "'.time().'")');
                                                                          
      mysql_query('UPDATE `undying` SET `opponents` = "'.($battle['opponents'] + rand(1,5)).'" WHERE `id` = "'.$battle['id'].'"');

    header('location: /undying/');

    }
  
?>
<br>
<a class='btn' href='/undying/?enter=true'><span class='end'><span class='label'>Подать заявку</span></span></a>

<?
  
  }
  else
  {

?>

<?
  
  }

?>  
  </div>
</div>

<?

  }

}
else
{
 
?>
<div class='main'>
<div class='block_zero' align='center'>
Для участии в <img src='/images/icon/bar.png' alt='*'/> Долине бессмертных требуется <img src='/images/icon/level.png' alt='*'/> 4 уровень
</div>
</div>
<?
 
}
  
include './system/f.php';

?>