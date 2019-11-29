<?php

namespace Addon\Breadcrumb;

defined('is_running') or die('Not an entry point...');


class Settings{

	function __construct(){
		global $langmessage, $addonRelativeCode, $page, $config, $addonPathCode;
		$page->head_js[] = $addonRelativeCode.'/Breadcrumb.js';
		$lang = \gpFiles::Get($addonPathCode.'/languages/'.$config['language'].'.php', 'lang') ?: \gpFiles::Get($addonPathCode.'/languages/en.php', 'lang');
		$this->loadConfig();

		if(\common::GetCommand() == 'save')
			$this->saveConfig();

		echo '<form method="post" action="'.\common::GetUrl('Admin_Breadcrumb').'">';
		echo '<table class="bordered">';
		echo '<tr><th colspan="2">'.$lang['Breadcrumb Settings'].'</th></tr>';
		echo '<tr><td>'.$langmessage['style'].'</td><td>';
		echo '<select name="style" id="breadcrumb-style">';
		echo '<option '.($this->style == 'Bootstrap' ? 'selected' : '').'>Bootstrap</option>';
		echo '<option '.($this->style == 'Foundation' ? 'selected' : '').'>Foundation</option>';
		echo '<option '.($this->style == 'Simple' ? 'selected' : '').'>Simple</option>';
		echo '</select>';
		echo '</td></tr>';
		echo '<tr id="breadcrumb-separator"><td>'.$lang['Separator'].'</td><td>';
		echo '<input name="separator" value="'.$this->separator.'"/>';
		echo '</td></tr><tr><td></td><td>';
		echo '<input type="hidden" name="cmd" value="save" />';
		echo '<input type="submit" name="" value="'.$langmessage['save'].'" class="gpsubmit" />';
		echo '</td></tr></table></form>';

		echo '<div class="text-right">Made by <a href="https://sestolab.pp.ua" target="_blank">Sestolab</a></div>';
	}

	function saveConfig(){
		global $addonPathData, $langmessage;
		$config['style'] = $_POST['style'];
		$config['separator'] = isset($_POST['separator']) ? $_POST['separator'] : '&gt;';

		$this->style = $config['style'];
		$this->separator = $config['separator'];
		if( \gpFiles::SaveArray($addonPathData.'/config.php', 'config', $config) )
			return message($langmessage['SAVED']);
		message($langmessage['OOPS']);
	  }

  	function loadConfig(){
		global $addonPathData;
		$config = \gpFiles::Get($addonPathData.'/config.php', 'config');
		$this->style = isset($config['style']) ? $config['style'] : 'Simple';
		$this->separator = isset($config['separator']) ? $config['separator'] : '&gt;';
  	}

}
