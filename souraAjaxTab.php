<?php
//set_time_limit(0);
$souraAjx=$_POST['soura'];
$souraAjxName=$_POST['souraName'];
include('config.php');
$cnx=mysql_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass']);
mysql_select_db($dbconfig['db'], $cnx) or die ('La base de données ne peut pas être sélectionnée');

$sql="SELECT * FROM eya where soura =".$souraAjx;
if($eya!=0) $sql.= " and number=".$eya;
$reponse = mysql_query($sql);
$nbEyet= mysql_num_rows($reponse);

if(floor($souraAjx)<10) $souraAjxMp3="00".$souraAjx;
else if(floor($souraAjx)<100) $souraAjxMp3="0".$souraAjx;
else $souraAjxMp3=$souraAjx;
?>
    <table height="510" cellspacing="0" cellpadding="0" border="0" align="center" width="500" dir="ltr">
	<tbody><tr style="background-image:url('http://prayers.jfntechnologie.com/tafsir_quran/img/p11.gif')">
		<td height="214" style="background-image:url('http://prayers.jfntechnologie.com/tafsir_quran/img/p001_01.gif')">
</td>
		<td style="background-image:url('http://prayers.jfntechnologie.com/tafsir_quran/img/p001_02.png');text-align:center;background-position:50%">
        <br />        <br />        <br />        <br />
        <span style="font-weight: bold; font-size: 41px; font-family: Traditional Arabic; color: darkRed;">سورة <?= $souraAjxName ?> </span>
</td>
		<td style="background-image:url('http://prayers.jfntechnologie.com/tafsir_quran/img/p001_03.gif')">
</td>
	</tr>
	<tr>
		<td background="http://prayers.jfntechnologie.com/tafsir_quran/img/p001_04.gif">&nbsp;</td>
		<td>
		  <div class="eyet" align="center" dir="rtl">
          <script>
var tDialog = new Dialog(Dialog.DIALOG_CONTEXTUAL);
</script>
          
      <?php if($souraAjx!=1 && $souraAjx!=9) { ?>
	   <center><img src="http://prayers.jfntechnologie.com/tafsir_quran/img/basmala.gif"></center>
	   
       <?php 
	   }
