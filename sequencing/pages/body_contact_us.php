<?php
	$myadmin = 'Y';
	
	$mystatus = '';	
	if(isset($_POST['mystatus']))
	{
		if ($_POST['mystatus'])
		{
			$mystatus = $_POST['mystatus'];
		}
	}
	if(isset($_GET['mystatus']))
	{
		if ($_GET['mystatus'])
		{
			$mystatus = $_GET['mystatus'];
		}
	}
	//echo '<br> mystatus : ' . $mystatus;
	
	$mybox = '';
	if(isset($_POST['mybox']))
	{
		if ($_POST['mybox'])
		{
			$mybox = $_POST['mybox'];
		}
	}
	if(isset($_GET['mybox']))
	{
		if ($_GET['mybox'])
		{
			$mybox = $_GET['mybox'];
		}
	}
	//echo '<br> mybox : ' . $mybox;
	
	if ($mybox != 'add')
	{
		$myadmin = 'N';
	}	
		

	if ($myadmin == 'N')
	{
		include('body_account_not_found.php');
	}
	else
	{

		if ($mystatus != 'sent')
		{	
$contact_id = '';
$contact_date = $globaldate;

$contact_subject = '';
$contact_name = '';
$contact_mobile = '';
$contact_email = '';

$contact_type = '';
$contact_desc = '';
$contact_status = 'Open';

$contact_active = 'Y';
$contact_user = $_SESSION["ulname"];
$contact_stamp = $globaldatetime;

$formtitle = 'ADD RECORD';			
?>	
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
					Contact Us Page
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
Please give us at least 3 days to reply to your inquiry
                        </div>
						
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
<form role="form" method="post" action="index.php?body=contact_us&mystatus=sent&mybox=<?php print($mybox); ?>">
	<div class="form-group">
		<label>Subject</label>
		<input class="form-control" placeholder="Enter subject title" name="contact_subject"  value="<?php print ("$contact_subject"); ?>" >
	</div>
	<div class="form-group">
		<label>Name</label>
		<input class="form-control" placeholder="Enter your name" name="contact_name"  value="<?php print ("$contact_name"); ?>" >
	</div>
	<div class="form-group">
		<label>Mobile No.</label>
		<input class="form-control" placeholder="Enter mobile #" name="contact_mobile"  value="<?php print ("$contact_mobile"); ?>" >
	</div>
	<div class="form-group">
		<label>Email</label>
		<input class="form-control" placeholder="Enter email" type="email" name="contact_email"  value="<?php print ("$contact_email"); ?>" >
	</div>
	<div class="form-group">
		<label>Message</label>
		<textarea class="form-control" rows="4" name="contact_desc"><?php print("$contact_desc"); ?></textarea>	
	</div>
	
	<input type="hidden" name="contact_id" value="<?php print ("$contact_id"); ?>" />
	<input type="hidden" name="contact_date" value="<?php print ("$contact_date"); ?>" />
	<input type="hidden" name="contact_status" value="<?php print ("$contact_status"); ?>" />
	<button type="submit" class="btn btn-default">Send Email</button>
	<button type="reset" class="btn btn-default">Reset</button>
</form>		
                                </div>		
                                <!-- /.col-lg-6 (nested) -->																								
							</div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
<?php
		}
		else
		{
$contact_id = $_POST['contact_id'];
$contact_date = $_POST['contact_date'];

$contact_subject = $_POST['contact_subject'];
$contact_name = $_POST['contact_name'];
$contact_mobile = $_POST['contact_mobile'];
$contact_email = $_POST['contact_email'];

$contact_type = $_POST['contact_type'];
$contact_desc = $_POST['contact_desc'];
$contact_status = $_POST['contact_status'];

$contact_active = 'Y';
$contact_user = $_SESSION["ulname"];
$contact_stamp = $globaldatetime;

//echo "<br> contact_id " . $contact_id;
?>	

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Contact Us Page</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<table width="100%">
								<tr>
									<td align="left">
Message beging sent...
									</td>
									<td align="right">
<a href="index.php?body=contact_us&mybox=add">
Send Another Message?
</a>	
									</td>
								</tr>
							</table>
                        </div>
										
						
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
	<div class="form-group">
		<label>Name</label>
		<br />
		 <? print("$contact_name"); ?>
	</div>
	<div class="form-group">
		<label>Mobile No.</label>
		<br />
		<? print("$contact_mobile"); ?>
	</div>
	<div class="form-group">
		<label>Email Address</label>
		<br />
		<? print("$contact_email"); ?>
	</div>
	<div class="form-group">
		<label>Result</label>
		<br />
		<? 
		if ($contact_name == '') 
		{
			echo "Missing name. Email Not Sent!";
		}
		else			
		if ($contact_subject == '') 
		{
			echo "Missing subject. Email Not Sent!";
		}
		else			
		if ($contact_desc == '') 
		{
			echo "Missing message. Email Not Sent!";
		}
		else				
		{
			$query_send = 
				"INSERT INTO contact_us (
					contact_id,
					contact_date,
					
					contact_subject,
					contact_name,
					contact_mobile,
					contact_email,
					
					contact_type,
					contact_desc,
					contact_status,
					
					contact_active,
					contact_user,
					contact_stamp
				) 
				VALUES 
				(
					'$contact_id',
					'$contact_date',
					
					'$contact_subject',
					'$contact_name',
					'$contact_mobile',
					'$contact_email',
					
					'$contact_type',
					'$contact_desc',
					'$contact_status',
					
					'$contact_active',
					'$contact_user',
					'$contact_stamp'
				)";	
	
			mysql_query($query_send) or die(mysql_error());   
		

			if ($user != "root")
			{
				if ($_SESSION['coemail'] = '')
				{
					$recipient = $_SESSION['coemail'];
					$recipient2 = 'vpower1978@yahoo.com';
					$subject = $_SESSION['coname'] . " : Inquiry Page [" . $contact_name . "]";
					$message = "Name : " . $contact_name . " \n\n" . "Mobile : " . $contact_mobile . " \n\n" . "Email : " . $contact_email . " \n\n" . "Subject : " . $contact_subject .  "\n\n" . "Message : " . $contact_desc;

					$mailheader = "From: $contact_email\n";
					$mailheader .= "Reply-To: $contact_email\n\n";
					mail($recipient, $subject, $message, $mailheader) or die ("Failure");
					mail($recipient2, $subject, $message, $mailheader) or die ("Failure");
				
					echo "Thank you we have received your inquiry!";
				}
				else
				{
					echo "Thank you we have received your inquiry! <br> But there is no default company email!";
				}
			}
			else
			{	
				echo "Thank you we have received your inquiry! <br> Although email was not sent due to ROOT account!";
			}
			
		}
/*
?>
<script type="text/javascript">setTimeout("window.close();", 50);
</script>	
<?php
*/
		?>				
	</div>
                                </div>		
                                <!-- /.col-lg-6 (nested) -->																								
							</div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->						
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<?php	
		}
	}
?>			