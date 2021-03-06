<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> 投稿画面</title>
<link rel="stylesheet" type="text/css" href="/teamG/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/teamG/css/navbar.css">
<link rel="stylesheet" type="text/css" href="/teamG/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/teamG/css/toukou.css">
<link rel="stylesheet" type="text/css" href="/teamG/css/footer.css">
<script type="text/javascript" src="/teamG/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/teamG/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/teamG/js/dispCalendar.js"></script>
<script type="text/javascript" src="/teamG/js/ajaxzip3.js"></script>
<script type="text/javascript" src="/teamG/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	require('navbar.php');
?>


	<div class="container"><br><br><br>
		<div class="text-center"><h3>投稿画面</h3></div>
			<div id="toukou_form" class="col-md-6 col-md-offset-3">
				<form class="form-horizontal" role="form" method="post" action="toukoukakuninn.php" enctype="multipart/form-data">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">施設名</span>
							<input id="fac_name" type="text" class="form-control" name="FacName" required value="" placeholder="施設名登録" autofocus>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
                			<span class="input-group-addon" id="basic-addon3">〒</span>
              				<input type="text" name="zip1" class="form-control" pattern="^[0-9]+$" maxlength="3" required value="" >
                			<span class="input-group-addon" id="basic-addon5">-</span>
              				<input type="text" name="zip2" class="form-control" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','address1','address2');" pattern="^[0-9]+$" maxlength="4" required value="">
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="input-group">
				      		<span class="input-group-addon" id="basic-addon3">都道府県</span>
				      		<input type="text" name="address1" class="form-control" size="60" readonly>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
	    					<span class="input-group-addon" id="basic-addon3">市区町村</span>
	      					<input type="text" name="address2" class="form-control" size="60" readonly>
	    				</div>
	  				</div>
			  		<div class="form-group">
			    		<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">番地</span>
			    			<input type="text" name="address3" class="form-control" required>
			    		</div>
			  		</div>					
			  		<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">MAIL</span>
            				<input id="fac_email" type="text" class="form-control" name="MailAddress" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required value="" placeholder="メール">
            			</div>
          			</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">電話番号</span>
							<input id="fac_tel" type="text" class="form-control" name="Tel" pattern="\d{1,5}-\d{1,4}-\d{1,4}" required value="" maxlength="14" placeholder="0000-0000-0000">
            			</div>
          			</div>
					<div class="form-group">
						<div class="input-group">
			  				<span class="input-group-addon" id="basic-addon4">日程</span>
        					<input type="text" class="form-control" id="datepickerFrom" name="StartDate" required placeholder="クリックして下さい"/>
							<span class="input-group-addon" id="basic-addon5">～</span>
							<input type="text" class="form-control" id="datepickerTo" name="StopDate" required placeholder="クリックして下さい"/>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon4" for="upload_file">画像添付</span>
							<input type="file" name="upload_file[]" multiple id="upload_file">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">説明</span>
							<textarea class="form-control"  name="Exposition" maxlength="1000"  placeholder="アメニティの貸出サービス・片付け"></textarea>
						</div>
					</div>
					<div id="select" class="form-button_group">
						<br><label for="amenity"><h4><strong>アメニティ</strong></h4></label><br>
							<label><input type="checkbox" name="Network" value="Wi-Fi"/>Wi-Fi</label>
							<label><input type="checkbox" name="Electrical" value="電気"/>電気</label>
							<label><input type="checkbox" name="Water" value="水道"/>水道</label><br>
							<label><input type="checkbox" name="Parking" value="駐車場"/>駐車場</label>
							<label><input type="checkbox" name="Toilet" value="トイレ"/>トイレ</label>
							<label><input type="checkbox" name="Gas" value="ガス"/>ガス</label><br>
							<label><input type="checkbox" name="Barrierfree" value="バリアフリー"/>バリアフリー</label>
							<label><input type="checkbox" name="FoodDrink" value="飲食"/>飲食</label>
							<label><input type="checkbox" name="AirCondition" value="冷暖房使用可能"/>冷暖房使用可能</label>
							<label><input type="checkbox" name="NoFire" value="火気厳禁"/>火気厳禁</label>
					</div>
					<div id="select" class="form-button_group">
						<br><label for="id"><h4><strong>カテゴリー</strong></h4></label><br>
							<label><input type="checkbox" name="kategory[0]" value="パーティー"/>パーティー</label>
							<label><input type="checkbox" name="kategory[1]" value="演奏"/>演奏</label>
							<label><input type="checkbox" name="kategory[2]" value="会議"/>会議</label><br>
							<label><input type="checkbox" name="kategory[3]" value="スポーツ"/>スポーツ</label>
							<label><input type="checkbox" name="kategory[4]" value="結婚式"/>結婚式</label><br>
							<label><input type="checkbox" name="kategory[5]" value="オフィス"/>オフィス</label>
							<label><input type="checkbox" name="kategory[6]" value="車・バイク練習"/>車・バイク練習</label>
							<label><input type="checkbox" name="kategory[7]" value="料理"/>料理</label>
							<label><input type="checkbox" name="kategory[8]" value="展示"/>展示会</label>
							<label><input type="checkbox" name="kategory[9]" value="写真撮影"/>写真撮影</label>
							<label><input type="checkbox" name="kategory[10]" value="その他"/>その他</label><br><br>
					</div>
					<div id="" class="form-group ninzu">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon4">人数</span>
							<input id="people" type="text" class="form-control" name="PeopleNum" pattern="^([0-9]{0,8})$" required maxlength="8" value="">
							<span class="input-group-addon" id="basic-addon2">人</span>
						</div>
					</div>
					<div id="" class="form-group hirosa">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon4">広さ</span>
							<input id="fac_area" type="text" class="form-control" name="Area" pattern="^-?\d{1,}\.\d*$"required value="" maxlength="8" placeholder="00.00">
							<span class="input-group-addon" id="basic-addon2">m&#178;</span>
						</div>
					</div>
					<div id="test" class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon4">料金</span>
							<input id="price" type="text" class="form-control" name="Price" pattern="^([0-9]{0,7})$"maxlength="7" required value="">
							<span class="input-group-addon" id="basic-addon2">円</span>
						</div>
					</div>
					<div id="check" class="form-button_group">
						<br>
						<label><strong><h4>支払い方法</h4></strong></label><br>
							<label><input type="checkbox" name="pay_cash" value="現金"/>現金</label>
							<label><input type="checkbox" name="pay_card" value="カード" disabled />カード</label>
							<label><input type="checkbox" name="pay_cry" value="暗号通貨" disabled>暗号通貨</label>
							<br><br>
					</div>
					<div class="button-group text-center">
							<button type="button" class="btn btn-default cancel">キャンセル</button>
							<button type="submit" class="btn btn-primary ok">確認する</button>
					</div>
				</form>
			</div>
		</div>
		<?php 
			require('footer.php');
		?>

<script type="text/javascript" src="/teamG/js/gazou1.js"></script>
<script type="text/javascript" src="/teamG/js/toukouClickEvent.js"></script>
</body>
</html>