while($donnees=mysql_fetch_array($reponse)){ 

$eya=$donnees['number'];
$eyaContent=$donnees['content'];
if(floor($eya)<10) $eyaMp3="00".$eya;
else if(floor($eya)<100) $eyaMp3="0".$eya;
else $eyaMp3=$eya;
?>

  <a id="eya_<?= $eya?>" title="إضغط على الآية للحصول على التفاسير والترجمة ..."  onmouseout="if(document.getElementById('eyadiv_<?= $eya?>').getStyle('display')=='none') this.setClassName('ayaah')" onmouseover="this.setClassName('ayaah selected');" class="ayaah"><?= $eyaContent ?></a>
  <a class="ayaah number" style="cursor: pointer;"> ﴿<?= $eya ?>﴾ </a>	

    
    <div id='eyadiv_<?= $eya?>' class='popup' style='position:relative;  height: 180px; display:none; overflow: auto;'>
        <ul>

            <a onclick="tDialog.setContext(this).showChoice(tafsirTitle, tafsirContent,'أنشر','إغلق');populateTafsirDialog('<?= $souraAjx ?>','<?= $eya ?>','jalalain','الجلالين'); return false" href='#'><b>تفسير الجلالين</b></a>
            <a onclick="tDialog.setContext(this).showChoice(tafsirTitle, tafsirContent,'أنشر','إغلق');populateTafsirDialog('<?= $souraAjx ?>','<?= $eya ?>','kortobi','القرطبي'); return false"  href='#'><b>تفسير القرطبي</b></a>
            <a onclick="tDialog.setContext(this).showChoice(tafsirTitle, tafsirContent,'أنشر','إغلق');populateTafsirDialog('<?= $souraAjx ?>','<?= $eya ?>','tabari','الطبري'); return false"  href='#'><b>تفسير الطبري</b></a>
            <a  onclick="tDialog.setContext(this).showChoice(tafsirTitle, tafsirContent,'أنشر','إغلق');populateTafsirDialog('<?= $souraAjx ?>','<?= $eya ?>','ibnkathir','إبن كثير'); return false"  href='#'><b>تفسير إبن كثير</b></a>
            
                        <div id='eyaHid_<?= $eya?>' style="width:300px"> </div>
            <li> <b>ترجم هذه الآية إلى</b>
            <select style="direction:ltr" id="selectLang_<?= $eya?>" onchange="populateTranslationDialog('<?= $souraAjx ?>','<?= $eya ?>'); return false">
            <option value="english" title="English">English</option>
            <option value="azerbaijani" title="Azerbaijani">Azerbaijani</option>
            <option value="bosnian" title="Bosnian">Bosnian</option>  
            <option value="chinese" title="Chinese">Chinese</option>  
            <option value="chineseSimplified" title="Chinese Simplified">Chinese Simplified</option>              
            <option value="dutch" title="Dutch">Dutch</option>
            <option value="englishAsad" title="English Asad">English Asad</option>
            <option value="englishPickthall" title="English Pickthall">English Pickthall</option>
            <option value="englishQaribullah" title="English Qaribullah">English Qaribullah</option>
            <option value="englishShakir" title="English Shakir">English Shakir</option>
            <option value="englishUS" title="English US">English US</option>
            <option value="finnish" title="Finnish">Finnish</option>
            <option value="french" title="French">French</option>
            <option value="german" title="German">German</option>
            <option value="indonesian" title="Indonesian">Indonesian</option>
            <option value="italian" title="Italian">Italian</option>
            <option value="japanese" title="Japanese">Japanese</option>
            <option value="korean" title="Korean">Korean</option>
            <option value="latin" title="Latin">Latin</option>
            <option value="malaysian" title="Malaysian">Malaysian</option>
            <option value="mexican" title="Mexican">Mexican</option>
            <option value="persian" title="Persian">persian</option>
            <option value="poland" title="Poland">Poland</option>
            <option value="portuguese" title="Portuguese">Portuguese</option>
            <option value="russian" title="Russian">Russian</option>
            <option value="spanish" title="Spanish">Spanish</option>
            <option value="swahili" title="Swahili">Swahili</option>
            <option value="tamil" title="Tamil">Tamil</option>
            <option value="turkish" title="Turkish">Turkish</option>
                                                                                                                                                                   
            
            </select> <a onclick="tDialog.setContext(this).showChoice(translationTitle, translationContent,'أنشر','إغلق');populateTranslationDialog('<?= $souraAjx ?>','<?= $eya ?>'); return false" href="#"><b>إضغط هنا</b></a> </li>
            <li>
               <div style="display:inline-block;">
            <fb:mp3 width="160px" src="http://prayers.jfntechnologie.com/audio/ayah/Huzify/<?= $souraAjxMp3.$eyaMp3 ?>.mp3" title="الآية  <?= $eya ?> من سورة <?= $souraAjxName ?>" artist="عبدالرحمن حذيفي" album="القرآن الكريم" />
            </div>
            <div style="display:inline-block">
            <fb:mp3 width="160px" src="http://prayers.jfntechnologie.com/audio/ayah/Menshawi/<?= $souraAjxMp3.$eyaMp3 ?>.mp3" title="الآية <?= $eya ?> من سورة <?= $souraAjxName ?>" artist="محمد صديق المنشاوي" album="القرآن الكريم" />
            </div>
           
              <div style="display:inline-block">
            <fb:mp3 width="160px" src="http://74.86.30.138/~quran/quran/mp3/muaiqly_<?= floor($souraAjxMp3)."_".floor($eyaMp3)."_".floor($eyaMp3) ?>.mp3" title="الآية <?= $eya ?> من سورة <?= $souraAjxName ?>" artist="ماهر المعيقلي" album="القرآن الكريم" />
            </div>
            </li>
            
            <li><a onclick="publishEyaOnWall('<?= $eya?>','<?= $eyaContent?>');return false;" href='#'><b>أريد نشر هذه الآية</b></a></li>
            <li><a href="#" onclick="document.getElementById('eya_<?= $eya ?>').setClassName('ayaah');Animation(document.getElementById('eyadiv_<?= $eya?>')).to('height', '0px').to('opacity', 0).hide().go(); return false;">إغلق هذه النافذة</a> </li>
        </ul>
        
        
       
        
        
        
</div>
<script>
document.getElementById('eya_<?= $eya?>').addEventListener('click',mouseaction);
</script>

 
<?php }	

 ?>
 
<fb:js-string var="tafsirContent">
<div id="dialog_content" style="max-height:280px;overflow:auto;text-align:right;font-size:13px;padding:10px;line-height:1.5">  
        <span id="caric"><center><img src="http://prayers.jfntechnologie.com/prayers_time/loader.gif" /></center></span>  
        
    </div>      
</fb:js-string>

<fb:js-string var="tafsirTitle">
<div id="dialog_title" style="text-align:center;font-size:15px">  
        <span id="caric"><center><img src="http://prayers.jfntechnologie.com/prayers_time/loader_small.gif" /></center></span>  
    </div>  
</fb:js-string>

<fb:js-string var="translationContent">
<div id="dialog_content_trans" style="max-height:280px;overflow:auto;text-align:left;font-size:14px;padding:10px;line-height:1.5">  
        <span id="caric"><center><img src="http://prayers.jfntechnologie.com/prayers_time/loader.gif" /></center></span>  
        
    </div>      
</fb:js-string>

<fb:js-string var="translationTitle">
<div id="dialog_title_trans" style="text-align:center;font-size:15px">  
        <span id="caric"><center><img src="http://prayers.jfntechnologie.com/prayers_time/loader_small.gif" /></center></span>  
    </div>  
</fb:js-string>

      
 </div></td>
		<td background="http://prayers.jfntechnologie.com/tafsir_quran/img/p001_06.gif">&nbsp;</td>
	</tr>
	<tr>
		<td  height="215">
			<img height="215" width="78" alt="" src="http://prayers.jfntechnologie.com/tafsir_quran/img/p001_07.gif"></td>
		<td>
			<img height="215" width="362" alt="" src="http://prayers.jfntechnologie.com/tafsir_quran/img/p001_08.gif"></td>
		<td>
			<img height="215" width="79" alt="" src="http://prayers.jfntechnologie.com/tafsir_quran/img/p001_09.gif"></td>
	</tr>
</tbody></table>

 
  


<?php  mysql_close(); ?>  
