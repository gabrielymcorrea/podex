<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/audioplayer.css" />
	<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<style>
	body { min-height: 200vh; background-color: #121212}
	#wrapper { margin: 150px auto; max-width: 100%; }
</style>
</head>

<body>
	<div id="wrapper">
		<audio preload="auto" controls id="play-footer">
			<source src="https://www.w3schools.com/html/horse.mp3">
		</audio>
		
		<script 
		src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
		crossorigin="anonymous">
		</script>

		<script src="js/audioplayer.js"></script>
		
		<script>
			$(function() {
				$('#play-footer').audioPlayer();
			});
		</script>

	</div>
</body>

</html>
