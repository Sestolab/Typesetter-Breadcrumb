<?php

namespace Addon\Breadcrumb;

defined('is_running') or die('Not an entry point...');

class Breadcrumb{

	function __construct(){
		global $gp_menu, $page, $addonPathData;

		if(file_exists($addonPathData.'/config.php'))
			include_once  $addonPathData.'/config.php';

		$items = array(
			'Bootstrap' => array(
				'ol' => '<ol class="breadcrumb">',
				'li' => '<li class="breadcrumb-item">%s</li>',
				'active' => '<li class="breadcrumb-item active" aria-current="page">%s</li>',
				'nav' => '</ol></nav>'
			),
			'Foundation' => array(
				'ol' => '<ol class="breadcrumbs">',
				'li' => '<li>%s</li>',
				'active' => '<li>%s</li>',
				'nav' => '</ol></nav>'
			),
			'Simple' => array(
				'ol' => '',
				'li' => '%s  '.(isset($config['separator']) ? $config['separator'] : '&gt;').' ',
				'active' => '%s',
				'nav' => '</nav>'
			)
		);

		$style = isset($config['style']) ? $config['style'] : 'Simple';
		$pages = \common::Parents($page->gp_index, $gp_menu);
		$pages[] = \common::GetLabel(key($gp_menu));

		echo '<nav aria-label="breadcrumb" role="navigation">'.$items[$style]['ol'];
			for ($i = count($pages)-1; $i >= 0; $i--){
				$title = \common::IndexToTitle($pages[$i]);
				if($pages[$i] != $page->gp_index)
					printf($items[$style]['li'], \common::Link($title, \common::GetLabel($title)));
			}
		printf($items[$style]['active'], $page->label);
		echo $items[$style]['nav'];

	}

}
