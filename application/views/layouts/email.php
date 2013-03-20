<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?= $title ?></title>
	<?php foreach($css as $link): ?>
	<link type="text/css" rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/css/<?= $link ?>.css" />
	<?php endforeach; ?>
	<?php foreach($js as $link): ?>
	<script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/<?= $link ?>.js"></script>
	<?php endforeach; ?>
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-29444973-1']);
	  _gaq.push(['_setDomainName', 'POignite.com']);
	  _gaq.push(['_setAllowLinker', true]);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
</head>
<body>


<div class="container">
	<?= $homepage ?>
	<div class="content" style="min-height: 530px;">
		<?= $alertitemadd ?>

		<?= $start ?>

		<?= $dashboard ?>

		<?= $nikeplussync ?>
		<?= $nikeplusruns ?>
		
		<?= $nutritionsearch ?>
		
		<?= $login ?>

		<?= $nutrition ?>
		<?= $nutritionlog ?>
		<?= $nutritionfavorites ?>
		<?= $workout ?>
		<?= $workoutlog ?>
		<?= $workoutfavorites ?>

		<?= $privacy ?>
		<?= $tos ?>
	</div>
</div> 
<?= $content ?>
</body>
</html>