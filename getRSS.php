<?php

date_default_timezone_set('America/Los_Angeles');

$t=time();
//echo($t . "<br>");

//get the q parameter from URL
$q=$_GET["q"];

$type = $_GET["t"];

//find out which feed was selected
if($q=="ABCNewsTopStories") {
  $xml=("http://feeds.abcnews.com/abcnews/topstories"); 
} elseif 
  ($q=="ABCWorldHeadlines") {
  $xml=("http://feeds.abcnews.com/abcnews/internationalheadlines");   
} elseif 
  ($q=="ABCUSHeadlines") {
  $xml=("http://feeds.abcnews.com/abcnews/usheadlines");   
} elseif 
  ($q=="ABCPoliticsHeadlines") {
  $xml=("http://feeds.abcnews.com/abcnews/politicsheadlines");   
} elseif 
  ($q=="ABCTheBlotter") {
  $xml=("http://feeds.abcnews.com/abcnews/blotterheadlines");   
}

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;

if ($type !== "noDesc") {
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;
}

//output elements from "<channel>"
echo("<h2><a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<span style='font-size: 12px;'> " . date('l jS \of F Y h:i:s A',$t) . "</span></h2>");

if ($type !== "noDesc") {
echo($channel_desc . "</p>");
}

//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('item');
$elementCount = $x->length;
//echo $elementCount;
$j = 1;
for ($i=0; $i<=$elementCount - 1; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;
  echo ("<p>" . $j . ". <a href='" . $item_link
  . "'>" . $item_title . "</a>");
  echo ("<br>");
  echo ($item_desc . "</p>");
  $j++;
}
?>
