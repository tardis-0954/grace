<?php
include ('./system/common.php');
include ('./system/functions.php');
include ('./system/user.php');
$title = 'Битва питомцев';
include ('./system/h.php');
  $id = _string(_num($_GET['id']));
  if($id) {
    $i = mysql_query('SELECT * FROM `pets_user` WHERE `id` = "'.$id.'"');
    $i = mysql_fetch_array($i);
if($_GET['act'] == attack && $i['id'] != 0) {
   $mypet = mysql_query('SELECT * FROM `pets_user` WHERE `user` = "'.$user['id'].'"');
    $mypet = mysql_fetch_array($mypet);
   if($mypet['sila'] == 0) {
   echo '<div class="block center">Купите питомца!</div>';
   include ('./system/f.php');
   exit();
   }
    if($mypet['hp'] < 10 && $i['hp'] < 10) {
    echo '<div class="block center">Для атаки у вашего питомца или питомца противника должно быть минимум 10 здоровья!</div>';
  } else {
  $exp = rand(1, $user['level']);
  $parami = $i['hp'] + $i['sila'] + $i['def'];
  $parammy = $mypet['hp'] + $mypet['sila'] + $mypet['def'];
  if($parammy > $parami) {
  echo '<div class="block center">Победа!<br>Награда: '.$exp.' <img src="/images/icon/exp.png"> опыта!</div>';
  mysql_query("update `users` set `exp` = `exp` + '".$exp."' where `id` = '".$user['id']."'");
  } else {
  echo '<div class="block center">Поражение! <br>Потери вашего питомца: -10 <img src="/images/icon/vit.png"> здоровья!</div>';
  mysql_query("update `pets_user` set `hp` = `hp` - 10 where `user` = '".$user['id']."'");
}
}
}
}
echo '<div class="main block">Противник:<br> <img src="/images/pets/'.$i['img'].'.png" height="100" width="80"><br>'.$i['name'].' </div>';
echo '<div class="main block"><img src="/images/icon/str.png"> Сила: '.$i['sila'].' <br><img src="/images/icon/def.png"> Защита: '.$i['def'].' <br> <img src="/images/icon/vit.png"> Здоровье: '.$i['hp'].'/'.$i['max_hp'].'</div>';
echo '<div class="main menuList"><li><a href="?act=attack&id='.$i['id'].'">Атаковать</li></a></div>';
echo '<div class="main menuList"><li><a href="/fights_pet.php">Другие противники</li></a></div>';
include ('./system/f.php');
?>