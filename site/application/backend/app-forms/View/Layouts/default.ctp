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
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>
		PROMPT - <?php echo $title; ?>
	</title>


	<script>var me =<?php echo json_encode(AuthComponent::user()); ?>;</script>



	<!-- JS: Libraries -->
	<script type="text/javascript" src="/pdb/js/lib/jquery-1.11.2.min.js"></script>

	<script type="text/javascript" src="/pdb/js/lib/angular.min.js"></script>

<!-- Angular -->
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-aria.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-messages.min.js"></script>

  <script type="text/javascript" src="/pdb/js/lib/moment.js"></script>

  <!-- Angular Material Library -->
  <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0-rc.5/angular-material.min.js"></script>

	<script src="/pdb/js/lib/angular.checklist-model.js"></script>

	<script type="text/javascript" src="/pdb/css/lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/pdb/js/lib/date.js"></script>

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
	<script type="text/javascript" src="/pdb/js/plugins/garlic.js"></script>


	<script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>

	<script type="text/javascript" src="/pdb/js/lib/datamaps.world.min.js"></script>

	<!-- Polyfill for IE<11 Input[type=number] -->
	<script type="text/javascript" src="/pdb/js/lib/number-polyfill.min.js"></script>


	<!-- Multiple Select -->
	<link rel="stylesheet" href="/pdb/js/lib/multiple-select/multiple-select.css">
	<script type="text/javascript" src="/pdb/js/lib/multiple-select/multiple-select.js"></script>

	<!--
	<script type="text/javascript" src="/pdb/js/plugins/bootstrap-wysiwyg.js"></script> -->

	<script type="text/javascript" src="/pdb/js/main.js"></script>
	

	<!-- CSS: Libraries -->
	<link rel="stylesheet" type="text/css" href="/pdb/css/lib/jquery-ui-1.11.4/jquery-ui.min.css">
	
	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="/pdb/css/lib/font-awesome-4.4.0/css/font-awesome.min.css">
	
	<script 
	    src="//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js" 
	    type="text/javascript">
	</script>
	<script 
	    src="https://intlalert.sharepoint.com/_layouts/15/sp.runtime.js"
	    type="text/javascript">
	</script>

	<script 
	    src="https://intlalert.sharepoint.com/_layouts/15/sp.js"
	    type="text/javascript">
	</script>

	

	

	<link rel="stylesheet" type="text/css" href="/pdb/css/cake.generic.css">
	<link rel="stylesheet" type="text/css" href="/pdb/css/style.css">

	<link rel="stylesheet" type="text/css" href="/forms/css/forms.css">

	

	<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

	<!-- Angular Material style sheet -->
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0-rc2/angular-material.min.css">


	<link rel="stylesheet" type="text/css" href="/pdb/css/print.css" media="print" >
	
</head>

<body class="<?php echo implode(' ', $body_classes); ?>">

	<div id="container">

		<nav class="main">

			<img src="/pdb/img/logo.png" height="60" class="logo">

<?php if (AuthComponent::user('id')): // only show nav to logged in users ?>

			<ul>




<?php if ($is_admin): // only show nav to logged in users ?>

				<!-- <li class="dashboard-admin">
					
					<a href="/pdb/dashboard/admin">
						<i class="fa fa-lock"></i>
						Admin
					</a>
				</li> -->

<?php endif;// (AuthComponent::user('role') == 'admin'): // only show nav to logged in users ?>





			</ul>

	<?php endif; // (AuthComponent::user('id')): // only show nav to logged in users ?>
	
		</nav>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer" class="clearfix">




			<ul>
				<li class="logo">
					<img src="/pdb/img/logo.png">
				</li>
				<li>
					<a href="https://intalert.typeform.com/to/SUUUaZ" target="_blank">Report Bug</a>
				</li>
				<?php if (AuthComponent::user('id')): // only show nav to logged in users ?>
				<li>
					<a href="/pdb/users/logout">Log out</a>
				</li>
				<?php endif; // (AuthComponent::user('id')): // only show nav to logged in users ?>
			</ul>
			

				
			
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>



<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75451475-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>
