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
<!--[if IE 7 ]><html class="ie ie7 lte9 lte8 lte7" lang="en-US"><![endif]-->
<!--[if IE 8]><html class="ie ie8 lte9 lte8" lang="en-US">	<![endif]-->
<!--[if IE 9]><html class="ie ie9 lte9" lang="en-US"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="noIE" lang="ar-AR" dir="rtl">
<!--<![endif]-->
	<head>
		<!-- meta -->
		<title>Spread The Quran - تفسير وترجمة معاني القرآن الكريم</title>

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/ionicons.min.css">
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/owl.theme.css">
	    <link rel="stylesheet" href="css/main.css">

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.js"></script>
		<![endif]-->

		<!--[if IE 8]>
	    	<script src="assets/js/selectivizr.js"></script>
	    <![endif]-->
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
<link rel="stylesheet" href="css/site.css">

<!-- Bootstrap 2.0 -->

<!--<link rel="stylesheet" href="css/bootstrap-responsive.css" >-->
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
<script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/contact.js"></script>
	<script src="js/smoothscroll.js"></script>
	<script src="js/script.js"></script>

<script src="js/jquery.webui-popover.js"></script>
<script src="js/audioplayer.js"></script>
<script src="js/functions.js"></script>

 


<script>

$( document ).ready(function() {

	
   
		  
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
<input type="hidden" id="hidTransLang" />
	 

	<!-- Navigation -->
	<section class="navigation_bar">
		

		<nav class="navbar navbar-default navigation">
			<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header" style="float:none">
					<table style="margin:0 auto">
					<tr>
					<td>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
</td>
<td>&nbsp;</td>
<td>
					<div>
					
		 
					 <!--  div reader -->
          <div id="divReader">
            <div>
                <audio id="audioSurahReader" preload="auto" controls>
                <source src="http://ia601408.us.archive.org/17/items/soudais_surah/<?= $souraMp3 ?>.mp3" />
                </audio>
	            <div class="audioPlayerTitle">سورة &#65279;<?= $souraName ?> - عبد الرحمن السديس</div>
            </div>
            
           </div> 
           <!-- end div reader -->
		   <p>
                    
                   <select style="font-size:18px" id="selectList" onChange="getSouraAjax()">
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
					 
               
               <select style="font-size:17px" id="selectReader" onChange="changeReader()">
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
		    </div>
			</td>
			</tr>
			</table>
				</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<!--
						<li class="active">
						 
<a href="#" onClick="FB_SharePageLike()" class="uibutton confirm icon fb" >سجل<br>اعجابك</a>
			
						</li>
						<li><a href="#" onClick="FB_SendLinkToFriends()" class="uibutton confirm icon fb" >أرسل<br>لصديق</a></li>
						<li><a href="#" onClick="FB_GetFriendsRequest()" class="uibutton icon fb confirm" >أدع<br>أصدقائك !</a></li>
						<li><a href="#" onClick="FB_AddAppToPage()" class="uibutton confirm" style="font-size:17px;" >أضف البرنامج  <br> لصفحتك !</a></li>
						<li> <div class="fb-like" data-href="https://www.facebook.com/adhkar.tafsir.quran" data-width="61" data-layout="box_count" data-action="like" data-show-faces="false" data-share="true"></div></li>
						 
						 -->
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav>





	</section> <!-- .navigation_bar -->


	<!-- Book -->
	<section class="book" >
		<div class="">
			<div class="container section-wrapper">
				<div class="row">
					<div class="">
					<div class="">
<div id="divSoura" class="" ></div>
<br><br>
<div  style="text-align:center" style="background-color:#DCDCDC;" >
<br>
<div class="fb-comments" data-href="https://apps.facebook.com/quran_tafsir/"   data-numposts="10" data-colorscheme="light" data-mobile="0" data-order-by="reverse_time" ></div>
</div>

</div>

						 
					</div>
				</div>
			</div> <!-- .container -->
		</div> <!-- /.book-bg -->
	</section> <!-- #book --> 
	 
 	
 	 
 

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					&copy; 2015 spreadquran.com.
				</div>
				<div class="col-sm-4 text-center">
					<span class="social-icons">
						<a href="https://www.facebook.com/adhkar.tafsir.quran/" target="_blank"><i class="ion-social-facebook"></i></a>
						<a href="https://twitter.com/spreadquran_com" target="_blank"><i class="ion-social-twitter"></i></a>
						
					</span>
				</div>
				<div class="col-sm-4">
					<div class="themewagon">
						 <a href="http://www.spreadquran.com">spreadquran.com</a> - contact@spreadquran.com
					</div>
				</div>
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</footer>



	



</body>
</html>