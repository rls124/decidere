<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
 	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="Author" content="Ing. René Carlos Gumiel">
	<?php echo $this->Html->meta('favicon.ico','/img/favicon.ico',array('type' => 'icon')); ?>

	<?php
		$keywords = "analitycs";
		$cakeDescription = "DECIDERE";
		if (isset($cakeDescription)) {
			echo $this->Html->meta('description',$cakeDescription);
		} 
		if (isset($keywords)) {
			echo $this->Html->meta('keywords',$keywords);
		}

		echo $this->Html->css(array('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700')); 

		echo $this->Html->css(array('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'));

		//CSS toast, prompt, alert, notify 
		echo $this->Html->css(array('lobibox.min'));

		//CSS datetime picker
		echo $this->Html->css(array('jquery.datetimepicker'));

		//CSS sorter datatables for admin users
		echo $this->Html->css(array('jquery.dataTables.min'));

		//datatables plugin for export to xlsx, cvs, psd
		echo $this->Html->css(array('https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css'));

		//CSS Jquery UI
		echo $this->Html->css(array('jquery-ui.min')); 

		//CSS range slider 
		echo $this->Html->css(array('range-slider/css/normalize', 'range-slider/css/ion.rangeSlider', 'range-slider/css/ion.rangeSlider.skinModern' ));

		//CSS chosen
		echo $this->Html->css(array('chosen/chosen.min'	));

		//CSS select2
		echo $this->Html->css(array('select2/select2.min'	));

		//CSS bootstrap toggle bootstrap
		echo $this->Html->css(array('toggle/bootstrap-toggle.min'));

		echo $this->Html->css(array('bootstrap.min', 'animate', 'ihover.min', 'hover-min', 'custombox.min', 'template', 'template_media', 'template_ipad', 'template_iphone'));

		//sorter table dashboard
		echo $this->Html->css(array('table-sorter/theme.bootstrap.min'));

		//echo $this->Html->script(array('jquery-2.1.4.min'));

		echo $this->Html->script(array('jquery-1.9.1.min'));

		//jquery UI
		echo $this->Html->script(array('jquery-ui.min'));

		//Jquery UI touch
		echo $this->Html->script(array('jquery.ui.touch-punch.min'));

		echo $this->Html->script(array('select2/select2.full.min'));

		echo $this->Html->script(array('jquery.serializejson.min'));

		echo $this->Html->script(array('jquery.simple-sidebar.min'));

		echo $this->Html->script(array('easy-pie-chart/jquery.easypiechart.min'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<script type="text/javascript" src="https://core10.atlassian.net/s/d41d8cd98f00b204e9800998ecf8427e-T/y9kbzl/b/c/c8a734256c6dd2d1e4344e119e50264f/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=389b888f"></script>


	<!-- google analitycs code OLD-->
	<!--<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-59249118-1', 'auto');
		ga('send', 'pageview');

	</script>-->

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-59222259-6', 'auto');
		ga('send', 'pageview');

	</script>


	
	<div class="cover" id="wrapper">
		
		<?php 
			
			/* CORE10-SW-DEC-15 ... Added 'Shopping Cart formatting issues' */	
			//if shopping cart
			if ($this->Session->read('ShoppingCart')) {
				echo $this->Html->link('<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"><b>'.count($this->Session->read('ShoppingCart')).'</b></span>', array('controller' => 'Shop', 'action' => 'index', 'ext'=>'html'), array('escape'=>false, 'class'=>'flotante hvr-bounce-to-left',  'data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"Shopping cart (". count($this->Session->read('ShoppingCart')) . ")" )); 
			}
		?>

		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>	
		<?php echo $this->element('modals'); ?>
	</div>
	<footer>
		<?php //echo $this->element('footer', array($news, $companyData)); ?>
	</footer>

	<script type="text/javascript">var web_root =  <?php echo json_encode(  Router::url('/') . 'sounds/'  ); ?> ;</script>


	<?php 

		//expor to csv xls
		//echo $this->Html->script(array('csv/xlsx.core.min', 'csv/FileSaver.min', 'csv/tableexport.min'));
		// echo $this->Html->script(array('export/tableExport', 'export/jquery.base64'));
		// echo $this->Html->script(array('export/jspdf/libs/sprintf', 'export/jspdf/jspdf', 'export/jspdf/libs/base64'));
		
		//chose item multiple select in form scenario
		echo $this->Html->script(array('chosen/chosen.jquery.min'));
		
		//range slider for input range in scenario form
		echo $this->Html->script(array('range-slider/ion.rangeSlider.min'));

		//toggle control for user plan
		echo $this->Html->script(array('toggle/bootstrap-toggle.min'));
		
		//dialogs advanced, toast, promp, alert etc
		echo $this->Html->script(array('lobibox.min'));

		//date time picker
		echo $this->Html->script(array('jquery.datetimepicker.full.min'));
		
		//table sorter, paginator, search Admin - users
		echo $this->Html->script(array('jquery.dataTables.min'));

		//datatables plugin for export to xlsx, cvs, psd
		echo $this->Html->script(array(
			'https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js',
			'https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js',
			'https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js',
			'https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js',
			'https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js',
			'https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js'
		));

		//text area auto size
		echo $this->Html->script(array('autosize.min.js'));
		echo $this->Html->script(array('jquery.cookie.js'));
		//bootstrap
		echo $this->Html->script(array('bootstrap.min', 'legacy.min', 'custombox.min'));

		//format for price
		echo $this->Html->script(array('jquery.price_format.2.0.min'));

		//JS for table sorter dashboard
		echo $this->Html->script(array('table-sorter/jquery.tablesorter.min', 'table-sorter/jquery.tablesorter.widgets.min'/*, 'table-sorter/widget-cssStickyHeaders.min', 'table-sorter/widget-stickyHeaders.min'*/));
		
		echo $this->Html->script(array('scenarios'));
		echo $this->Html->script(array('script'));
		echo $this->Html->script(array('new_scenario'));
		echo $this->Html->script(array('edit_scenario'));
		echo $this->Html->script(array('run_scenario'));
		echo $this->Html->script(array('admin'));
		echo $this->Html->script(array('shop'));
		echo $this->Html->script(array('contact'));
		echo $this->Html->script(array('dashboard'));
		//echo $this->Html->script(array('test-jquery'));
		echo $this->Html->script(array('user'));
	?>
	
</body>
</html>
