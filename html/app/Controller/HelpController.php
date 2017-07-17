<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class HelpController extends AppController {

	public $uses = array('User');
	public $helpers = array('Js', 'Session');
	public $components = array('RequestHandler');
	
	public function index() {
		$title_for_layout = "DECIDERE | HELP";
		$this->set(compact('title_for_layout'));
		$this->set('_serialize', array('title_for_layout'));
	}

	public function faq() {
		$title_for_layout = "DECIDERE | F.A.Q.";
		$this->set(compact('title_for_layout'));
		$this->set('_serialize', array('title_for_layout'));
	}
	
}
