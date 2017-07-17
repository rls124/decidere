<!--Modal login-->
<div class="modal fade bs-example-modal-sm" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 	<div class="modal-dialog modal-sm">
    	<div class="modal-content">
    		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h1 class="title-modal-login">Log In to your Decidere account</h1>
			</div>
			<?php echo $this->Form->create('User', $options = array('url'=>array('controller'=>'Admin', 'action'=>'loginAjax'), 'id'=>'formLoginModal')); ?>
				<div class="row">
					<?php echo $this->Form->input('username', $options = array('class'=>'form-login form-control', 'placeholder'=>"Username", 'div'=>false, 'label'=>false, 'id'=>'username-login')); ?>
				</div>
				<div class="row">
					<?php echo $this->Form->input('password', $options = array('class'=>'form-login form-control', 'placeholder'=>"Password", 'div'=>false, 'label'=>false)); ?>
				</div>
				<div class="row">
					<p class="status-login animated shake"></p>
				</div>
				<div class="row">
					<input type="checkbox" value="1" class="form-check" name="remember" id="remember"><label class="text-check-form" for="remember">Remember me</label>
				</div>
				<div class="row">
					<button type="submit" class="submit-login">
						<?php echo $this->Html->image('btn-login-form.png', $options = array('class'=>'', 'alt'=>'Login')); ?>
					</button>
					<a href="#" data-toggle="modal" data-target="#forgotModal" class="link-forgot-password text-right">Forgot Password</a>
				</div>	    
			<?php echo $this->Form->end(); ?>
    	</div>
  	</div>
</div>

<div class="modal fade bs-example-modal-sm" id="forgotModal"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 	<div class="modal-dialog modal-sm">
    	<div class="modal-content">
	    		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1 class="title-modal-login">Forgotten Password</h1>
				<p>Please enter the email address you have associated with your Decidere account.</p>
				<p>An email with additional instructions will be sent to that email address.</p>
			<?php echo $this->Form->create('User', $options = array('url'=>array('controller'=>'Admin', 'action'=>'forgotAjax'), 'id'=>'formForgotModal')); ?>
				<div class="row">
					<?php echo $this->Form->input('email', $options = array('class'=>'form-login form-control', 'placeholder'=>"Email address", 'div'=>false, 'label'=>false, 'id'=>'email-forgot')); ?>
				</div>
				<div class="row">
					<button type="submit" class="btn btn-default btn-orange">Submit</button>
				</div>	    
			<?php echo $this->Form->end(); ?>
    	</div>
  	</div>
</div>


<script type="text/javascript">
	/* CORE10-SW-DEC-31 */
	$(function(){
		/* Check Cookies on Load */
		var isChecked = $.cookie("loginRememberMe");
		if (isChecked == 'true') {
			$("#remember").attr('checked','checked')
			$("input[name='data[User][username]']").val($.cookie('loginUsername'));
			$("input[name='data[User][password]']").val($.cookie('loginPassword'));
		}
		
		/* Write Cookies on Submit */
		$('.submit-login').click(function(event){
		    if(isChecked){
		        $.cookie('loginRememberMe',true, { path:'/', expires: 365 });
		        $.cookie('loginUsername',$("input[name='data[User][username]']").val(), { path:'/', expires: 365 });
		        $.cookie('loginPassword',$("input[name='data[User][password]']").val(), { path:'/', expires: 365 });
		    } else {
		        $.cookie('loginRememberMe',false, { path:'/', expires: 365 });
		        $.cookie('loginUsername', '', { path:'/', expires: 365 }); 
		        $.cookie('loginPassword', '', { path:'/', expires: 365 }); 
		    }
		});
		
	})
</script>


<!--End modal login-->

