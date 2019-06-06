<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

    $title = 'Дуэли';

include './system/h.php';

if(mysql_result(mysql_query('SELECT * FROM `duel` WHERE `user` = "'.$user['id'].'"'),0) == 0) {

  mysql_query('INSERT INTO `duel` (`user`) VALUES ("'.$user['id'].'")');

}

    $duel = mysql_query('SELECT * FROM `duel` WHERE `user` = "'.$user['id'].'"');
    $duel = mysql_fetch_array($duel);

    $sack = mysql_query('SELECT * FROM `sack` WHERE `user` = "'.$user['id'].'"');      
    $sack = mysql_fetch_array($sack);

if(!$sack) {

  mysql_query('INSERT INTO `sack` (`user`) VALUES ("'.$user['id'].'")');

}

  if($_GET['refresh'] == true) {
  
    if($user['duel_fights'] > 0 OR $user['g'] < 20) {
    
      header('location: /duel/');
      
     exit;
    
    }
    
    mysql_query('UPDATE `users` SET `duel_fights` = "10",
                                              `g` = `g` - 20 WHERE `id` = "'.$user['id'].'"');
  
    header('location: /duel/');

  }

?>

<?

if($user['level'] > 4) {

    if($_GET['last'] == true && $user['duel_changes'] > 0) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `duel_rating` >= "'.($user['duel_rating']/2).'" AND `duel_rating` <= "'.$user['duel_rating'].'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      if(!$opponent) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `duel_rating` <= "'.$user['duel_rating'].'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      }

      mysql_query('UPDATE `users` SET `duel_changes` = `duel_changes` - 1 WHERE `id` = "'.$user['id'].'"');
      mysql_query('UPDATE `duel` SET `opponent` = "'.$opponent['id'].'" WHERE `user` = "'.$user['id'].'"');
    
      header('location: /duel/');
    
    }

    if(!$duel['opponent']) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `duel_rating` >= "'.($user['duel_rating']/2).'" AND `duel_rating` <= "'.$user['duel_rating'].'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      if(!$opponent) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `duel_rating` <= "'.$user['duel_rating'].'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      }
    
      mysql_query('UPDATE `duel` SET `opponent` = "'.$opponent['id'].'" WHERE `user` = "'.$user['id'].'"');
        
    }
    else
    {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$duel['opponent'].'"');
      $opponent = mysql_fetch_array($opponent);
    
    }

  if($_GET['attack'] == true) {

  if(time() - $duel['time'] < 1) {
  
    header('location: /duel/');
  
  exit;
  
  }

  
  if($user['hp'] > ( ( ($user['vit'] * 2) / 100 ) * 10 )) {
  
  if( $user['duel_fights'] > 0) {
  
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
   
      $dmg += round(($dmg / 100) * $a_3_bonus);
      
    }


    $dodge = ( (rand(1,2) * ($opponent['agi'] / 100) ) - (rand(1,2) * ($user['agi'] / 100)));

    if(mt_rand(0, 100) <= $dodge) {
   
      $dmg = 0;
      
    }



      $opponent_dmg +=round(rand(($opponent['str']/6),($opponent['str']/4)));

      if($a_2 == true) {
      
        $dmg -= round(($opponent_dmg / 100) * $a_2_bonus);
      
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

    $_hp  = round($duel['opponent_dmg'] / 4);

    }
    else
    {

    $_hp  = round($duel['opponent_dmg'] / 2);    
    
    }

    if($_hp > $user['hp']) {
        
      $_hp  = $user['hp'];
        
    }


?>

<div class='block center'>

<?
    
    
    if($dmg > $opponent_dmg) {

      $_s =   rand(1,50) * $opponent['level'];
    $_exp =   rand(1,20) * $opponent['level'];
          

    if($clan_memb && $clan_memb['v'] > 0) {
    
      $_exp += round($_exp/100) * $clan_memb['v'];
    
    }

    
    $_rating = rand(1,$opponent['level']);
    
   mysql_query('UPDATE `users` SET `duel_rating` = `duel_rating` + '.$_rating.' WHERE `id` = "'.$user['id'].'"');

?>

<img src='/images/icon/2hit.png' alt='*'/> <font color='#90c090'><b>Победа!</b></font> <img src='/images/icon/2hit.png' alt='*'/>

<?

  
   $opponent = mysql_query('SELECT * FROM `users` WHERE `duel_rating` <= "'.$user['duel_rating'].'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
   $opponent = mysql_fetch_array($opponent);
    
      mysql_query('UPDATE `duel` SET `opponent` = "'.$opponent['id'].'" WHERE `user` = "'.$user['id'].'"');


    }
    else
    {

      $_s =   rand(1,25) * $opponent['level'];
    $_exp =   rand(1,10) * $opponent['level'];
    

    if($clan_memb && $clan_memb['v'] > 0) {
    
      $_exp += round($_exp/100) * $clan_memb['v'];
    
    }
    
    $_rating = rand(1,($opponent['level'] * 2));

   mysql_query('UPDATE `users` SET `duel_rating` = `duel_rating` - '.(($user['duel_rating'] - $_rating < 0) ? $user['duel_rating']:$_rating).' WHERE `id` = "'.$user['id'].'"');

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


  if($clan_memb) {
    
    $_exp += round($_exp/100) * $clan_memb['bonus'];
    
  }

  if($premium) {
  
  $_exp+= round($_exp/ 100) * 25;
  
  }


      if($clan) {
        
       mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.' WHERE `id` = "'.$clan['id'].'"');
       mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');

      }

?>

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

  <div class='separ'></div>
<img src='/images/icon/silver.png' alt="*"/> <?=$_s?> серебра <img src='/images/icon/exp.png' alt='*'/> <?=$_exp?> опыта

<?

  if($user['duel_trophy'] + 1 == 5) {

      $res = rand(1,9);
$res_count = rand(1,3);

    mysql_query('UPDATE `sack`  SET    `'.$res.'` = `'.$res.'` + '.$res_count.' WHERE `user` = "'.$user['id'].'"');
    mysql_query('UPDATE `users` SET `duel_trophy` = "0"                         WHERE   `id` = "'.$user['id'].'"');

    switch($res) {
    case 1:
    $res_name = 'Алмаз';
     break;
    case 2:
    $res_name = 'Корунд';
     break;
    case 3:
    $res_name = 'Обсидиан';
     break;
    case 4:
    $res_name = 'Графит';
     break;
    case 5:
    $res_name = 'Оникс';
     break;
    case 6:
    $res_name = 'Амброзия';
     break;
    case 7:
    $res_name = 'Мята';
     break;
    case 8:
    $res_name = 'Аир';
     break;
    case 9:
    $res_name = 'Рябина';
     break;
  }
  
?>

  <div class='separ'></div>
  <font color='#90b0c0'>Награда за 5 поединков:</font><br/>
  <img src='/images/icon/res/<?=$res?>.png' alt='*'/> <?=$res_name?> (<?=$res_count?> <font color='#90b0c0'>шт.</font>)

<?
  
  }
  else
  {
  
    mysql_query('UPDATE `users` SET `duel_trophy` = `duel_trophy` + 1 WHERE `id` = "'.$user['id'].'"');
  
  }

?>

</div>

<?

   mysql_query('UPDATE `users` SET `exp` = `exp` + '.$_exp.',
                                     `s` =   `s` + '.$_s.' WHERE `id` = "'.$user['id'].'"');
 

  
   mysql_query('UPDATE `duel` SET `time` = "'.(time() + 1).'" WHERE `user` = "'.$user['id'].'"');

   mysql_query('UPDATE `users` SET `hp` = `hp` - '.$_hp.',
                     `duel_last_update` = "'.time().'",
                          `duel_fights` = `duel_fights` - 1 WHERE `id` = "'.$user['id'].'"');



   $opponent = mysql_query('SELECT * FROM `users` WHERE `duel_rating` <= "'.$user['duel_rating'].'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
   $opponent = mysql_fetch_array($opponent);
    
   mysql_query('UPDATE `duel` SET `opponent` = "'.$opponent['id'].'" WHERE `user` = "'.$user['id'].'"');

  }
  else
  {

?>

<div class='block center'>
<font color='#c06060'>У вас закончились бесплатные бои!</font><br/>
До восстановления: <?=_time(($user['duel_last_update'] + (60 * 30)) - time())?>

  <div class='separ'></div>
   <a class='btn' href='/duel/?refresh=true'><span class='end'><span class='label'>Купить</span></span></a>
  <br/>
  <br/>
  <font color='#909090'>Цена: <img src='/images/icon/gold.png' alt='*'/> 20 золота</font>

</div>

<?
  
  }
  
  }
  else
  {

?>

<div class='block' align='center'>
<font color='#c06060'>Для нападения надо минимум <img src='/images/icon/health.png' alt='*'/> 10% жизни</font>  
</div>

<?

  }

  }
  else
  {

?>

<?

  }

?>
<div class='main'>
<div class='block' align='center'>
<font color='#90b0c0'>Мой рейтинг: <?=$user['duel_rating']?></font>
<?

if($_GET['attack'] == true && $_rating > 0) {

  if($dmg > $opponent_dmg) {

?><font color='#30c030'>(+<?

  }
  else
  {

?><font color='#f33'>(-<?

  }

?><?=$_rating?>)</font>

<?

}

?>
</div>
  <div class='mini-line'></div>

<?

  $opponent = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$duel['opponent'].'"');
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

<div class='block' align='center'>
  <img src='/images/icon/race/<?=$opponent['r']?>.png' alt='*'/> <?=$opponent['login']?><br/>
  Рейтинг: <?=$opponent['duel_rating']?><br/>
  <a href='?attack=true'><img src='/manekenImage/<?=$opponent['sex']?>/<?=$w_1['item']?>/<?=$w_2['item']?>/<?=$w_3['item']?>/<?=$w_4['item']?>/<?=$w_5['item']?>/<?=$w_6['item']?>/<?=$w_7['item']?>/<?=$w_8['item']?>/' alt='*'/></a><br/>
  
  <img src='/images/icon/str.png' alt='*'/> <?=$opponent['str']?>
  <img src='/images/icon/vit.png' alt='*'/> <?=$opponent['vit']?>
  <img src='/images/icon/agi.png' alt='*'/>  <?=$opponent['agi']?>
  <img src='/images/icon/def.png' alt='*'/> <?=$opponent['def']?>
    <div class='separ'></div>
   <a class='btn' href='?attack=true'><span class='end'><span class='label'>Атаковать</span></span></a> <br/><br/>
    
    <font color='#90b0c0'>Доступно боёв:</font> <img src='/images/icon/2hit.png' alt='*'/> <b><?=$user['duel_fights']?></b><br/>
    <font color='#90b0c0'>Награда:</font> <?=$user['duel_trophy']?> из 5 боев</font>
 </td>
 </tr></table>
 
</div>

  <div class='mini-line'></div>
<div class='block' align='center'>
  <img src='/images/icon/race/<?=$user['r']?>.png' alt='*'/> <?=$user['login']?><br/>
<img src='/images/icon/str.png' alt='*'/> <?=$user['str']?> <img src='/images/icon/vit.png' alt='*'/> <?=$user['vit']?> <img src='/images/icon/agi.png' alt='*'/> <?=$user['agi']?> <img src='/images/icon/def.png' alt='*'/> <?=$user['def']?>
</div>

<div class='mini-line'></div>

<div class='block' align='center'>
  <a class='btn' href='?last=true'><span class='end'><span class='label'>Другой противник</span></span></a><br/>
  <font color='#909090'>Бесплатная смена противника: <img src='/images/icon/hit.png' alt='*'/> <?=$user['duel_changes']?> раз</font>
</div>
<div class='mini-line'></div></div>
<small>
<div class='main'>
<li><small>Бои не накапливаются больше 10</li></small>
<li><small>После 5 поединков, вы получите по 1 случайному ресурсу</li></small>
<li><small>За 5 боев выдается хорошая награда</li></small>
<li><small>Бесплатных смен не накапливается больше 10</li></small>
</div></small>
<?

}
else
{

?>

  <div class='main'>
<div class='block' align='center'>
  <img src='/images/icon/farm.png' alt='*'/> Дуэли доступны с <img src='/images/icon/level.png' alt='*'/> 5 уровня<br/>
</div></div>


<?

}

include './system/f.php';

?>