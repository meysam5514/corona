<?php
error_reporting(false);
header('Content-type: application/json;');

//■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function get($url){
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36");
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
//curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
//curl_setopt($ch,CURLOPT_COOKIESESSION ,true);
//curl_setopt($ch, CURLOPT_COOKIEJAR,"cooki.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cooki.txt");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch,CURLOPT_NOBODY,FALSE);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt($ch,CURLOPT_AUTOREFERER,1);
curl_setopt($ch,CURLOPT_ENCODING, 'UTF-8');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
return curl_exec($ch);
curl_close($ch);
}
//■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function post($url,$data){
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
//curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
//curl_setopt($ch,CURLOPT_COOKIESESSION ,true);
//curl_setopt($ch, CURLOPT_COOKIEJAR,"cooki.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cooki.txt");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch,CURLOPT_NOBODY,FALSE);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt($ch,CURLOPT_AUTOREFERER,1);
curl_setopt($ch,CURLOPT_ENCODING, 'UTF-8');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
return curl_exec($ch);
curl_close($ch);
}
//■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
$urlkobs = $_GET['url'];

$meysam1=get("https://www.worldometers.info/coronavirus/weekly-trends/");

preg_match_all('#<td style="font-weight: bold; font-size:15px; text-align:left;"><a class="mt_a" href="(.*?)">(.*?)</a></td>#',$meysam1,$side1);

preg_match_all('#<td style="font-weight: bold; text-align:right">(.*?)</td>#',$meysam1,$side2);

preg_match_all('#<span style="(.*?)">(.*?)</span>#',$meysam1,$side3);

preg_match_all('#<span>(.*?)</span>#',$meysam1,$side4);

$world[]=['Weekly New Cases'=>$side3[2][1],'Weekly New Cases Change'=>$side3[2][2],'Weekly New Deaths'=>$side4[1][0],'Weekly New Deaths Change'=>$side4[1][1],'Weekly Recovered'=>$side4[1][2], 'Weekly Recovered Change'=>$side4[1][3]];





for($i=0;$i<=count($side2[1])-1;$i=$i+13){

$Cases_in_the_last_7_days1[]=             $side2[1][$i];
$Cases_in_the_preceding_7_days1[]=        $side2[1][$i+1];
$Weekly_Case_Change_percent1[]=           $side2[1][$i+2];
$Cases_in_the_last_7_days_1M_pop1[]=      $side2[1][$i+3];
$Deaths_in_the_last_7_days1[]=            $side2[1][$i+4];
$Deaths_in_the_preceding_7_days1[]=       $side2[1][$i+5];
$Weekly_Death_Change_percent1[]=          $side2[1][$i+6];
$Deaths_in_the_last_7_days_1M_pop1[]=     $side2[1][$i+7];
$Weekly_Case_Change1[]=                   $side2[1][$i+8];
$Weekly_Case_Change_1M_pop1[]=            $side2[1][$i+9];
$Weekly_Deaths_Change1[]=                 $side2[1][$i+10];
$Weekly_Deaths_Change_1M_pop1[]=          $side2[1][$i+11];
$Population1[]=                           $side2[1][$i+12];
}

for($i=0;$i<=count($side1[2])-1;$i++){
					
$country=$side1[2][$i];

$Cases_in_the_last_7_days=           $Cases_in_the_last_7_days1[$i];        
$Cases_in_the_preceding_7_days=      $Cases_in_the_preceding_7_days1[$i];
$Weekly_Case_Change_percent=         $Weekly_Case_Change_percent1[$i]  ;
$Cases_in_the_last_7_days_1M_pop=    $Cases_in_the_last_7_days_1M_pop1[$i]; 
$Deaths_in_the_last_7_days=          $Deaths_in_the_last_7_days1[$i]     ;
$Deaths_in_the_preceding_7_days=     $Deaths_in_the_preceding_7_days1[$i]  ; 
$Weekly_Death_Change_percent=        $Weekly_Death_Change_percent1[$i]     ;  
$Deaths_in_the_last_7_days_1M_pop=   $Deaths_in_the_last_7_days_1M_pop1[$i] ;
$Weekly_Case_Change=                 $Weekly_Case_Change1[$i]         ;
$Weekly_Case_Change_1M_pop=          $Weekly_Case_Change_1M_pop1[$i]  ;
$Weekly_Deaths_Change=               $Weekly_Deaths_Change1[$i]       ;
$Weekly_Deaths_Change_1M_pop=        $Weekly_Deaths_Change_1M_pop1[$i]  ;   
$Population=                         $Population1[$i]       ;      

    
$pptpr["$country"]=['Cases in the last 7 days'=>$Cases_in_the_last_7_days ,'Cases in the preceding 7 days'=>$Cases_in_the_preceding_7_days,'Weekly Case % Change'=>$Weekly_Case_Change_percent,'Cases in the last 7 days/1M pop'=>$Cases_in_the_last_7_days_1M_pop,'Deaths in the last 7 days'=>$Deaths_in_the_last_7_days,'Deaths in the preceding 7 days'=>$Deaths_in_the_preceding_7_days,'Weekly Death % Change'=>$Weekly_Death_Change_percent,'Deaths in the last 7 days/1M pop'=>$Deaths_in_the_last_7_days_1M_pop,'Weekly Case Change'=>$Weekly_Case_Change,'Weekly Case Change/1M pop'=>$Weekly_Case_Change_1M_pop,'Weekly Deaths Change'=>$Weekly_Deaths_Change,	'Weekly Deaths Change/1M pop'=>$Weekly_Deaths_Change_1M_pop,'Population' =>$Population];
}

//========================================================= 
echo json_encode(['ok' => true, 'channel' => '@SIDEPATH','writer' => '@meysam_s71','world'=>$world,  'Results' =>$pptpr], 448);
//========================================================= 