<!--Modal login-->
<div class="modal fade bs-example-modal-sm" id="modal-contact"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h1 class="title-modal-login-contact">Contact Us</h1>
			</div>
			<?php echo $this->Form->create('Contact', array( 'url'=>array('controller'=>'Ajax', 'action'=>'contact'), 'id'=>'form-contact' )); ?>
				<div class="row">
					<?php echo $this->Form->input('first_name', $options = array('class'=>'form-login form-control', 'placeholder'=>"First name*", 'div'=>false, 'label'=>false, 'required'=>'required')); ?>
				</div>
				<div class="row">
					<?php echo $this->Form->input('last_name', $options = array('class'=>'form-login form-control', 'placeholder'=>"Last name*", 'div'=>false, 'label'=>false, 'required'=>'required')); ?>
				</div>
				<div class="row">
					<?php echo $this->Form->input('email', $options = array('class'=>'form-login form-control', 'placeholder'=>"Email*", 'div'=>false, 'label'=>false, 'required'=>'required')); ?>
				</div>
				<div class="row">
					<?php echo $this->Form->input('phone', $options = array('class'=>'form-login form-control', 'placeholder'=>"Phone*", 'div'=>false, 'label'=>false, 'required'=>'required')); ?>
				</div>
				<div class="row">
					<?php echo $this->Form->input('subject', $options = array('class'=>'form-login form-control', 'div'=>false, 'label'=>false, 'required'=>'required', 'type'=>'select', 'options' => array('1'=>'I want to use my own data', '2'=>'Payment Issues', '3'=>'Registration Issues', '4'=>'Issues running scenarios', '5'=>'Other' ) )); ?>
				</div>
				<div class="row">
					<?php echo $this->Form->input('message', $options = array('class'=>'form-login form-control', 'placeholder'=>"Message*", 'div'=>false, 'label'=>false, 'required'=>'required', 'type'=>'textarea')); ?>
				</div>
				<div class="row text-right">
					<button type="submit" class="submit-contact">
						Send
					</button>
				</div>	    
			<?php echo $this->Form->end(); ?>
    	</div>
  	</div>
</div>
<!--End modal login-->

<!--Modal Financial-->
<div class="modal fade bs-example-modal-sm" id="financialModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 	<div class="modal-dialog ">
    	<div class="modal-content white">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1 class="white">Financial Products</h1>
    		</div>
			<div class="info">
	        	<div class="line-info-back-datasets"></div>
	        	<p>Building a comprehensive portfolio that meets your clients’ goals takes a lot of time and research.  Many financial advisors still rely on subjective analysis, basic filtering, or wholesaler recommendations to make investment product recommendations.  With Decidere, you can build your own customized scenarios for a variety of client goals and use them over and over with one click.  You will always find the best products for the current market environment without the hours of research.</p>
	    	</div>
    	</div>
  	</div>
</div>
<!--End modal Financial-->


<!--Modal Automobiles-->
<div class="modal fade bs-example-modal-sm" id="automobilesModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 	<div class="modal-dialog">
    	<div class="modal-content white">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1 class="white">Automobiles</h1>
    		</div>
			<div class="info">
	        	<div class="line-info-back-datasets"></div>
	        	<p>Looking for your next vehicle?  Whether you are looking to upgrade to something sportier, the perfect transportation for your growing family or daily commute, you will have specific criteria that are important to you.  Automobile search sites today require that you already know what make or model you want before you search.  Decidere is different; you set the criteria that are most and least important to you such as fuel economy, seating, price and even the paint color; we find the car.</p>
	    	</div>
    	</div>
  	</div>
</div>
<!--End modal Automobiles-->

<!--Modal Real State-->
<div class="modal fade bs-example-modal-sm" id="realEstateModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 	<div class="modal-dialog ">
    	<div class="modal-content white">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1 class="white">Real Estate</h1>
    		</div>
			<div class="info">
	        	<div class="line-info-back-datasets"></div>
	        	<p>Looking for your next vehicle?  Whether you are looking to upgrade to something sportier, the perfect transportation for your growing family or daily commute, you will have specific criteria that are important to you.  Automobile search sites today require that you already know what make or model you want before you search.  Decidere is different; you set the criteria that are most and least important to you such as fuel economy, seating, price and even the paint color; we find the car.</p>
	    	</div>
    	</div>
  	</div>
