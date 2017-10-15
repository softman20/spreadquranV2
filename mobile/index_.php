<?php
//set_time_limit(0);
$lang="ar";
$urlRacineAudio ="";
$soura=$_GET['sorah'];
if($soura=="") $soura=1;
$eya=0;
include('config.php');
$cnx=mysql_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass']);
mysql_select_db($dbconfig['db'], $cnx) or die ('La base de données ne peut pas être sélectionnée');

$sqlSoura="SELECT souraName FROM eya where soura=".$soura;
$result = mysql_query($sqlSoura);
$data=mysql_fetch_array($result);
$souraName=$data['souraName'];


if(floor($soura)<10) $souraMp3="00".$soura;
else if(floor($soura)<100) $souraMp3="0".$soura;
else $souraMp3=$soura;
//echo "soramp3 : ".$souraMp3;
	
?>
<!DOCTYPE html>
<head>
<title>Spread The Quran - تفسير وترجمة معاني القرآن الكريم</title>
 <meta name="Description" CONTENT="تستطيع بإذن الله عن طريق هذا البرنامج ،الإستماع و قراءة و تصفح و تفسير  وترجمة القرآن الكريم آية آية إلى أكثر من 25 لغة والعديد من القراء والإطلاع على مختلف التفاسير لإبن كثير، الجلالين ، الطبري والقرطبي.">
 <meta property="fb:app_id" content="179229142087638" />
        <meta property="og:title" content="SpreadQuran.com" />
        <meta property="og:image" content="http://www.spreadquran.com/img/quran_logo.jpg" />
        <meta property="og:url" content="http://apps.facebook.com/quran_tafsir/" />
        <meta property="og:type" content="quran_tafsir:meaning_of_quran" />
        
<link rel="icon" href="quran.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="robots" content="all">
<meta name="viewport" content="width=device-width,initial-scale=1" />
<!-- Bootstrap 2.0 -->
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-responsive.css" >
<link rel="stylesheet" href="css/jquery.webui-popover.css">
<link rel="stylesheet" href="css/audioplayer.css">
<link rel="stylesheet" href="css/fb-buttons.css">

<style>
.row {
    margin-top:10px;
}

.sidebar-outer {
    position: relative;
}
	 @media (max-width: 480px) { .soura {margin-left:0;}}
	 @media (max-width: 767px) { .soura {margin-left:0;}}

@media (min-width: 768px) {
    .sidebar {
        position: relative;
    }
}

</style>
<!-- Latest compiled and minified JavaScript -->

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.webui-popover.js"></script>
<script src="js/audioplayer.js"></script>
<script src="js/functions.js"></script>

<script>

$( document ).ready(function() {

		var $scrollingDiv = $("#eyadivMenu");
           $(window).scroll(function(){            
// landscape = window.orientation? window.orientation=='landscape' : true;
    if(window.innerWidth >= 768)
            $scrollingDiv.stop().animate({"marginTop": ($(window).scrollTop() )}, "slow" );         
        });
		  
	$( function()
	{
		$( 'audio' ).audioPlayer();
	});

   getSouraAjax(<?= $soura ?>);
   

});

