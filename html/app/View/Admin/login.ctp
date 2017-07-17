<div class="container cover-img">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 a-side">
	<br />
	<br />
	<br />
	<br />
		<header class="forewhite">
			<h1>Login</h1>
			<h3 class="text-center">Your session has expired, please login again.</h3>
		</header>

		<section class="col-lg-offset-5 col-md-5 col-lg-2 col-md-2 col-sm-12 col-xs-12">
			<?php echo $this->Form->create('User', $options = array('url'=>array('controller'=>'Admin', 'action'=>'loginAjax'), 'id'=>'formLoginModal', 'class'=> 'form-2')); ?>
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
		</section>
	</div>
</div>
<!-- jQuery if needed -->
<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
<script type="text/javascript">
$(function(){
    $(".showpassword").each(function(index,input) {
        var $input = $(input);
        $("<p class='opt'/>").append(
            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
                var change = $(this).is(":checked") ? "text" : "password";
                var rep = $("<input placeholder='Password' type='" + change + "' />")
                    .attr("id", $input.attr("id"))
                    .attr("name", $input.attr("name"))
                    .attr('class', $input.attr('class'))
                    .val($input.val())
                    .insertBefore($input);
                $input.remove();
                $input = rep;
             })
        ).append($("<label for='showPassword'/>").text("Show password")).insertAfter($input.parent());
    });

    $('#showPassword').click(function(){
		if($("#showPassword").is(":checked")) {
			$('.icon-lock').addClass('icon-unlock');
			$('.icon-unlock').removeClass('icon-lock');    
		} else {
			$('.icon-unlock').addClass('icon-lock');
			$('.icon-lock').removeClass('icon-unlock');
		}
    });
});
</script>