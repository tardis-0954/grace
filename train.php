<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}
    
    $title = 'Тренировка';


include './system/h.php';  
    function cost($i) {
        
        switch($i) {
          case 0:
           $cost = 200;
           break;
        
          case 1:
           $cost = 400;
           break;
        
          case 2:
           $cost = 600;
           break;
          
          case 3:
           $cost = 800;
           break;

          case 4:
           $cost = 1000;
           break;   
           
          case 5:
           $cost = 1;
           break;        

          case 6:
           $cost = 1600;
           break;   

          case 7:
           $cost = 3200;
           break;

          case 8:
           $cost = 4800;
           break;   
           
          case 9:
           $cost = 6400;
           break;   

          case 10:
           $cost = 8000;
           break;   

          case 11:
           $cost = 10;
           break;   

          case 12:
           $cost = 2400;
           break;   

          case 13:
           $cost = 4800;
           break;   

          case 14:
           $cost = 7200;
           break;   

          case 15:
           $cost = 9600;
           break;   

          case 16:
           $cost = 12000;
           break;   

          case 17:
           $cost = 20;
           break;   

          case 18:
           $cost = 3200;
           break;   

          case 19:
           $cost = 7200;
           break;   

          case 20:
           $cost = 10800;
           break;   

          case 21:
           $cost = 14400;
           break;   

          case 22:
           $cost = 18000;
           break;   

          case 23:
           $cost = 40;
           break;   

          case 24:
           $cost = 3600;
           break;   

          case 25:
           $cost = 7200;
           break;   

          case 26:
           $cost = 10800;
           break;   

          case 27:
           $cost = 14400;
           break;   

          case 28:
           $cost = 18000;
           break;   

          case 29:
           $cost = 80;
           break;   

          case 30:
           $cost = 4800;
           break;   

          case 31:
           $cost = 9600;
           break;   

          case 32:
           $cost = 14400;
           break;   

          case 33:
           $cost = 19200;
           break;   

          case 34:
           $cost = 24000;
           break;   

          case 35:
           $cost = 160;
           break;   

          case 36:
           $cost = 5600;
           break;   

          case 37:
           $cost = 11200;
           break;   

          case 38:
           $cost = 16800;
           break;   

          case 39:
           $cost = 22400;
           break;   

          case 40:
           $cost = 28000;
           break;   

          case 41:
           $cost = 320;
           break;   

          case 42:
           $cost = 6400;
           break;   

          case 43:
           $cost = 12800;
           break;   

          case 44:
           $cost = 19200;
           break;   

          case 45:
           $cost = 25600;
           break;   

          case 46:
           $cost = 32000;
           break;   

          case 47:
           $cost = 640;
           break;   

          case 48:
           $cost = 7200;
           break;   

          case 49:
           $cost = 14400;
           break;   

          case 50:
           $cost = 21600;
           break;   

          case 51:
           $cost = 28800;
           break;   

          case 52:
           $cost = 36000;
           break;   

          case 53:
           $cost = 1280;
           break;   

          case 54:
           $cost = 5000;
           break;   

          case 55:
           $cost = 16000;
           break;   

          case 56:
           $cost = 24000;
           break;   

          case 57:
           $cost = 32000;
           break;   

          case 58:
           $cost = 40000;
           break;   

          case 59:
           $cost = 2560;
           break;   

        }
        
    return $cost;
    
    }

    function value($i) {
        
        switch($i) {
          case 0:
           $value = 's';
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
           $value = 's';
           break;        

          case 11:
           $value = 'g';
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
           $value = 's';
           break;        

          case 17:
           $value = 'g';
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
           $value = 's';
           break;        
          
          case 22:
           $value = 's';
           break;     
              
          case 23:
           $value = 'g';
           break;        

          case 24:
           $value = 's';
           break;     

          case 25:
           $value = 's';
           break;     

          case 26:
           $value = 's';
           break;     

          case 27:
           $value = 's';
           break;     

          case 28:
           $value = 's';
           break;     

          case 29:
           $value = 'g';
           break;     

          case 30:
           $value = 's';
           break;     

          case 31:
           $value = 's';
           break;     

          case 32:
           $value = 's';
           break;     

          case 33:
           $value = 's';
           break;     

          case 34:
           $value = 's';
           break;     

          case 35:
           $value = 'g';
           break;     

          case 36:
           $value = 's';
           break;     

          case 37:
           $value = 's';
           break;     

          case 38:
           $value = 's';
           break;     

          case 39:
           $value = 's';
           break;     

          case 40:
           $value = 's';
           break;     

          case 41:
           $value = 'g';
           break;     

          case 42:
           $value = 's';
           break;     

          case 43:
           $value = 's';
           break;     

          case 44:
           $value = 's';
           break;     

          case 45:
           $value = 's';
           break;     

          case 46:
           $value = 's';
           break;     

          case 47:
           $value = 'g';
           break;     

          case 48:
           $value = 's';
           break;     

          case 49:
           $value = 's';
           break;     

          case 50:
           $value = 's';
           break;     

          case 51:
           $value = 's';
           break;     

          case 52:
           $value = 's';
           break;     

          case 53:
           $value = 'g';
           break;     

          case 54:
           $value = 's';
           break;     

          case 55:
           $value = 's';
           break;     

          case 56:
           $value = 's';
           break;     

          case 57:
           $value = 's';
           break;     

          case 58:
           $value = 's';
           break;     

          case 59:
           $value = 'g';
           break;     

        }
    
    return $value;
    
    }

