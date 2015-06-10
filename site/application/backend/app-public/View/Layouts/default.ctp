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

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		ProjectsDB
	</title>

	<!-- JS: Libraries -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<!-- JS: Plugins -->
	<script type="text/javascript" src="/pdb/js/plugins/word-and-character-counter.js"></script>
	<script type="text/javascript" src="/pdb/js/plugins/jquery.validate.js"></script>
	<!--
	<script type="text/javascript" src="/pdb/js/plugins/bootstrap-wysiwyg.js"></script> -->
	

	<!-- CSS: Libraries -->
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.4/themes/hot-sneaks/jquery-ui.css">
	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
	


	<script>var me =<?php echo json_encode(AuthComponent::user()); ?>;</script>


	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic?v2');
		echo $this->Html->css('style?v2');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
</head>
<body>
	<div id="container">
		<!-- <div id="header" class="clearfix">

			
			<img src="/pdb/img/logo.png" style="height:40px; float:left; margin-bottom:1em;">

		</div> -->
		<nav>
			<ul>
				<li>
					<a href="/pdb/dashboard/dashboard">Dashboard</a>
				</li>

				<li>
					<a href="/pdb/donors">Donors</a>
				</li>

				<li>
					<a href="/pdb/territories">Territories</a>
				</li>

				<li>
					<a href="/pdb/projects/add">Add Project</a>
				</li>

				<li>
					<a href="/pdb/projects">Search Projects</a>
				</li>

				<li>
					<a href="/pdb/programmes/pipelineSummary">MAC Pipeline</a>
				</li>

				

			</ul>
		</nav>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
