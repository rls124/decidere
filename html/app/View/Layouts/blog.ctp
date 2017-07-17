<?php
/* SVN FILE: $Id: default.ctp 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for default.php
 *
 * Long description for default.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2009, Miha Nahtigal
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009, Miha Nahtigal
 * @link          http://www.nahtigal.com/
 * @package       lil_blogs_app
 * @subpackage    lil_blogs_app.views.layouts
 * @since         v 1.0
 * @version       $Revision: 126 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-07-02 09:21:52 +0200 (čet, 02 jul 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
	<?php 
		echo $html->charset('utf-8');
		echo '<title>'.$title_for_layout.'</title>';
		echo $html->css('lil_blogs');
		echo $scripts_for_layout;
	?>
	<meta name="verify-v1" content="PJm832ubumYYA8DwpIe0cyh8Q9fjZzXQMHEacHkd8hg=" />
</head>

<body>

<div id="container">
	
	<div id="header">
		<ul id="nav">
			<li><?php echo $html->link(__('Home', true), '/'); ?></li>
		</ul>
		<h1><?php 
			if (isset($blog)) {
				echo $html->link($sanitize->html($blog['Blog']['name']), array(
					'controller' => 'posts',
					'action'     => 'index',
					'blogname'   => $blog['Blog']['short_name'],
					'admin'      => false,
				)); 
			} else {
				__('LilBlogs List', true);
			}
		?></h1>
	</div> <!-- #header -->
	<?php if ($session->check('Message.flash')) $session->flash(); ?>
	<?php if ($session->check('Message.auth')) $session->flash('auth'); ?>
	<div id="content">
<?php
	if (@!$this->params['admin']) {
?>
	<div id="sidebar">
	    <?php
			if (isset($blog)) {
	    ?>
		<h1><?php __('Search'); ?></h1>
		<div>
			<?php
				echo $form->create('Post', array('url'=>'/lil_blogs/posts/index/'.$blog['Blog']['short_name']));
				echo '<fieldset>';
				echo $form->input('criterio', array('div'=>false, 'label'=>false, 'size'=>15));
				echo $form->submit('Go', array('div'=>false));
				echo '</fieldset>';
				echo $form->end();
			?>
		</div>
		<?php
			}
	    ?>
		<?php
			if (isset($blog['Category']) && is_array($blog['Category'])) {
		?>
		<h1><?php __('Categories'); ?></h1>
		<ul>
			<?php
				foreach($blog['Category'] as $category) {
					echo '<li>'.$html->link($category['name'], array(
						'admin' => false,
						'controller' => 'posts',
						'action' => 'index',
						'blogname' => $blog['Blog']['short_name'],
						'category' => $category['id']
					)).'</li>'.PHP_EOL;
				}
			?>
		</ul>
		<?php
			}
			
			if (isset($Auth)) {
		?>
		<h1><?php printf(__('Howdy, %s', true), $Auth['Author'][Configure::read('LilBlogsPlugin.authorDisplayField')]); ?></h1>
		<ul>
			<li><?php echo $html->link(__('Dashboard', true), '/admin'); ?></li>
			<li><?php echo $html->link(__('Logout', true), '/logout'); ?></li>
		</ul>
		<?php
			} else {
		?>
		<h1><?php __('Admin'); ?></h1>
		<ul>
			<li><?php echo $html->link(__('Login', true), '/login'); ?></li>
		</ul>
		<?php
			}
		?>
		<h1><?php __('Meta'); ?></h1>
		<ul>
			<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Strict">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
			<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
		</ul>
	</div> <!-- #sidebar -->
<?php
	}
?>
		<?php echo $content_for_layout ?>
	</div> <!-- #content -->
	<div id="footer" style="clear:both">
		<a href="http://hellobmw.com/">LoseMyMind</a> * <!-- please keep this, thanks! -->
		<?php
			if (!empty($blog)) {
				echo $html->link(__('RSS Blogs\'s Posts', true), array('plugin'=>'lil_blogs', 'controller'=>'posts', 'action'=>'index', 'blogname'=>$blog['Blog']['short_name'].'.rss'));
				echo ' * ';
				echo $html->link(__('RSS All Blogs\'s Comments', true), array('plugin'=>'lil_blogs', 'controller'=>'comments', 'action'=>'index', 'blogname'=>$blog['Blog']['short_name'].'.rss'));
				if (isset($post)) {
					echo ' * ';
					echo $html->link(__('RSS This Post\'s Comments', true), array('plugin'=>'lil_blogs', 'controller'=>'comments', 'action'=>'index', 'blogname'=>'cakephp', 'post'=>$post['Post']['slug'] . '.rss'));
				}
			}
		?>
	</div> <!-- #footer -->

</div> <!-- #container -->
</body>
</html>
