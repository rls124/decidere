<br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Admin Panel</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li> <?php echo $this->Html->link('Datasets', array('controller' => 'Admin', 'action' => 'datasets')); ?> </li>
        <li> <?php echo $this->Html->link('Users', array('controller' => 'Admin', 'action' => 'users')); ?> </li>
        <li> <?php echo $this->Html->link('Coupons', array('controller' => 'Admin', 'action' => 'coupons')); ?> </li>
        <li> <?php echo $this->Html->link('Mapping', array('controller' => 'Admin', 'action' => 'mapping')); ?> </li>
        <li> <?php echo $this->Html->link('Info Popups', array('controller' => 'Admin', 'action' => 'info')); ?> </li>
        <li> <?php echo $this->Html->link('CMS', array('controller' => 'Admin', 'action' => 'cms')); ?> </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>