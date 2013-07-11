<?php

function showPre($array = array(),$name = ''){

	echo "<pre>";
	if($name != '')
		echo "$name\n";

	print_r($array);
	echo "</pre>";
}

function normalizeFileSize($bytes){
	$kb = number_format($bytes/1024,2);

	if($kb > 500)
	{
		$mb = number_format($kb/1024,2);
		return $mb." MB";
	}

	return $kb." KB";
}
?>