</div>
<!--End modal Real State-->

<!--Modal Appliances-->
<div class="modal fade bs-example-modal-sm" id="appliancesModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 	<div class="modal-dialog ">
    	<div class="modal-content white">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1 class="white">Appliances</h1>
    		</div>
			<div class="info">
	        	<div class="line-info-back-datasets"></div>
	        	<p>With dozens of brands, hundreds of styles and literally thousands of feature options, finding the best appliances for your home or your lifestyle can be overwhelming.  We built a comprehensive database of appliances on the market today. Find the best one for you, leave it to the stores to provide the best price – at least you’ll know exactly what you want when you walk in.</p>
	    	</div>
    	</div>
  	</div>
</div>
<!--End modal Appliances-->

<!--Modal Insurance-->
<div class="modal fade bs-example-modal-sm" id="insuranceModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 	<div class="modal-dialog ">
    	<div class="modal-content white">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1 class="white">Insurance</h1>
    		</div>
			<div class="info">
	        	<div class="line-info-back-datasets"></div>
	        	<p>These days we are inundated with marketing from insurance companies claiming to have the lowest rates, the most reliable claims experience, and the best perks.  Many will offer to provide comparative quotes in order to win you over.  When you get down to it, finding the right insurance match for you is complicated.  You can compare all the criteria here, no strings attached.</p>
	    	</div>
    	</div>
  	</div>
</div>
<!--End modal Insurance-->


<!--Modal Recreational Vehicles-->
<div class="modal fade bs-example-modal-sm" id="recreationalVehiclesModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 	<div class="modal-dialog ">
    	<div class="modal-content white">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1 class="white">Recreational Vehicles</h1>
    		</div>
			<div class="info">
	        	<div class="line-info-back-datasets"></div>
	        	<p>When you are looking to buy something fun, the experience shouldn’t be stressful or exhausting. First time buyers and avid recreationalists alike can find the perfect toy for them by setting criteria that are important in the Decidere system and then submitting for results.  You get a ranked list of available options starting with the best fit for your needs.</p>
	    	</div>
    	</div>
  	</div>
</div>
<!--End modal Recreational Vehicles-->

<!--Modal custom dataset-->
<div class="modal fade bs-example-modal-sm" id="customDatasetsModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 	<div class="modal-dialog ">
    	<div class="modal-content white">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1 class="white">Custom Dataset for Enterprise</h1>
    		</div>
			<div class="info">
	        	<div class="line-info-back-datasets"></div>
	        	<p>Your data, your way.  Our algorithm can be dynamically applied to any set of data and configured to meet your business objectives.</p>
	    	</div>
    	</div>
  	</div>
</div>
<!--End modal custom dataset-->


<!--Modal coupon-->
<div class="modal fade bs-example-modal" id="modalCoupon" tabindex="-1" role="dialog" aria-labelledby="modalCoupon">
 	<div class="modal-dialog">
    	<div class="modal-content">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    		<div class="modal-header text-center">
				<p class="subtitle-dashboard" style="text-align: center;">Add coupon code</p>
    		</div>
			<?php echo $this->Form->create(null, $options = array( 'url' => array('controller' => 'Ajax', 'action' =>'checkCoupons' ), 'id' => 'form-check-coupon'  )); ?>
				<div class="input-group">
					<input type="text" class="form-control" autocomplete="off" name="coupon">		 		
			      	<span class="input-group-btn">
			        	<button class="btn btn-primary btn-newScenario" type="submit">Check</button>
			      	</span>
			    </div>
			    <p id="coupon-not-found" class="status-check-coupon animated shake"></p>
		    <?php echo $this->Form->end(); ?>
    	</div>
  	</div>
</div>
<!--End modal coupon-->

