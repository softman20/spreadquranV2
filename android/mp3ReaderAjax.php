<?php header('Access-Control-Allow-Origin: *');
$urlRacineAudio ="";
$souraNbr=$_POST['souraNbr'];
$souraName=$_POST['souraName'];
$reader=$_POST['reader'];
$readerName=$_POST['readerName'];

//$fullUrl = $urlRacineAudio."surah/". $reader ."/". $souraNbr .".mp3";

switch ($reader) {
	case "soudais":
		$fullUrl = "http://ia601408.us.archive.org/17/items/soudais_surah/". $souraNbr .".mp3";
		break;
		
	case "shuraim":
		$fullUrl = "http://ia902709.us.archive.org/4/items/shuraim_surah/". $souraNbr .".mp3";
		break;
	case "Abdelbasset":
		$fullUrl = "http://ia902700.us.archive.org/18/items/Abdelbasset_surah/". $souraNbr .".mp3";
		break;
	case "Mishary-El-Afasi":
		$fullUrl = "http://ia902709.us.archive.org/34/items/Mishary-El-Afasi_surah/". $souraNbr .".mp3";
		break;
	case "AlAjmi":
		$fullUrl = "http://ia601007.us.archive.org/9/items/AlAjmi_surah/". $souraNbr .".mp3";
		break;
	case "AbuBakrAs-Shatery":
		$fullUrl = "http://ia902700.us.archive.org/13/items/AbuBakrAs-Shatery_surah/". $souraNbr .".mp3";
		break;
	case "AbduLLahAl-Matrood":
		$fullUrl = "http://ia902704.us.archive.org/20/items/AbduLLahAl-Matrood_surah/". $souraNbr .".mp3";
		break;
	case "Al-Ghaamidi":
		$fullUrl = "http://ia902701.us.archive.org/0/items/Al-Ghaamidi_surah/". $souraNbr .".mp3";
		break;
	case "HassanIbrahimHashem":
		$fullUrl = "http://ia601408.us.archive.org/17/items/HassanIbrahimHashem_surah/". $souraNbr .".mp3";
		break;
	case "Hussary":
		$fullUrl = "http://ia601007.us.archive.org/17/items/Hussary_surah/". $souraNbr .".mp3";
		break;
	case "Huzify":
		$fullUrl = "http://ia801406.us.archive.org/34/items/Huzify_surah/". $souraNbr .".mp3";
		break;
	case "IbraheemAl-Akhdar":
		$fullUrl = "http://ia601007.us.archive.org/10/items/IbraheemAl-Akhdar_surah/". $souraNbr .".mp3";
		break;
	case "Jibreal":
		$fullUrl = "http://ia601001.us.archive.org/26/items/Jibreal_surah/". $souraNbr .".mp3";
		break;
	case "Menshawi":
		$fullUrl = "http://ia902702.us.archive.org/29/items/Menshawi_surah/". $souraNbr .".mp3";
		break;
	case "MuhammadAyyoub":
		$fullUrl = "http://ia601903.us.archive.org/21/items/MuhammadAyyoub_surah/". $souraNbr .".mp3";
		break;
	case "MustafaIsmael":
		$fullUrl = "http://ia902702.us.archive.org/16/items/MustafaIsmael_surah/". $souraNbr .".mp3";
		break;
	case "Ali-Barraq":
		$fullUrl = "https://ia701201.us.archive.org/18/items/Ali-Barraq_Morocco/". $souraNbr .".mp3";
		break;
	case "Maher_maaykli":
		$fullUrl = "https://ia600500.us.archive.org/29/items/Maher_maaykli_mp3/". $souraNbr .".mp3";
		break;
}





?>
    <div>
	<audio id="audioSurahReader" preload="auto" controls>
    <source src="<?= $fullUrl?>" />
    </audio>
	<div class="audioPlayerTitle">سورة &#65279;<?= $souraName ?> - <?=$readerName?></div>
    </div>
    <script>
	$( function()
	{
		$( '#audioSurahReader' ).audioPlayer();
	});
	</script>
