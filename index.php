

<?php $error1= "Please input a valid location!";
if($_GET['location']=="")
	
 echo "<script type='text/javascript'> window.alert('$error1');</script>";
else{
$true=0;
if($_GET['location']!="")
{
if($_GET["type1"]=="ZIP Code")
{
$zip=$_GET['location'];

if(!(is_numeric($zip)&&strlen($zip)==5))
echo "<script type='text/javascript'>  alert('Please input a ZIP Code with 5 digit numbers!');</script>";

else{
$count=0;
$url="http://where.yahooapis.com/v1/concordance/usps/".@$_GET['location']."?appid=

[GithqOXV34ERghRJSZlOIIm0cJ1gqyBKMTEF3EeN8esOcGDc5jYhiTjt8onoidmrH66ZqA]";


$error2="Zero results found!";
function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}

if(get_http_response_code($url) == "404"){
   echo "<script type='text/javascript'> alert('$error2');</script>";
}
if(get_http_response_code($url) != "404"){
$xml= simplexml_load_file($url);
foreach($xml->woeid as $entry)
{
 $count+=1;
}
$woeid = $xml->woeid;
if(@$_GET["temperature"]=="Celsius")
$url2="http://weather.yahooapis.com/forecastrss?w=".$woeid."&u=c";
if(@$_GET["temperature"]=="Fahrenheit")
$url2="http://weather.yahooapis.com/forecastrss?w=".$woeid."&u=f";
$xml2= simplexml_load_file($url2);
$namespaces=$xml2->channel->item->getNameSpaces(true);
$yweather1=$xml2->channel->item->children($namespaces['yweather']);
$namespaces2=$xml2->channel->getNameSpaces(true);
$yweather2=$xml2->channel->children($namespaces['yweather']);
$text1=(string)$yweather1->condition->attributes()->text;

$temp1=(string)$yweather1->condition->attributes()->temp;

$temperature1=(string)$yweather2->units->attributes()->temperature;
$deg="&deg";
$city1=(string)$yweather2->location->attributes()->city;
$region1=(string)$yweather2->location->attributes()->region;
$country1=(string)$yweather2->location->attributes()->country;
$geo=$xml2->channel->item->children($namespaces['geo']);
$lat1=$geo->lat;
$long1=$geo->long;
$link1=$xml2->channel->item->link;
$html=$xml2->channel->item->description;
$htmlParser=new DOMDocument();
$htmlParser->loadHTML($html);
$html=simplexml_import_dom($htmlParser);
$src=$html->body->img['src'];

$day=array();
$low=array();
$high=array();
$text=array();
$i=0;
$yweather3=$xml2->channel->item->children($namespaces['yweather']);
while($i<5){
	$day[$i]=$yweather3->forecast[$i]->attributes()['day'];
	$low[$i]=$yweather3->forecast[$i]->attributes()['low'];
	$high[$i]=$yweather3->forecast[$i]->attributes()['high'];
	$text[$i]=$yweather3->forecast[$i]->attributes()['text'];
	$i+=1;
}

	header("Content-type: text/plain");
	$xml =new SimpleXMLElement("<xml></xml>");
	$weather=$xml->addChild('weather');
	$weather->feed=htmlspecialchars ($url2);
	$weather->link=htmlspecialchars ($link1);
	$location=$weather->addChild('location');
	$location->addAttribute('city',$city1);
	$location->addAttribute('region',$region1);
	$location->addAttribute('country',$country1);
	$units=$weather->addChild('units');
	$units->addAttribute('temperature',$temperature1);
	$condition=$weather->addChild('condition');
	$condition->addAttribute('text',$text1);
	$condition->addAttribute('temp',$temp1);
	$img=$weather->addChild('img',$src);
	for($i=0;$i<5;$i+=1){
	$forecast=$weather->addChild('forecast');
	$forecast->addAttribute('day',$day[$i]);
	$forecast->addAttribute('low',$low[$i]);
	$forecast->addAttribute('high',$high[$i]);
	$forecast->addAttribute('text',$text[$i]);
	}
	//Header('Content-Type: text/xml');
    /* get the xml printed */
    echo $xml->saveXML();

}
  }
  }

if(@$_GET["type1"]=="City") 
{

$city=$_GET['location'];
$f1="true";
if(!preg_match('/^[a-zA-Z0-9,-\\s]+$/',$city))
echo "<script type='text/javascript'>  alert('Invalid location! City name should contain only alphabet,number,comma, whitespaces and 
hyphen!');</script>";
else{
$url="http://where.yahooapis.com/v1/places\$and(.q('".urlencode(@$_GET['location'])."'),.type(7));start=0;count=5?"."appid=
[GithqOXV34ERghRJSZlOIIm0cJ1gqyBKMTEF3EeN8esOcGDc5jYhiTjt8onoidmrH66ZqA]";
$i=0;
$count=0;
$count2=0;
function xml_child_exists($xml, $childpath)
 {
    $result = $xml->xpath($childpath);
    if(!empty($result)) {$true=1;}
	else $true=0;
	return $true;
	
 }
$xml_content=file_get_contents($url);
$xml=simplexml_load_string($xml_content);

foreach($xml->place as $entry)
{
 $count+=1;
}
$error2="Zero results found!";
if($count==0) echo "<script type='text/javascript'> alert('$error2');</script>";
else{


$html_text2="";

$entry=$xml->place[0];
$woeid = $entry->woeid;
$warray=array();
$warray[$i]=$woeid;
if(@$_GET["temperature"]=="Celsius")
$url2="http://weather.yahooapis.com/forecastrss?w=".$warray[$i]."&u=c";
if(@$_GET["temperature"]=="Fahrenheit")
$url2="http://weather.yahooapis.com/forecastrss?w=".$warray[$i]."&u=f";

$xml2= simplexml_load_file($url2);

 $flag="false";
if(xml_child_exists($xml2,"//yweather:location")||xml_child_exists($xml2,"//item/yweather:condition")||xml_child_exists
($xml2,"//item/geo:lat")||xml_child_exists($xml2,"//item/geo:long")||xml_child_exists($xml2,"//yweather:units"))
{ $flag="true";
$namespaces=$xml2->channel->item->getNameSpaces(true);
$yweather1=$xml2->channel->item->children($namespaces['yweather']);
$namespaces2=$xml2->channel->getNameSpaces(true);
$yweather2=$xml2->channel->children($namespaces['yweather']);
 $text1=(string)$yweather1->condition->attributes()->text;
if($text1=="") $text1="N/A";
 $temp1=(string)$yweather1->condition->attributes()->temp;
if($temp1=="") $temp1="N/A";
$temperature1=(string)$yweather2->units->attributes()->temperature;
if($temperature1=="") $temperature1="N/A";
$deg="&deg";
$city1=(string)$yweather2->location->attributes()->city;
if($city1=="") $city1="N/A";

$region1=(string)$yweather2->location->attributes()->region;
if($region1=="") $region1="N/A";
$country1=(string)$yweather2->location->attributes()->country;
if($region1=="") $region1="N/A";
$geo=$xml2->channel->item->children($namespaces['geo']);
$lat1=$geo->lat;
if($lat1=="") $lat1="N/A";
$long1=$geo->long;
if($long1=="") $long1="N/A";
$link1=$xml2->channel->item->link;
if($link1=="") $link1="N/A";
$html=$xml2->channel->item->description;
$htmlParser=new DOMDocument();
$htmlParser->loadHTML($html);
$html=simplexml_import_dom($htmlParser);
$src=$html->body->img['src'];
if($src=="") $src="N/A";
$yweather3=$xml2->channel->item->children($namespaces['yweather']);
$day=array();
$low=array();
$high=array();
$text=array();
$i=0;
while($i<5){
	$day[$i]=$yweather3->forecast[$i]->attributes()['day'];
	$low[$i]=$yweather3->forecast[$i]->attributes()['low'];
	$high[$i]=$yweather3->forecast[$i]->attributes()['high'];
	$text[$i]=$yweather3->forecast[$i]->attributes()['text'];
	$i+=1;
}

if($flag=="true")
{
	header("Content-type: text/plain");
	$xml =new SimpleXMLElement("<xml></xml>");
	$weather=$xml->addChild('weather');
	$weather->feed=htmlspecialchars ($url2);
	$weather->link=htmlspecialchars ($link1);
	$location=$weather->addChild('location');
	$location->addAttribute('city',$city1);
	$location->addAttribute('region',$region1);
	$location->addAttribute('country',$country1);
	$units=$weather->addChild('units');
	$units->addAttribute('temperature',$temperature1);
	$condition=$weather->addChild('condition');
	$condition->addAttribute('text',$text1);
	$condition->addAttribute('temp',$temp1);
	$img=$weather->addChild('img',$src);
	for($i=0;$i<5;$i+=1){
	$forecast=$weather->addChild('forecast');
	$forecast->addAttribute('day',$day[$i]);
	$forecast->addAttribute('low',$low[$i]);
	$forecast->addAttribute('high',$high[$i]);
	$forecast->addAttribute('text',$text[$i]);
	}
	//Header('Content-Type: text/xml');
    /* get the xml printed */
    echo $xml->saveXML();

}
$i+=1;
}
}

}

}
}
}
?> 


 

