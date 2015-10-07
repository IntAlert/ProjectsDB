<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


// build body classes
$body_classes = array(
	$this->params->controller,
	$this->params->controller . '-' . $this->params->action,
	$this->params->controller . '-' . $this->params->action . '-' . implode(',', $this->params['pass']),
);

// build title if none exists

if ( !isset($title) ) {
	$title = ucfirst($this->params->controller) . ' - ' . ucfirst($this->params->action);

	if (count($this->params['pass'])) {
		$title .= ' - ' . implode(',', $this->params['pass']);
	}	
}



?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		PROMPT - <?php echo $title; ?>
	</title>

	<!-- JS: Libraries -->
	<script type="text/javascript" src="/pdb/js/lib/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="/pdb/js/lib/jquery-ui.min.js"></script>

	<script type="text/javascript">
		// Resolve name collision between jQuery UI and Twitter Bootstrap
		$.widget.bridge('uitooltip', $.ui.tooltip);
		$.widget.bridge('uibutton', $.ui.button);
		$.widget.bridge('uibuttonset', $.ui.buttonset);
	</script>
	<!--<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->

	<!-- JS: Plugins -->
	<script type="text/javascript" src="/pdb/js/plugins/word-and-character-counter.js"></script>
	<script type="text/javascript" src="/pdb/js/plugins/jquery.validate.js"></script>
	<script type="text/javascript" src="/pdb/js/plugins/jquery.autogrow.js"></script>
	<script type="text/javascript" src="/pdb/js/plugins/jquery.number.js"></script>


	
	<!--
	<script type="text/javascript" src="/pdb/js/plugins/bootstrap-wysiwyg.js"></script> -->

	<script type="text/javascript" src="/pdb/js/main.js"></script>
	

	<!-- CSS: Libraries -->
	<link rel="stylesheet" type="text/css" href="/pdb/css/lib/jquery-ui.css">
	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="/pdb/css/lib/font-awesome-4.4.0/css/font-awesome.min.css">


	<script>var me =<?php echo json_encode(AuthComponent::user()); ?>;</script>


	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('style');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
</head>

<body class="<?php echo implode(' ', $body_classes); ?>">

	<div id="container">
		<div id="header" class="clearfix">

			<img src="/pdb/img/logo.png" style="">

		</div>
		<nav class="main">



<?php if (AuthComponent::user('id')): // only show nav to logged in users ?>
			<ul>
				<li class="dashboard">
					<a href="/pdb/dashboard/dashboard">Dashboard</a>
				</li>
<?php if (AuthComponent::user('role') == 'manager'): // only show nav to logged in users ?>
				<li class="donors">
					<a href="/pdb/donors">Donors</a>
				</li>

				<li class="territories">
					<a href="/pdb/territories">Territories</a>
				</li>
<?php endif; // (AuthComponent::user('role') == 'manager'): // only show nav to logged in users ?>

				<li class="projects-add">
					<a href="/pdb/projects/add">Add Project</a>
				</li>

				<li class="projects-index">
					<a href="/pdb/projects">Search Projects</a>
				</li>

				<li class="pipeline">
					<a href="/pdb/departments/pipelineSummary">MAC Pipeline</a>
				</li>

			</ul>

	<?php endif; // (AuthComponent::user('id')): // only show nav to logged in users ?>
	
		</nav>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php if (AuthComponent::user('id')): // only show nav to logged in users ?>

				<a href="/pdb/users/logout">Log out</a>
			<?php endif; // (AuthComponent::user('id')): // only show nav to logged in users ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
