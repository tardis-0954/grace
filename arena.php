<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}
    
    $title = 'Арена';


include './system/h.php';  

if(mysql_result(mysql_query('SELECT * FROM `arena` WHERE `user` = "'.$user['id'].'"'),0) == 0) {

  mysql_query('INSERT INTO `arena` (`user`) VALUES ("'.$user['id'].'")');

}

    $arena = mysql_query('SELECT * FROM `arena` WHERE `user` = "'.$user['id'].'"');
    $arena = mysql_fetch_array($arena);

?>
<?


    if($_GET['last'] == true) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `agi` + `def` >= "'.(($user['str'] + $user['vit'] + $user['agi'] + $user['def']) / 2).'" AND `str` + `vit` + `agi` + `def` <= "'.($user['str'] + $user['vit'] + $user['agi'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      if(!$opponent) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `agi` + `def` <= "'.($user['str'] + $user['vit'] + $user['agi'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      }
    
    mysql_query('UPDATE `arena` SET `opponent` = "'.$opponent['id'].'" WHERE `user` = "'.$user['id'].'"');
    
    header('location: /arena/');
    
    }


      if(!$arena['opponent']) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `agi` + `def` >= "'.(($user['str'] + $user['vit'] + $user['agi'] + $user['def']) / 2).'" AND `str` + `vit` + `agi` + `def` <= "'.($user['str'] + $user['vit'] + $user['agi'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      if(!$opponent) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `agi` + `def` >= "'.(($user['str'] + $user['vit'] + $user['agi'] + $user['def']) / 2).'" AND `id` != "'.$user['id'].'" OR `str` + `vit` + `agi` + `def` <= "'.($user['str'] + $user['vit'] + $user['agi'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      }
    
      mysql_query('UPDATE `arena` SET `opponent` = "'.$opponent['id'].'" WHERE `user` = "'.$user['id'].'"');
        
      }
      else
      {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$arena['opponent'].'"');
      $opponent = mysql_fetch_array($opponent);

      }

  
  if($_GET['full_mana'] == true) {
  
  if($user['mp'] < 50 OR $user['g'] < 1 OR $user['level'] < 1) {
  
    header('location: /arena/');
  
  exit;
  
  }
  
    $fights = round($user['mp'] / 50);
  
    $win = 0;
    $los = 0;
    
    $_exp = 0;
      $_s = 0;
  
    for($fight = 1; $fight <= $fights; $fight++) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `agi` + `def` >= "'.(($user['str'] + $user['vit'] + $user['agi'] + $user['def']) / 2).'" AND `str` + `vit` + `agi` + `def` <= "'.($user['str'] + $user['vit'] + $user['agi'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      if(!$opponent) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `agi` + `def` >= "'.(($user['str'] + $user['vit'] + $user['agi'] + $user['def']) / 2).'" AND `id` != "'.$user['id'].'" OR `str` + `vit` + `agi` + `def` <= "'.($user['str'] + $user['vit'] + $user['agi'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      }

        $dmg = 0;
    
    $opponent_dmg = 0;
    
    for($round = 1; $round < 6; $round++) {

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
    
      $dmg -= round(rand(($opponent['def']/12),($opponent['def']/7)));
        
    if($dmg < 0) {
    
      $dmg = 0;
    
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
    
    }


    $dodge = ( (rand(1,2) * ($opponent['agi'] / 100) ) - (rand(1,2) * ($user['agi'] / 100)));

    if(mt_rand(0, 100) <= $dodge) {
   
      $dmg = 0;
      
    }



      $opponent_dmg +=round(rand(($opponent['str']/6),($opponent['str']/4)));

      if($a_2 == true) {
      
        $opponent_dmg -= round(($opponent_dmg / 100) * $a_2_bonus);
      
      }

      $opponent_dmg -= round(rand(($user['def']/12),($user['def']/7)));
    
    if($opponent_dmg < 0) {
    
      $opponent_dmg = 0;
    
    }


    $opponent_crit = ( (rand(1,2) * ($opponent['agi'] / 100) ) - (rand(1,2) * ($user['agi'] / 100)));

    if(mt_rand(0, 100) <= $opponent_crit) {
   
      $opponent_dmg *= 2;
    
    if($a_4 == true) {
    
      $opponent_dmg -= round(($opponent_dmg / 100) * $a_4_bonus);
    
    }
    
    }    
    
    $opponent_dodge = ( (rand(1,2) * ($user['agi'] / 100) ) - (rand(1,2) * ($opponent['agi'] / 100)));

    if(mt_rand(0, 100) <= $opponent_dodge) {
   
      $opponent_dmg = 0;
     
    }

    }

    if($dmg > $opponent_dmg) {

      $_s +=  rand(1,10) * $opponent['level'];          
    $_exp +=  rand(1,5)  * $opponent['level'];
      
      $win+= 1;
      
    }
    else
    {

      $_s += rand(1,5) * $opponent['level'];
    $_exp += rand(1,2) * $opponent['level'];  
    
      $los+= 1;
    
    }
    
    }
  
  
  if($clan_memb && $clan_memb['v'] > 0) {
    
  $_exp += round($_exp/100) * $clan_memb['v'];
    
  }


  if($premium) {
  
  $_exp+= round($_exp/ 100) * 25;
  
  }
  
  
  mysql_query('UPDATE `users` SET `mp` =  `mp` - '.($fights * 50).',
                                 `exp` = `exp` + '.$_exp.',
                                   `s` =   `s` + '.$_s.',
                                   `g` =   `g` - 1 WHERE `id` = "'.$user['id'].'"');

   
      if($clan) {
        
       mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.' WHERE `id` = "'.$clan['id'].'"');
       mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');

      }
    
