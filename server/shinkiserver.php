<?php
		session_start();
		$resMes = "sucess";
		if(trim($_POST["id"]) == false){
			$_SESSION['message_Shinki'] = "IDを入力してください";
		}
		elseif(strpos($_POST["id"]," ") !== false || strpos($_POST["id"],"　") !== false){
			$_SESSION['message_Shinki'] = "スペースがないidを入力をしてください";
		}
		elseif(preg_match('/[a-zA-Z0-9]/', $_POST["id"])){
			$_SESSION['message_Shinki'] = "ユーザーIDは半角英数字で入力してください";
		}
		elseif(empty($_POST["first"]) || empty($_POST["given"]) || empty($_POST["first_kana"]) || empty($_POST["given_kana"]) ){
			$_SESSION['message_Shinki'] = "名前を入力してください";
		}
		elseif(preg_match('/[^ァ-ヶー]/u', $_POST['first_kana']) || preg_match('/[^ァ-ヶー]/u', $_POST['given_kana']) ){
			$_SESSION['message_Shinki'] = "ふりがなは全角カタカナで入力してください";
		}
		elseif(empty($_POST["password"])){
			$_SESSION['message_Shinki'] = "パスワードを入力してください";
		}
		elseif(empty($_POST["email"])){
			$_SESSION["message_Shinki"] = "メールアドレスを入力してください";
		}
		elseif(empty($_POST["postnum"])){
			$_SESSION["message_Shinki"] = "郵便番号を入力してください";
		}
		elseif(empty($_POST["address"])){
			$_SESSION["message_Shinki"] = "住所を入力してください";
		}
		elseif(empty($_POST["tel"])){
			$_SESSION["message_Shinki"] = "電話番号を入力してください";
		}
		elseif(strcmp($_POST["password"],$_POST["re_password"]) !=0 ){
			$_SESSION["message_Shinki"] = "パスワードが一致しません";
		}
		elseif(strcmp($_POST["email"],$_POST["re_email"]) != 0){
			$_SESSION["message_Shinki"] = "メールアドレスが一致しません";
		}

		if(isset($_SESSION['message_Shinki'])){
			$resMes = "false";
		}
		else{
			$dsn ="mysql:dbname=teamG;host=localhost;charset=utf8";
			$user = "kobe";
			$password = "denshi";
			try{
				$today = getdate();
				$d = $today["mday"];
				$m = $today["mon"];
				$y = $today["year"];
				$dbh = new PDO($dsn, $user, $password);

				$sql = "select * from Users where UserID = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, htmlspecialchars($_POST['id']),PDO::PARAM_STR);
				$stmt -> execute();
				if(!$stmt -> fetch(PDO::FETCH_ASSOC)){
					//TODO:POSTはできてるっぽいのにinsert出来ていないみたい(2,3,4,5カラム目)
					$sql = "insert into Users(UserID,FirstName,FirstNameKana,GivenName,GivenNameKana,Password,AcountDate,UserPostNum,UserAddress,UserTel,UserMailAddress) values(?,?,?,?,?,?,?,?,?,?,?)";
					$stmt = $dbh -> prepare($sql);
					$stmt -> bindValue(1, htmlspecialchars($_POST['id']), PDO::PARAM_STR);
					$stmt -> bindValue(2, htmlspecialchars($_POST['first']), PDO::PARAM_STR);
					$stmt -> bindValue(3, htmlspecialchars($_POST['first_kana']), PDO::PARAM_STR);
					$stmt -> bindValue(4, htmlspecialchars($_POST['given']), PDO::PARAM_STR);
					$stmt -> bindValue(5, htmlspecialchars($_POST['given_kana']), PDO::PARAM_STR);
					$stmt -> bindValue(6, password_hash(htmlspecialchars($_POST['password']),PASSWORD_DEFAULT), PDO::PARAM_STR);
					$stmt -> bindValue(7, $y.'-'.$m.'-'.$d, PDO::PARAM_STR);
					$stmt -> bindValue(8, htmlspecialchars($_POST['postnum']), PDO::PARAM_STR);
					$stmt -> bindValue(9, htmlspecialchars($_POST['address']), PDO::PARAM_STR);
					$stmt -> bindValue(10, htmlspecialchars($_POST['tel']), PDO::PARAM_STR);
					$stmt -> bindValue(11, htmlspecialchars($_POST['email']), PDO::PARAM_STR);
					$stmt -> execute();
					$_SESSION["userid"] = serialize(htmlspecialchars($_POST["id"]));
					// $_SESSION["password"] = htmlspecialchars($_POST["password"]);
					// unset($_SESSION["message_Shinki"]);
					// header("Location: ../php/mypage.php");
					// exit;
				}
				else{
					$_SESSION['message_Shinki'] = "入力したユーザーIDはすでに使われております。";
					// header("Location: ../php/shinki.php");
					$resMes = "false";
				}

				$dbh = null;
			}catch(PDOException $e){
				$_SESSION['message_Shinki'] = $e;
				$resMes = "error";
				echo $resMes;
			}
		}

		if(!isset($_SESSION["message_Shinki"])){
			$resMes = session_name(). '='. session_id();
		}
		else{
			$resMes = $resMes . "\n" .session_name(). '='. session_id();
		}
		echo $resMes;
