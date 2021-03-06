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
		<?php echo $title; ?> - PROMPT
	</title>

	<!-- JS: Libraries -->
	<script type="text/javascript" src="/pdb/js/lib/jquery-1.11.2.min.js"></script>
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

	

	<script>var me =<?php echo json_encode(AuthComponent::user()); ?>;</script>


	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('style');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

	<link rel="stylesheet" type="text/css" href="/pdb/css/print.css" media="print" >
	
</head>

<body class="<?php echo implode(' ', $body_classes); ?>">

	<div id="container">

		<nav class="main clearfix">

			<div class="clearfix">
				<div class="logo-container">
					<img src="/pdb/img/logo-slogan-landscape.png" height="80" class="logo">
				</div>


				<?php if (AuthComponent::user('id')): // only show nav to logged in users ?>
		
				<div id="search-shortcut" class="clearfix">
					<form action="/pdb/projects" method="get">

						<input type="hidden" name="action" value="search">

						<input type="text" name="q" placeholder="Search PROMPT projects" class="contracted search-autocomplete">

					</form>
				</div>

				<?php endif; // (AuthComponent::user('id')): // only show nav to logged in users ?>
				
			</div>

<?php if (AuthComponent::user('id')): // only show nav to logged in users ?>
	

			<ul>



				<li class="dashboard">
					
					<a href="/pdb/dashboard/dashboard">
						<i class="fa fa-map"></i>
						PROMPT Dashboard
					</a>
				</li>


<?php if ($is_admin): // only show nav to logged in users ?>

				<li class="dashboard-admin">
					
					<a href="/pdb/dashboard/admin">
						<i class="fa fa-lock"></i>
						Admin
					</a>
				</li>

<?php endif;// (AuthComponent::user('role') == 'admin'): // only show nav to logged in users ?>


				<li class="projects-searchDocs">
					
					<a href="/pdb/projects/searchDocs">
						<i class="fa fa-files-o"></i>
						Search Documents
					</a>

				</li>

				<li class="projects-index">
					
					<a href="/pdb/projects">
						<i class="fa fa-search"></i>
						Search Data
					</a>

				</li>

				<li class="projects-add">
					<a href="/pdb/projects/add">
						<i class="fa fa-plus-circle"></i>
						Add Proposal/Project
					</a>
				</li>

				<li class="pipeline">
					
					<a href="/pdb/pipeline/summary">
						<i class="fa fa-table"></i>
						Projects &amp; Fundraising Pipeline
					</a>
				</li>



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
					<img src="/pdb/img/small_logo.png">
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
