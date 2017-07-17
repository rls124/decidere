<?php

App::uses('AppController', 'Controller');

class AdministratorController extends AppController {

	var $layout = 'admin';

	public $uses = array('User', 'Testimonial', 'Slider', 'Environment', 'GoodLife', 'Novelty', 'Package', 'CompanyData', 'EnvironmentImage');
	public $helpers = array('Js', 'Session');
	public $components = array('RequestHandler');


	public function beforeFilter() {
		$this->Auth->allow('index','logout','login','registerUser');
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
			return $this->redirect($this->Auth->redirect());
			}
		$this->Session->setFlash(__('Usuario o contraseña incorrecto, por favor intenta nuevamente!'));
		 return $this->redirect(array('action' => 'index'));	
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	public function index(){
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->CompanyData->create();
			if ($this->CompanyData->save($this->request->data)) {
				$this->Session->setFlash(('La información se guardo correctamente.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(('La información no pudo guardarse.'));
				return $this->redirect(array('action' => 'index'));
			}
		}
		$companyData = $this->CompanyData->find('first', array('conditions'=>array('CompanyData.id'=>'1')));
		$this->set(compact('companyData'));
		$this->set('_serialize', array('companyData'));
	}

	/*public function registerUser(){
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('usuario registrado'));
				return $this->redirect(array('action'=>'login'));
			} else {
				$this->Session->setFlash(__('Error en el registro de usuario'));
				return $this->redirect(array('action'=>'login'));
			}
		}
	}*/

	public function site() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->CompanyDatum->create();
			if ($this->CompanyDatum->save($this->request->data)) {
				$this->Session->setFlash(('La información se guardo correctamente.'));
				return $this->redirect(array('action' => 'site'));
			} else {
				$this->Session->setFlash(('La información no pudo guardarse.'));
				return $this->redirect(array('action' => 'site'));
			}
		}
		$companyData = $this->CompanyDatum->find('first', array('conditions'=>array('CompanyDatum.id'=>'1')));
		$this->set(compact('companyData'));
		$this->set('_serialize', array('companyData'));
	}

	public function contact() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->CompanyDatum->create();
			if ($this->CompanyDatum->save($this->request->data)) {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>La información se guardo correctamente.'), 'default', array('class'=>'alert alert-success alert-dismissible fade in'));
				return $this->redirect(array('action' => 'contact'));
			} else {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>La información no pudo guardarse.'), 'default', array('class'=>'alert alert-danger alert-dismissible fade in'));
				return $this->redirect(array('action' => 'contact'));
			}
		}
		$companyData = $this->CompanyDatum->find('first', array('conditions'=>array('CompanyDatum.id'=>'1')));
		$this->set(compact('companyData'));
		$this->set('_serialize', array('companyData'));
	}

	public function slider() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->Slider->create();
			if ($this->Slider->save($this->request->data)) {
				$this->Session->setFlash(('La imágen se guardo correctamente.'));
				return $this->redirect(array('action' => 'slider'));
			} else {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>La imágen no pudo guardarse.'), 'default', array('class'=>'alert alert-danger alert-dismissible fade in'));
				return $this->redirect(array('action' => 'slider'));
			}
		} 
	    $sliders = $this->Slider->find('all');
		$this->set(compact('sliders'));
		$this->set('_serialize', array('sliders'));
	}

	public function news() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->Novelty->create();
			if ($this->Novelty->save($this->request->data)) {
				$this->Session->setFlash(('La novedad se guardo correctamente.'));
				return $this->redirect(array('action' => 'news'));
			} else {
				$this->Session->setFlash(('La novedad no pudo guardarse.'));
				return $this->redirect(array('action' => 'news'));
			}
		} 
	    $news = $this->Novelty->find('all');
		$this->set(compact('news'));
		$this->set('_serialize', array('news'));
	}

	public function packages() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->Package->create();
			if ($this->Package->save($this->request->data)) {
				$this->Session->setFlash(('El paquete se guardo correctamente.'));
				return $this->redirect(array('action' => 'packages'));
			} else {
				$this->Session->setFlash(('El paquete no pudo guardarse.'));
				return $this->redirect(array('action' => 'packages'));
			}
		} 
	    $packages = $this->Package->find('all', array('order'=>array('Package.id'=>'DESC')));
		$this->set(compact('packages'));
		$this->set('_serialize', array('packages'));
	}

	public function goods() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->GoodLife->create();
			if ($this->GoodLife->save($this->request->data)) {
				$this->Session->setFlash(('El item de buen vivir se guardo correctamente.'));
				return $this->redirect(array('action' => 'goods'));
			} else {
				$this->Session->setFlash(('El item de buen vivir no pudo guardarse.'));
				return $this->redirect(array('action' => 'goods'));
			}
		} 
	    $goods = $this->GoodLife->find('all', array('recursive'=>1, 'order'=>array('GoodLife.id'=>'DESC')));
		$this->set(compact('goods'));
		$this->set('_serialize', array('goods'));
	}

	public function environments() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->Environment->create();
			if ($this->Environment->save($this->request->data)) {
				$this->Session->setFlash(('La galeria de instalaciones se guardo correctamente.'));
				return $this->redirect(array('action' => 'environments'));
			} else {
				$this->Session->setFlash(('La galeria de instalaciones no pudo guardarse.'));
				return $this->redirect(array('action' => 'environments'));
			}
		} 
	    $environments = $this->Environment->find('all');
		$this->set(compact('environments'));
		$this->set('_serialize', array('environments'));
	}

	public function testimonials() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->Testimonial->create();
			if ($this->Testimonial->save($this->request->data)) {
				$this->Session->setFlash(('El testimonio guardo correctamente.'));
				return $this->redirect(array('action' => 'testimonials'));
			} else {
				$this->Session->setFlash(('El testimonio pudo guardarse.'));
				return $this->redirect(array('action' => 'testimonials'));
			}
		} 
	    $testimonials = $this->Testimonial->find('all', array('order'=>array('Testimonial.id'=>'DESC') ));
		$this->set(compact('testimonials'));
		$this->set('_serialize', array('testimonials'));
	}

	public function environmentEdit($id = null) {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->Environment->create();
			if ($this->Environment->save($this->request->data)) {
				$this->Session->setFlash(('La galeria de instalaciones se guardo correctamente.'));
				return $this->redirect(array('action' => 'environmentEdit', $this->request->data['Environment']['id']));
			} else {
				$this->Session->setFlash(('La galeria de instalaciones no pudo guardarse.'));
				return $this->redirect(array('action' => 'environmentEdit', $this->request->data['Environment']['id']));
			}
		}
	    $environment = $this->Environment->find('first', array('recursive'=>1, 'conditions'=>array('Environment.id'=>$id)));
		$this->set(compact('environment'));
		$this->set('_serialize', array('environment'));
	}

	public function saveEnvironmentImage() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is('ajax')) {
	    	if (count($this->request->data['EnvironmentImage']['image'])>0) {
	    		$limit = 0;
			    for ($i=0; $i<count($this->request->data['EnvironmentImage']['image']); $i++) {
			    	$data = array('EnvironmentImage'=>array('id'=>'', 'image'=>$this->request->data['EnvironmentImage']['image'][$i], 'environment_id'=>$this->request->data['EnvironmentImage']['environment_id'] ));				
					$this->EnvironmentImage->save($data);
					$limit++;
			    }
	    	}

			$images = $this->EnvironmentImage->find('all', array('limit'=> $limit, 'order'=>array('EnvironmentImage.id'=>'DESC') ));	
			$this->set(compact('images'));
			$this->set('_serialize', array('images'));
	    }
	}

	public function getColorViews() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is('ajax')) {
			$id=$this->request->data('id'); 
	    	$views = $this->ColorImage->find('all', array('order'=>array('ColorImage.id'=>'DESC'), 'conditions'=>array('ColorImage.color_id'=>$id)));
	    }
		$this->set(compact('views'));
		$this->set('_serialize', array('views'));
	}

	public function saveColorImage() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is('ajax')) {
			$last_id = $this->ColorImage->find('first', array('order'=>array('ColorImage.id'=>'DESC')));
	    	if (count($this->request->data['ColorImage']['image'])>0) {
			    for ($i=0; $i<count($this->request->data['ColorImage']['image']); $i++) {
			    	$data = array('ColorImage'=>array('id'=>'', 'image'=>$this->request->data['ColorImage']['image'][$i], 'color_id'=>$this->request->data['ColorImage']['color_id'], 'product_id'=>$this->request->data['ColorImage']['product_id'], 'item_id'=>$this->request->data['ColorImage']['item_id']));				
					$this->ColorImage->save($data);
			    }
	    	}
	    }
		$id=$this->request->data['ColorImage']['color_id']; 
		$views = $this->ColorImage->find('all', array('order'=>array('ColorImage.id'=>'DESC'), 'conditions'=>array('AND'=>array('ColorImage.color_id'=>$id), 'AND' => array('ColorImage.id >'=>$last_id['ColorImage']['id']))));	
	    //$views = $this->request->data;
		$this->set(compact('views'));
		$this->set('_serialize', array('views'));
	}

	public function deleteEnvironmentImage() {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }

	    	if ($this->request->is('ajax')) {
		    	$id = $this->request->data['id'];
		    	$this->EnvironmentImage->id = $id;
		    	if ($this->EnvironmentImage->delete()) {
					$response = array('res'=>'success');
					$this->set(compact('response'));
					$this->set('_serialize', array('response'));				
				} else {
					$response = array('res'=>'error');
					$this->set(compact('response'));
					$this->set('_serialize', array('response'));				
				}
	    	 	
	    	}
	    
	}

	public function deleteView($id=null) {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($id != null) {
	    	$this->ColorImage->id = $id;
	    	if ($this->ColorImage->delete()) {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>La imagen se elimino correctamente.'), 'default', array('class'=>'alert alert-info alert-dismissible fade in'));
			} else {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>La imagen no pudo eliminarse.'), 'default', array('class'=>'alert alert-danger alert-dismissible fade in'));
			}
	    }
	    return $this->redirect(array('action' => 'products'));
	}

	public function deleteColor($id=null) {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($id != null) {
	    	$this->Color->id = $id;
	    	if ($this->Color->delete()) {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>El Color se elimino correctamente.'), 'default', array('class'=>'alert alert-info alert-dismissible fade in'));
			} else {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>El Color no pudo eliminarse.'), 'default', array('class'=>'alert alert-danger alert-dismissible fade in'));
			}
	    }
	    return $this->redirect(array('action' => 'products'));

	}

	public function deleteItem($id=null) {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($id != null) {
	    	$this->Item->id = $id;
	    	if ($this->Item->delete()) {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>El item se elimino correctamente.'), 'default', array('class'=>'alert alert-info alert-dismissible fade in'));
			} else {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>El item no pudo eliminarse.'), 'default', array('class'=>'alert alert-danger alert-dismissible fade in'));
			}
	    }
	    return $this->redirect(array('action' => 'products'));

	}


	public function delete($id = null, $type = null, $id_url=null) {
		if($this->Session->read('Auth.User.role')!='admin') {
	    	return $this->redirect(array('action'=>'login'));
	    }
		$flag = false;
		$model = "";
		$message = "";
		$url = "";
		switch ($type) {
			case 'slider':
				$model = 'Slider';
				$flag = true;
				$message = 'La imagen';
				$url = "slider";
				break;

			case 'novelty':
				$model = 'Novelty';
				$flag = true;
				$message = 'La novedad';
				$url = "news";
				break;

			case 'package':
				$model = 'Package';
				$flag = true;
				$message = 'El paquete';
				$url = "packages";
				break;

			case 'goodlife':
				$model = 'GoodLife';
				$flag = true;
				$message = 'El item de buen vivir';
				$url = "goods";
				break;

			case 'environment':
				$model = 'Environment';
				$flag = true;
				$message = 'La instalación';
				$url = "environments";
				break;

			case 'testimonial':
				$model = 'Testimonial';
				$flag = true;
				$message = 'El testimonio';
				$url = "testimonials";
				break;

			default:
				return $this->redirect(array('action' => 'index'));
				break;
		}

		if ($flag==true) {
			$this->$model->id = $id;
			if (!$this->$model->exists()) {
				$this->Session->setFlash(__($message.' no valida'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->$model->delete()) {
				//$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$message.' se elimino correctamente.'), 'default', array('class'=>'alert alert-info alert-dismissible fade in'));
				$this->Session->setFlash(( $message.' se elimino correctamente.'));
			} else {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$message.' no pudo eliminarse.'), 'default', array('class'=>'alert alert-danger alert-dismissible fade in'));
			}
			return $this->redirect(array('action' => $url));
		} else {
			return $this->redirect(array('action' => $url));
		}		
	}
}