if(isset($_GET['str'])) {

if($user['_str'] < 61) {

    if(value($user['_str']) == 's') {

      if($user['s'] < cost($user['_str'])) {
      
        
      
      }
      else
      {
      
          mysql_query('UPDATE `users` SET `str` =   `str` + 1,
                                         `_str` =  `_str` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `s` = `s` - '.cost($user['_str']).' WHERE `id` = "'.$user['id'].'"');
      
      }

    }
    else
    if(value($user['_str'] == 'g')) {
      
      if($user['g'] < cost($user['_str'])) {
      
        
      
      }
      else
      {
      

          mysql_query('UPDATE `users` SET `str` =   `str` + 1,
                                         `_str` =  `_str` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `g` = `g` - '.cost($user['_str']).' WHERE `id` = "'.$user['id'].'"');
      
      }    
    
    }

}    
    header('location: /train.php');

}

if(isset($_GET['vit'])) {

if($user['_vit'] < 61) {

    if(value($user['_vit']) == 's') {

      if($user['s'] < cost($user['_vit'])) {
      
        
      
      }
      else
      {
      
          mysql_query('UPDATE `users` SET `vit` =   `vit` + 1,
                                         `_vit` =  `_vit` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `s` = `s` - '.cost($user['_vit']).' WHERE `id` = "'.$user['id'].'"');
      
      }

    }
    else
    if(value($user['_vit'] == 'g')) {
      
      if($user['g'] < cost($user['_vit'])) {
      
        
      
      }
      else
      {
      

          mysql_query('UPDATE `users` SET `vit` =   `vit` + 1,
                                         `_vit` =  `_vit` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `g` = `g` - '.cost($user['_vit']).' WHERE `id` = "'.$user['id'].'"');
      
      }    
    
    }

}    
    header('location: /train.php');

}

if(isset($_GET['agi'])) {

if($user['_agi'] < 61) {

    if(value($user['_agi']) == 's') {

      if($user['s'] < cost($user['_agi'])) {
      
        
      
      }
      else
      {
      
          mysql_query('UPDATE `users` SET `agi` =   `agi` + 1,
                                         `_agi` =  `_agi` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `s` = `s` - '.cost($user['_agi']).' WHERE `id` = "'.$user['id'].'"');
      
      }

    }
    else
    if(value($user['_agi'] == 'g')) {
      
      if($user['g'] < cost($user['_agi'])) {
      
        
      
      }
      else
      {
      

          mysql_query('UPDATE `users` SET `agi` =   `agi` + 1,
                                         `_agi` =  `_agi` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `g` = `g` - '.cost($user['_agi']).' WHERE `id` = "'.$user['id'].'"');
      
      }    
    
    }

}    
    header('location: /train.php');

}

if(isset($_GET['def'])) {

if($user['_def'] < 61) {

    if(value($user['_def']) == 's') {

      if($user['s'] < cost($user['_def'])) {
      
        
      
      }
      else
      {
      
          mysql_query('UPDATE `users` SET `def` =   `def` + 1,
                                         `_def` =  `_def` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `s` = `s` - '.cost($user['_def']).' WHERE `id` = "'.$user['id'].'"');
      
      }

    }
    else
    if(value($user['_def'] == 'g')) {
      
      if($user['g'] < cost($user['_def'])) {
      
        
      
      }
      else
      {
      

          mysql_query('UPDATE `users` SET `def` =   `def` + 1,
                                         `_def` =  `_def` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `g` = `g` - '.cost($user['_def']).' WHERE `id` = "'.$user['id'].'"');
      
      }    
    
    }

}    
    header('location: /train.php');

}

if(isset($_GET['mana'])) {

if($user['_mana'] < 61) {

    if(value($user['_mana']) == 's') {

      if($user['s'] < cost($user['_mana'])) {
      
        
      
      }
      else
      {
      
          mysql_query('UPDATE `users` SET `mana` =  `mana` + 5,
                                         `_mana` = `_mana` + 1,
                                         `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

      mysql_query('UPDATE `users` SET `s` = `s` - '.cost($user['_mana']).' WHERE `id` = "'.$user['id'].'"');
      
      }

    }
    else
    if(value($user['_mana'] == 'g')) {
      
      if($user['g'] < cost($user['_mana'])) {
      
        
      
      }
      else
      {
      

          mysql_query('UPDATE `users` SET `mana` =  `mana` + 5,
                                         `_mana` = `_mana` + 1,
                                         `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

      mysql_query('UPDATE `users` SET `g` = `g` - '.cost($user['_mana']).' WHERE `id` = "'.$user['id'].'"');
      
      }    
    
    }

}    
    header('location: /train.php');

}

?>
<div class='main'>
<div class='block_zero'>
<img src='/images/icon/str.png' alt='*'/> Сила: <?=$user['str']?> <font color='#999'>(урон <?=round($user['str']/6)?> -  <?=round($user['str']/4)?>)</font><br/>
<small>+<?=$user['_str']?> к мастерству</small>

<?

  $_str_progress = round(100 / (60 / $user['_str']));

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px;'>
<div style='background: #fc3; height: 4px; width: <?=$_str_progress?>%;'></div>
</div><small>Чем больше сила, тем больше урона нанесёшь врагу!
</small>
<?

  if($user['_str'] < 60) {

?>
<br/><br/>
<div align='center'>
<a class='btn' href='?str'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($user['_str']) == 'g' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['_str'])?></span></span></a>
</div>

<?

  }

?>

</div>
 <div class='mini-line'></div>

<div class='block_zero'>

<img src='/images/icon/vit.png' alt='*'/> Жизнь: <?=$user['vit']?> <font color='#999'>(<?=($user['vit']*2)?>)</font><br/>
<small>+<?=$user['_vit']?> к мастерству</small>

<?

  $_vit_progress = round(100 / (60 / $user['_vit']));

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px;'>
<div style='background: #fc3; height: 4px; width: <?=$_vit_progress?>%;'></div>
</div><small>Здоровья много не бывает
</small>

<?

  if($user['_vit'] < 60) {

?>
<br/><br/>
<div align='center'>
<a class='btn' href='?vit'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($user['_vit']) == 'g' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['_vit'])?></span></span></a>
</div>

<?

  }

?>


</div>
 <div class='mini-line'></div>

<div class='block_zero'>

<img src='/images/icon/agi.png' alt='*'/> Удача: <?=$user['agi']?> <font color='#999'>(<?=$user['agi']/100?> % крит/уклонение)</font><br/>
<small>+<?=$user['_agi']?> к мастерству</small>

<?

  $_agi_progress = round(100 / (60 / $user['_agi']));

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px;'>
<div style='background: #fc3; height: 4px; width: <?=$_agi_progress?>%;'></div>
</div><small>Увеличивает шанс на уворот и крит.удар
</small>

<?

  if($user['_agi'] < 60) {

?>
<br/><br/>
<div align='center'>
<a class='btn' href='?agi'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($user['_agi']) == 'g' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['_agi'])?></span></span></a>
</div>

<?

  }

?>

</div>
 <div class='mini-line'></div>


<div class='block_zero'>

<img src='/images/icon/def.png' alt='*'/> Защита: <?=$user['def']?> <font color='#999'>(поглощение урона <?=round($user['def']/12)?> - <?=round($user['def']/7)?>)</font><br/>
<small>+<?=$user['_def']?> к мастерству</small>

<?

  $_def_progress = round(100 / (60 / $user['_def']));

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px;'>
<div style='background: #fc3; height: 4px; width: <?=$_def_progress?>%;'></div>
</div><small>Поглощает урон врага
</small>

<?

  if($user['_def'] < 60) {

?>
<br/><br/>
<div align='center'>
<a class='btn' href='?def'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($user['_def']) == 'g' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['_def'])?></span></span></a>
</div>

<?

  }

?>


</div>
 <div class='mini-line'></div>


<div class='block_zero'>

<img src='/images/icon/mana.png' alt='*'/> Мана:  <?=$user['mana']?><br/>
<small>+<?=$user['_mana']?> к мастерству</small>

<?

  $_mana_progress = round(100 / (60 / $user['_mana']));

?>
<div style='border:1px solid #000; background: #ffffff; height: 4px;'>
<div style='background: #fc3; height: 4px; width: <?=$_mana_progress?>%;'></div>
</div><small>Увеличивает запас маны
</small><br/>

<?

  if($user['_mana'] < 60) {

?>
<div align='center'>
<a class='btn' href='?mana'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($user['_mana']) == 'g' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['_mana'])?></span></span></a>
</div>

<?

  }

?>

</div>
 <div class='mini-line'></div>


<div class='block_zero'>
<img src='/images/icon/skill.png' alt='*'/> Мастерство: <?=$user['skill']?>
</div>
</div>
<?
  
include './system/f.php';

?>