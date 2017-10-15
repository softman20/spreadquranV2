<style>
b br {display:none;}
</style>

<?php
header('Access-Control-Allow-Origin: *');
function getTafsir($soura,$eya,$imam){
	
	include('config.php');
	$cnx=mysql_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass']);
	mysql_select_db($dbconfig['db'], $cnx) or die ('La base de données ne peut pas être sélectionnée');	
	$sql="SELECT content FROM ".$imam." where soura=".$soura." and number=".$eya;
//	echo $sql;
	$reponse = mysql_query($sql);
	$donnees=mysql_fetch_array($reponse);
	$tafsir=trim($donnees['content']);

    mysql_close();	
	return $tafsir;
}

$NoTafsir=false;
$soura=$_GET['soura'];
$eya=$_GET['eya'];
$imam=$_GET['imam'];
$hidden=$_GET['hidden'];

$tafsir= getTafsir($soura,$eya,$imam);
$tafsirText = $tafsir;
//$tafsirText =str_replace('.','. &nbsp; ',$tafsirText );
	
	$tafsir=str_replace('.','.<br><br>',$tafsir);
	$tafsir=str_replace('{',' <b style="color:darkRed"><i style="font-size:0">ـ</i>{',$tafsir);
	$tafsir=str_replace('}','}<i style="font-size:0">ـ</i></b> ',$tafsir);
	$tafsir=str_replace('[',' <i style="color:green"><i style="font-size:0">ـ</i>[',$tafsir);
	$tafsir=str_replace(']',']<i style="font-size:0">ـ</i></i> ',$tafsir);

$tafsirText = str_replace('"','\'\'',$tafsirText);
$tafsirText = addslashes($tafsirText);
$transText = str_replace('"','\'\'',$transText);
$transText = addslashes($transText);
if (strlen($transText) >=63000){
		 $transText=substr(0,60000,$transText);
 		 $compTranslation=' ... <b><i>للحصول على التفسير كاملاً إذهب إلى صفحة السورة www.spreadquran.com</i></b>';
 		 $transText=$transText.$compTranslation;
}




if($tafsir=="" || $tafsir=="لا يوجد"){
 $tafsir='<span style="text-align: center; font-size: 20px; color: green;">غير متوفر حالياً</span>';
 $NoTafsir=true;
 }
?>

<div style="max-height:280px;overflow:auto;text-align:right;font-size:17px;line-height:1.5;direction:rtl"><?= $tafsir ?></div>
<!--
<script>	FB_ShareActionExploreMeaning(); </script>

<?php if(!$NoTafsir){ ?>
<br />
<p style="text-align:center">
<a onclick="FB_PublishStatus('<?= $tafsirText ?>'); return false;" href="#" class="uibutton confirm icon fb"><b>أنشر على الحائط</b></a>
</p>
<?php } ?>
-->



