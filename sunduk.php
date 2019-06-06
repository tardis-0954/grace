<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


$title = 'Волшебный сундук';    

include './system/h.php';  

if($_GET['act'] == ok) {
if($user['chester'] == 0) {
echo '<div class="block center">Необходим ключ!</div>';
}else{
$rand = rand(0,1);
mysql_query("update `users` set `chester` = `chester` - 1 where `id` = '".$user['id']."'");
if($rand == 0) {
echo '<div class="block center">В этом сундуке ничего нет!</div>';
}else{
$rangold = rand(0,$user['level']);
echo '<div class="block center">Вы нашли: '.$rangold.' <img src="/images/icon/gold.png"> золота!</div>';
mysql_query("update `users` set `g` = `g` + '".$rangold."' where `id` = '".$user['id']."'");
}
}
}
echo '
<div class="main center"><div class="block">
Выбери сундук: <br><br>
<a href="?act=ok"><img src="/images/bcefe3d8b2204fedc9b14fa71f26686c.png" height="60"></a> <div style="margin-right: 6px;"></div>
<a href="?act=ok"><img src="/images/bcefe3d8b2204fedc9b14fa71f26686c.png" height="60"></a>
<a href="?act=ok"><img src="/images/bcefe3d8b2204fedc9b14fa71f26686c.png" height="60"></a>
</div>
</div><div class="main"><div class="block">Чтобы открыть сундук нужен ключ который ты можешь найти в <a href="/farm">Походе</a>!
<br>У тебя: '.$user['chester'].' ключей</div>
</div>';
  
include './system/f.php';

?>