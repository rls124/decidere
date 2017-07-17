<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::import('Vendor', 'HttpClient', array('file' => 'HttpClient.class.php'));
App::import('Vendor', 'Stripe', array('file' => 'stripe-php-3.15.0/init.php'));

class InfoController extends AppController { 



	var $name = "Info";

	public $uses = array('User', 'Dataset', 'Scenario', 'Provider', 'Favorite', 'Mapping', 'Category', 'Info', 'Plan', 'UserProvider', 'UserPlan', 'Coupon', 'UserDataset');
	public $helpers = array('Js', 'Session');
	public $components = array('RequestHandler');


	public function __index() {
        $this->set('infos', $this->Info->find('all'));  // here the change Contacts to Contact.
    }	



	public function index() {
		
	}


	//delete
	public function delete($id = null, $type = null, $id_url=null) {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('controller'=>'Admin', 'action'=>'login'));
	    }
		$flag = false;
		$model = "";
		$message = "";
		$url = "";
		switch ($type) {
			case 'scenario':
				$model = 'Scenario';
				$flag = true;
				$message = 'The scenario';
				$url = "dashboard";
				break;

			default:
				return $this->redirect(array('action' => 'index'));
				break;
		}

		if ($flag==true) {
			$this->$model->id = $id;
			if (!$this->$model->exists()) {
				$this->Session->setFlash(__($message.' no valid'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->$model->delete($id, true)) {
				$this->Session->setFlash(( $message.'  was successfully deleted.'));
			} else {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$message.' no pudo eliminarse.'), 'default', array('class'=>'alert alert-danger alert-dismissible fade in'));
			}
			return $this->redirect(array('action' => $url));
		} else {
			return $this->redirect(array('action' => $url));
		}		
	}


}