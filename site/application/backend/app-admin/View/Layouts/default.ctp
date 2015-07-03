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

$cakeDescription = __d('cake_dev', 'Real Netball Mums Admin');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->Html->script('jquery.js');
		echo $this->fetch('script');
	?>
	
</head>
<body>
	<div id="container">
		<div id="header">

			<nav>
				<ul>
<?php if (AuthComponent::user('role') == 'admin'): ?>
					<li>
						<a href="/admin/dashboard/dashboard">App Dashboard</a>
					</li>

					<li>
						<a href="/admin/weightings/editor">Weightings Editor</a>
					</li>
					<li>
						<a href="/admin/questions">List Questions</a>
					</li>
					<li>
						<a href="/admin/personas">List Personas</a>
					</li>
					<li>
						<a href="/admin/predictions">List Predictions</a>
					</li>
					<li>
						<a href="/admin/prizeentries">List Prize Entries</a>
					</li>
					<li>
						<a href="/admin/users/logout">Logout</a>
					</li>
<?php else: // (AuthComponent::user('role') == 'admin'): ?>
					<li>
						<a href="/admin/users/login">Login</a>
					</li>
<?php endif; // (AuthComponent::user('role') == 'admin'): ?>
				</ul>
			</nav>


			<h1><?php echo $this->Html->link($cakeDescription, '/'); ?></h1>
			
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'/admin',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
