<?php $base = $this->Html->url(array('controller' => 'Home', 'action' => 'grupo'), $full = false); ?>
<div class="row" id="content-header">
	<div class="row" >
		<div class="row hidden-sm hidden-xs main-menu-lg menu-second" id="content-navbar">
			<div class="col-lg-4 col-md-4 content-nav-parts">
				<?php echo $this->Html->link($this->Html->image('site/logo.png', $options = array('class'=>'img-responsive logo-main-menu')), '/', array('escape'=>false, 'class'=>'link-logo-main-menu hvr-wobble-vertical')); ?>
			</div>
			<div class="col-lg-7 col-md-8 content-nav-parts">
				<div class="row">
					<nav>
						<ul class="nav nav-justified" id="nav">
							<li id="li-home" class="col-lg-3 col-md-3"><?php echo $this->Html->link('HOME</br>'.$this->Html->image('site/rectangle.png', $options = array('class'=>'img-center img-main-menu-li')), '/', array('escape'=>false, 'class'=>'a-main-menu ')); ?> </li>
							<li id="li-empresa" class="col-lg-3 col-md-3"><?php echo $this->Html->link('EMPRESA</br>'.$this->Html->image('site/rectangle.png', $options = array('class'=>'img-center img-main-menu-li')), array('controller' => 'Home', 'action' => 'empresa', 'ext'=>'html'), array('escape'=>false, 'class'=>'a-main-menu ')); ?></li>
							<li id="li-productos" class="col-lg-3 col-md-3 li-products">
								<?php echo $this->Html->link('PRODUCTOS</br>'.$this->Html->image('site/rectangle.png', $options = array('class'=>'img-center img-main-menu-li')), array('controller' => 'Home', 'action' => 'productos', 'ext' => 'html'), array('escape'=>false, 'class'=>'a-main-menu ')); ?>
								<ul class="sub second">
									<?php if (count($allProducts)>0) {
										createMenu($allProducts, '', '', $base);
									} ?>
								</ul>
							</li>
							<li id="li-contactos" class="col-lg-3 col-md-3"><?php echo $this->Html->link('CONTACTOS</br>'.$this->Html->image('site/rectangle.png', $options = array('class'=>'img-center img-main-menu-li')), array('controller' => 'Home', 'action' => 'contacto', 'ext'=>'html'), array('escape'=>false, 'class'=>'a-main-menu ')); ?></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<div class="row hidden-lg hidden-md content-nav-small">
			

			<div class="demo-1">
				<div id="dl-menu" class="dl-menuwrapper hidden-lg hidden-md">
					<button class="dl-trigger">Open Menu</button>
					<ul class="dl-menu">
						<li class="home-nav1">
							<?php echo $this->Html->link('HOME', "/"); ?>
						</li>
						<li>
							<?php echo $this->Html->link('EMPRESA', array('controller' => 'Home', 'action' => 'empresa', 'ext'=>'html')); ?>
						</li>
						<li>
							<?php echo $this->Html->link('PRODUCTOS', "#"); ?>
							<ul class="dl-submenu">
								<li><?php echo $this->Html->link('TODOS', array('controller' => 'Home', 'action' => 'productos', 'ext'=>'html')); ?></li>
								<?php if (count($allProducts)>0) {
										createMenuSmall($allProducts, '', $base);
									} ?>
							</ul>
						</li>
						<li>
							<?php echo $this->Html->link('CONTACTO', array('controller' => 'Home', 'action' => 'contacto', 'ext'=>'html')); ?>
						</li>
					</ul>
				</div><!-- /dl-menuwrapper -->
			</div>


		</div>
	</div>
	<diw class="row">
		<?php echo $this->Html->image('site/triangle.png', $options = array('class'=>'img-responsive img-center')); ?>
	</diw>
</div>

<?php 
	function createMenu($products, $type, $parent, $base) {
		foreach ($products as $product) { ?>
			<?php if ($parent=="") {
				$parent_route = $product['Product']['id'];
			} else {
				$parent_route = $parent;
				} ?>
			<li>
				<a href="<?php echo $base . "/".$product['Product']['id']."/". $parent_route."/".Inflector::slug($product['Product']['name'], $replacement = '-') ; ?>"><?php echo $product['Product']['name']; ?></a> 
				<?php if (!empty($product['children'])) { ?>
					<?php switch ($type) {
						case 'left': ?>
							<ul class="left second">
								<?php createMenu($product['children'], 'right', $parent_route, $base); ?>
							</ul>
							<?php break;
						
						case 'right': ?>
							<ul class="right second">
								<?php createMenu($product['children'], 'left', $parent_route, $base); ?>
							</ul>
							<?php break;

						default: ?>
							<ul class="left second">
								<?php createMenu($product['children'], 'right', $parent_route, $base); ?>
							</ul>
							<?php break;
					} ?>
					
				<?php } ?>
			</li>		
		<?php }
	}


	function createMenuSmall($products, $parent, $base) {
		
		foreach ($products as $product) { ?>
			<?php if ($parent=="") {
				$parent_route = $product['Product']['id'];
			} else {
				$parent_route = $parent;
				} ?>
			<li>
				<?php if (!empty($product['children'])) { ?>
					<a href="#"><?php echo $product['Product']['name']; ?></a> 
				<?php } else { ?>
				<a href="<?php echo $base . "/".$product['Product']['id']."/". $parent_route."/".Inflector::slug($product['Product']['name'], $replacement = '-') ; ?>"><?php echo $product['Product']['name']; ?></a>
				<?php } ?>
				<?php if (!empty($product['children'])) { ?>
						<ul class="dl-submenu">
							<li><a href="<?php echo $base . "/".$product['Product']['id']."/". $parent_route."/".Inflector::slug($product['Product']['name'], $replacement = '-') ; ?>">TODOS - <?php echo $product['Product']['name']; ?></a></li>
							<?php createMenuSmall($product['children'], $parent_route, $base); ?>
						</ul>
				<?php } ?>
			</li>		
		<?php }


	} 
?>