<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Пещера';    

include './system/h.php';

    $sack = mysql_query('SELECT * FROM `sack` WHERE `user` = "'.$user['id'].'"');      
    $sack = mysql_fetch_array($sack);

if(!$sack) {

  mysql_query('INSERT INTO `sack` (`user`) VALUES ("'.$user['id'].'")');

}


  $cave = mysql_query('SELECT * FROM `cave` WHERE `user` = "'.$user['id'].'"');
  $cave = mysql_fetch_array($cave);

       $res_1 = rand(1,9);
$res_1_chanse = rand(0,25);
  
       $res_2 = rand(1,9);
$res_2_chanse = rand(0,25);

       $res_3 = rand(1,9);
$res_3_chanse = rand(0,25);

  if($cave['dawn'] == 1 && $cave['gather'] == 0 && $cave['time'] <= time()) {

  if(!$cave['res_1'] && !$cave['res_2'] && !$cave['res_3']) {
  
    mysql_query('UPDATE `cave` SET `res_1` = "'.$res_1.'",
                            `res_1_chanse` = "'.$res_1_chanse.'",
                                   `res_2` = "'.$res_2.'",
                            `res_2_chanse` = "'.$res_2.'",
                                   `res_3` = "'.$res_3.'",
                            `res_3_chanse` = "'.$res_3_chanse.'" WHERE `user` = "'.$user['id'].'"');
  
  }
  
  }


  $cave = mysql_query('SELECT * FROM `cave` WHERE `user` = "'.$user['id'].'"');
  $cave = mysql_fetch_array($cave);

  if(!$cave) {
  
    mysql_query('INSERT INTO `cave` (`user`) VALUES ("'.$user['id'].'")');
  
  }

   function res($i) {
  
    switch($i) {
    case 1:
    $name = 'Алмаз';
     break;
    case 2:
    $name = 'Корунд';
     break;
    case 3:
    $name = 'Обсидиан';
     break;
    case 4:
    $name = 'Графит';
     break;
    case 5:
    $name = 'Оникс';
     break;
    case 6:
    $name = 'Амброзия';
     break;
    case 7:
    $name = 'Мята';
     break;
    case 8:
    $name = 'Аир';
     break;
    case 9:
    $name = 'Рябина';
     break;
  }

    return $name;
  
  }

  
?>

<?

  if($cave['dawn'] == 1 && $cave['time'] <= time()) {
  
if($cave['gather'] == 0) {

?>
<div class='main'>
<div class='block center'><font color='#90b0c0'>Осмотр пещеры завершен<br/>
  Вы нашли место с ресурсами:</font>
</div></div>
 <div class='mini-line'></div>
<div class='main'>
<div class='block_zero'>
  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_1']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_1'])?><br/><small>
  Шанс добыть: <?=$cave['res_1_chanse']?>%
  </small></td></tr></table><br/>

  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_2']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_2'])?><br/><small>
  Шанс добыть: <?=$cave['res_2_chanse']?>%
  </small></td></tr></table><br/>

  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_3']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_3'])?><br/><small>
  Шанс добыть: <?=$cave['res_3_chanse']?>%
  </small></td></tr></table>

</div>
<div class='mini-line'></div>
<div class='main'>
<div class='block_zero' align='center'>
<a class='btn' href='/cave/?gather=true'><span class='end'><span class='label'>Начать добычу</span></span></a>
<br/>
  <a href='/cave/?dawn=true'><font color='#909090'>Новый поиск</font></a>
</div></div>
</div>
<?

