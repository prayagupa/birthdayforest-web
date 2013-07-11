<?php

function getSelectCountry($name, $selected = NULL,$attributes = NULL){
	$CI = CI_Controller::get_instance();

	/* @var $cRepo Doctrine\ORM\EntityRepository */
	$cRepo = $CI->doctrine->em->getRepository('models\Country');
	$countries = $cRepo->findAll();

	$options = array();

	foreach($countries as $c){
		$options[$c->id] = $c->name;
	}


	echo form_multiselect($name,$options,$selected,$attributes);
}



function getCities(){

	$CI = CI_Controller::get_instance();

	/* @var $cRepo Doctrine\ORM\EntityRepository */
	$cityRepository = $CI->doctrine->em->getRepository('models\City');
	$cities = $cityRepository->findAll();

	$options = array();

	foreach($cities as $t){
		$options[$t->getId()] = $t->getName();
	}

	return $options;


}
/**
 *
 * getOperatingCountries
 */
function getOperatingCountries(){

	$CI = CI_Controller::get_instance();
//	$poolCountry = Options::get('config_operating_countries',NULL);

	$countryIds = 1;
	$countries = array();

	/* @var $cRepo Doctrine\ORM\EntityRepository */
	//foreach ($countryIds as $countryID) {
		$countries[] = $CI->doctrine->em->find('models\Country',$countryIds);
	//}
	$options = array();

	//foreach($countries as $c){
		$options[$countries[0]->getId()] = $countries[0]->getName();

	//}


	return $options;
}

function getRegions(){
	$CI = CI_Controller::get_instance();

	/*
	 * all entities in the repository.
	 * @var $regionRepo Doctrine\ORM\EntityRepository
	 *
	 */
	$regionRepo = $CI->doctrine->em->getRepository('models\Region');
	$regions = $regionRepo->findAll();
	$options = array();
	foreach($regions as $r){
		$options[$r->getId()] = $r->getName();
	}
	return $options;
}

function getSectors(){
	$CI = CI_Controller::get_instance();

	/*
	 * all entities in the repository.
	 * @var $sectorRepository Doctrine\ORM\EntityRepository
	 *
	 */
	$sectorRepository = $CI->doctrine->em->getRepository('models\Sector');
	$sectors = $sectorRepository->findAll();
	$options = array();
	foreach($sectors as $s){
		$options[$s->getId()] = $s->getDescription();
	}
	return $options;
}

function getMainSectorNames(){
	$CI = CI_Controller::get_instance();

	/*
	 * all entities in the repository.
	 * @var $sectorRepository Doctrine\ORM\EntityRepository
	 *
	 */
	$sectorRepository = $CI->doctrine->em->getRepository('models\Sector');
	$sectors = $sectorRepository->getAllMainSectors();
	$options = array();
	foreach($sectors as $s){
		$options[$s['sectorId']] = $s['description'];
	}
	return $options;
}

function getSubSectorNames(){
	$CI = CI_Controller::get_instance();

	/*
	 * all entities in the repository.
	 * @var $sectorRepository Doctrine\ORM\EntityRepository
	 *
	 */
	$sectorRepository = $CI->doctrine->em->getRepository('models\Sector');
	$sectors = $sectorRepository->getAllSubSectors();
	$options = array();
	foreach($sectors as $s){
		$options[$s['sectorId']] = $s['description'];
	}
	return $options;
}


function getEducations(){
	$CI = CI_Controller::get_instance();
	/*
	 * all entities in the repository.
	 * @var $sectorRepository Doctrine\ORM\EntityRepository
	 */
	$educationRepository = $CI->doctrine->em->getRepository('models\Education');
	$educations = $educationRepository->findAll();
	$options = array();
	foreach($educations as $e){
		$options[$e->getId()] = $e->getName();
	}
	return $options;
}

function getCustomDateDiffDays($parameterDate){
	return gregoriantojd(date('m'), date('d'), date('Y')) - gregoriantojd($parameterDate->format('m'), $parameterDate->format('d'), $parameterDate->format('Y'));
}

function getDateDiffDays($pDate){
	return getCustomDateDiffDays($pDate)." Days ago";
}

/* Function to make pixelated images
* Supported input: .png .jpg .jpeg .gif
*
*
* Created on 24.01.2011 by Henrik Peinar
*/


/*
* image - the location of the image to pixelate
* pixelate_x - the size of "pixelate" effect on X axis (default 10)
* pixelate_y - the size of "pixelate" effect on Y axis (default 10)
* output - the name of the output file (extension will be added)
*/
function pixelate($image, $output, $pixelate_x = 20, $pixelate_y = 20){
    // check if the input file exists
    if(!file_exists($image))
        echo 'File "'. $image .'" not found';

    // get the input file extension and create a GD resource from it
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    if($ext == "jpg" || $ext == "jpeg")
        $img = imagecreatefromjpeg($image);
    elseif($ext == "png")
        $img = imagecreatefrompng($image);
    elseif($ext == "gif")
        $img = imagecreatefromgif($image);
    else
        echo 'Unsupported file extension';

    // now we have the image loaded up and ready for the effect to be applied
    // get the image size
    $size = getimagesize($image);
    $height = $size[1];
    $width = $size[0];

    // start from the top-left pixel and keep looping until we have the desired effect
    for($y = 0;$y < $height;$y += $pixelate_y+1){
        for($x = 0;$x < $width;$x += $pixelate_x+1){
            // get the color for current pixel
            $rgb = imagecolorsforindex($img, imagecolorat($img, $x, $y));

            // get the closest color from palette
            $color = imagecolorclosest($img, $rgb['red'], $rgb['green'], $rgb['blue']);
            imagefilledrectangle($img, $x, $y, $x+$pixelate_x, $y+$pixelate_y, $color);
        }
    }

    // save the image
    //demo code : $output_name = $output .'_'. time() .'.jpg';
	$output_name = $output.'.jpg';
    imagejpeg($img, $output_name);
    imagedestroy($img);
}