<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>エラー</title>
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/php/css/footer.css">
	<link rel="stylesheet" type="text/css" href="/php/css/error.css">
	<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
	<script src="/php/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		require('navbar.php');
	?>
	<div class="container main">
		<div class="text-center">
			<h1>予約できませんでした</h1>
		</div>
		<div class="text-center">
			施設管理者が施設を予約することはできません。施設利用者としてログインしてやり直してください。
		</div>
		<div class="text-center back_button">
			<a href="/php/server/logout.php">ログアウト</a>
		</div>
	</div>
	<?php
		require('footer.php');
	?> 
</body>
</html>