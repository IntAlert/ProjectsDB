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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		ProjectsDB
	</title>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>


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
<body>
	<div id="container">
		<div id="header">

			<!-- <h1 style="float:right">ProjectsDB</h1> -->
			<img src="/pdb/img/logo.png" style="height:40px; float:left; margin-bottom:1em;">

		</div>
		<nav>
			<ul>
				<li>
					<a href="/pdb/dashboard/dashboard">Dashboard</a>
				</li>

				<li>
					<a href="/pdb/projects/add">Add Project</a>
				</li>

				<li>
					<a href="/pdb/projects">Search Projects</a>
				</li>

				<li>
					<a href="/pdb/payments/pipeline">MAC Pipeline</a>
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
