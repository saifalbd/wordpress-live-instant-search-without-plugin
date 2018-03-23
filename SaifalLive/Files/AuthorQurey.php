<?php


namespace Files;

use Files\Validation;

$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/files/Validation.php'); 


class AuthorQurey extends Validation
{
	
	private $findVal;
	private $postArg;

	function __construct(array $arg)
	{

		$this->postArg =$arg;
parent::getVaildArg($this->postArg);
	}


public function Setval(string $val)
{
	
	return $this->AuthorResult($val);

}


public function AuthorResult($val)
{

	  global $wpdb;  
$results =[];

$AuthorLimit = parent::rowLimit();
$Author = "select id from $wpdb->users WHERE display_name LIKE '".$val."%' limit ".$AuthorLimit;

 $AuthorFatch = $wpdb->get_results($Author);


if ($AuthorFatch) {
foreach ($AuthorFatch as $row) {

$title =  get_the_author_meta('display_name', $row->id );
$link = get_author_posts_url($row->id);
$count  = parent::countRole() ? get_author_posts_url($row->id) : false;
$description  = (parent::txtoptions())?get_the_author_meta('description', $row->id ) : '';
//get_avatar_url( $row->id )
$photo = (parent::showImg())? get_avatar_url($row->id) :'';

$setResult =['title'=>$title,'link'=>$link,'count'=>$count,'description'=>$description,'photo'=>$photo] ;


$returnArray  = $this->setResult('post',$setResult);
//return $this->test();


array_push($results, $returnArray);





} //end foreach

return json_encode($results);

} //end if


	} //end AuthorResult($val)


}  //end class 