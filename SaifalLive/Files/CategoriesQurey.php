<?php


namespace Files;

use Files\Validation;

$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/files/Validation.php'); 


class CategoriesQurey extends Validation
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
	
	return $this->CategoriesResult($val);

}


public function CategoriesResult($val)
{

 global $wpdb;  

$results =[];

$CategoriesLimit = parent::rowLimit();

  $getNewsoneCategories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
));

if ($getNewsoneCategories) {
foreach ($getNewsoneCategories as $category) {
 $catagoryName =  $category->name;
if (preg_match("/".$val."/i", $catagoryName)) {
$catagoryID = get_cat_ID( $catagoryName);

$title =  $catagoryName;
$link =  get_category_link( $catagoryID );
$count  = parent::countRole() ? get_author_posts_url($row->id) : false;
$description  = (parent::txtoptions())? category_description( $catagoryID) : '';

$photo = (parent::showImg())? 'phtp true' :'';

$setResult =['title'=>$title,'link'=>$link,'count'=>$count,'description'=>$description,'photo'=>$photo] ;

$returnArray  = $this->setResult('post',$setResult);
//return $this->test();


array_push($results, $returnArray);

} //end  if (preg_match("/".$newsonetitle."/i", $catagoryName));



} //end foreach

return json_encode($results);


} //end if


	} //end AuthorResult($val)


}  //end class 
