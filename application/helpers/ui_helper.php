<?php

function ui_icon($type){
	$map = array(	'edit'		=>	'ui-icon-pencil',
					'add'		=>	'ui-icon-plusthick',
					'delete'	=>	'ui-icon-trash',
					'view'		=>	'ui-icon-arrowthick-1-e'
				);
	
	$icon = $map[$type];
	
	echo '<span class="ui-icon '.$icon.'"></span>';
}

function action_button($type,$link,$attr = array()){
	$map = array(	'edit'			=>	'ui-icon-pencil',
					'add'			=>	'ui-icon-plusthick',
					'delete'		=>	'ui-icon-trash',
					'view'			=>	'ui-icon-arrowthick-1-e',
					'permissions'	=>	'ui-icon-locked',
					'copy'			=>	'ui-icon-copy',
					'block'			=>	'ui-icon-cancel',
					'unblock'		=>  'ui-icon-check',
					'doc'			=>  'ui-icon-document',
					'minimize'		=>	'ui-icon-carat-1-n'
			);
	
	$icon = isset($map[$type]) ? $map[$type] : 'ui-icon-'.$type;
	
	//build attributes
	$attributes = '';
	$class = 'action-icon';
	if(is_array($attr)){
		foreach($attr as $key => $value){
			if(strtolower($key) != 'class')
				$attributes .= $key.'="'.$value.'"';
			else
				$class .= ' '.$value;
		}
	}
	
	echo '<a href="'.$link.'" '.$attributes.' class="'.$class.'"><span class="ui-icon '.$icon.'"></span></a>';
}