if($_GET['gather'] == true) {

$time = (60 * 50);

               if($premium) {

$time-= round( $time / 100 ) * 10;
    
             }

    
    mysql_query('UPDATE `cave` SET `gather` = "1",
                                     `time` = "'.(time() + $time).'" WHERE `user` = "'.$user['id'].'"');
  
  header('location: /cave/');
  
  }


if($_GET['dawn'] == true) {
  
$time = (60 * 25);
  
             if($premium) {

$time-= round( $time / 100 ) * 10;
    
             }


    mysql_query('UPDATE `cave` SET `dawn` = "1",
                                   `time` = "'.(time() + $time).'",
                                   `res_1`= "0",
                                   `res_2`= "0",
                                   `res_3`= "0"  WHERE `user` = "'.$user['id'].'"');
  
  header('location: /cave/');
  
  }


  }
  else
  {

?>

<div class='main'> <div class='block_zero' align='center'><font color='#90b0c0'>Работа завершена<br/>
Вы пытались добыть следующие ресурсы:</font>
</div>
 <div class='mini-line'></div>

<?
  
  $res_1 = rand(0,100);
  $res_2 = rand(0,100);
  $res_2 = rand(0,100);
  
?>

<div class='main'>

  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_1']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_1'])?><br/><small>
  <?=($res_1 <= $cave['res_1_chanse'] ? '<font color=\'#30c030\'>Ресурс добыт!</font>':'<font color=\'#c06060\'>Ресурс не добыт!</font>')?>
  </small></td></tr></table><br/>

  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_2']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_2'])?><br/><small>
  <?=($res_2 <= $cave['res_2_chanse'] ? '<font color=\'#30c030\'>Ресурс добыт!</font>':'<font color=\'#c06060\'>Ресурс не добыт!</font>')?>
  </small></td></tr></table><br/>


  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_3']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_3'])?><br/><small>
  <?=($res_3 <= $cave['res_3_chanse'] ? '<font color=\'#30c030\'>Ресурс добыт!</font>':'<font color=\'#c06060\'>Ресурс не добыт!</font>')?>
  </small></td></tr></table>

</div><div class='mini-line'></div>
<div class='block_zero' align='center'>
<a class='btn' href='/cave/'></span class='end'><span class='label'> Обновить</span></span></a>
</div></div>
<?
  
  if($res_1 <= $cave['res_1_chanse']) {

    mysql_query('UPDATE `sack` SET `'.$cave['res_1'].'` = `'.$cave['res_1'].'` + 1 WHERE `user` = "'.$user['id'].'"');  
  
  }

  if($res_2 <= $cave['res_2_chanse']) {

    mysql_query('UPDATE `sack` SET `'.$cave['res_2'].'` = `'.$cave['res_2'].'` + 1 WHERE `user` = "'.$user['id'].'"');  
  
  }

  if($res_3 <= $cave['res_3_chanse']) {

    mysql_query('UPDATE `sack` SET `'.$cave['res_3'].'` = `'.$cave['res_3'].'` + 1 WHERE `user` = "'.$user['id'].'"');  
  
  }


    mysql_query('UPDATE `cave` SET `dawn` = "0",
                                 `gather` = "0",
                                   `time` = "0",
                                   `res_1`= "0",
                                   `res_2`= "0",
                                   `res_3`= "0"  WHERE `user` = "'.$user['id'].'"');


  }

  }
  else
  {

?>
<div class='main'>
<div class='block_zero center'>
  <img src='/rusalc/peshera.jpg' width='100%' alt='*'/>
<div class='block' align='center'><font color='#90b0c0'>В пещере можно найти камни и травы</font></div><br><br>
<?

    if($cave['dawn'] == 1) {
    
  if($cave['gather'] == 0) {

if($cave['time'] > time()) {
  
?>

<font color='#90b0c0'>Вы осматриваете пещеру</font><br/>
Осталось: <?=_time($cave['time'] - time())?>

<?
  
  }
  else
  {
  
  
  }
  
  }
  else
  {

?>

<font color='#90b0c0'>Вы занимаетесь добычей ресурсов..</font><br/>
Осталось: <?=_time($cave['time'] - time())?>

<?
  
  }
  
  }
  else
  {
  
if($_GET['dawn'] == true) {
  
$time = (60 * 25);
    
             if($premium) {

$time-= round( $time / 100 ) * 10;
    
             }
  
    mysql_query('UPDATE `cave` SET `dawn` = "1",
                                   `time` = "'.(time() + $time).'" WHERE `user` = "'.$user['id'].'"');
  
  header('location: /cave/');
  
  }

?>
  
<a class='btn' href='/cave/?dawn=true'><span class='end'><span class='label'>Спуститься</span></span></a>
<?
  
  }

?>

  </div>
</div>

<?
  
  }
    
include './system/f.php';

?>