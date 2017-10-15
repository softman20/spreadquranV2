var urlHosting='';//window.location.protocol+"://localhost/quran/";

function stripHtml(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}

function FB_PublishStatus(statusText){
	// FB.getLoginStatus(function(response) {
  // if (response.status === 'connected') {
    // alert('co');
	// // the user is logged in and has authenticated your
    // // app, and response.authResponse supplies
    // // the user's ID, a valid access token, a signed
    // // request, and the time the access token 
    // // and signed request each expire
    // var uid = response.authResponse.userID;
    // var accessToken = response.authResponse.accessToken;
  // } else if (response.status === 'not_authorized') {
  // alert('not co');
    // // the user is logged in to Facebook, 
    // // but has not authenticated your app
  // } else {
  // alert('not log');
    // // the user isn't logged in to Facebook.
  // }
 // });
 
 
	 FB.login(function(){
	  FB.api('/me/feed', 'post', {message: statusText});
	 }, {scope: 'publish_actions'});
	
	 
	
//	return false;
}

function FB_SharePageLike(){
	
	 FB.ui({
    display: 'popup',
    method: 'share_open_graph',
    action_type: 'og.likes',
    action_properties: JSON.stringify({
        object:'https://apps.facebook.com/quran_tafsir/',
    })
  }, function(response){});	 
	 	return false;
}

function FB_AddAppToPage(){
	FB.ui({
  method: 'pagetab',
  redirect_uri: 'https://www.facebook.com/dialog/pagetab?app_id=179229142087638&redirect_uri=https://apps.facebook.com/quran_tafsir/'
}, function(response){});
		return false;
}

function FB_GetFriendsRequest(){
	FB.ui({method: 'apprequests',
      message: 'تستطيع بإذن الله عن طريق هذا البرنامج ،الإستماع و تفسير وترجمة معاني القرآن الكريم'
  }, function(data){});
		return false;
}

function FB_SendLinkToFriends(){
	 FB.ui({
  method: 'send',
  link: 'https://apps.facebook.com/quran_tafsir/',
});
	 	return false;
}

function FB_ShareActionExploreMeaning(){
	//FB.login(function(){
	 FB.api(
  'me/quran_tafsir:explore',
  'post',
  {
    meaning_of_quran: "http://spreadquran.com/action_explore_quran_meaning.html"
  },
  function(response) {
    // handle the response
  }
);	 
//	}, {scope: 'publish_actions'});
//});
return false;
}

function FB_ShareActionTranslateMeaning(){
	//FB.login(function(){
	 FB.api(
  'me/quran_tafsir:translate',
  'post',
  {
    meaning_of_quran: "http://spreadquran.com/action_explore_quran_meaning.html"
  },
  function(response) {
    // handle the response
  }
);	 
//	}, {scope: 'publish_actions'});
//});
return false;
}

function mouseaction(eyaNbr,souraAjx) {
 var ouverte =$('#eyadiv_'+eyaNbr).css("display")=="block";
 if(ouverte){
	 $('#eya_'+eyaNbr).attr('class','ayaah');$('#eyadiv_'+eyaNbr).toggle('slow');
 }
 else {
var oldLang= $('#hidTransLang').val();
//alert(oldLang);
  if(oldLang!="") $('#selectLang_'+eyaNbr).val(oldLang);
	//hide others
	$('.divForEya').hide();
	$('.ayaah').attr("class","ayaah");
	$('.linkForPopover').webuiPopover('hide');	  
	  
    $('#eya_'+eyaNbr).attr("class","ayaah selected");	

	 	$('#eyadiv_'+eyaNbr).show("slow"); 

	
	translationPopOver(souraAjx,eyaNbr);
	$('.linkForPopover2').webuiPopover('hide');	  
 }
}

function tafsirPopOver(soura,eya,imam,imamTitle,source){
 
	var url = urlHosting+"tafsirAjax.php?soura="+soura+"&eya="+eya+"&imam="+imam;
	var queryParams = { 'soura':soura,'eya':eya,'imam' : imam };
	  
    var	asyncSettings = {	closeable:true,
					 		padding:true,
							placement:'auto',
							width:'auto',
					 		url:url,
							multi:false,
					 		type:'async',			
							title:imamTitle,
					 		content:function(data){ 
							return data}
						};
						
	$('#'+source).webuiPopover(asyncSettings);

}
function translationPopOver(soura,eya){
 

	var lang=$('#selectLang_'+eya).val();
	var langTitle = $('#selectLang_'+eya+' option:selected').text();
	$('#hidTransLang').val(lang);
	var url = urlHosting+"translateAjax.php?soura="+soura+"&eya="+eya+"&lang="+lang;
	  
    var	asyncSettings = {	closeable:true,
					 		padding:true,					 		
					 		url:url,
							cache:false,
							placement:'auto',
							width:'auto',
							multi:false,
					 		type:'async',			
							title:langTitle,
					 		content:function(data){ 
							return data}
						};
	$('#aTrans_'+eya).webuiPopover('destroy').webuiPopover(asyncSettings);
}
 
function changeReader(){

	var soura=$("#selectList").val();
	var souraMp3 = soura;
	if(parseFloat(soura)<10) souraMp3="00"+soura;
	else if(parseFloat(soura)<100) souraMp3="0"+soura;

	var souraName=$("#selectList option:selected").text();
	
	$("#divReader").html('<span id="carics"><center><img src="img/loader.gif" /></center></span>');
	var reader = $("#selectReader").val();
	var readerName=$("#selectReader option:selected").text();
	
	var url = urlHosting+"mp3ReaderAjax.php";
	var queryParams = { 'souraNbr':souraMp3,'souraName':souraName,'reader':reader,'readerName':readerName };
//	alert( reader+" "+readerName+" "+souraName+" "+souraMp3);
	$.ajax({
		url: url,
		type: 'POST',
		data: queryParams,
		success: function(data) {
        $("#divReader").html(data);
        }
	});	 
	
	return false;	  
}


 

function getSouraAjax(soura) {
	$('#eya_1').attr('class','ayaah');
	$("#eya_1").tooltip('hide');
	 
	changeReader();	
	var souraName=$("#selectList option:selected").text();
	
	if(soura==undefined){		
		soura = $("#selectList").val();
	}
	
	$("#divSoura").html('<span style="color:peru ;font-size:22px;"><br><br><br><br><br><center><img src="img/loader_small.gif" /></center><center><img src="img/loader.gif" /></center><center><img src="img/loader_small.gif" /></center><center>نرجوا إنتظار لحظات حتى يكتمل تحميل السورة والتفاسير... شكراً</center><br><br><br><br><br><br><br><br></span>');
	
	var url = urlHosting+"souraAjax.php";
	var queryParams = { 'soura':soura,'souraName':souraName}; 
	 
	$.ajax({
		url: url,
		type: 'POST',
		data: queryParams,
		success: function(data) {
        $("#divSoura").html(data);
		   $('#eya_1').attr('class','ayaah selected');
		   //$("#eya_1").tooltip('show');

        }
	});	 
	
	
    
	return false;
}


/*
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
	
//	new Dialog().showMessage('',document.getElementById('hidTransLang').getValue());
	document.getElementById('hidTransLang').setValue(lang);
	
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
*/