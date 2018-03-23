<?php


$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/files/RegistarRoute.php'); 


$arg= [
'routeoption'=>[
'themename'=>'', // default mythemes
'namespace'=>'', // default myplugin
'endpoint'=>'', //default find
'postslug'=>'', //default mypost
'categoryslug'=>'', //default mycategory
'authorslug'=>''  //default myauthor
],
'dataoption'=>[
'rowlimit'=>50, // requare
'showimg'=>true,  //default false
'demoimg'=>'demo img patch', // post tumblil is fail
'txtoptions'=>[
	'show'=>true, //default false
	'wordlength'=>10,  //required if show is true
	'endlinetxt'=>'..',  //default false
	'linktxt'=>'more click',  //default empty text
	'linkclass'=>'linkclass',   //default false
],
'count'=>[
	'show'=>true,   //default false
	'postwithtxt'=>'post val',    //default empty
	'categorywithtxt'=>'total post',    //default empty
	'authorwithtxt'=>'total post',    //default empty
]

],


];


// your default  post url
// http://saifal.local/wp-json/myplugin/v1/find?mypost=value
// your default category url
// http://saifal.local/wp-json/myplugin/v1/find?mycategory=value
// your default author url
// http://saifal.local/wp-json/myplugin/v1/find?myauthor=value


 $apiroute = new RegistarRoute($arg);

$apiroute->register();


