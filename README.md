# wordpress live search package without plugin

wordpress live instant search custom rest api post,author, categories search  package  using with vue js


#for configer:
[app path]/SaifalLive/config.php

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
'demoimg'=>'demo image path', // if post tumblil is fail
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

pass your argument

$apiroute = new RegistarRoute($arg);

register scearch route

$apiroute->register();


 your default post get url
 http://yourdomain.com/wp-json/myplugin/v1/find?mypost=value
 your default category get url
 http://yourdomain.com/wp-json/myplugin/v1/find?mycategory=value
 your default author get url
 http://yourdomain.com/wp-json/myplugin/v1/find?myauthor=value

#for use:
in your function.php

$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/config.php'); 

$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/javascript_ragistar.php'); 



if you change default $arg['routeoption'] you mustbe change in you vue js component inside  data option values
