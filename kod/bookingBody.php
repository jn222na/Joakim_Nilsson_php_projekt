<?php



		 class bookingBody{
			public function echoBody($body){
				
				
				
				
				echo "
				<!DOCTYPE html>
				<html>
				<head>
				<link rel='stylesheet' type='text/css' href='mystyle.css'>
					<meta charset=UTF-8>
					<title>Lanster</title>
							<script type = 'text/javascript'>
							function colourGreen() {
        document.getElementById('btn').className = 'colorbtnChange';
    }
							</script>	
				</head>
				<body>
				<img src='bilder/2.png' name='BG' width='1680' height='1080' id='BG'>
				$body
				
				</body>
				</html>
				";
			}
		}
