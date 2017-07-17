<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class NewsController extends AppController {


	public $uses = array('User');
	public $helpers = array('Js', 'Session');
	public $components = array('RequestHandler');
	
	public function index() {
		$title_for_layout = "DECIDERE | NEWS";
		$this->set(compact('title_for_layout'));
		$this->set('_serialize', array('title_for_layout'));
	}
}