</script>
</head>
<body>
<div id="fb-root"></div>
<script>
 window.fbAsyncInit = function() {
    FB.init({
      appId      : '179229142087638',
      xfbml      : true,
      version    : 'v2.2'
    });

    // ADD ADDITIONAL FACEBOOK CODE HERE
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/all.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

/*
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=179229142087638&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
*/
</script>
<div id="background"></div>

<input type="hidden" id="hidTransLang" />
<!-- logo entete -->
<br>
<div class="container-fluid">
<div class="row-fluid">

     <div class="sidebar-outer span3">
    <div id='eyadivMenu' class='popup sidebar shadow'>    
       <ul>
          <li><br><b style="font-size: 20pt; color: rebeccapurple;">.:: الإعدادات ::.</b> 
           <br>

           </li>
           <li>
	            <p>
                   <b style="font-size: 25px;">السورة</b>
                   <select style="direction:rtl;width:150px;font-size:18px" id="selectList" onChange="getSouraAjax()">
                   <?php
                   $sqlIndex="SELECT distinct soura, souraName FROM eya";
                   $resultIndex = mysql_query($sqlIndex);
                   while($dataIndex=mysql_fetch_array($resultIndex))
                   {
                   echo '<option value="'.$dataIndex['soura'].'" title="'.$dataIndex['souraName'].'" ';
                   if($soura==$dataIndex['soura']) echo ' selected="selected" ';
                   echo ' >'.$dataIndex['souraName'].'</option>';
                   }  
            ?>
                   </select>    
    	    </p>       
        	<p>
               <b style="font-size: 25px;">القارئ</b>
               <select style="width:150px;direction:rtl;font-size:17px" id="selectReader" onChange="changeReader()">
             <!--  <option value="muaiqli" title="ماهر المعيقلي">ماهر المعيقلي</option> -->
               <option value="soudais" title="عبد الرحمن السديس">عبد الرحمن السديس</option>
               <option value="shuraim" title="سعود الشريم">سعود الشريم</option>
               <option value="Ali-Barraq" title="علي البراق">علي البراق</option>       
               <option value="Maher_maaykli" title="ماهر  المعيقلي">ماهر  المعيقلي</option>       
               <option value="Abdelbasset" title="عبد الباسط عبد الصمد">عبد الباسط عبد الصمد</option>       
               <option value="Mishary-El-Afasi" title="مشاري راشد العفاسي">مشاري راشد العفاسي</option>              
               <option value="AlAjmi" title="أحمد العجمي">أحمد العجمي</option>
               <option value="AbuBakrAs-Shatery" title="أبو بكر الشاطري">أبو بكر الشاطري</option>
               <option value="AbduLLahAl-Matrood" title="عبد الله مطرود">عبد الله مطرود</option>
               <option value="Al-Ghaamidi" title="سعد الغامدي">سعد الغامدي</option>
               <option value="HassanIbrahimHashem" title="حسن إبراهيم هاشم">حسن إبراهيم هاشم</option>
               <option value="Hussary" title="محمود خليل الحصري">محمود خليل الحصري</option>
               <option value="Huzify" title="عبدالرحمن حذيفي">عبدالرحمن حذيفي</option>
               <option value="IbraheemAl-Akhdar" title="إبراهيم الأخضر">إبراهيم الأخضر</option>
               <option value="Jibreal" title="محمد جبريل">محمد جبريل</option>
               <option value="Menshawi" title="محمد صديق المنشاوي">محمد صديق المنشاوي</option>
               <option value="MuhammadAyyoub" title="محمد أيوب">محمد أيوب</option>
               <option value="MustafaIsmael" title="مصطفى إسماعيل">مصطفى إسماعيل</option>
               </select>       
          </p>
        </li> 
    	<li>    
          <!--  div reader -->
          <div id="divReader">
            <div>
                <audio id="audioSurahReader" preload="auto" controls>
                <source src="http://ia601408.us.archive.org/17/items/soudais_surah/<?= $souraMp3 ?>.mp3" />
                </audio>
	            <div class="audioPlayerTitle">سورة &#65279;<?= $souraName ?> - عبد الرحمن السديس</div>
            </div>
            <br>
           </div> 
           <!-- end div reader -->
       </li> 
     <li>

<div class="fb-like" data-href="https://www.facebook.com/adhkar.tafsir.quran" data-width="61" data-layout="box_count" data-action="like" data-show-faces="false" data-share="true"></div>
<!--<div class="fb-like" data-href="https://www.facebook.com/adhkar.almoslem.alyawmia" data-width="61" data-layout="box_count" data-action="like" data-show-faces="false" data-share="true"></div>-->
<br>
<br>
<a href="#" onClick="FB_AddAppToPage()" class="uibutton special" style="font-size:17px;" >أضف البرنامج  <br> إلى صفحتك !</a>
<br>
<br>
<a href="#" onClick="FB_GetFriendsRequest()" class="uibutton icon fb special" >أدع أصدقائك !</a>
<br>
<br>
<a href="#" onClick="FB_SendLinkToFriends()" class="uibutton confirm icon fb" >أرسل لصديق</a>
<br><br>
<a href="#" onClick="FB_SharePageLike()" class="uibutton confirm icon fb" >سجل اعجابك</a>
<br><br>
       </li>                   
     </ul>
  </div> 
 <!-- end eaydivmenu -->
 
  </div> 

<div class="span5">
<div id="divSoura" class="soura" ></div>
<br><br>
<div  class="soura" style="background-color:#DCDCDC;" >
<br>
<div class="fb-comments" data-href="https://apps.facebook.com/quran_tafsir/" width="600" data-numposts="10" data-colorscheme="light" data-mobile="0" data-order-by="reverse_time" ></div>
</div>

</div>

 
 </div>
 
</div>
<br>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-4807913-9', 'auto');
  ga('send', 'pageview');

</script>
 </body>
 </html>
 