<?php

function getTitle($Url){
    $str = file_get_contents($Url);
    if(strlen($str)>0){
        preg_match("/\<title\>(.*)\<\/title\>/",$str,$title);
        return $title[1];
    }
}
//Example:
$doc = new DOMDocument();
@$doc->loadHTMLFile($_POST["url"]);
$xpath = new DOMXPath($doc);


  echo json_encode(array("title"=>$xpath->query('//title')->item(0)->nodeValue));
?>