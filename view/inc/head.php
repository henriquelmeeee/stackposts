<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title><?php print htmlentities($title);?>
	</title>
	<?php
    asset([
        'js/jquery-3.6.0.min.js',
        'js/jquery.pjax.min.js',
		'js/loadingoverlay.min.js',
		'js/script.js'
    ]);
    ?>
</head>
<body>