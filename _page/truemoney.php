<?php
	use Maythiwat\WalletAPI;
    require_once(__DIR__ . '/../_system/func_wallet/_truewallet.php');
    require_once '_system/func_wallet/_loginTW.php';

    $sql_wallet = 'SELECT * FROM wallet_account WHERE id = 1';
    $query_wallet = $connect->query($sql_wallet);

    if($query_wallet->num_rows == 1)
    {
    	$f_wallet = $query_wallet->fetch_assoc();
    	$wallet_email = $f_wallet['email'];
    	$wallet_password = $f_wallet['password'];
    	$wallet_phone = $f_wallet['phone'];
    	$wallet_name = $f_wallet['name'];
    	$wallet_message = $f_wallet['message'];
    	$wallet_reference_token = $f_wallet['reference_token'];
    }

    /* ห้ามแก้ไข */
	$config_tw = array(
		'email' => $wallet_email,
		'password' => $wallet_password,
		'referen_token' => $wallet_reference_token
	);
	/* จบการห้าม */

    function curl($url) {
		global $config_tw;
		$ch = curl_init();  
		$post = [
			'email' => $config_tw['email'],
			'password' => $config_tw['password'],
			'referen_token' => $config_tw['referen_token']
		];
		curl_setopt($ch, CURLOPT_URL, $url);    
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$data = curl_exec($ch);     
		curl_close($ch);    
		return $data; 
	}
?>
<script type="text/javascript">
	function NumbersOnly(e){
	    var keynum;
	    var keychar;
	    var numcheck;
	    if(window.event) {// IE
	        keynum = e.keyCode;
	    } else if(e.which) {// Netscape/Firefox/Opera
	        keynum = e.which;
	    }
	    if(keynum == 13 || keynum == 8 || typeof(keynum) == "undefined"){
	        return true;
	    }
	    keychar= String.fromCharCode(keynum);
	    numcheck = /^[0-9]$/;  // อยากจะพิมพ์อะไรได้มั่ง เติม regular expression ได้ที่ line นี้เลยคับ
	    return numcheck.test(keychar);
	}
</script>
 <div class="card  border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-credit-card"></i> เติมเงิน</h5>
                            <hr>
					<div class="row">
												<div class="col-md-12 col-12 text-center text-dark">
                                                                                                    <h5>อัตราการเติมเงินด้วย TrueMoney</h5><hr>
                                                                                                    <form name="topup_truemoney" method="POST">
							<div class="row">
								<div class="input-group col-md-12 mb-2">
									<input name="truemoney_password" type="text" onkeypress="return NumbersOnly(event);" class="form-control" placeholder="รหัสบัตรทรูมันนี่ 14 หลัก" required="" maxlength="14">
                                                                </div>
                                                        </div><p></p>
                                                                                                        <button name="btn_truemoney" type="submit" class="btn btn-primary btn-block">
										เติมเงิน
									</button>
                                                                                                    </form><hr>
			                <table class="table text-dark text-center">
				                <thead>
				                    <tr>
				                        <td class="py-1">ราคาเติม</td>
				                        <td class="py-1">พ้อยที่ได้</td>
				                    </tr>
				                </thead>
				               	<tbody>
				                   <tr>
				                   		<?php
				                   			$sql_truemoney_points = 'SELECT * FROM truemoney ORDER BY amount ASC';
			            					$query_truemoney_points = $connect->query($sql_truemoney_points);

			            					while($truemoney_points = $query_truemoney_points->fetch_assoc())
			            					{
			            						?>
													<td class="py-1"><?php echo $truemoney_points['amount']; ?> บาท</td>
							                        <td class="py-1"><?php echo $truemoney_points['points']; ?> <i class="fas fa-coins text-dark"></i></td>
							                        </tr><tr>
			            						<?php
			            					}
				                   		?>
				                    </tr>
				                </tbody>
			                </table>

			            </div>

				</div>
			</div>		
