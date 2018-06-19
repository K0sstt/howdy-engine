<?php 

class News_Controller extends Controller {
	public function main($args) {
		$news_list = array();

		render('main', array(
			'news_list' => $news_list));
	}

	public function read($args) {
		$news_object = $args['1'];

		render('read', array(
			'news_object' => $news_object,
			'id' => $args['1']));
	}
}