<?php
$soura="1";
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
<style>
.popup {
    text-align: center; 
    padding: 10px;
    background-color: #eee;
    border: solid 1px #3b5998;    
}

.popup ul {
    padding: 0;
    margin: 0;
}

.popup li {
    float: none;
    padding: 6px 0;
}

.popup a {
    background: transparent;
    padding: 0;
}
.popup a:hover {
    background: transparent;
    text-decoration: underline;
    color: red;
}

.soura{font-family:tahoma;margin-top:40px;text-align:center}
.ayaah{font-family:'Traditional Arabic';font-size:28px;color:#333300;text-decoration:none}
.ayaah.selected{background-color:#EEEEEE;}
.ayaah.number{color:#005500;white-space:nowrap;font-size:18px;}
.eyet{background-image:url("http://prayers.jfntechnologie.com/tafsir_quran/img/p001_05.gif");text-align:justify;padding:10px;line-height:1.7}



</style>
<script>

function publishEyaOnWall(eya,eyaContent){

	 var selectList=document.getElementById('selectList');
	 var soura=selectList.getValue();
	 var souraName=selectList.getOptions()[selectList.getSelectedIndex()].getTitle();
	 
	 var attachment = {
        'name':'سورة '+souraName+' : الآية ' + eya,
        'href':'http://apps.facebook.com/quran_tafsir/list.php?sorah='+soura,
        'description':eyaContent,
        'media':[{
            'type':'image',
            'src':'http://prayers.jfntechnologie.com/tafsir_quran/img/quran_logo.jpg',
            'href':'http://www.facebook.com/apps/application.php?id=179229142087638'
            }]
    };

	Facebook.streamPublish('', attachment);
}

function publishTafsirOnWall(eya,eyaContent,imamTitle){

	 var selectList=document.getElementById('selectList');
	 var soura=selectList.getValue();
	 var souraName=selectList.getOptions()[selectList.getSelectedIndex()].getTitle();

	 var attachment = {
        'name': 'تفسير '+imamTitle+' للآية '+eya+' من سورة '+souraName,
        'href':'http://apps.facebook.com/quran_tafsir/list.php?sorah='+soura,
        'description':eyaContent,
        'media':[{
            'type':'image',
            'src':'http://prayers.jfntechnologie.com/tafsir_quran/img/quran_logo.jpg',
            'href':'http://www.facebook.com/apps/application.php?id=179229142087638'
            }]
    };

	Facebook.streamPublish('', attachment);
}

function publishTranslationOnWall(eya,eyaContent,langTitle){

	 var selectList=document.getElementById('selectList');
	 var soura=selectList.getValue();
	 var souraName=selectList.getOptions()[selectList.getSelectedIndex()].getTitle();
	 var attachment = {
        'name': langTitle+' : ترجمة  الآية '+eya+' من سورة '+souraName,
        'href':'http://apps.facebook.com/quran_tafsir/list.php?sorah='+soura,
        'description':eyaContent,
        'media':[{
            'type':'image',
            'src':'http://prayers.jfntechnologie.com/tafsir_quran/img/quran_logo.jpg',
            'href':'http://www.facebook.com/apps/application.php?id=179229142087638'
            }]
    };

	Facebook.streamPublish('', attachment);
}



function mouseaction(evt) {
  eventFiredBy_ObjectId = evt.target.getId();
	mypos=eventFiredBy_ObjectId.indexOf('_')+1;
//new Dialog().showMessage(mypos,eventFiredBy_ObjectId.substring(mypos));
   targetNbr = eventFiredBy_ObjectId.substring(mypos);
   targetId = document.getElementById('eyadiv_'+targetNbr);

//hide others
     //if (eventFiredBy_ObjectId != 'button2')
	 for(var i=1;i<115;i++){
		if(targetNbr!=i && document.getElementById('eyadiv_'+i))  document.getElementById('eyadiv_'+i).setStyle({display: 'none'});
	  }
	  
	  for(var i=1;i<115;i++){
		if(targetNbr!=i && document.getElementById('eya_'+i))  document.getElementById('eya_'+i).setClassName('ayaah');
	  }
	  
     document.getElementById('eya_'+targetNbr).setClassName('ayaah selected');
	
	Animation(targetId).to('height', 'auto').from('0px').to('width', '320px').from('0px').to('opacity', 1).from(0).show().go();
    targetId.setStyle({overflow: 'auto'});
}

function populateTafsirDialog(soura,eya,imam,imamTitle){

	var selectList=document.getElementById('selectList');
	 var soura=selectList.getValue();
	 var souraName=selectList.getOptions()[selectList.getSelectedIndex()].getTitle();
	 	
	var hidDialog = new Dialog(Dialog.DIALOG_CONTEXTUAL);
	hidDialog.setContext(document.getElementById('eyaHid_'+eya));
	hidDialog.setStyle('width','250px');
	
	tDialog.onconfirm = function() {
		hidDialog.showMessage('.:: تفسير '+imamTitle+' للآية '+eya+' من سورة '+souraName+' ::.','الرجاء إنتظار تحميل التفسير ... شكراً','إغلق');return false;
		}
	
	var ajax = new Ajax(); 
	ajax.responseType = Ajax.FBML; 
	ajax.ondone = function(data) 
	{ 
		document.getElementById('dialog_content').setInnerFBML(data);
		document.getElementById('dialog_title').setInnerXHTML('<span style="text-align:center">.:: تفسير '+imamTitle+' للآية '+eya+' من سورة '+souraName+' ::.</span>');
		var tafsir = document.getElementById('hidTafsir').getValue();
		if (tafsir.length>=1000){
		 tafsir=tafsir.substr(0,930);
 		 var compTafsir=' ... <b><i>للحصول على التفسير كاملاً إذهب إلى صفحة السورة</i></b>'
 		 tafsir=tafsir+compTafsir;
		}
		//new Dialog().showMessage('',tafsir);
		if(tafsir!=""){
		tDialog.onconfirm = function() {
		publishTafsirOnWall(eya,tafsir,imamTitle);	
		}
		}else {
		tDialog.onconfirm = function() {
		hidDialog.showMessage('.:: تفسير '+imamTitle+' للآية '+eya+' من سورة '+souraName+' ::.','غير متوفر حالياً','إغلق');return false;
		}
		}
	}
 

	var queryParams = { 'soura':soura,'eya':eya,'imam' : imam };
	ajax.post('http://prayers.jfntechnologie.com/tafsir_quran/tafsirAjax.php',queryParams);
	return false;
}

function populateTranslationDialog(soura,eya){

	//new Dialog().showMessage('',lang+" "+langTitle);
document.getElementById('dialog_title_trans').setInnerXHTML('<span id="caric"><center><img src="http://prayers.jfntechnologie.com/prayers_time/loader_small.gif" /></center></span>');
	document.getElementById('dialog_content_trans').setInnerXHTML('<span id="caric"><center><img src="http://prayers.jfntechnologie.com/prayers_time/loader.gif" /></center></span>');
	
	var selectLang = document.getElementById('selectLang_'+eya);
	var lang=selectLang.getValue();
	var langTitle=selectLang.getOptions()[selectLang.getSelectedIndex()].getTitle();
	
	var selectList=document.getElementById('selectList');
	 var soura=selectList.getValue();
	 var souraName=selectList.getOptions()[selectList.getSelectedIndex()].getTitle();
	
	
	var hidDialog = new Dialog(Dialog.DIALOG_CONTEXTUAL);
	hidDialog.setContext(document.getElementById('eyaHid_'+eya));
	hidDialog.setStyle('width','250px');
	tDialog.onconfirm = function() {
		hidDialog.showMessage('.:: ترجمة الآية '+eya+' من سورة '+souraName+' ::.','الرجاء إنتظار تحميل الترجمة ... شكراً','إغلق');return false;
		}
	
	var ajax = new Ajax(); 
	ajax.responseType = Ajax.FBML; 
	ajax.ondone = function(data) 
	{ 
		document.getElementById('dialog_content_trans').setInnerFBML(data);
		document.getElementById('dialog_title_trans').setInnerXHTML('<span style="text-align:center">'+langTitle+' : ترجمة  الآية '+eya+' من سورة '+souraName+' إلى </span>');
		
		var translation = document.getElementById('hidTranslation').getValue();
		if (translation.length>=1000){
		 translation=translation.substr(0,930);
 		 var compTranslation=' ... <b><i>للحصول على التفسير كاملاً إذهب إلى صفحة السورة</i></b>'
 		 translation=translation+compTranslation;
		}
		//new Dialog().showMessage('',tafsir);
//		new Dialog().showMessage('',translation);
		if(translation!=""){
		tDialog.onconfirm = function() {
		publishTranslationOnWall(eya,translation,langTitle);	
		}
		}else {
		tDialog.onconfirm = function() {
		hidDialog.showMessage('.:: ترجمة الآية '+eya+' من سورة '+souraName+' ::.','غير متوفر حالياً','إغلق');return false;
		}
		}
	}
 
	var queryParams = { 'soura':soura,'eya':eya,'lang' : lang };
	ajax.post('http://prayers.jfntechnologie.com/tafsir_quran/translateAjax.php',queryParams);
	return false;
}

function changeReader(){

	var selectList=document.getElementById('selectList');
	 var soura=selectList.getValue();
	 var souraName=selectList.getOptions()[selectList.getSelectedIndex()].getTitle();
	 var souraMp3 = soura;
	 if(parseFloat(soura)<10) souraMp3="00"+soura;
	 else if(parseFloat(soura)<100) souraMp3="0"+soura;
	var divReader=document.getElementById('divReader')
	var selecReader=document.getElementById('selectReader');
	divReader.setInnerXHTML('<span id="carics"><center><img src="http://prayers.jfntechnologie.com/prayers_time/loader.gif" /></center></span>');
	var reader = selecReader.getValue();

	var readerName=selecReader.getOptions()[selecReader.getSelectedIndex()].getTitle();

	
	var ajax = new Ajax(); 
	ajax.responseType = Ajax.FBML; 
	ajax.ondone = function(data) 
	{ 
		divReader.setInnerFBML(data);
	}
 
	var queryParams = { 'souraNbr':souraMp3,'souraName':souraName,'reader':reader,'readerName':readerName };
	ajax.post('http://prayers.jfntechnologie.com/tafsir_quran/mp3ReaderAjax.php',queryParams);
	return false;
	  
}


// function to publish application on user wall
function publishOnWall(){
	
	 var attachment = {
        'name':'برنامج تفسير القرآن الكريم',
        'href':'http://apps.facebook.com/quran_tafsir/',
        'description':'تستطيع بإذن الله عن طريق هذا البرنامج ،الإستماع و قراءة و تصفح و تفسير وترجمة القرآن الكريم آية آية إلى أكثر من 25 لغة والعديد من القراء والإطلاع على مختلف التفاسير لإبن كثير، الجلالين ، الطبري والقرطبي.',
        'media':[{
            'type':'image',
            'src':'http://prayers.jfntechnologie.com/tafsir_quran/img/quran_logo.jpg',
            'href':'http://www.facebook.com/apps/application.php?id=179229142087638'
            }]
    };

	Facebook.streamPublish('', attachment);
	
}



function getSouraAjax(soura) {
changeReader();
//	new Dialog().showMessage('',soura);
	var selectList=document.getElementById('selectList');
	var souraName=selectList.getOptions()[selectList.getSelectedIndex()].getTitle();	
	
	if(soura==undefined){		
		soura = selectList.getValue();
	}
	var divSoura=document.getElementById('divSoura');
	divSoura.setInnerXHTML('<span style="color: highlight;"><center><img src="http://prayers.jfntechnologie.com/prayers_time/loader_small.gif" /></center><center><img src="http://prayers.jfntechnologie.com/prayers_time/loader.gif" /></center><center><img src="http://prayers.jfntechnologie.com/prayers_time/loader_small.gif" /></center><center>نرجوا إنتظار لحظات حتى يكتمل تحميل السورة والتفاسير... شكراً</center></span>');
	//new Dialog().showMessage('',soura);
	var ajax = new Ajax(); 
	ajax.responseType = Ajax.FBML; 
	ajax.ondone = function(data) 
	{ 
		divSoura.setInnerFBML(data);
	}
 
	var queryParams = { 'soura':soura,'souraName':souraName};
	ajax.post('http://prayers.jfntechnologie.com/tafsir_quran/souraAjaxTab.php',queryParams);
	return false;

}
getSouraAjax(<?= $soura ?>);
//new Dialog().showMessage('', getElementsByClass('soura').style);
</script>


  <div align="center" style="margin-top:40px">
  <div id='eyadivMenu' class='popup' style='width:343px;direction:rtl'>
        <ul>
       <li><a href="#" onclick="publishOnWall()">.:: <b>أنشر البرنامج ... جازاك الله كل خير</b> ::.</a>
       <br /></li>
       <li>
        <span>
        <b>السورة</b>
       <select style="direction:rtl" id="selectList" onchange="getSouraAjax()">
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
       
       
</span>
       
       <span>
       <b style="padding-right:20px">القارئ</b>
       <select style="width:140px;direction:rtl" id="selectReader" onchange="changeReader()">
      <!-- <option value="muaiqli" title="ماهر المعيقلي">ماهر المعيقلي</option> -->
       <option value="soudais" title="عبد الرحمن السديس">عبد الرحمن السديس</option>
       <option value="shuraim" title="سعود الشريم">سعود الشريم</option>
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
       
</span>
      </li> 
  <li>
            <div id="divReader" style="padding-right:75px">
            <fb:mp3 id="fbmp3Reader" width="200px"  src="http://quran.sarkosa.com/media/Maher-Almuaiqli/<?= $souraMp3 ?>.mp3" title="سورة <?= $souraName ?>" artist="ماهر المعيقلي" album="القرآن الكريم" />
            </div>
            </li>                    
        </ul>
        
        
    </div>   
        
        
        
</div>
<div id="divSoura" class="soura">
 <a href="#" onclick="getSouraAjax()" style="font-size:20px;color:highlight">إضغط هنا لتحميل السورة والتفاسير </a>
</div>

<div align="center" style="text-align:center">
<br><br>


<fb:fbml>
<fb:request-form id="fbreqform"
action="home.php<?php echo ($lang=="en") ? '?lang=en' : '?lang=ar'; ?>" 
method="POST" 
invite="true" 
type="<?php echo ($lang=="en") ? 'Prayer Times' : 'برنامج تفسير القرآن الكريم'; ?>" 
content="<?php echo ($lang=="en") ? 'I suggest you to use this Application to know Prayer Times arround the world.' : 'تستطيع بإذن الله عن طريق هذا البرنامج ،الإستماع و قراءة و تصفح و تفسير وترجمة القرآن الكريم آية آية إلى أكثر من 25 لغة والعديد من القراء والإطلاع على مختلف التفاسير لإبن كثير، الجلالين ، الطبري والقرطبي.'; ?><?php echo htmlentities("<fb:req-choice url=\"http://apps.facebook.com/quran_tafsir/\" label=\"Authorize My Application\"") ?>" > 

<fb:multi-friend-selector id="fbmultifs" cols=3 max=35 bypass="false" email_invite="false" import_external_friends="true"  showborder="true" actiontext="<?php echo ($lang=="en") ? 'Invite your friends to use this application.' : 'ادعو اصدقاءك لإستخدام هذا البرنامج ... الدال على الخير كفاعله .'; ?>"> 
</fb:request-form>


</fb:fbml>

</div>


<div align="center">
<br /><br />
<!-- USER COMMENTS -->
<fb:comments xid="tafsir_quran_comments" canpost="true" candelete="false" returnurl="http://www.facebook.com/apps/application.php?id=179229142087638" >
    <fb:title><?php echo ($lang=="en") ? 'Talk about Prayer Times Application' : 'تحدث عن برنامج تفسير القرآن الكريم'; ?></fb:title>
</fb:comments>


<br />
<hr noshade="noshade" style="border-width:0;background-color:highlight;width:505px;height:12px" />


<!-- gift div -->
<div style="text-align: center;  font-size: 22px; color: #3B5998;">
<?php echo ($lang=="en") ? 'This application is a gift from Adhkar Al-Moslem Al-yawmia' : 'هذا البرنامج هدية من أذكار المسلم اليومية '; ?></div>
  <br />
  <div style="text-align: center;">
    <a target="_blank" href="http://www.facebook.com/adhkar.almoslem.alyawmia">
      <img src="http://prayers.jfntechnologie.com/prayers_time/adhkar_moslem_logo.jpg" style="text-align: center;">
    </a>
</div>
</div>

<img src='http://ga.webdigi.co.uk/fbga.php?googlecode=UA-4807913-9&googledomain=facebook.com&pagelink=tab.php&pagetitle=tab_page'></img>