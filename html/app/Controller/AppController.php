<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {


	// //this is for secure action on PROD, ONLY FOR PROD
	// protected $secureActions = array(
	//        'select_dataset',
	//        'index',
	//        'save_token',
	//        'account'
	//    );

	// //Stripe API KEY DECIDERE account
	// //public $stripeApiKey = "sk_live_zia5qTrEUs8qeuxNrxpSYvzI";
	// public $stripeApiKey = "pk_live_oOipIA6iDhI2l3zNm1MblNqC";
	// //Stripe publishable API KEY DECIDERE account
	// public $stripePublishableApiKey = "pk_live_oOipIA6iDhI2l3zNm1MblNqC";

	// TEST Keys Stripe API KEY necogumiel account
/*
 	public $stripeApiKey = "sk_live_TdEkDp6dDaFb1qQb1ETwlRLA";
	public $stripePublishableApiKey = "pk_live_oOipIA6iDhI2l3zNm1MblNqC";
*/

/*
	public $stripeApiKey = "sk_test_cFF1e0cX2SSgFTFpq59SKJGM";
	public $stripePublishableApiKey = "pk_test_PEoEyhVLt0HKhoTOlrGphbr6";
*/

	public function stripeLive() {
	 	$this->stripeApiKey = "sk_live_TdEkDp6dDaFb1qQb1ETwlRLA";
		$this->stripePublishableApiKey = "pk_live_oOipIA6iDhI2l3zNm1MblNqC";
	}	

	public function stripeTest() {
		$this->stripeApiKey = "sk_test_cFF1e0cX2SSgFTFpq59SKJGM";
		$this->stripePublishableApiKey = "pk_test_PEoEyhVLt0HKhoTOlrGphbr6";
	}	



	//base url for R server
	public $baseUrlRServer = "https://r.decidere.com/";

	//url for get Dataset List
	public $urlDatasetList = 'cgi-bin/R/datasetList';

	//url for get column info
	public $urlColumnInfo = 'cgi-bin/R/columnInfo';

	//url for get screenable list
	public $urlScreenableLists = 'cgi-bin/R/screenableLists';

	//url for process
	public $urlRProcess = 'cgi-bin/R/process';


	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'Admin',
				'action' => 'dashboard'
				),
			'logoutRedirect' => array(
				'controller' => 'Home',
				'action' => 'index'
				)
		)
	);

	public function beforeFilter() {
		$this->Auth->allow();

		$this->urlDatasetList = $this->baseUrlRServer . $this->urlDatasetList;

		$this->urlColumnInfo = $this->baseUrlRServer . $this->urlColumnInfo;

		$this->urlScreenableLists = $this->baseUrlRServer . $this->urlScreenableLists;

		$this->urlRProcess = $this->baseUrlRServer . $this->urlRProcess;
		if(!$this->request->is('ssl')){
			$this->redirect('https://' . env('SERVER_NAME') . $this->here);
		}

		
		/* Choose StripeApiKeys, true = live, false = test */
		if (true) {
			$this->stripeLive();
		} else {
			$this->stripeTest();
		}

		// //this is for secure action on PROD, ONLY FOR PROD
		// if (in_array($this->params['action'], $this->secureActions) 
		//           && !isset($_SERVER['HTTPS'])) {
		//               $this->forceSSL();
		//       }
	}


	// //this is for secure action on PROD, ONLY FOR PROD
	// public function forceSSL() {
	//     $this->redirect('https://' . $_SERVER['SERVER_NAME'] . $this->here);
	// }


}
