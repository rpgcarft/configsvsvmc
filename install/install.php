<?php
ini_set('display_errors', 0);
function getOS() {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        return "win";
    } else {
        return "linux";
    }
}
function full_url($s) {
            $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
            $sp = strtolower($s['SERVER_PROTOCOL']);
            $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
            $port = $s['SERVER_PORT'];
            $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
            $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : $s['SERVER_NAME'];
            $url = $protocol . '://' . $host . $port . $s['REQUEST_URI'];
            $explode = explode("install", $url);
            return $explode[0];
        }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
            <title>ติดตั้ง - ระบบร้านค้ามายคราฟ By : XcodedingZ </title>
            <link href="../assets/css/kanit.css" rel="stylesheet">
            <link rel="stylesheet" href="../assets/css/style-theme.css">
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-6jHF7Z3XI3fF4XZixAuSu0gGKrXwoX/w3uFPxC56OtjChio7wtTGJWRW53Nhx6Ev" crossorigin="anonymous">
            <link rel="stylesheet" href="../assets/fa/css/font-awesome.css">
            <link rel="stylesheet" href="../assets/css/sweetalert2.min.css" >
            <link rel="stylesheet" href="../assets/css/mary.css">
            <link rel="stylesheet" href="../assets/css/lt.css">
            <script src="../assets/js/sweetalert2.all.min.js"></script>
            <link rel="icon" href="<?php echo $setting['icon'];?>" sizes="16x16">
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
  background: url(https://images4.alphacoders.com/802/thumb-1920-802406.jpg) no-repeat center center fixed;
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


</head>

<body>
<div id="wrap">
    

<div class="container">
    <br><br><br>
    <div class="row">
    	<div class="col-lg-4">
            <div class="list-group fontsupermarket">
              <a class="list-group-item <?php if($_GET["step"] == "1"){echo 'active';}else{} ?>"><div class="list-group-item-heading"><i class="fa fa-cog"></i> Step 1 : Check</div> <p class="list-group-item-text font16">ตรวจสอบระบบ</p></a>
              <a class="list-group-item <?php if($_GET["step"] == "2"){echo 'active';}else{} ?>"><div class="list-group-item-heading"><i class="fa fa-cloud"></i> Step 2 : MySQL </div> <p class="list-group-item-text font16">ฐานข้อมูล</p></a>
              <a class="list-group-item <?php if($_GET["step"] == "3"){echo 'active';}else{} ?>"><div class="list-group-item-heading"><i class="fa fa-cogs"></i> Step 3 : Configuration</div> <p class="list-group-item-text font16">ตั้งค่าพื้นฐาน</p></a>
              <a class="list-group-item <?php if($_GET["step"] == "completed"){echo 'active';}else{} ?>"><div class="list-group-item-heading"><i class="fa fa-check"></i> Completed</div> <p class="list-group-item-text font16">เสร็จสิ้นการติดตั้ง</p></a>
            </div>        
        </div>
        <div class="col-lg-8 card">
            <div class="card-body">
                <?php if(!$_GET){$_GET["step"] = '1';}
                    if(!$_GET["step"])
                    {
                      $_GET["step"] = "1";
                    }
                    if($_GET['step'] == "1"){ ?>
                <h3><i class="fa fa-cog"></i> Step 1 : Check <small>ตรวจสอบระบบ</small></h3><hr>
<div class="text-center"><img src="https://yt3.ggpht.com/a/AGF-l79WZwViw4VemlNZ9NwxWqNhfBt7CObl1X6roQ=s900-c-k-c0xffffffff-no-rj-mo" style="width:30%"><hr></div>
    <dl class="dl-horizontal">
      Operation System<span class="pull-right"><i class="fa fa-check"></i> <?php echo(getOS() == "win") ? "Windows" : "Linux"; ?></span><p></p>
      PHP Version<span class="pull-right"><i class="fa fa-check"></i> <?php echo phpversion(); ?></span>
    </dl>
    
	<div class="alert alert-danger text-center">
		คำเตือน :  ถ้าเปลี่ยนลิขสิท หรือ ทำอย่างอื่น <b>ข้อมูลนั้นจะถูกล้างทั้งหมด เเละไม่สามารถ ติดตั้งได้เเอดจะไม่รับผิดชอบ!!</b>
	</div>
	
    <div id="section-debug">
        	<a class="btn btn-primary btn-lg btn-block btn-next" href="install.php?step=2">Step 2 : Database <small>: Database</small> <i class="fa fa-arrow-right"></i></a>
        </div>
                <?php }elseif($_GET['step'] == "2"){ ?>
                    <h3 class="page-header-sub fontsupermarket font24"><i class="fa fa-cloud"></i> Step 2 : MySQL  <small>ฐานข้อมูล</small></h3><hr>
<form class="form-horizontal form-panel" id="form" role="form" action="install.php?step=3" method="post">
              <div class="form-group font18" style="margin-left:10px;">
                <strong>MySQL Database</strong>
              </div>
                    <div class="row">
                <div class="col-md-6 mb-3">
			            <label for="host">Host</label>
                                    <input type="text" class="form-control" id="host" name="host" value="localhost" required>
			        </div>
                            <div class="col-md-6 mb-3">
                                  <label for="username">Username</label>
                               <input type="text" class="form-control" id="username" name="username" value="root" required>
                             </div>
                            <div class="col-md-6 mb-3">
                                <label for="password">Password</label>
                              <input type="text" class="form-control" id="password" name="password" value="password">
                            </div>
                        <div class="col-md-6 mb-3">
                    <label for="database">Database</label>
                  <input type="text" class="form-control" id="database" name="database" value="minecraft" required>
                </div>
                <div class="col-md-12 mb-3">
                     <label for="database_authme">AuthMe</label>
                     <input type="text" disabled="" class="form-control" id="database_authme" name="database_authme" value="authme" required>
                </div>
    </div>

      <button type="submit" class="btn btn-primary btn-lg btn-block btn-next"><i class="fa fa-arrow-right"></i> Step 3 : Configuration <small>: ตั้งค่าพื้นฐาน</small></button>
</form>
                <?php }elseif($_GET['step'] == "3"){ ?>
                    <?php
                    
                    	$strFileName = "../_system/_config.php";
                        $objFopen = fopen($strFileName, 'w');
                        $strText1 = "
<?php
     session_start();
     ob_start();
     ini_set('display_errors', 0);
     date_default_timezone_set(\"Asia/Bangkok\");

     // MySQL
     \$config[\"mysql_host\"] = \"".$_POST['host']."\";
     \$config[\"mysql_username\"] = \"".$_POST['username']."\";
     \$config[\"mysql_password\"] = \"".$_POST['password']."\";
      \$config[\"mysql_dbname\"] = \"".$_POST['database']."\";

     ?>
                ";
                        fwrite($objFopen, $strText1);
                        if($objFopen)
                        {
                                $error = "<b><font color='#339900'>Create config file at 'function/config.php' success.</font></b><br>";
                        }
                        else
                        {
                                $error = "<b><font color='#ff0000'>Create config file at 'function/config.php' fail.</font></b><br>";
                        }
                        fclose($objFopen);
///////
                     include_once '../_system/_database.php';
                    $templine = '';
				$lines = file('install.sql');
				foreach ($lines as $line){
					if (substr($line, 0, 2) == '--' || $line == ''){
						continue;
					}
					$templine .= $line;
					if (substr(trim($line), -1, 1) == ';'){
						@mysqli_query($connect,$templine);
						$templine = '';
					}
				} 
                                echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> ทำการติดตั้งไฟล์ Config.php และทำการ Insert Database เรียบร้อยแล้วครับ</div>'; 
                    ?>
                     <?php
                    $strFileName = "../_system/license.key";
                    $rand_license = substr(str_shuffle('abcdefghijABCDEFGHIJ123456789111213168778JHBUGDYi9yy8969G41516171819'),0,50);
                        $objFopen = fopen($strFileName, 'w');
                        $strText1 = "".$rand_license." "
                        . "ระบบร้านค้ามายคราฟ ตัวนี้นั้นถูกเขียนขึ้นโดย FlukzTH Copyright © 2018 KPZ STUDIO V.0.2";
                        fwrite($objFopen, $strText1);
                ?>
                    <div class="col-lg-12 PanelMain">
                	<h3 class="page-header-sub fontsupermarket font24"><i class="fa fa-cogs"></i> Step 3 : Configuration <small>ตั้งค่าพื้นฐาน</small></h3><hr>
                <form class="form-horizontal form-panel" id="form" role="form" action="install.php?step=completed" method="post">
                  <div class="form-group">
                    <label for="backend_password" class=" control-label">รหัสหลังร้าน</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="backend_password" placeholder="Password" name="backend_password" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name_server" class=" control-label">Site Title</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="name_server" name="name_server" value="MineShopSettingMC ระบบร้านค้ามายคราฟ" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="www" class=" control-label">Baseurl</label>
                    <div class="col-sm-12">
                      <input type="url" class="form-control" id="www" name="www" value="<?php echo full_url($_SERVER); ?>" required="">
                    </div>
                  </div>
                 <hr>

                      <button type="submit" class="btn btn-primary btn-lg btn-block btn-next"><i class="fa fa-arrow-right"></i> Completed <small>: เสร็จสิ้นการติดตั้ง</small></button>
                </form>

                        </div>
                <?php }elseif($_GET['step'] == "completed"){ ?>
                	<h3 class="page-header-sub fontsupermarket font24"><i class="fa fa-check"></i> Completed <small>เสร็จสิ้นการติดตั้ง</small></h3><hr>
    <div class="text-center"><img src="https://yt3.ggpht.com/a/AGF-l79WZwViw4VemlNZ9NwxWqNhfBt7CObl1X6roQ=s900-c-k-c0xffffffff-no-rj-mo" width="150" height="150"><hr></div>
	<?php
                        rmdir("../test");
                        include_once '../_system/_database.php';
			$sql_edit_tmtopup = 'UPDATE setting SET backend_password = "'.$_POST['backend_password'].'", name_server = "'.$_POST['name_server'].'", www = "'.$_POST['www'].'"';
			$query_edit_tmtopup = $connect->query($sql_edit_tmtopup);
			if($query_edit_tmtopup)
			{
				echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> ทำการตั้งค่าพื้นฐาน เรียบร้อยแล้วครับ</div>';
			}
			else
			{
				echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขการตั้งค่า Wallet ไม่สำเร็จ</strong></div>';

			} ?>
      
		<div class="text-center">	  
                    <a class="btn btn-success btn-lg btn-next" href="../index.php"><i class="fa fa-home"></i> XcodedingZ ระบบร้านค้ามายคราฟ</a><p></p>
			<a class="btn btn-info btn-lg  btn-next" href="../backend"><i class="fa fa-dashboard"></i> XcodedingZ หลังร้านค้า</a>
		</div>	

	<div class="alert alert-danger text-center fontquark" style="margin-top:20px;font-size:24px;">ขอบคุณที่เลือกใช้ค่าย XcodedingZ นะครับ</div>
     
                <?php } ?>
        </div>
        </div>
    </div>
    
    <hr class="style-six">
<div class="table-responsive" style="border:0;" >
<table class="table borderless" border="0" width="auto" height="auto">
<tbody>
<tr>
<td width="100">
<img src="https://yt3.ggpht.com/a/AGF-l79WZwViw4VemlNZ9NwxWqNhfBt7CObl1X6roQ=s900-c-k-c0xffffffff-no-rj-mo" width="60" height="60">
</td>
<td style="color: #fff;">
<div class="contx" style="padding:8px;color:#FFF; text-align:center;">
    <small style="font-size:14px;">Design &amp; System By <a href="https://www.facebook.com/DekThaiCraft.ml/" style="color:#FFF;text-decoration:underline;"><strong>XCodedingZ | BigoneGamer_TV</strong></a></small>
  </div>
</td>
</tr>
</tbody>
</table>
</div>
    
</div>
</div><!-- #wrap -->
</body>
<script id="dsq-count-scr" src="//startbootstrap.disqus.com/count.js" async type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous" type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous" type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
<script type="1bd4d45c54bc5ac897fcf366-text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script type="1bd4d45c54bc5ac897fcf366-text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
<script src="../assets/js/scripts.js" type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="1bd4d45c54bc5ac897fcf366-|49" defer=""></script></body>
</html>