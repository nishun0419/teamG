<?php
	// session_start();
	// if(!isset($_SESSION["userid"])){
	// 	header('Location: ../php/login.php');
	// 	exit;
	// }

	$dsn = "mysql:dbname=teamG;host=localhost;charset=utf8";
	$user = "kobe";
	$password = "denshi";
	try{
		$dbh = new PDO($dsn,$user,$password);
		$error = false;
		if($_GET["process"] === "preOrder"){//予約確認前の処理(バリデーション)
			$sql = "select * from Reservations where UpID = ?";
			$stmt  = $dbh -> prepare($sql);
			$stmt -> bindValue(1, htmlspecialchars($_GET["UpID"]), PDO::PARAM_INT);
			$stmt -> execute();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$sql = "select * from ResDates where ResID = ?";
				$rstmt = $dbh -> prepare($sql);
				$rstmt -> bindValue(1, $row["ResID"], PDO::PARAM_INT);
				$rstmt -> execute();
				while($rrow = $rstmt -> fetch(PDO::FETCH_ASSOC)){
					if($rrow["Reservation"] === $_GET["Reservation"]){//募集日時も分岐に加える（未実装）
						$error = true;
					}
				}
			}
			if($error){ //エラー時の処理
				echo "error";
				exit;
			}
			else{ 		//非エラー時の処理
				echo "success";
				exit;

			}
		}
		else if($_GET["process"] === "mypage"){ //マイページ表示用
			$sql = "select * from Reservations where UserID = ?";
			$stmt=$dbh->prepare($sql);
			$stmt -> bindValue(1, $_GET["userid"], PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){ //予約日取得
				$sql = "select * from ResDates where ResID = ? and DATE(Reservation) >= ?";
				$date = date("Y-m-d");
				$fstmt = $dbh -> prepare($sql);
				$fstmt -> bindValue(1, $row["ResID"], PDO::PARAM_INT);
				$fstmt -> bindValue(2, $date, PDO::PARAM_STR);
				$fstmt -> execute();
				while($rrow = $fstmt -> fetch(PDO::FETCH_ASSOC)){ //施設情報取得
					$sql = "select * from Posts where UpID = ?";
					$rstmt = $dbh -> prepare($sql);
					$rstmt -> bindValue(1, $row["UpID"], PDO::PARAM_INT);
					$rstmt -> execute();
					while($frow = $rstmt -> fetch(PDO::FETCH_ASSOC)){ 
						$res[] = array( "ident" => $frow["UpID"],
										"FacName" => $frow["FacName"],
										"PostNum" => $frow["PostNum"],
										"Address" => $frow["Address"],
										"Pref" => $frow["Pref"],
										"Image" => $frow["Image1"],
										"orderdate" => $rrow["Reservation"],
										"ResPrice" => $row["ResPrice"],
										"ResID" => $row["ResID"]
						);
					}
				}
			}
		}
		else if($_GET["process"] === "order_check"){
			$sql = "select * from Reservations where UpID = ?";
			$stmt = $dbh -> prepare($sql);

			$stmt -> bindValue(1, $_GET["facilityid"], PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$sql = "select * from ResDates where ResID = ? and Reservation = ?";
				$resstmt = $dbh -> prepare($sql);
				$resstmt -> bindValue(1, $row["ResID"], PDO::PARAM_STR);
				$resstmt -> bindValue(2,$_GET["orderdate"], PDO::PARAM_STR);
				$resstmt -> execute();
				$urow = $resstmt -> fetch(PDO::FETCH_ASSOC);
				if($urow){
					$sql = "select * from Reservations where ResID = ?";
					$resstmt = $dbh -> prepare($sql);
					$resstmt -> bindValue(1, $urow["ResID"], PDO::PARAM_INT);
					$resstmt -> execute();
					$row = $resstmt -> fetch(PDO::FETCH_ASSOC);
					if($row){
						$sql = "select * from Users where UserID = ?";
						$resstmt = $dbh -> prepare($sql);
						$resstmt -> bindValue(1,$row["UserID"], PDO::PARAM_STR);
						$resstmt -> execute();
						$urow = $resstmt -> fetch(PDO::FETCH_ASSOC);
						if($urow){
							$sql = "select * from Posts where UpID = ?";
							$stmt = $dbh -> prepare($sql);
							$stmt -> bindValue(1, $_GET["facilityid"],PDO::PARAM_STR);
							$stmt -> execute();
							$frow = $stmt -> fetch(PDO::FETCH_ASSOC);
							if($frow){
								$res[] = array("FamilyName" => $urow["FamilyName"],
									"GivenName" => $urow["GivenName"],
								"FamilyNameKana" => $urow["FamilyNameKana"],
								"GivenNameKana" => $urow["GivenNameKana"],
								"UserPostNum" => $urow["UserPostNum"],
								"UserCity" => $urow["UserCity"],
								"UserPref" => $urow["UserPref"],
								"UserTel" => $urow["UserTel"],
								"orderdate" => $_GET["orderdate"],
								"ResPrice" => $row["ResPrice"],
								"FacName" => $frow["FacName"],
								"PostNum" => $frow["PostNum"],
								"Pref" => $frow["Pref"],
								"Address" => $frow["Address"],
								"Tel" => $frow["Tel"]
								);
							}
						}
					}
				}
			}
		}
		else if($_GET["process"] === "order_detail"){
			$sql = "select * from ResDates where ResID = ? and DATE(Reservation) >= ?";
			$stmt = $dbh -> prepare($sql);
			$date = date('Y-m-d');
			$stmt -> bindValue(1, htmlspecialchars($_GET["ResID"]), PDO::PARAM_STR);
			$stmt -> bindValue(2, $date, PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				$fac_order = $row["Reservation"];
			}
			else{
				exit;  //エラーページに遷移させるため
			}
			$sql = "select * from Reservations where ResID = ? and UserID = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1,htmlspecialchars($_GET["ResID"]), PDO::PARAM_STR);
			$stmt -> bindValue(2,htmlspecialchars($_GET["UserID"]),PDO::PARAM_STR);
			$stmt -> execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				$sql = "select * from Posts where UpID = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1,$row["UpID"], PDO::PARAM_STR);
				$stmt -> execute();
				$frow = $stmt -> fetch(PDO::FETCH_ASSOC);
				if($frow){
					$res[] = array("fac_name" => $frow["FacName"],
								   "PostNum" => $frow["PostNum"],
									"Pref" => $frow["Pref"],
									"Address" => $frow["Address"],
									"fac_price" => $row["ResPrice"],
									"fac_order" => $fac_order
								);
				}
			}
			else{
				exit;  //エラーページに遷移させるためにエラーを出させる
			}
		}
		header("Access-Control-Allow-Origin:*");
		header("Content-Type: application/json");
		echo json_encode($res);
		exit;
	}catch(PDOException $e){
		$res[] = array("title" => $e);
		echo json_encode($res);

	}
?>