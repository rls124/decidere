<script type="text/javascript">var urlSetOrderUserProvider =  <?php echo '"' . Router::url(['controller' => 'Ajax', 'action' => 'setOrderUserProvider']) . '"'; ?>  ;</script>
<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
</section>
<!--END COVER-->
<br />

<section id="shopping-cart">
	<div class="row">
		<h1 class="title-dashboard">Decidere Password Reset</h1>
		<div class="col-md-12">
			<div class="container container-background">
				<div class="p20">
				<div class="row">
					<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-0 col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
						<p class="text-foot-register">Decidere is a product of Decidere Analytics, LLC Fort Wayne, Indiana 46802</p>
					</div>
				</div>
	
				</div>
			</div>
		</div>
	</div>

</section>

<?php echo $this->element('side_nav', array('viewName' => 'Dashboard')); ?>



<script>
	
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

