<?php 

namespace Files;


class TextLinker 
{
	
private  $afterSortTxt;

	public function getSort(array $txtSort)
	{
		//['text',length]
 $text =$txtSort['text'];
$text = strip_tags($text);
$text = trim($text);
$length = $txtSort['length'];
		
$txtSortlnt = $length+1;
$excerpt = explode(' ', $text, $txtSortlnt);

if (sizeof($excerpt)>= $length) {
array_pop($excerpt);
$excerpt= implode(' ', $excerpt);

$this->afterSortTxt =$excerpt;
return  $excerpt;

}else{
return $text;   
}
		
	
	}

	public function getLink(array $arg)
	{ 
		//text , link , linktxt ,linkclass  ,dotval

if ($arg['text']) {
$text = $arg['text'];
$linkdot   = $arg['dotval'] ? $arg['dotval'] : '';
$link = $arg['link'] ? $arg['link'] : '#';
$linkclass   = $arg['linkclass'] ? 'class="'.$arg['linkclass'].'"' : '';
$linktxt   = $arg['linktxt'] ? $arg['linktxt'] : 'empty text';

$finalLink = $text.' '.$linkdot.'<a href="'.$link.'" '.$linkclass.'>'.$linktxt.'</a>';

return $finalLink;


}else{
	error_log("getLink Text is empty", 0);
}

		
	}

}