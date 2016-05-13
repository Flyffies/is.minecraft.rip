<?php
$file = file_get_contents('status.json');
$json = json_decode($file, true);

$login = $json['report']['login']['status'] == "up";
$session = $json['report']['session']['status'] == "up";
$skins = $json['report']['skins']['status'] == "up";
$website = $json['report']['website']['status'] == "up";
$realms = $json['report']['realms']['status'] == "up";

if ($login && $session && $skins && $website && $realms) {
	$up = True;
} else {
	$up = False;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Is Minecraft RIP?</title>

		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:300,400">

		<meta name="description" content="Is Minecraft RIP? Are the Minecraft servers down? Can't log into Minecraft?">

		<!-- Twitter -->
		<meta name="twitter:card" content="summary">
		<meta property="og:title" content="Is Minecraft RIP?">
		<meta property="og:site_name" content="Is Minecraft RIP?">
		<meta property="og:description" content="Is Minecraft RIP? - Are Minecraft's servers acting up?">
		<meta property="og:type" content="website">

		<!-- Mobile -->
		<meta name="application-name" content="Is Minecraft RIP?">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
	</head>
	<body>
		<div class="wrapper">
			<div class="container">
				<h1 class="text-center"><?php if ($up) { echo "No, everything going good!"; } else { echo "Partly, some servers seem to be down."; } ?></h1>

				<div class="text-center">
					<div id="login" class="span2">
						<div class="service">
							<div class="name">Login</div>
							<h2 class="status">Loading..</h2>
						</div>
						<div class="uptime">&nbsp;</div>
					</div>
					<div id="session" class="span2">
						<div class="service">
							<div class="name">Session</div>
							<h2 class="status">Loading..</h2>
						</div>
						<div class="uptime">&nbsp;</div>
					</div>
					<div id="website" class="span2">
						<div class="service">
							<div class="name">Website</div>
							<h2 class="status">Loading..</h2>
						</div>
						<div class="uptime">&nbsp;</div>
					</div>
					<div id="skins" class="span2">
						<div class="service">
							<div class="name">Textures</div>
							<h2 class="status">Loading..</h2>
						</div>
						<div class="uptime">&nbsp;</div>
					</div>
					<div id="realms" class="span2">
						<div class="service">
							<div class="name">Realms</div>
							<h2 class="status">Loading..</h2>
						</div>
						<div class="uptime">&nbsp;</div>
					</div>
				</div>
				<div class="text-center">
					<div id="announcement" class="psa"></div>
				</div>
				<div class="text-center">
					<img class="cute" src="//thecatapi.com/api/images/get?format=src&type=gif" alt="CUTE CAT">
				</div>
				<div class="footer">
					<div class="footer-line">
						<div class="text-center">
							Last update: <span id="last-update">00:00:00 CEST</span>  | 
							Made by <a href="//manuelgu.eu">manuelgu</a>  |  
							Source code on <a href="//github.com/is-minecraft-rip/is.minecraft.rip">GitHub</a>
						</div>
					</div>
				</div>

			</div>
		</div>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="assets/mcstatus.js"></script>
	</body>
</html>