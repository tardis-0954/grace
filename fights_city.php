<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


$title = 'Битва за город';    

include './system/h.php';  

$city = mysql_query('SELECT * FROM `city` WHERE `id` = "1"');
$city = mysql_fetch_array($city);
$cityuser = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$city['user'].'"');
if($city['attack_time'] < time()){
$city['attack_time'] = time();
}
$cityuser = mysql_fetch_array($cityuser);
echo '<div class="main block">
<img src="/images/city.png" width="98%" height="30%"><br>
Город принадлежит: <a href="/user/'.$city['user'].'/">'.$cityuser['login'].'</a>
<br>Доход города в час: '.$city['gold'].' <img src="/images/icon/gold.png"> золота <br>';
if($city['attack_time'] > time()) {
echo 'Захватить город можно через: '.vremja($city['attack_time'] - time()).'';
}
else {
echo '<b>Город можно захватить!</b>';
}
echo '
<br>Защитная стена города: '.$city['health'].'
<img src="/images/icon/vit.png"> </div>';
if($city['user'] != $user['id']) {
if($_GET['act'] == attack) {
if($user['level'] < 25) {
echo '<div class="block center">Атаковать город можно только с 25 уровня!</div>';
include ('./system/f.php');
exit();
}
if($city['attack_time'] > time()) {
echo '<div class="block center">Сейчас атаковать город нельзя!</div>';
}
else {
$attackcity = rand(0, $user['vit']);
if($user['hp'] < $attackcity) {
echo "
<div class='block' align='center'>
<font color='#c06060'>Для нападения надо минимум <img src='/images/icon/health.png' alt='*'/> $attackcity жизни</font>
  <div class='separ'></div>

<table cellpadding='0' cellspacing='0'>
<tr>
  
  <td><img src='/images/alchemy/potion.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;' align='left'><b>Настойка бодрости</b><br/>
  <small><small>+100% жизни</small></small></td>

</tr></table>

  <div class='separ'></div>

<div align='center'>
<a class='btn' href='/lab/wiz/?potion=true&referal=/fights_city.php'><span class='end'><span class='label'>Купить</span></span></a>
<br/><br/>
  <font color='#909090'>Цена: <img src='/images/icon/gold.png' alt='*'/> 15 золота</font>
</div>";
include ('./system/f.php');
exit();
}
if($city['health'] < 1) {
mysql_query("update `city` set `health` = 5000000, `user` = '".$user['id']."', `attack_time` = '".(time() + 3000)."',  `gold_time` = '".(time() + 1)."' where `id` = 1");
mysql_query("update `users` set `exp` = `exp` + 5000  where `id` = '".$user['id']."'");
echo '<div class="block center">Вы захватили этот город!<br>Награда: 5000 <img src="/images/icon/exp.png"> опыта</div>';
}
mysql_query("update `city` set `health` = `health` - '".$user['str']."' where `id` = 1");
mysql_query("update `users` set `exp` = `exp` + 100, `hp` = `hp` - '".$attackcity."' where `id` = '".$user['id']."'");
echo '<div class="block">Вы ударили стены города на: '.$user['str'].' <br>Получено: 100 <img src="/images/icon/exp.png"> опыта<br>Потери: -'.$attackcity.' <img src="/images/icon/vit.png"> </div>';
}
}
echo '<div class="main menuList"><li><a href="?act=attack">Атаковать город</a></li></div>';
}
if($city['user'] == $user['id']) {
if($_GET['act'] == up && $user['g'] > 10) {
mysql_query("update `city` set `gold` = `gold` + 1, `health` = `health` + 10 where `id` = 1");
mysql_query("update `users` set `g` = `g` - 10 where `id` = '".$user['id']."'");
header('location: ?');
}
echo '<div class="main menuList"><li><a href="?act=up">Улучшить город за 10 <img src="/images/icon/gold.png"></a></li></div>';
if($city['gold_time'] < time()) {
if($_GET['act'] == gold) {
mysql_query("update `city` set `gold_time` = '".(time() + 3200)."' where `id` = 1");
mysql_query("update `users` set `g` = `g` + '".$city['gold']."' where `id` = '".$user['id']."'");
header('location: ?');
}
echo '<div class="main menuList"><li><a href="?act=gold">Забрать '.$city['gold'].' <img src="/images/icon/gold.png"></a></li></div>';
}
}
include ('./system/f.php');