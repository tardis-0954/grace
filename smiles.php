<?
    
    include './system/common.php';
    
 include './system/functions.php';
         
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}
    
    $title = 'Список смайлов';


include './system/h.php';  

?>

<div class='main'>
<div class='block'>
<img src='/images/smiles/mini_ded.gif' alt=':@)'/> :@) :ded <br/>
<img src='/images/smiles/mini_angel.gif' alt='O:-)'/> O:-) 0:-) О:-) <br/>
<img src='/images/smiles/mini_diablo.gif' alt=']:-)'/> ]:-) ]:-] <br/>
<img src='/images/smiles/mini_blush.gif' alt=':$'/> :$ :-$ :-[ <br/>
<img src='/images/smiles/mini_lol.gif' alt=':))'/> :)) :-)) -)) =)) <br/>
<img src='/images/smiles/mini_ulibka.gif' alt=':)'/> :) :-) =) <br/>
<img src='/images/smiles/mini_podmigivanie.gif' alt=';)'/> ;) ;-) <br/>
<img src='/images/smiles/mini_spin.gif' alt=':-D'/> :-D :-d :D :d ))) <br/>
<img src='/images/smiles/mini_yazyk.gif' alt=':-Р'/> :-Р :-р :-P :-p :P :p <br/>
<img src='/images/smiles/mini_sad.gif' alt=':('/> :( :-( <br/>
<img src='/images/smiles/mini_cry.gif' alt=':'('/> :'( :'-( <br/>
<img src='/images/smiles/mini_dovolen.gif' alt=':]'/> :] :-] <br/>
<img src='/images/smiles/mini_hm.gif' alt=':-/'/> :-/ :-\ <br/>
<img src='/images/smiles/mini_krut.gif' alt='8-)'/> 8-) 8) <br/>
<img src='/images/smiles/mini_kiss.gif' alt=':*'/> :* :-* <br/>
<img src='/images/smiles/mini_crazy.gif' alt='%)'/> %) %-) <br/>
<img src='/images/smiles/mini_chok.gif' alt=':-о'/> :-о :-О :-o :-O О.о o.О O_o o_O <br/>
<img src='/images/smiles/mini_bye.gif' alt='О^'/> О^ O^ o^ <br/>
<img src='/images/smiles/mini_good.gif' alt=':Оb'/> :Оb :Ob :ob <br/>
<img src='/images/smiles/mini_fingal.gif' alt='6-('/> 6-(<br/>
<img src='/images/smiles/mini_gigi.gif' alt='%-E'/> %-E %-Е <br/>
<img src='/images/smiles/mini_gig.gif' alt=':gigi'/> :gigi<br/>
<img src='/images/smiles/mini_bravo.gif' alt=':bravo'/> :bravo :браво <br/>
<img src='/images/smiles/mini_heart.gif' alt=':heart'/> :heart :сердце <br/>
<img src='/images/smiles/mini_fig.gif' alt=':fig'/> :fig :фиг <br/>
<img src='/images/smiles/mini_rose.gif' alt=':rose'/> :rose :роза @-- <br/>
<img src='/images/smiles/mini_palci.gif' alt=':krut'/> :krut :крут <br/>
<img src='/images/smiles/mini_friends.gif' alt='dOOb'/> dOOb doob d00b <br/>
</div>
</div>
<?


  
include './system/f.php';

?>