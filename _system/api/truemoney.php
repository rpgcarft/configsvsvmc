<?php
	use Maythiwat\WalletAPI;
    require_once(__DIR__ . '/../func_wallet/_truewallet.php');
    require_once(__DIR__ . '/../_database.php');
    require_once(__DIR__ . '/../func_wallet/_loginTW.php');

    if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']) && isset($_POST['referen_token']) && isset($_POST['referen_token']))
	{
		if(isset($_GET['tmn']) && !empty($_GET['tmn']) && is_numeric($_GET['tmn']))
		{
			$tw = new WalletAPI();
			@$user = $_POST['email'];
			@$pass = $_POST['password'];
			@$reference_token = $_POST['referen_token'];
			@$tw_card = $_GET['tmn'];

			/* GET TOKEN */
			$sql_select_user = 'SELECT * FROM truewallet_token WHERE email = "'.$user.'"';
			$query_select_user = $connect->query($sql_select_user);
			$check_select_user = $query_select_user->num_rows;

			if($check_select_user == 0)
			{
				$login = new TrueWallet($user, $pass, $reference_token);
				$login->Login();
				$gettoken = $login->access_token;
				$insert_select_user = $connect->query('INSERT INTO truewallet_token (email,token) VALUES ("'.$user.'","'.$gettoken.'")');
				$token = $gettoken;
			}
			else
			{
				$login = new TrueWallet($user, $pass, $reference_token);
				$login->Login();
				$token = $login->access_token;

				$select_user = $query_select_user->fetch_assoc();
				$profile = $tw->GetProfile($select_user['token']);

				if($profile['code'] == '10001')
	            {
	                $token = $login->access_token;

	                $update_select_user = $connect->query('UPDATE truewallet_token SET token = "'.$token.'" WHERE email = "'.$user.'"');
	            }
	            elseif($profile['code'] == '20000')
	            {
	                $token = $select_user['token'];
	            }
				else
				{
					$login = new TrueWallet($user, $pass, $reference_token);
					$login->Login();
					$token = $login->access_token;

					$update_select_user = $connect->query('UPDATE truewallet_token SET token = "'.$token.'" WHERE email = "'.$user.'"');
				}
			}
			/* END GET TOKEN */
			
			$objtw = $tw->CashcardTopup($token, $tw_card);
			if(isset($objtw['amount']))
			{
				$objtw_amount = $objtw['amount']; // จำนวนเงิน
				$objtw_transactionId = $objtw['transactionId']; // หมายเลขอ้างอิง
				$objtw_serverFee = $objtw['serviceFree']; // ภาษีที่โดนหัก
				$objtw_cashcardPin = $objtw['cashcardPin']; // รหัสบัตรเงินสดทรูมันนี่
				$objtw_createDate = $objtw['createDate']; // วันเวลาที่เติมเข้าสู่ระบบ

				$data_s = array(
					'message' => 'success',
					'code' => '100',
					'transactionId' => $objtw_transactionId,
					'amount' => $objtw_amount,
					'serviceFee' => $objtw_serverFee,
					'cashcardPin' => $objtw_cashcardPin,
					'time' => $objtw_createDate
				);

				$send_data = json_encode($data_s);
				print_r($send_data);
			}
			else
			{
				$data_s = array(
					'message' => 'error',
					'code' => '404(3)'
				);

				$send_data = json_encode($data_s);
				print_r($send_data);
			}
		}
		else
		{
			$data_s = array(
				'message' => 'error',
				'code' => '404(2)'
			);

			$send_data = json_encode($data_s);
			print_r($send_data);
		}
	}
	elseif(isset($_GET['email']) && isset($_GET['password']) && !empty($_GET['email']) && !empty($_GET['password']) && isset($_GET['reference_token']) && isset($_POST['reference_token']))
	{
		if(isset($_GET['tmn']) && !empty($_GET['tmn']) && is_numeric($_GET['tmn']))
		{
			$tw = new WalletAPI();
			@$user = $_POST['email'];
			@$pass = $_POST['password'];
			@$reference_token = $_POST['reference_token'];
			@$tw_card = $_GET['tmn'];

			/* GET TOKEN */
			$sql_select_user = 'SELECT * FROM truewallet_token WHERE email = "'.$user.'"';
			$query_select_user = $connect->query($sql_select_user);
			$check_select_user = $query_select_user->num_rows;

			if($check_select_user == 0)
			{
				$login = new TrueWallet($user, $pass, $reference_token);
				$login->Login();
				$gettoken = $login->access_token;
				$insert_select_user = $connect->query('INSERT INTO truewallet_token (email,token) VALUES ("'.$user.'","'.$gettoken.'")');
				$token = $gettoken;
			}
			else
			{
				$login = new TrueWallet($user, $pass, $reference_token);
				$login->Login();
				$token = $login->access_token;

				$select_user = $query_select_user->fetch_assoc();
				$profile = $tw->GetProfile($select_user['token']);

				if($profile['code'] == '10001')
	            {
	                $token = $login->access_token;

	                $update_select_user = $connect->query('UPDATE truewallet_token SET token = "'.$token.'" WHERE email = "'.$user.'"');
	            }
	            elseif($profile['code'] == '20000')
	            {
	                $token = $select_user['token'];
	            }
				else
				{
					$login = new TrueWallet($user, $pass, $reference_token);
					$login->Login();
					$token = $login->access_token;

					$update_select_user = $connect->query('UPDATE truewallet_token SET token = "'.$token.'" WHERE email = "'.$user.'"');
				}
			}
			/* END GET TOKEN */
			
			$objtw = $tw->CashcardTopup($token, $tw_card);
			if(isset($objtw['amount']))
			{
				$objtw_amount = $objtw['amount']; // จำนวนเงิน
				$objtw_transactionId = $objtw['transactionId']; // หมายเลขอ้างอิง
				$objtw_serverFee = $objtw['serviceFree']; // ภาษีที่โดนหัก
				$objtw_cashcardPin = $objtw['cashcardPin']; // รหัสบัตรเงินสดทรูมันนี่
				$objtw_createDate = $objtw['createDate']; // วันเวลาที่เติมเข้าสู่ระบบ

				$data_s = array(
					'message' => 'success',
					'code' => '100',
					'transactionId' => $objtw_transactionId,
					'amount' => $objtw_amount,
					'serviceFee' => $objtw_serverFee,
					'cashcardPin' => $objtw_cashcardPin,
					'time' => $objtw_createDate
				);

				$send_data = json_encode($data_s);
				print_r($send_data);
			}
			else
			{
				$data_s = array(
					'message' => 'error',
					'code' => '404(3)'
				);

				$send_data = json_encode($data_s);
				print_r($send_data);
			}
		}
		else
		{
			$data_s = array(
				'message' => 'error',
				'code' => '404(2)'
			);

			$send_data = json_encode($data_s);
			print_r($send_data);
		}
	}
	else
	{
		$data_s = array(
			'message' => 'error',
			'code' => '404(1)'
		);

		$send_data = json_encode($data_s);
		print_r($send_data);
	}