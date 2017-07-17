<script type="text/javascript">var urlSetOrderUserProvider =  <?php echo '"' . Router::url(['controller' => 'Ajax', 'action' => 'setOrderUserProvider']) . '"'; ?>  ;</script>
<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
</section>
<!--END COVER-->
<br />

<section id="shopping-cart">
	<div class="row">
			<div class="col-md-offset-4 col-md-4 col-sm-12">
				
				<?php if ($error_message != "") { ?>
					<h1 class="title-dashboard"><?php echo $error_message; ?></h1>
				<?php } else { ?>
				
					<h1 class="title-dashboard">Decidere Password Reset</h1>
					<div class="p20">
	
					<?php echo $this->Form->create('User', $options = array('url'=>array('controller'=>'reset', 'action'=>'reset'), 'id'=>'passwordForm', 'class'=> 'form-2')); ?>
						<?php echo $this->Form->input('id', $options = array('type'=>"hidden", 'label'=>false, 'value'=>$user['User']['id'])); ?>
						<?php echo $this->Form->input('reset_key', $options = array('type'=>"hidden", 'label'=>false, 'value'=>$user['User']['reset_key'])); ?>

						<div class="row">
							<h1>Decidere Password Reset</h1>
						</div>
						<div class="row">
							<?php echo $this->Form->input('new_password', $options = array('class'=>'form-login form-control', 'placeholder'=>"New Password",'type'=>'password')); ?>
						</div>
						<div class="row">
							<?php echo $this->Form->input('confirm_password', $options = array('class'=>'form-login form-control', 'placeholder'=>"Confirm New Password",'type'=>'password')); ?>
						</div>
						<div class="row">
							<button type="submit" class="submit-login btn btn-orange">Submit</button>
						</div>	    
						<?php echo $this->Form->end(); ?>
						
					</div>		
				<?php } ?>		
				<div class="p20">
					<div class="row">
						<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-0 col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
							<p class="text-foot-register">Decidere is a product of Decidere Analytics, LLC Fort Wayne, Indiana 46802</p>
						</div>
					</div>
				</div>
			</div>
	</div>
</section>
<?php echo $this->element('side_nav', array('viewName' => 'Dashboard')); ?>



<script>
	$(function(){
		
		$('form#passwordForm').submit(function(){

			var error_message = "";			
			var password = $('input#UserNewPassword').val();
			var confirm_password = $('input#UserConfirmPassword').val();
			
			if (password.length < 8) {
	            Lobibox.alert('warning', {
	                msg: "The password you have entered is too short. A minimum of 8 characters is required, please try again."
	            });				
				return false;
			} else if (password != confirm_password) {
	            Lobibox.alert('warning', {
	                msg: "The passwords you have entered do not match, please re-enter your passwords."
	            });				
				return false;
			}
			
			return true;			
			
		});
		
	});
	function getUrlParameter(sParam) {
	    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
	        sURLVariables = sPageURL.split('&'),
	        sParameterName,
	        i;
	
	    for (i = 0; i < sURLVariables.length; i++) {
	        sParameterName = sURLVariables[i].split('=');
	
	        if (sParameterName[0] === sParam) {
	            return sParameterName[1] === undefined ? true : sParameterName[1];
	        }
	    }
	};

	$('a[data-toggle="tab"]').on('click',function(){
		var tab = $(this).attr("id");
			tab = tab.substr(1,tab.length-1);		
			history.pushState(null,null,'?tab='+tab);
	})
	
	
	$(function(){
		var tab = getUrlParameter("tab");
		if (typeof tab != 'undefined') {
			$('li[role="tab"]').removeClass('active');
			$('div[role="tabpanel"]').removeClass('active').hide();
			$('#_'+tab).closest('li').addClass('active');
			$('#'+tab).addClass('active').show();;
			
		}
	})
	
</script>