?>

<div class='block center'><img src='/images/icon/2hit.png' alt='*'/> <font color='#90c090'><b>Вся мана использована</b></font> <img src='/images/icon/2hit.png' alt='*'/><br/>
  <div class='separ'></div>
  <img src='/images/icon/1.png' alt='*'/> <font color='#90c090'>Побед: <b><?=$win?></b></font> | <img src='/images/icon/2.png' alt='*'/> <font color='#c06060'>Поражений: <b><?=$los?></b></font>
  <div class='separ'></div>

<?

  if($a_1 == true OR $a_2 == true OR $a_3 == true OR $a_4 == true OR $a_5 == true) {
  
?>

<?

  if($a_1 == true) echo ' <img src=\'/images/ability/1.'.$user['ability_1_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_2 == true) echo ' <img src=\'/images/ability/2.'.$user['ability_2_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_3 == true) echo ' <img src=\'/images/ability/3.'.$user['ability_3_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_4 == true) echo ' <img src=\'/images/ability/4.'.$user['ability_4_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_5 == true) echo ' <img src=\'/images/ability/5.'.$user['ability_5_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';

?>

  <div class='separ'></div>

<?

  }

?>

  <img src='/images/icon/silver.png' alt='*'/> <?=$_s?> серебра <img src='/images/icon/exp.png' alt='*'/> <?=$_exp?> опыта


<?

  $w_chanse = rand(1,100);
    $chanse = rand(1,10) * rand(1,100);
  
  if($chanse < $w_chanse) {
    
    $w = mysql_query('SELECT * FROM `shop` WHERE `id` < 73 ORDER BY RAND() LIMIT 1');
    $w = mysql_fetch_array($w);

  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = "0" AND `user` = "'.$user['id'].'"'),0) + 1 < 20) {

    mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                   `bonus`,
                                    `_str`,
                                    `_vit`,
                                    `_agi`,
                                    `_def`) VALUES ("'.$user['id'].'",
                                                       "'.$w['id'].'",
                                                    "'.$w['bonus'].'",
                                                     "'.$w['_str'].'",
                                                     "'.$w['_vit'].'",
                                                     "'.$w['_agi'].'",
                                                     "'.$w['_def'].'")');

  $w_id = mysql_insert_id();

     $w = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$w_id.'"');
     $w = mysql_fetch_array($w);


  $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w['item'].'"');
  $item = mysql_fetch_array($item);
  
    mysql_query('UPDATE `inv` SET `quality` = '.$item['quality'].' WHERE `id` = '.$w_id);


?>

  <div class='separ'></div>
  <font color='#f0c060'>Новая вещь в твоей <img src='/images/icon/bag.png' alt=''/> <a href='/inv/bag/'><u>сумке</u></a>!</font><br/>

<?

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
  
?>
<div align='center'>
<table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$w['item']?>' alt='*'/></td>
  <td valign='top' align='left' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt='*'/> <a href='/item/<?=$w['id']?>/'><?=$item['name']?></a>
  <br/>
  <small><small>
  <font color="<?=$quality_color?>"><?=$quality?> [<?=$w['bonus']?>/<?=$bonus?>]</font>

<?

  if($user['w_'.$item['w']] != 0) {
    
    $equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item['w']].'"');
    $equip_item = mysql_fetch_array($equip_item);


  if(($row['_str'] + $w['_vit'] + $w['_agi'] + $w['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_agi'] + $equip_item['_def']) > 0) {
    
?>

  <font color='#30c030'>+<?=($w['_str'] + $w['_vit'] + $w['_agi'] + $w['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_agi'] + $equip_item['_def'])?></font> 

<?

  }

  
  }
  else
  {

?>
    
  <font color="#30c030">+<?=($w['_str'] + $w['_vit'] + $w['_agi'] + $w['_def'])?></font>

<?

  }

?>

  </small></small></td></tr></table>
</div>
<?

  }

  }

