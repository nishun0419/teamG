<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>施設詳細</title>
	<link rel="stylesheet" type="text/css" href="/teamG/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/detail_facility.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/footer.css">
	<script type="text/javascript" src="/teamG/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/teamG/js/jquery-ui.min.js"></script>

	<script type="text/javascript" src="/teamG/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		require('navbar.php');
		$id = htmlspecialchars($_GET["id"]);
		if(isset($_SESSION["token"])){
			unset($_SESSION["token"]);
		}
	?>
	<script type="text/javascript">
		var serchparam = null;
		var dataprocess = "detail";
		var ident = '<?php echo $id; ?>';
		var userid = null;
	</script>
	<div class="back_color"></div>
	<!-- モーダル・ダイアログ -->
	<div class="modal fade" id="orderModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
					<h4 class="modal-title">予約日</h4>
				</div>
				<div class="modal-body">
					<div class="text-center calendarVal"></div>
				</div>
				<div class="modal-footer">
					<form method="POST" action="/teamG/ordercontroller">
						<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
						<input type="hidden" name="upID" id="upID">
						<input type="hidden" name="reservation" id="reservation">
						<input type="hidden" name="process" value="preOrder">
						<button type="submit" class="btn btn-primary">予約</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="container main">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1 id="fac_name"></h1>
			</div>
			<div id="detail_Info"></div>
		</div>
	</div>
	<script type="text/javascript" src="/teamG/js/separate.js"></script>
	<script type="text/javascript" src="/teamG/js/Map.js"></script>
	<script type="text/javascript" src="/teamG/js/disp_fac_Calendar.js"></script>
	<script type="text/javascript" src="/teamG/js/dispDetailFacility.js"></script>
	<script type="text/javascript" src="/teamG/js/getFacility.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZg9ufeYKKY11pds-r8Y-qkfDQLIN-2fw"></script>
    <?php
		require('footer.php');
	?> 
</body>
</html>