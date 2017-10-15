<?php
header('Access-Control-Allow-Origin: *');
//set_time_limit(0);
$urlRacineAudio ="";
$souraAjx=$_POST['soura'];
$souraAjxName=$_POST['souraName'];
//$lang = "French";
include('config.php');

$cnx=mysql_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass']);
mysql_select_db($dbconfig['db'], $cnx) or die ('La base de données ne peut pas être sélectionnée');
$eya=0;
$sql="SELECT * FROM eya where soura =".$souraAjx;
if($eya!=0) $sql.= " and number=".$eya;
$reponse = mysql_query($sql);
$nbEyet= mysql_num_rows($reponse);

if(floor($souraAjx)<10) $souraAjxMp3="00".$souraAjx;
else if(floor($souraAjx)<100) $souraAjxMp3="0".$souraAjx;
else $souraAjxMp3=$souraAjx;
?>

 
    <table height="510" cellspacing="0" cellpadding="0" border="0" align="center"  dir="ltr" style="max-width:835px;">
	<tbody><tr style="background-image:url('img/p11.gif')">
		<td height="214" style="background-image:url('img/p001_01.gif')">
</td>
		<td style="background-image:url('img/p001_02.png');text-align:center;background-position:50% center;">
        <br />        <br />        <br />        
        <span class="souraTitle" >سورة <?= $souraAjxName ?> </span>
</td>
		<td style="background-image:url('img/p001_03.gif')">
</td>
	</tr>
	<tr>
		<td background="img/p001_04.gif">&nbsp;</td>
		<td>
		  <div class="eyet" align="center" dir="rtl">
          <script>
//var tDialog = new Dialog(Dialog.DIALOG_CONTEXTUAL);
</script>
          
      <?php if($souraAjx!=1 && $souraAjx!=9) { ?>
	   <center><img src="img/basmala.gif"></center>
	   
       <?php 
	   }
