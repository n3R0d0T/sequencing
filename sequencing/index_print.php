<?php
	$my_ticket_id = ''; 		
	if(isset($_POST['my_ticket_id']))
	{
		if ($_POST['my_ticket_id'])
		{
			$my_ticket_id = $_POST['my_ticket_id'];
		}
	}
	if(isset($_GET['my_ticket_id']))
	{
		if ($_GET['my_ticket_id'])
		{
			$my_ticket_id = $_GET['my_ticket_id'];
		}
	}

	$coname = '';
	$coaddr = '';

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
	
	$tltaken_date = '';
	$tltaken_swipe = '';
	$tltaken_status = '';
	
	$tlactive = '';
	$tluser = '';
	$tlstamp = '';

	if ($my_ticket_id != '')
	{
		include "./pages/config829290383029.php"; 
		
		//echo '<br> globaldate : ' . $globaldate;
		//echo '<br> globaldatetime : ' . $globaldatetime;
		
		$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword")or die("cannot connect to server ");
		@mysql_select_db("$dbdatabase")or die("Unable to select database.");
	
		$query_show = " 
			SELECT *
			FROM company_list a
			WHERE a.coactive = 'Y' ";
		$result_show = mysql_query($query_show) or die('Error : purchase_list Show Entry : ' . mysql_error());	
		while ($row_show =  mysql_fetch_array ($result_show)) 
		{
			$coname = $row_show[coname];
			$coaddr = $row_show[coaddr];
		}
			
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
			
			$tltaken_date = $rowdb[tltaken_date];
			$tltaken_swipe = $rowdb[tltaken_swipe];
			$tltaken_status = $rowdb[tltaken_status];
			
			$tlactive = $rowdb[tlactive];
			$tluser = $rowdb[tluser];
			$tlstamp = $rowdb[tlstamp];
		}
		
		mysql_close($link);		
	}
	
	if (($my_ticket_id != '') && ($tlid != ''))
	{	
?>
        
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="cs" />
	<link href="./css/screen_print.css" type="text/css" rel="stylesheet" media="screen,projection" />
	<title>.</title>
      <style type="text/css">
         table.one {
		 	font-family: 'Trebuchet MS', 'Geneva CE', lucida, sans-serif;
            border-collapse:separate;
            border-spacing:1px;
         }
      </style>	
</head>

<body onLoad="self.print()">

<table width="800px" align="center">
	<tr>
		<td align="center">
    
		<font size="+2"><?php print($coname); ?></font>
		<br>
		<strong><?php print($coaddr); ?></strong>
		<br>
		<font size="+2">Ticket Form</font>
<?php
	if ($tltaken_swipe > 1) 
	{
		print('<br><font size="+1">Re-Printed ' . $tltaken_swipe . 'X</font>');	
	}
?>		
		<br>
		<table border="1">
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
					<td>Sequence No.</td>
					<td><strong><?php print($tlsequence);?></strong></td>
				</tr>
				<tr>
					<td>2</td>
					<td>Customer Name</td>
					<td><strong><?php print($tlcustomer);?></strong></td>
				</tr>
				<tr>
					<td>3</td>
					<td>Contact No.</td>
					<td><strong><?php print($tlcontact);?></strong></td>
				</tr>
				<tr>
					<td>4</td>
					<td>Transaction ID</td>
					<td><strong><?php print($tltransid);?></strong></td>
				</tr>
				<tr>
					<td>5</td>
					<td>Ticket ID</td>
					<td><strong><?php print($tlticket);?></strong></td>
				</tr>	
				<tr>
					<td>6</td>
					<td>Section</td>
					<td><strong><?php print($tlsection);?></strong></td>
				</tr>	
				<tr>
					<td>7</td>
					<td>Branch</td>
					<td><strong><?php print($tlbranch);?></strong></td>
				</tr>																					
				<tr>
					<td>8</td>
					<td>Transaction Date</td>
					<td><strong><?php print($tltransdate);?></strong></td>
				</tr>																					
				<tr>
					<td>9</td>
					<td>Payment Type</td>
					<td><strong><?php print($tlpayment);?></strong></td>
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
			
		</td>
	</tr>
</table>		
		
<script type="text/javascript">setTimeout("window.close();", 50);
</script>	

</body>

</html>	

<?php
	}	
?>
