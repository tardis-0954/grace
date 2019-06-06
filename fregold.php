<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


$title = 'Добыча золота';    

include './system/h.php';  

if($user['level'] < 25) {
echo '<div class="main block">Добыча золота доступна с 25 уровня!';
include ('./system/f.php');
exit();
}
if($_GET['act'] == up) {
if($user['biznes_dohod'] >= 100) {
echo '<div class="main block">Максимальный доход составляет: 100 золота. Чтобы увеличить его, необходимо купить золото по СМС хотя бы один раз.</div>';
include ('./system/f.php');
exit();
}
if($user['g'] < $user['biznes_dohod']) {
echo '<div class="main block">Недостаточно золота!</div>';
}else{
mysql_query("update `users` set `g` = `g` - '".$user['biznes_dohod']."', `biznes_dohod` = `biznes_dohod` + 1 where `id` = '".$user['id']."'");
header ('location: ?');
exit();
}
}


if($_GET['act'] == ce) {
if($user['biznes_time'] > time()) {
echo '<div class="main block center">Ошибка!</div>';
}else{
mysql_query("update `users` set `g` = `g` + '".$user['biznes_dohod']."', `biznes_time` = '".(time() + 1800)."' where `id` = '".$user['id']."'");
header ('location: ?');
exit();
}
}
if($user['biznes_time'] < time()){
$user['biznes_time'] = time() - 60;
}
echo '<div class="main block center"><img src="rusalc/dobisha.jpg" width="100%"><br><small>Стань самым богатым!</small></div>';
echo '<div class="main block">Твой доход за 30 минут составляет: '.$user['biznes_dohod'].' <img src="/images/icon/gold.png"><br>';
if($user['biznes_time'] > time()) {
echo 'Успей забрать своё золото через: '.vremja($user['biznes_time'] - time()).' ';
}else{
echo '<b>Забирай золото!</b>';
}
echo ' </div>';
echo '<div class="main menuList"><li><a href="?act=up">Повысить доход за '.$user['biznes_dohod'].' <img src="/images/icon/gold.png"></a></li></div>';
if($user['biznes_time'] < time()) {
echo '<div class="mini-line"></div>';
echo '<div class="main menuList"><li><a href="?act=ce">Забрать '.$user['biznes_dohod'].' <img src="/images/icon/gold.png"></a></li></div>';
}
include ('./system/f.php');
?>
