<?php
//hi2010!$
set_time_limit(0);
ini_set(max_execution_time, 500);
ini_alter(memory_limit, -1);


function getnbHadithMoslem(){
	$lines = file('hadithMoslem.txt');
	$nbrLines= count($lines);
	$nbValid=0;
	foreach($lines as $line) {
		$line=explode('|',trim($line));
		$hadith=$line[2];	
		if(strlen($hadith)<421) $nbValid++;
	}
	return $nbValid." of ".$nbrLines;
}

	function discover(){
	include('config.php');
	$cnx=mysql_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass']);
	mysql_select_db($dbconfig['db'], $cnx) or die ('La base de données ne peut pas être sélectionnée');
	
	$lines = file('QuranTurkish.txt');
	$nbrLines= count($lines);
	echo "nbr lines : ".$nbrLines."<br>";
	foreach($lines as $line) {
		$line=explode('|',trim($line));
		$soura=$line[0];
		$eya=$line[1];	
		$text=$line[2];
		$text=iconv("ISO-8859-2","UTF-8", $text);
		//$text=iconv("ISO-8859-2","UTF-8", $text);		
		//$text=iconv("Windows-1256","UTF-8", $text);		
		$text=addslashes($text);
	
	//echo $soura." ".$eya." ".$text."<br><br>";		
	
	//$sql="update jalalain set content='".$text."' where soura=".$soura." and number=".$eya;
	$sql = "insert into turkish values (".$soura.",".$eya.",'".$text."')";
	//echo $sql."<br>";
	echo $soura." ".$eya."<br><br>";
	mysql_query($sql);
	}
	
    mysql_close();
	}
	
	discover();
	
	
	function getEya($soura,$eya=0){
	include('config.php');
	$cnx=mysql_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass']);
	mysql_select_db($dbconfig['db'], $cnx) or die ('La base de données ne peut pas être sélectionnée');
	
	$sql="SELECT * FROM eya where soura=".$soura;
	if($eya!=0) $sql.= " and number=".$eya;
	$reponse = mysql_query($sql);
	while($donnees=mysql_fetch_array($reponse)){
	
	 echo $donnees['content'];
	 }
	
    mysql_close();
	}
	
	function getTafsirEya($soura,$eya=0){
	include('config.php');
	$cnx=mysql_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass']);
	mysql_select_db($dbconfig['db'], $cnx) or die ('La base de données ne peut pas être sélectionnée');
	
	$sql="SELECT * FROM eya where soura=".$soura;
	if($eya!=0) $sql.= " and number=".$eya;
	$reponse = mysql_query($sql);
	while($donnees=mysql_fetch_array($reponse)){
	 echo $donnees['content']."<br>";
	 	
	 echo $donnees['jalalain'];
	 }
	
    mysql_close();
	}

	
	
	//getEya(110,1);
	//getTafsirEya(110,2);
	//echo "<br>";
		//getEya(110);
		
		
	function index(){
	include('config.php');
	$cnx=mysql_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass']);
	mysql_select_db($dbconfig['db'], $cnx) or die ('La base de données ne peut pas être sélectionnée');
	
	$lines = file('QuranIndex.txt');
	$nbrLines= count($lines);
	echo "nbr lines : ".$nbrLines."<br>";
	$i=1;
	foreach($lines as $line) {
		$line=explode('|',trim($line));
		$soura=$line[0];		
//		$soura=iconv("Windows-1256","UTF-8", $soura);		
		//echo $soura."<br>";		
	$sql="update eya2 set souraName='".$soura."' where soura=".$i;
//	$sql="insert into eya2 values (".$i.",0,'')";
	echo $sql."<br>";
	$i++;
	echo $soura." ".$eya."<br>";
	mysql_query($sql);
	}
	
    mysql_close();
	}
	//index();

?>