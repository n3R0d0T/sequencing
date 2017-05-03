<?php
	$ulverify_ticket = 'N';
	if(isset($_SESSION['ulverify_ticket']))
		if ($_SESSION['ulverify_ticket'] == 'Y')
			$ulverify_ticket = $_SESSION['ulverify_ticket'];		

	$uladmin = 'N';
	if(isset($_SESSION['uladmin']))
		$uladmin = $_SESSION['uladmin'];	

	if ($uladmin == 'Y')
		$ulverify_ticket = 'Y';	
		
		
	$mystatus = '';	
	if(isset($_GET['mystatus']))
	{
		if ($_GET['mystatus'])
		{
			$mystatus = $_GET['mystatus'];
		}
	}
	//echo '<br> mystatus : ' . $mystatus;
	
	$mybox = '';	
	if(isset($_GET['mybox']))
	{
		if ($_GET['mybox'])
		{
			$mybox = $_GET['mybox'];
		}
	}
	//echo '<br> mybox : ' . $mybox;
	


	$my_ticket_id = '';	
	if(isset($_POST['my_ticket_id']))
	{
		if ($_POST['my_ticket_id'])
		{
			$my_ticket_id = $_POST['my_ticket_id'];
		}
	}
	//echo '<br> my_ticket_id : ' . $my_ticket_id;



	if ($mybox != 'add')
	{
		$ulverify_ticket = 'N';
	}	


	if ($ulverify_ticket == 'N')
	{
		include('body_account_not_found.php');
	}
	else
	{
		/*LOG-IN FORM*/
	 	if ($_SESSION['logverify_ticket'] == '') 
		{
			$_SESSION['logverify_ticket'] = $_SESSION["ulname"];
			$modulename = 'verify_ticket';
			$updatedby = $_SESSION["ulname"];
			$logdate = $globaldate;
			$logstamp = $globaldatetime;
			$logtype = 'LOG-IN';
			$query = "INSERT INTO user_log (logdate, logform, logtype, loguser, logstamp) 
					  VALUES ('$logdate', '$modulename', '$logtype', '$updatedby', '$logstamp')";
			mysql_query($query) or die(mysql_error());   	
		}
		/*LOG-IN FORM*/		
	
	
		//check if ticket exists
		$my_ticket_message = '';
	
		$tlid = '';
		$tldate = '';
		$tlbatch = '';
		$tlsequence = '';
		$tlcustomer = '';
		$tlcontact = '';
		$tltransid = '';
		$tlticket = '';
		$tlsection = '';
		$tlbranch = '';
		$tltransdate = '';
		$tlpayment = '';
		
		$tlday = '';
		$tlarea = '';
		$tlemail = '';

		$tltaken_date = '';
		$tltaken_swipe = '';
		$tltaken_status = '';
		
		$tlactive = '';
		$tluser = '';
		$tlstamp = '';
	
		if ($my_ticket_id != '')
		{
			$querydb  = "
				   SELECT  
					 *
				   FROM 
					 ticket_list a
				   WHERE
					 a.tlticket = '$my_ticket_id' ";			 
			$resultdb = mysql_query($querydb);
			while ($rowdb =  mysql_fetch_array ($resultdb)) 
			{
				$tlid = $rowdb[tlid];
				$tldate = $rowdb[tldate];
				$tlbatch = $rowdb[tlbatch];
				$tlsequence = $rowdb[tlsequence];
				$tlcustomer = $rowdb[tlcustomer];
				$tlcontact = $rowdb[tlcontact];
				$tltransid = $rowdb[tltransid];
				$tlticket = $rowdb[tlticket];
				$tlsection = $rowdb[tlsection];
				$tlbranch = $rowdb[tlbranch];
				$tltransdate = $rowdb[tltransdate];
				$tlpayment = $rowdb[tlpayment];
				
				$tlday = $rowdb[tlday];
				$tlarea = $rowdb[tlarea];
				$tlemail = $rowdb[tlemail];

				$tltaken_date = $rowdb[tltaken_date];
				$tltaken_swipe = $rowdb[tltaken_swipe];
				$tltaken_status = $rowdb[tltaken_status];
				
				$tlactive = $rowdb[tlactive];
				$tluser = $rowdb[tluser];
				$tlstamp = $rowdb[tlstamp];
			}
			
			//check if ticket exists
			//$tltaken_status =   TAKEN    CANCEL
			if ($tlid == '')
			{
				$my_ticket_message = 'Ticket does not exists!';
			}
			else
			if ($tltaken_status == 'TAKEN')
			{
				$my_ticket_message = 'Ticket scanned already!';
			}
			else
			if ($tltaken_status == 'CANCEL')
			{
				$my_ticket_message = 'Ticket already cancelled!';
			}
			else				
			{
				$my_ticket_message = 'VERFIED';
			}
		}
	
		
		$computer_user = $_SESSION["ulname"];
		$computer_stamp = $globaldatetime;
		

		$mytag = '';	
		if(isset($_GET['mytag']))
		{
			if ($_GET['mytag'])
			{
				$mytag = $_GET['mytag'];
			}
		}	
		
		$mybox = '';	
		if(isset($_GET['mybox']))
		{
			if ($_GET['mybox'])
			{
				$mybox = $_GET['mybox'];
			}
		}
		if(isset($_POST['mybox']))
		{
			if ($_POST['mybox'])
			{
				$mybox = $_POST['mybox'];
			}
		}		
		//echo '<br> mybox : ' . $mybox;				
?>		

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Verify Ticket ID</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
Basic Information
                        </div>
						
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
<form name="import" method="post" action="index.php?body=verify_ticket_dbase&mybox=add&mytag=POST">
	<div class="form-group">
		<label>Scan Ticket ID </label>
		<input class="form-control" type="text" name="my_ticket_id" autofocus required />
		<br>
		<button type="submit" class="btn btn-default">Verify</button>
		<button type="reset" class="btn btn-default">Reset</button>
	</div>
	
<?php		
	//echo "<br> my_ticket_id " . $my_ticket_id;
	//echo "<br> my_ticket_message " . $my_ticket_message;
	if ($my_ticket_message != '')
	{
		echo '<div class="form-group">';

		if ($my_ticket_message == 'VERFIED') 
		{							
			echo '<font size="+2"> Your ticket has been accepted!</font>';

			$tltaken_date = $globaldatetime;
			$tltaken_status = 'TAKEN';

			//update the table that the ticket has been accepted
			$query_verify = 
			"UPDATE 
				ticket_list 
			SET 
				tltaken_date = '$globaldatetime',
				tltaken_swipe = tltaken_swipe + 1,
				tltaken_status = 'TAKEN'
			WHERE 
				tlid = '$tlid' ";						
			mysql_query($query_verify) or die(mysql_error());   

		}
		else
		{
			echo '<font size="+2"> ' . $my_ticket_message . '</font>';
		}
		
		echo '</div>';
	}
?>		
</form>		
								</div>
							</div>
						</div>
					</div>
					
<?php
		if (($mytag == 'POST') && ($tlid != ''))
		{
?>

					<div class="panel panel-default">
                        <div class="panel-heading">
Ticket Information
                        </div>
						
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Field</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Day</td>
                                            <td><strong><?php print($tlday);?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Area</td>
                                            <td><strong><?php print($tlarea);?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Number</td>
                                            <td><strong><?php print($tlsequence);?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Name</td>
                                            <td><strong><?php print($tlcustomer);?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Email</td>
                                            <td><strong><?php print($tlemail);?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Daytime Phone</td>
                                            <td><strong><?php print($tlcontact);?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Serial No.</td>
                                            <td><strong><?php print($tlticket);?></strong></td>
                                        </tr>	
                                        <tr>
                                            <td>8</td>
                                            <td>Section</td>
                                            <td><strong><?php print($tlsection);?></strong></td>
                                        </tr>	
                                        <tr>
                                            <td>9</td>
                                            <td>Purchase Date</td>
                                            <td><strong><?php print($tltransdate);?></strong></td>
                                        </tr>																					
                                       
										<tr>
                                            <td>10</td>
                                            <td>Ticket Stamp</td>
                                            <td><strong><?php echo date('m/d/Y h:i:s A', strtotime($tltaken_date)); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>Ticket Status</td>
                                            <td><strong><?php print($tltaken_status);?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

<?php
		}
?>
					
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
										
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
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
<?php
	}
?>			