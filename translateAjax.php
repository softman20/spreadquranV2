<style>
b br {display:none;}
</style>
<?php
function getTranslation($soura,$eya,$lang){
	
	include('config.php');
	$cnx=mysql_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass']);
	mysql_select_db($dbconfig['db'], $cnx) or die ('La base de données ne peut pas être sélectionnée');	
	$sql="SELECT content FROM ".$lang." where soura=".$soura." and number=".$eya;
	//echo $sql;
	$reponse = mysql_query($sql);
	$donnees=mysql_fetch_array($reponse);
	$tafsir=trim($donnees['content']);
	$tafisr=addslashes($tafsir);
	//$tafsir=str_replace('.','.<br><br>',$tafsir);
//	$tafsir=str_replace('{',' <b style="color:darkRed"><i style="font-size:0">ـ</i>{',$tafsir);
	//$tafsir=str_replace('}','}<i style="font-size:0">ـ</i></b> ',$tafsir);
	//$tafsir=str_replace('[',' <i style="color:green">[',$tafsir);
	//$tafsir=str_replace(']',']</i> ',$tafsir);

    mysql_close();	
	return $tafsir;
}


$soura=$_GET['soura'];
$eya=$_GET['eya'];
$lang=$_GET['lang'];
$hidden=$_GET['hidden'];

$translation= getTranslation($soura,$eya,$lang);
$translationHid="";
if($translation=="" || $translation=="لا يوجد"){
 $translation='<span style="text-align: center; font-size: 20px; color: green;">غير متوفر حالياً</span>';
 }

//$transText = preg_replace("/\"/", "\\\"", $transText);
?>
<div id="divTransEya_<?=eya?>'" style="max-height:280px;overflow:auto;text-align:left;font-size:17px;line-height:1.5;">
<?= $translation ?> <br /> Qur'An [<?=$eya?>/<?=$soura?>]
</div>
<script>FB_ShareActionTranslateMeaning();</script>
<br />
<p style="text-align:center">
<a onclick="FB_PublishStatus('<?= $transText ?>\nQur\'An [<?=$eya?>/<?=$soura?>]'); return false;" href="#" class="uibutton confirm icon fb"><b>أنشر على الحائط</b></a>
</p>





