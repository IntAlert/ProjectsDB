<?php 
	
	
	$description = $persona['Persona']['description'];
	
	$persona_img_url = Configure::read('BASE_URL') . '/img/og/persona_' . $persona['Persona']['id'] . '.jpg';

	$namespace = Configure::read('FACEBOOK_APP_NAMESPACE');

?>

<!DOCTYPE html>
<html>
	<head prefix="og: http://ogp.me/ns#">
		<title><?php echo $persona['Persona']['name']; ?></title>
		<meta property="fb:app_id" content="<?php echo $app_id; ?>"/>
		<meta property="og:locale" content="en_GB">
		<meta property="og:url" content="<?php echo $this_url; ?>">
		<meta property="og:title" content="<?php echo $persona['Persona']['name']; ?>">
		<meta property="og:description" content="<?php echo $description; ?>">
		
		<meta property="og:type" content="<?php echo $namespace; ?>:website">

		<meta name="description" content="<?php echo $description; ?>">


		<meta property="og:image" content="<?php echo $persona_img_url; ?>">

	</head>


	<body>
		<h1><?php echo $persona['Persona']['name']; ?></h1>
		<p><?php echo $description; ?></p>
	</body>
</html>