?>

</div>
</div>

<?

  }
    
  if($_GET['attack'] == true) {
  
  if(time() - $arena['time'] < 1) {
  
    header('location: /arena/');
  
  exit;
  
  }
  
  if($user['mp'] > 49 && $user['hp'] > ( ( ($user['vit'] * 2) / 100 ) * 10 )) {

    $dmg = 0;
    
    $opponent_dmg = 0;
    
    for($round = 1; $round < 6; $round++) {

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
    
      $dmg -= round(rand(($opponent['def']/12),($opponent['def']/7)));
        
    if($dmg < 0) {
    
      $dmg = 0;
    
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
    
    }


    $dodge = ( (rand(1,2) * ($opponent['agi'] / 100) ) - (rand(1,2) * ($user['agi'] / 100)));

    if(mt_rand(0, 100) <= $dodge) {
   
      $dmg = 0;
      
    }



      $opponent_dmg +=round(rand(($opponent['str']/6),($opponent['str']/4)));

      if($a_2 == true) {
      
        $opponent_dmg -= round(($opponent_dmg / 100) * $a_2_bonus);
      
      }

      $opponent_dmg -= round(rand(($user['def']/12),($user['def']/7)));
    
    if($opponent_dmg < 0) {
    
      $opponent_dmg = 0;
    
    }


    $opponent_crit = ( (rand(1,2) * ($opponent['agi'] / 100) ) - (rand(1,2) * ($user['agi'] / 100)));

    if(mt_rand(0, 100) <= $opponent_crit) {
   
      $opponent_dmg *= 2;
    
    if($a_4 == true) {
    
      $opponent_dmg -= round(($opponent_dmg / 100) * $a_4_bonus);
    
    }
    
    }    
    
    $opponent_dodge = ( (rand(1,2) * ($user['agi'] / 100) ) - (rand(1,2) * ($opponent['agi'] / 100)));

    if(mt_rand(0, 100) <= $opponent_dodge) {
   
      $opponent_dmg = 0;
     
    }

    }

    if($dmg > $opponent_dmg) {

    $_hp  = round($opponent_dmg / 4);
    
    }
    else
    {

    $_hp  = round($opponent_dmg / 2);

    }


        if($_hp > $user['hp']) {
        
        $_hp  = $user['hp'];
        
        }

  mysql_query('UPDATE `users` SET `hp` = `hp` - '.$_hp.',
                                  `mp` = `mp` - 50 WHERE `id` = "'.$user['id'].'"');



?>

<div class='block center'>

<?
    
    
    if($dmg > $opponent_dmg) {

      $_s =  rand(1,100) + (rand(1,10) * $opponent['level']);          
    $_exp =  rand(1,5)  * $opponent['level'];
      
    
    if($clan_memb && $clan_memb['v'] > 0) {
    
      $_exp += round($_exp/100) * $clan_memb['v'];
    
    }
          
?>

<img src='/images/icon/2hit.png' alt='*'/> <font color='#90c090'><b>Победа!</b></font> <img src='/images/icon/2hit.png' alt='*'/>

<?

    }
    else
    {

      $_s = rand(1,100) + (rand(1,5) * $opponent['level']);
    $_exp = rand(1,2) * $opponent['level'];  
  
    if($clan_memb && $clan_memb['v'] > 0) {
    
      $_exp += round($_exp/100) * $clan_memb['v'];
    
    }
      
?>

<img src='/images/icon/2hit.png' alt='*'/> <font color='#c06060'><b>Поражение!</b></font> <img src='/images/icon/2hit.png' alt='*'/>

<?

    }

        if($_s < 1) {
          
          $_s = 1;
          
        }

        if($_exp < 1) {
          
          $_exp = 1;
          
        }
   

  if($premium) {
  
  $_exp+= round($_exp/ 100) * 25;
  
  }

  if($clan) {
        
       mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.' WHERE `id` = "'.$clan['id'].'"');
       mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');

  }


      mysql_query('UPDATE `arena` SET `end` = "0" WHERE `user` = "'.$user['id'].'"');
     
      $opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `agi` + `def` >= "'.(($user['str'] + $user['vit'] + $user['agi'] + $user['def']) / 2).'" AND `str` + `vit` + `agi` + `def` <= "'.($user['str'] + $user['vit'] + $user['agi'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      if(!$opponent) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `agi` + `def` <= "'.($user['str'] + $user['vit'] + $user['agi'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      }
    
      mysql_query('UPDATE `arena` SET `opponent` = "'.$opponent['id'].'",
                                          `time` = "'.(time() + 1).'"WHERE `user` = "'.$user['id'].'"');

?>

  <div class='separ'></div>

<?

  if($a_1 == true OR $a_2 == true OR $a_3 == true OR $a_4 == true OR $a_5 == true) {
  
?>

<?

  if($a_1 == true) echo ' <img src=\'/images/ability/1.'.$user['ability_1_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_2 == true) echo ' <img src=\'/images/ability/2.'.$user['ability_2_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_3 == true) echo ' <img src=\'/images/ability/3.'.$user['ability_3_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_4 == true) echo ' <img src=\'/images/ability/4.'.$user['ability_4_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';
  if($a_5 == true) echo ' <img src=\'/images/ability/5.'.$user['ability_5_quality'].'.png\' width=\'25px\' height=\'25px\' alt=\'*\'/> ';

?>

  <div class='separ'></div>

<?

  }

?>

<img src='/images/icon/silver.png' alt="*"/> <?=n_f($_s)?> серебра <img src='/images/icon/exp.png' alt='*'/> <?=n_f($_exp)?> опыта

<?

  $w_chanse = rand(1,100);
    $chanse = rand(1,10) * rand(1,100);

  if($chanse < $w_chanse) {
    
  $w = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` < \'3\' ORDER BY RAND() LIMIT 1'));

  if(mysql_num_rows(mysql_query('SELECT * FROM `inv` WHERE `place` = \'0\' AND `user` = \''.$user['id'].'\'')) + 1 < 20) {

    mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                    `quality`,
                                    `bonus`,
                                    `_str`,
                                    `_vit`,
                                    `_agi`,
                                    `_def`) VALUES (\''.$user['id'].'\',
                                                    \''.$w['id'].'\',
                                                    \''.$w['quality'].'\',
                                                    \''.$w['bonus'].'\',
                                                    \''.$w['_str'].'\',
                                                    \''.$w['_vit'].'\',
                                                    \''.$w['_agi'].'\',
                                                    \''.$w['_def'].'\')');

  $w_id = mysql_insert_id();

     $w = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$w_id.'\''));
  $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$w['item'].'\''));
  
?>

  <div class='separ'></div>
  <font color='#f0c060'>Новая вещь в твоей <img src='/images/icon/bag.png' alt=''/> <a href='/inv/bag/'><u>сумке</u></a>!</font><br/>

<?

  switch($w['quality']) {
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
  
?>
<div align='center'>
<table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$w['item']?>' alt='*'/></td>
  <td valign='top' align='left' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$w['quality']?>.png' alt='*'/> <a href='/item/<?=$w['id']?>/'><?=$item['name']?></a>
  <br/>
  <small><small>
  <font color="<?=$quality_color?>"><?=$quality?> [<?=$w['bonus']?>/<?=$bonus?>]</font>

<?

  if($user['w_'.$item['w']] != 0) {
    
    $equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item['w']].'"');
    $equip_item = mysql_fetch_array($equip_item);


  if(($row['_str'] + $w['_vit'] + $w['_agi'] + $w['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_agi'] + $equip_item['_def']) > 0) {
    
?>

  <font color='#30c030'>+<?=($w['_str'] + $w['_vit'] + $w['_agi'] + $w['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_agi'] + $equip_item['_def'])?></font> 

<?

  }

  
  }
  else
  {

?>
    
  <font color="#30c030">+<?=($w['_str'] + $w['_vit'] + $w['_agi'] + $w['_def'])?></font>

<?

  }

?>

  </small></small></td></tr></table>
</div>
<?

  }

  }

?>
 
<?
if($user['level'] > 1) {
?>
<div class='separ'></div><a href='/arena/?full_mana=true'>Использовать всю ману за 1 <img src='/images/icon/gold.png'></a>
<?
}
?>
</div>

<?

    mysql_query('UPDATE `users` SET `exp` = `exp` + '.$_exp.',
                                      `s` =   `s` + '.$_s.' WHERE `id` = "'.$user['id'].'"');
    

  }
  else
  {
  
?>

<div class='block' align='center'>
<font color='#c06060'>Для нападения надо минимум <img src='/images/icon/health.png' alt='*'/> 10% жизни и <img src='/images/icon/mana.png' alt='*'/> 50 маны</font>
  <div class='separ'></div>

<table cellpadding='0' cellspacing='0'>
<tr>
  
  <td><img src='/images/alchemy/potion.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;' align='left'><b>Настойка бодрости</b><br/>
  <small><small>+100% маны и жизни</small></small></td>

</tr></table>

  <div class='separ'></div>

<div align='center'>
<a class='btn' href='/lab/wiz/?potion=true&referal=/arena'><span class='end'><span class='label'>Купить</span></span></a>
<br/><br/>
  <font color='#909090'>Цена: <img src='/images/icon/gold.png' alt='*'/> 15 золота</font>
</div>

</div>
<div class='mini-line'></div>

<?
  
  }

  }


  if($_GET['attack'] == true OR $_GET['full_mana'] == true) {
  
  
  }
  else
  {

?>

<?
  
  }

  $opponent = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$arena['opponent'].'"');
  $opponent = mysql_fetch_array($opponent);


$w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_1'].'"');
$w_1 = mysql_fetch_array($w_1);

if(!$w_1) {

$w_1['item'] = 0;

}

$w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_2'].'"');
$w_2 = mysql_fetch_array($w_2);

if(!$w_2) {

$w_2['item'] = 0;

}


$w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_3'].'"');
$w_3 = mysql_fetch_array($w_3);

if(!$w_3) {

$w_3['item'] = 0;

}

$w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_4'].'"');
$w_4 = mysql_fetch_array($w_4);

if(!$w_4) {

$w_4['item'] = 0;

}

$w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_5'].'"');
$w_5 = mysql_fetch_array($w_5);

if(!$w_5) {

$w_5['item'] = 0;

}

$w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_6'].'"');
$w_6 = mysql_fetch_array($w_6);

if(!$w_6) {

$w_6['item'] = 0;

}

$w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_7'].'"');
$w_7 = mysql_fetch_array($w_7);

if(!$w_7) {

$w_7['item'] = 0;

}


$w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_8'].'"');
$w_8 = mysql_fetch_array($w_8);

if(!$w_8) {

$w_8['item'] = 0;

}
if($opponent['id'] == 0) {
header('location: ?');
}
?>

<div class='main' align='center'><div class='block_zero'>
<font color='#90b0c0'>Побеждай врагов и становись сильнее!</font>
</div></div>
<div class='mini-line'></div>


<div class='main'>
<div class='block_zero'>
<table cellpadding='0' cellspacing='0'>
  <tr>
  <td><a href='/arena/?attack=true'><img src='/manekenImage/<?=$opponent['sex']?>/<?=$w_1['item']?>/<?=$w_2['item']?>/<?=$w_3['item']?>/<?=$w_4['item']?>/<?=$w_5['item']?>/<?=$w_6['item']?>/<?=$w_7['item']?>/<?=$w_8['item']?>/' alt='*'/></a>
 </td>
  <td valign='top' style='padding-left: 5px;'>
  <img src='/images/icon/race/<?=$opponent['r']?>.png' alt='*'/> <?=$opponent['login']?><br/><br>
    <img src='/images/icon/str.png' alt='*'/> Сила:   <?=$opponent['str']?><br/>
    <img src='/images/icon/vit.png' alt='*'/> Жизнь:  <?=$opponent['vit']?><br/>
    <img src='/images/icon/agi.png' alt='*'/> Удача:  <?=$opponent['agi']?><br/>
    <img src='/images/icon/def.png' alt='*'/> Защита: <?=$opponent['def']?><br/><br/>
    
 <a class='btn' href='/arena/?attack=true'><span class='end'><span class='label'>Атаковать</span></span></a>
 </td>
 </tr></table>
 </div>
</div>

<div class='mini-line'></div>

<div class='main'><div class='block_zero'>
  Твои параметры:<br/>
<img src='/images/icon/str.png' alt='*'/> <?=$user['str']?> <img src='/images/icon/vit.png' alt='*'/> <?=$user['vit']?> <img src='/images/icon/agi.png' alt='*'/> <?=$user['agi']?> <img src='/images/icon/def.png' alt='*'/> <?=$user['def']?>
</div></div>
<div class='mini-line'></div>
<div class='main'><div class='block_zero'><small>Чем сильнее противник, тем больше Опыта и Серебра получишь за победу!</small></div></div>
<?

include './system/f.php';

?>