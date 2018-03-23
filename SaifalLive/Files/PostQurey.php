<?php 

namespace Files;

use Files\Validation;

$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/files/Validation.php'); 


class PostQurey  extends Validation
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
	
	return $this->PostResult($val);

}


public function PostResult($val)
{
	

$postLimit = parent::rowLimit();
global $wpdb;
$results = [];
$newsonePostlike = $val.'%';
$querystr = "
SELECT id,post_author,post_content,post_title  FROM $wpdb->posts WHERE  $wpdb->posts.post_type ='post' 
AND $wpdb->posts.post_status ='publish'
 AND $wpdb->posts.post_title like  '$newsonePostlike'
 ORDER BY $wpdb->posts.post_date DESC LIMIT $postLimit 
 ";
$pageposts = $wpdb->get_results($querystr, OBJECT);


if ($pageposts) {


 foreach ($pageposts as $post){
 setup_postdata($post); 



$title = get_the_title($post->id);
$link = get_permalink( $post->id );
$count  = parent::countRole() ? 50 : false;
$description  = (parent::txtoptions())?get_the_content() : '';
$photo = (parent::showImg())?  get_the_post_thumbnail_url($post->id,'full'):'';


$setResult =['title'=>$title,'link'=>$link,'count'=>$count,'description'=>$description,'photo'=>$photo] ;


$returnArray  = $this->setResult('post',$setResult);
//return $this->test();



array_push($results, $returnArray);

} //end foreach	

return json_encode($results);

} //end of



}//end of post



	


}