<!--Modal shopping message-->
<div class="modal fade" id="shoppingMessageModal" tabindex="-1" role="dialog">
 	<div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-body">
				<p>Thank you for registering for a Decidere account! </p>
	        	<p>All datasets that are currently available for analysis are listed by market segment in the menu below. You may subscribe to any datasets by selecting either a monthly or annual subscription. 
				</p>
				<p>Want to try it out first? Get started now on one of our demo datasets by going to your <?php echo $this->Html->link('My Dashboard', array('controller' => 'User', 'action' => 'dashboard'), array('class'=>'link-dashboard')); ?> now.</p>
	    	</div>
	    	<div class="modal-footer">
	    		<div class="checkbox confirmShoppingMessage">
  					<label><input type="checkbox" id="confirmShoppingMessageCheckbox">Don't show me this message again</label>
				</div>
        		<button type="button" id="btnconfirmShoppingMessage" class="btn btn-default" data-dismiss="modal">Ok</button>
			</div>
    	</div>
  	</div>
</div>
<!--Modal shopping message-->

<!--Modal dashboard message-->
<div class="modal fade" id="dashboardMessageModal" tabindex="-1" role="dialog">
 	<div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-body">
	        	<p>Welcome to your personalized Decidere dashboard! Here you can create new scenarios or run your saved favorite scenarios on any demo datasets or the datasets to which you have subscribed. 
				</p>
				<p>If you have not subscribed to any datasets, you may do so by clicking <?php echo $this->Html->link('here', array('controller' => 'Register', 'action' => 'selectDataset'), array('class'=>'link-dashboard')); ?></p>
	    	</div>
	    	<div class="modal-footer">
	    		<div class="checkbox confirmDashBoardMessage">
  					<label><input type="checkbox" id="confirmCheckbox">Don't show me this message again</label>
				</div>
        		<button type="button" id="btnDashBoardMessage" class="btn btn-default" data-dismiss="modal">Ok</button>
      		</div>
    	</div>
  	</div>
</div>
<!--Modal dashboard message-->

<!--Modal run scenario-->
<div class="modal fade" id="runScenarioModal" tabindex="-1" role="dialog">
 	<div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-body">
	        	<p>Save your Favorites by selecting any records you wish to save to your dashboard and click the green "Save" button.  You will be prompted to name your saved scenario. </p>
	    	</div>
	    	<div class="modal-footer">
	    		<div class="checkbox confirmRunScenarioMessage">
  					<label><input type="checkbox" id="runScenarioConfirmCheckbox">Don't show me this message again</label>
				</div>
        		<button type="button" id="btnRunScenarioMessage" class="btn btn-default" data-dismiss="modal">Ok</button>
      		</div>
    	</div>
  	</div>
</div>
<!--Modal run scenario-->

<!--Modal edit scenario-->
<div class="modal fade" id="editScenarioModal" tabindex="-1" role="dialog">
 	<div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-body">
	        	<p>Save your Favorites by selecting any records you wish to save to your dashboard and click the green "Save" button.  You will be prompted to name your saved scenario. </p>
	    	</div>
	    	<div class="modal-footer">
	    		<div class="checkbox confirmEditScenarioMessage">
  					<label><input type="checkbox" id="editScenarioConfirmCheckbox">Don't show me this message again</label>
				</div>
        		<button type="button" id="btnEditScenarioMessage" class="btn btn-default" data-dismiss="modal">Ok</button>
      		</div>
    	</div>
  	</div>
</div>
<!--Modal edit scenario-->


<!-- CORE10-SW-DEC-21-->
<!--Modal Purchase Responder -->
<div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog">
 	<div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-body">
				<h3>Purchase Information</h3>
	        	<p>Products sold as &quot;30, 60 or 90 days free&quot; will not be charged to your card until the end of the trial period.</p>
	    	</div>
	    	<div class="modal-footer">
		    	
        		<button type="button" id="btnPurchaseModal" class="btn btn-default" data-dismiss="modal">Ok</button>
      		</div>
    	</div>
  	</div>
</div>
<!--Modal edit scenario-->

<div class="content-spinner animated zoomIn">
	<?php echo $this->Html->image('sppiner.gif', $options = array()); ?>
</div>