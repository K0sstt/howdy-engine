<?php 

namespace Twig_Extensions;

class Urls_Twig_Extension extends \Twig_Extension {

	protected
		$placeholders;

	public function getFunctions() {
		return array(
			new \Twig_SimpleFunction('url', array($this, 'url'))
		);
	}

	public function url($arguments) {
		$this->placeholders = $arguments;

		// Define alias and app name
		if(isset($arguments['alias'])) {
			$alias_name = $arguments['alias'];
			unset($arguments['alias']);
		}
		if(isset($arguments['app'])) {
			$app_name = $arguments['app'];
			unset($arguments['app']);
		}

		// Get iterable urls, based on alias type
		$iterable_urls = array();
		if(isset($app_name)) {
			$iterable_urls = array_merge($iterable_urls, require APPS_DIR.'/'.strtolower($app_name).'/urls.php');
		}
		else {
			$settings = require BASE_DIR.'/settings.php';
			foreach($settings['apps'] as $app) {
				$iterable_urls = require APPS_DIR.'/'.strtolower($app).'/urls.php';
			}
		}

		// Return alias
		foreach($iterable_urls as $iu) {
			if($alias_name == $iu['alias']) {
				return $this->convert_url($iu['pattern']);
			}
		}
	}

	public function convert_url($pattern) {
		return preg_replace_callback('#\{[A-z0-9]+\}#', array($this, 'convert_url_callback'), $pattern);
	}

	public function convert_url_callback($match) {
		$key = str_replace('{', '', str_replace('}', '', $match['0']));
		$value = $this->placeholders[$key];
		unset($this->placeholders[$key]);
		return $value;
	}

	public function getName() {
		return 'howdy_urls';
	}
}