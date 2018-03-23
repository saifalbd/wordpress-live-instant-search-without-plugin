<?php 



use Files\Validation;

use Files\PostQurey;
use Files\AuthorQurey;

use Files\CategoriesQurey;


$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/files/Validation.php'); 

$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/files/PostQurey.php'); 

$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/files/AuthorQurey.php');

$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/files/CategoriesQurey.php');  



class RegistarRoute
{
	

	private $routeOption;
	private $sendArg;
	private $themName ='mythemes' ;
	private $nameSpace = 'myplugin';
	private $endPoint = 'find';
	private $postSlug = 'mypost';
	private $categorySlug = 'mycategory';
	private $authorSlug = 'myauthor';


	function __construct(array $arg)
	{

if (count($arg['dataoption'])>2) {
	$this->routeOption = true;
  if ($arg['routeoption']) {$this->routeConfiger($arg['routeoption']); }
 
	$this->sendArg = $arg['dataoption'];
	

}else{
$this->routeOption =false;
}



	}
/*
end contructor
 */


private  function stringVlidation($text){
if (!empty($text)) {
if (!is_numeric($text)) {
if (strlen($text)>0) {
 return $text;
}
 }}
return false;



}

public function routeConfiger($option)
{
 /*
 'themename'=>'newsone',
'namespace'=>'newsone',
'endpoint'=>'find',
'postslug'=>'mypost',
'categoryslug'=>'mycategory',
'authorslug'=>'myauthor'
*/


if ($option['themename']) {
$themName = $option['themename'];
if ($this->stringVlidation($themName)) {
$this->themName = $themName;
 }}

 if ($option['namespace']) {
$namespace = $option['namespace'];
if ($this->stringVlidation($namespace)) {
$this->nameSpace = $namespace;
 }}

  if ($option['endpoint']) {
$endpoint = $option['endpoint'];
if ($this->stringVlidation($endpoint)) {
$this->endPoint = $endpoint;
 }}

   if ($option['postslug']) {
$postslug = $option['postslug'];
if ($this->stringVlidation($postslug)) {
$this->postSlug = $postslug;
 }}

   if ($option['categoryslug']) {
$categorySlug = $option['categoryslug'];
if ($this->stringVlidation($categoryslug)) {
$this->categoryslug = $categoryslug;
 }}

    if ($option['authorslug']) {
$authorslug = $option['authorslug'];
if ($this->stringVlidation($authorslug)) {
$this->authorslug = $authorslug;
 }}

}



public function register()
{
	

 register_rest_route($this->nameSpace.'/v1', ''.$this->endPoint, [
        'methods' => WP_REST_Server::READABLE,
        'callback' =>array ($this,'saifalSearchRequest'),
        'args' =>$this->saifalSearchRequestArgs()
    ]);


}


public function saifalSearchRequest ( $request ) {


    $PostQurey = new PostQurey($this->sendArg);
    $AuthorQurey = new AuthorQurey($this->sendArg);
    $CategoriesQurey = new CategoriesQurey($this->sendArg);

    $results = ['data'=>''];
    // check for a search term
    if( isset($request[$this->postSlug])) {
    if ($this->stringVlidation($request[$this->postSlug])) {
		// get posts
		// set up the data I want to return
    // 
    // 
  
         $results['data']  =   $PostQurey->Setval($request[$this->postSlug]);

       }
    };

     if( isset($request[$this->authorSlug])) {
      if ($this->stringVlidation($request[$this->authorSlug])) {
		// get posts
		// set up the data I want to return
  
          $results['data']  =    $AuthorQurey->Setval($request[$this->authorSlug]);
        // $results  =   $PostQurey->Setval($request[$this->postSlug]);
     };
    };

     if( isset($request[$this->categorySlug])) {
     if ($this->stringVlidation($request[$this->categorySlug])) {
		// get posts
		// set up the data I want to return
          $results['data']  =    $CategoriesQurey->Setval($request[$this->categorySlug]);
     };
    };

    
    return  rest_ensure_response( $results);
}




public function saifalSearchRequestArgs() {
    $args = [];
     $args[$this->postSlug] = [
       'description' => esc_html__( 'The search term.', $this->themName),
       'type'        => 'string',
   ];

   $args[$this->authorSlug] = [
       'description' => esc_html__( 'The search term.', $this->themName),
       'type'        => 'string',
   ];

    $args[$this->categorSlug] = [
       'description' => esc_html__( 'The search term.', $this->themName),
       'type'        => 'string',
   ];

   

   return $args;
}






}

