<script>
  $(function() {
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  });
  </script>
  <style>
  .ui-tabs-vertical { width: 55em; }
  .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
  .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
  .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
  .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; }
  .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 40em;}
  </style>


  <div id="tabs">
	<ul>
		<li><a href="#project-edit-general">General</a></li>
		<li><a href="#project-edit-financial">Financials</a></li>
		<li><a href="#project-edit-description">Description</a></li>

		<li><a href="#project-edit-status">Status/Likelihood</a></li>

		<li><a href="#project-edit-programme">Programmes/Territories</a></li>
		<li><a href="#project-edit-timespan">Timespan</a></li>
		<li><a href="#project-edit-people">People</a></li>
		<li><a href="#project-edit-web">Web links</a></li>
	</ul>


	<div id="project-edit-general">
		<h2>project-edit-general</h2>
	</div>


	<div id="project-edit-financial">
		<h2>project-edit-financial</h2>
	</div>


	<div id="project-edit-description">
		<h2>project-edit-description</h2>
	</div>


	<div id="project-edit-web">
		<h2>project-edit-web</h2>
	</div>


	<div id="project-edit-timespan">
		<h2>project-edit-timespan</h2>
	</div>


	<div id="project-edit-status">
		<h2>project-edit-status</h2>
	</div>


	<div id="project-edit-programme">
		<h2>project-edit-programme</h2>
	</div>


	<div id="project-edit-people">
		<h2>project-edit-people</h2>
	</div>


</div>