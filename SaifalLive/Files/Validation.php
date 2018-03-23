<?php 

namespace Files;
use Files\TextLinker;

$appdir = get_template_directory().'/SaifalLive';
include_once($appdir . '/files/TextLinker.php'); 


class Validation 
{
	

private  $arg=[];
protected  $error;


public function getVaildArg(array $arg)
{
	$this->arg = $arg;
}


	
public  function rowLimit()
	{

		return is_int($this->arg['rowlimit']) ?$this->arg['rowlimit']: 10;


	}

public function showImg()
{
return is_bool($this->arg['showimg']) ? $this->arg['showimg']: false;	
}

public function demoImg()
{

return is_string($this->arg['demoimg']) ?? false;	
if (is_string($this->arg['demoimg'])) {
	return $this->arg['demoimg'];
}else{
$this->error ='image demo link not vaild';
}

}

public function txtoptions()
{
	if ($this->arg['txtoptions']['show']) {
		return is_bool($this->arg['txtoptions']['show'])?true :false;
	}else{
		return false;
	}
	
}





public function wordlength()
{
	return is_int($this->arg['txtoptions']['wordlength'])? $this->arg['txtoptions']['wordlength'] : $this->error ='wordlength is not vaild must need integer value';
	
}

public function endLineTxt()
{
	$txtoptions = $this->arg['txtoptions']['endlinetxt'];

	return is_string($txtoptions)?$txtoptions: '....';
	
}




public function linkTxt()
{
	$linktxt = $this->arg['txtoptions']['linktxt'];
	return is_string($linktxt)? $linktxt : 'click more';
	
}


public function linkClass()
{
	$linkclass = $this->arg['txtoptions']['linkclass'];
	return is_string($linkclass)?$linkclass: '';
	
}


public function countRole()
{
	$show = $this->arg['count']['show'];
	return is_bool($show)? $show : false;
	
}


public function postwithtxt()
{

	$postwithtxt = $this->arg['count']['postwithtxt'];
	return is_string($postwithtxt)? $postwithtxt: '';
	
}

public function categorywithtxt()
{
	$categorywithtxt = $this->arg['count']['categorywithtxt'];
	return is_string($categorywithtxt)? $categorywithtxt: '';
	
}


public function authorwithtxt()
{
	$authorwithtxt = $this->arg['count']['authorwithtxt'];
	return is_string($authorwithtxt)? $authorwithtxt : '';
	
}

public function vaildText($arg)
{
	if ($arg) {
	return strlen($arg)>2 ?$arg :false;
	}else{
		return false;
	}
}


public function textFilter(string $arg):string
{
	

}


public function setDescription(string $text)
{

$text = strip_tags($text);
if (str_word_count($text)>$this->wordlength()) {

$TextLinker = new TextLinker();
$length = $this->wordlength();
$linktxt = $this->linkTxt();
$linkclass = $this->linkClass();
$endLineTxt = $this->endLineTxt();

$getSort = $TextLinker->getSort(['text'=>$text,'length'=>$length]); //['text',length]
$description =  $TextLinker->getLink(
[
'text'=>$getSort,
'link'=>$linktxt,
'linkclass'=>$linkclass,
'linkclass'=>$linkclass,
'dotval'=>$endLineTxt
]	
);

}else {
$description  = $text;	
}
//[text , link , linktxt ,linkclass  ,dotval]



return $description;
	
}


public function setCount($reqName,$countVal){
$countval  = $countVal;

switch ($reqName) {
	case 'post':
		$countTxt = $this->postwithtxt();
		break;
	case 'catagory':
		$countTxt = $this->categorywithtxt();
		break;
	case 'author':
		$countTxt = $this->authorwithtxt();
		break;

	default:
	$countTxt ='';
		break;
}



return array('text'=>$countTxt,'val'=>$countval);


}

public function setPhoto(string $photo):string
{

return $photo;
	
}


public function setResult(string $reqName, array $arg)
{



//['titel',link,count,description]

if ($arg['title'] && $arg['link'] ) {

$title = $arg['title'];
$link = $arg['link'];
$count = '';
$photo = '';

if ($arg['count']) {

$count = $this->setCount($reqName,$arg['count']);

} //end if ($arg['count'])

if ($this->txtoptions()) {
if ($this->vaildText($arg['description'])) {

$description = $this->setDescription($arg['description']);
}else{
$description ='';	
}
}

if ($arg['photo']) {
$photo = $this->setPhoto($arg['photo']);
}




$result=['title'=>$title,'link'=>$link,'count'=>$count,'description'=>$description,'tumblr'=>$photo];

return $result;


} //end if


} // end fun

} //end class