<?php
if(isset($_POST['btn_truemoney']))
						{
    if($_SESSION['username']){
							/* ห้ามแก้ไข หากไม่รู้ */
							$url_truemoney = "".$setting['www']."_system/api/truemoney.php?tmn=";
							@$tw_card = $connect->real_escape_string($_POST['truemoney_password']);
				            $tmn = json_decode(curl($url_truemoney.$tw_card));
							/* จบการห้ามแก้ไข */

				            if($tmn->code == '100')
				            {
				            	$objtw_amount = $tmn->amount;
				            	$sql_search = 'SELECT * FROM truemoney WHERE amount = "'.$objtw_amount.'"';
			            		$query_search = $connect->query($sql_search);

			            		if($query_search->num_rows != 0)
			            		{
			            			$fetch_search = $query_search->fetch_assoc();
			            			$update_amount = $fetch_search['points'];
			            		}
			            		else
			            		{
			            			$update_amount = 0;
			            		}

			            		$sql_updatepoints = 'UPDATE authme SET points = points+"'.$update_amount.'", topup = topup+"'.$objtw_amount.'", topup_m = topup_m+"'.$objtw_amount.'", rp = rp+"'.$objtw_amount.'" WHERE id = "'.$_SESSION['uid'].'"';
			            		$query_updatepoints = $connect->query($sql_updatepoints);
			            		if($query_updatepoints)
			            		{
			            			$activities_action = "TOPUP TrueMoney";
			            			$time_date = date("Y-m-d H:i");
			            			$sql_insert_log = 'INSERT INTO activities (uid,username,action,date,topup_amount,transaction) VALUES ("'.$_SESSION['uid'].'","'.$_SESSION['username'].'","'.$activities_action.'","'.$time_date.'","'.$objtw_amount.'","'.$tw_card.'")';
									$connect->query($sql_insert_log);

									$msg = 'คุณได้ทำการเติมเงินด้วยบัตรทรูมันนี่ '.$objtw_amount.' บาท';
									$alert = 'success';
									$msg_alert = 'สำเร็จ!';
			            		}
				            }
				            elseif($tmn->code == '404(3)')
				            {
				            	$msg = 'รหัสบัตรทรูมันนี่ถูกใช้งานแล้ว หรือ รหัสบัตรทรูมันนี่ผิด';
								$alert = 'error';
								$msg_alert = 'เกิดข้อผิดพลาด!';
				            }
				            elseif($tmn->code == '404(2)')
				            {
				            	$msg = 'เกิดข้อผิดพลาด รหัสบัตรเงินสดทรูมันนี่ไม่ถูกต้อง';
								$alert = 'error';
								$msg_alert = 'เกิดข้อผิดพลาด!';
				            }
				            elseif($tmn->code == '404(1)')
				            {
				            	$msg = 'เกิดข้อผิดพลาด กรุณาแจ้งแอดมินติดต่อผู้พัฒนา (WEBSHOP)';
								$alert = 'error';
								$msg_alert = 'เกิดข้อผิดพลาด!';
				            }
				            else
				            {
				            	$msg = 'เกิดข้อผิดพลาด ไม่ทราบสาเหตุ';
								$alert = 'error';
								$msg_alert = 'เกิดข้อผิดพลาด!';
				            }
				           
			            	?>
			            		<script>
									swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
										button: "Reload",
									})
									.then((value) => {
										window.location.href = window.location.href;
									});
								</script>
			            	<?php }else{
                                                    $msg = 'เกิดข้อผิดพลาด กรุณาเข้าสู่ระบบ';
									$alert = 'error';
									$msg_alert = 'เกิดข้อผิดพลาด!';
      ?>
                                                                        <script>
									swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
										button: "Reload",
									})
									.then((value) => {
										window.location.href = window.location.href;
									});
								</script>
                                             <?php    } } ?>
 </div>