while($donnees=mysql_fetch_array($reponse)){ 

$eya=$donnees['number'];
$eyaContent=$donnees['content'];
if(floor($eya)<10) $eyaMp3="00".$eya;
else if(floor($eya)<100) $eyaMp3="0".$eya;
else $eyaMp3=$eya;
?>

  <a onclick="mouseaction(<?= $eya?>,<?= $souraAjx ?>)" title="إضغط على الآية للحصول على التفاسير والترجمة ..." id="eya_<?= $eya?>"  onmouseout="if($('#eyadiv_<?= $eya?>').css('display')=='none') $('#eya_<?= $eya?>').attr('class','ayaah');" onmouseover="$('#eya_<?= $eya?>').attr('class','ayaah selected');" class="ayaah" style="cursor: pointer;text-decoration:none"><?= $eyaContent ?></a>
  <a class="ayaahNumber" style="text-decoration:none"> ﴿<?= $eya ?>﴾ </a>	

    
    <div id='eyadiv_<?= $eya?>' class='popup divForEya' style='position:relative;margin-top:-2px; display:none;'>
        <ul>
		<li class="tafsir">
            <a class="btn btn-default btn-xs linkForPopover" id="tafJal_<?=$eya?>" href='#'><b>تفسير الجلالين</b></a>
            <a class="btn btn-default btn-xs linkForPopover" id="tafKor_<?=$eya?>" href='#'><b>تفسير القرطبي</b></a>
            <a class="btn btn-default btn-xs linkForPopover" id="tafTab_<?=$eya?>" href='#'><b>تفسير الطبري</b></a>
            <a class="btn btn-default btn-xs linkForPopover" id="tafKat_<?=$eya?>" href='#'><b>تفسير إبن كثير</b></a>
            <script>
			tafsirPopOver('<?= $souraAjx ?>','<?= $eya ?>','jalalain','تفسير الجلالين','tafJal_<?=$eya?>');
			tafsirPopOver('<?= $souraAjx ?>','<?= $eya ?>','kortobi','تفسير القرطبي','tafKor_<?=$eya?>');
			tafsirPopOver('<?= $souraAjx ?>','<?= $eya ?>','tabari','الطبري','tafTab_<?=$eya?>');
			tafsirPopOver('<?= $souraAjx ?>','<?= $eya ?>','ibnkathir','إبن كثير','tafKat_<?=$eya?>');
			</script>
            
           <div id='eyaHid_<?= $eya?>' style=""> </div>
           </li>
            <li class="tafsir"> <b>لترجمة  هذه الآية إلى</b>
			 
          <select style="text-align:left" id="selectLang_<?= $eya?>" onchange="translationPopOver('<?= $souraAjx ?>','<?= $eya ?>'); return false">
            <option value="english" title="English" selected>English</option>
			<option value="french" title="French">Français</option>
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
                                                                                                                                                                   
            
            </select> <a class="btn  btn-primary btn-xs linkForPopover2" id="aTrans_<?= $eya ?>"  href="#"><b>إضغط هنا</b></a> </li>            
            <!-- <li class="tafsir">                        
               
				<div  class="row-fluid" style="direction:ltr">
                    
                  
                  <div class="span4">
                        <audio id="AyyoubAudioEya_<?= $eya ?>" preload="auto" controls>
                        <source src="http://www.everyayah.com/data/Muhammad_Ayyoub_128kbps/<?= $souraAjxMp3.$eyaMp3 ?>.mp3" />
                        </audio>
                        <div class="audioPlayerTitle">محمد أيوب</div>
                    </div>
                    
                    <div class="span4">
                        <audio id="MenshawiAudioEya_<?= $eya ?>" preload="auto" controls>
                        <source src="http://www.everyayah.com/data/Minshawy_Murattal_128kbps/<?= $souraAjxMp3.$eyaMp3 ?>.mp3" />
                        </audio>
                        <div class="audioPlayerTitle">محمد صديق المنشاوي</div>
                    </div>
           
                   
                     <div class="span4">
                        <audio id="HuzifyAudioEya_<?= $eya ?>" preload="auto" controls>
                        <source src="http://www.everyayah.com/data/Hudhaify_128kbps/<?= $souraAjxMp3.$eyaMp3 ?>.mp3" />
                        </audio>
                        <div class="audioPlayerTitle">عبدالرحمن حذيفي</div>
                    </div>
                 
                    
               </div>
                       <script>
					   $( function()	{	$('#HuzifyAudioEya_<?= $eya ?>').audioPlayer();	});	
					   $( function()	{	$('#MenshawiAudioEya_<?= $eya ?>').audioPlayer();	});
					   $( function()	{	$('#AyyoubAudioEya_<?= $eya ?>').audioPlayer();	});
                       </script>
               
            </li>-->
            
           <!-- <li class="tafsir"><a onclick="FB_PublishStatus('<?= $eyaContent ?> \n  الآية <?= $eya ?> من سورة <?= $souraAjxName ?>')" href='#' class="uibutton confirm icon fb"><b>أنشر هذه الآية على الحائط</b></a></li>-->
		   
		  
		   <? 
		   //echo mb_strlen($eyaContent, "UTF-8") + mb_strlen($souraAjxName, "UTF-8");
		   if(mb_strlen($eyaContent, "UTF-8") + mb_strlen($souraAjxName, "UTF-8")<119){ ?>
		   <li class="tafsir"><a href="https://twitter.com/intent/tweet?text=<?= $eyaContent ?> --  الآية <?= $eya ?> من سورة <?= $souraAjxName ?>" >
		   <img src="img/share-tweet.png"></a></li>
			<? } ?>
		   
            <li class="tafsir"><a class="btn btn-primary btn-xs" href="#" onclick="$('#eya_<?= $eya ?>').attr('class','ayaah');$('#eyadiv_<?= $eya?>').toggle('slow'); return false;"><b>X</b></a> </li>
        </ul>
        
</div>
 
 
<?php }	

 ?>
 
<!--<fb:js-string var="tafsirContent">
<div id="dialog_content" style="max-height:280px;overflow:auto;text-align:right;font-size:13px;padding:10px;line-height:1.5">  
        <span id="caric"><center><img src="img/loader.gif" /></center></span>  
        
    </div>      
</fb:js-string>

<fb:js-string var="tafsirTitle">
<div id="dialog_title" style="text-align:center;font-size:15px">  
        <span id="caric"><center><img src="img/loader_small.gif" /></center></span>  
    </div>  
</fb:js-string>

<fb:js-string var="translationContent">
<div id="dialog_content_trans" style="max-height:280px;overflow:auto;text-align:left;font-size:14px;padding:10px;line-height:1.5">  
        <span id="caric"><center><img src="img/loader.gif" /></center></span>  
        
    </div>      
</fb:js-string>

<fb:js-string var="translationTitle">
<div id="dialog_title_trans" style="text-align:center;font-size:15px">  
        <span id="caric"><center><img src="img/loader_small.gif" /></center></span>  
    </div>  
</fb:js-string>-->

      
 </div></td>
		<td background="img/p001_06.gif">&nbsp;</td>
	</tr>
	<tr>
		<td  height="215">
			<img height="215" width="78" alt="" src="img/p001_07.gif"></td>
		<td style="background-image:url('img/p001_08.gif')"></td>
		<td>
			<img height="215" width="79" alt="" src="img/p001_09.gif"></td>
	</tr>
</tbody></table>

 <div style="height: 12px;"></div>
  


<?php  mysql_close(); ?>  
