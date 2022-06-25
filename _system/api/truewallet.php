<?php
	use Maythiwat\WalletAPI;
    require_once(__DIR__ . '/../func_wallet/_truewallet.php');
    require_once(__DIR__ . '/../_database.php');
    require_once(__DIR__ . '/../func_wallet/_loginTW.php');

	if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']) && isset($_POST['referen_token']) && isset($_POST['referen_token']))
	{
		if(isset($_GET['transaction']) && !empty($_GET['transaction']) && is_numeric($_GET['transaction']))
		{

			$tw = new WalletAPI();
			@$user = $_POST['email'];
			@$pass = $_POST['password'];
			@$reference_token = $_POST['referen_token'];

			/* Time Settings */
			$now_datetime = date('d/m/Y H:i');
			$today_day =  date("d");
			$today_month = date("m");
			$today_year =  date("Y");
			$today_year_s = $today_year - 1;
			$today_use_check_s = $today_year_s."-".$today_month."-".$today_day;
			$today_year_e = $today_year + 1;
			$today_use_check_e = $today_year_e."-".$today_month."-".$today_day;
			/* END Time Settings */

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

			/* GET TRANSACTION */
			$activities = $tw->FetchActivities($token, $today_use_check_s, $today_use_check_e);
			$fti_u = NULL;
			foreach($activities as $arr)
			{
				if($arr['original_action'] == 'creditor')
				{
				    $data = $tw->FetchTxDetail($token, $arr['report_id']);
				    $flr = $data['data'];
				    $fti = $flr['section4']['column2']['cell1']['value'];
				    $ftam = $flr['amount'];
				    $ftm = $flr['personal_message']['value'];
				    $ftphone = $flr['ref1'];
				    $fttime = $flr['section4']['column1']['cell1']['value'];

				    if($fti == $_GET['transaction'])
					{
						$fti_u = $fti; // หมายเลขอ้างอิง
						$ftam_u = $ftam; // จำนวนเงิน
						$ftm_u = $ftm; // ข้อความ
						$ftphone_u = $ftphone; // เบอร์ที่โอนมา
						$fttime_u = $fttime; // วันที่และเวลาที่ทำรายการ
						$ftreport_u = $arr['report_id']; // Report ID
						break;
					}
				}
			}
			/* END GET TRANSACTION */

			/* CHECK TRANSACTION */
			if($fti_u == $_GET['transaction'])
			{
				$data_s = array(
					'message' => 'success',
					'code' => '100',
					'reportID' => $ftreport_u,
					'transaction' => $fti_u,
					'amount' => $ftam_u,
					'message_transfer' => $ftm_u,
					'phone' => $ftphone_u,
					'time' => $fttime_u
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
			/* END CHECK TRANSACTION */
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
	elseif(isset($_GET['email']) && isset($_GET['password']) && $_GET['reference_token'])
	{
		if(isset($_GET['transaction']) && !empty($_GET['transaction']) && is_numeric($_GET['transaction']))
		{

			$tw = new WalletAPI();
			@$user = $_GET['email'];
			@$pass = $_GET['password'];
			@$reference_token = $_GET['reference_token'];

			/* Time Settings */
			$now_datetime = date('d/m/Y H:i');
			$today_day =  date("d");
			$today_month = date("m");
			$today_year =  date("Y");
			$today_year_s = $today_year - 1;
			$today_use_check_s = $today_year_s."-".$today_month."-".$today_day;
			$today_year_e = $today_year + 1;
			$today_use_check_e = $today_year_e."-".$today_month."-".$today_day;
			/* END Time Settings */

			$login = new TrueWallet($user, $pass, $reference_token);
			$login->Login();
			$token = $login->access_token;

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

			/* GET TRANSACTION */
			$activities = $tw->FetchActivities($token, $today_use_check_s, $today_use_check_e);
			$fti_u = NULL;
			foreach($activities as $arr)
			{
				if($arr['original_action'] == 'creditor')
				{
				    $data = $tw->FetchTxDetail($token, $arr['report_id']);
				    $flr = $data['data'];
				    $fti = $flr['section4']['column2']['cell1']['value'];
				    $ftam = $flr['amount'];
				    $ftm = $flr['personal_message']['value'];
				    $ftphone = $flr['ref1'];
				    $fttime = $flr['section4']['column1']['cell1']['value'];

				    if($fti == $_GET['transaction'])
					{
						$fti_u = $fti; // หมายเลขอ้างอิง
						$ftam_u = $ftam; // จำนวนเงิน
						$ftm_u = $ftm; // ข้อความ
						$ftphone_u = $ftphone; // เบอร์ที่โอนมา
						$fttime_u = $fttime; // วันที่และเวลาที่ทำรายการ
						$ftreport_u = $arr['report_id']; // Report ID
						break;
					}
				}
			}
			/* END GET TRANSACTION */

			/* CHECK TRANSACTION */
			if($fti_u == $_GET['transaction'])
			{
				$data_s = array(
					'message' => 'success',
					'code' => '100',
					'reportID' => $ftreport_u,
					'transaction' => $fti_u,
					'amount' => $ftam_u,
					'message_transfer' => $ftm_u,
					'phone' => $ftphone_u,
					'time' => $fttime_u
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
			/* END CHECK TRANSACTION */
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
?>