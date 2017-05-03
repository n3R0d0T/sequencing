<?php
	include "./pages/config829290383029.php"; 
	$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword")or die("cannot connect to server ");
	@mysql_select_db("$dbdatabase")or die("Unable to select database.");

	//echo '<br> globaldate : ' . $globaldate;
	//echo '<br> globaldatetime : ' . $globaldatetime;

	$my_ticket_id = ''; 		
	if(isset($_GET['my_ticket_id']))
	{
		if ($_GET['my_ticket_id'])
		{
			$my_ticket_id = $_GET['my_ticket_id'];
		}
	}
	$my_ticket_id = mysql_real_escape_string($my_ticket_id);

	$coname = '';
	$coaddr = '';
	$coevent_name = '';
	$coevent_tag = '';
	$coevent_logo = '';
	$coevent_print = '';
	
	$query_show = " 
		SELECT *
		FROM company_list a
		WHERE a.coactive = 'Y' ";
	$result_show = mysql_query($query_show) or die('Error : purchase_list Show Entry : ' . mysql_error());	
	while ($row_show =  mysql_fetch_array ($result_show)) 
	{
		$coname = $row_show[coname];
		$coaddr = $row_show[coaddr];
		$coevent_name = $row_show[coevent_name];
		$coevent_tag = $row_show[coevent_tag];
		$coevent_logo = $row_show[coevent_logo];
		$coevent_print = $row_show[coevent_print];
	}	

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
    $tlnote = '';

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
            $tlnote = $rowdb[tlnote];
		}
		

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
	mysql_close($link);		
	
	if (($my_ticket_id != '') && ($tlid != ''))
	{	
?>
        
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="cs" />
	<title>.</title>
</head>

<body onLoad="self.print()">

<table width="800px" align="center" cellpadding="5px" cellspacing="5px">
	<tr>
		<td align="center" valign="middle">
	
			<table width="500px" border="1">
				<tr>
					<td align="center" valign="middle">

				
						<table width="100%" cellpadding="10px" style="font-family:arial;">
							<tr>
								<td align="center" valign="middle">
				
									<?php
									//echo " <br> ulpicture " . $_SESSION['ulpicture'];
									if ($coevent_print != '')
									{						
									?>
										<img src="./pages/events/<?php print($coevent_print); ?>" alt="logo" width="200px">
									<?php
									}
									?>
											
								</td>
								<td align="center" valign="middle">
									<strong style="font-size:72px">DAY <?php print($tlday); ?></strong>					
									<br>
									<strong style="font-size:72px"><?php print($tlarea); ?> - <?php print($tlsequence);?></strong>
									<?php
									if ($tltaken_swipe > 0) 
									{
										print('<br><br><font size="+1">Re-Printed ' . $tltaken_swipe . 'X</font>');	
									}
									?>														
								</td>
							</tr>
				
							<tr>
                                <td><font size="+2">Name</font> </td>
                                <td ><font size="+2"><?php print($tlcustomer);?></font></td>
							</tr>
							<!--<tr>
								<td>Email </td>
								<td><?php print($tlemail);?></td>
							</tr>
							<tr>
								<td>Contact </td>
								<td><?php print($tlcontact);?></td>
							</tr> -->
							<tr>
                                <td><font size="+2">Ticket ID</font></td>
                                <td><font size="+2"><?php print($tlticket);?></font></td>
							</tr>	
							<tr>
                                <td><font size="+2">Section</font></td>
                                <td><font size="+2"><?php print($tlsection);?></font></td>
							</tr>
                            <tr>
                                <td><font size="+2">Note</font></td>
                                <td><font size="+2"><?php print($tlnote);?></font></td>
							</tr>
						</table>

					</td>
				</tr>
			</table>		
			
		</td>
	</tr>
	<tr>
		<td align="left" >
<br />
<br />
<strong>PLEASE BE REMINDED OF THE FOLLOWING:  </strong>
<br /><br />
1. This <strong>PRINTOUT</strong> will serve as your <strong>Queuing Stub</strong>. So <strong>DO NOT FORGET</strong> to <strong>BRING</strong> this with you together with your ticket on Concert Day.       
<br />
&nbsp;&nbsp;&nbsp; 
<br />
2. Strictly <strong><em>NO PRINTOUT, NO LINEUP SEQUENCE.</em></strong> 
<br /><br />
3. Be Guided with the <strong>LINE UP SCHEDULE</strong> below:
<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>- DAY 1 (May 6) : Line will open at <em>2:00pm</em> and will close at <em>5:00pm</em></strong>
<br />
** if you arrive later than 5:00pm, you will not be allowed to join the line up sequence anymore, but instead, join the regular line of those without sequence.
<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>- DAY 2 (May 7) : Line will open at <em>12:00noon</em>, and will close at <em>3:00pm</em></strong>
<br />
** if you arrive later than 3:00pm, you will not be allowed to join the line up sequence anymore, but instead, join the regular line of those without sequence.
<br /><br />
4. Designated PULP Ushers will assist you in the Lineup, please observe proper lineup etiquette. <br /><br />
5. Line Up sequence is for venue entrance purpose only. It will be your option where to stand once you are inside the main concert hall.


<br />

		</td>
	</tr>
</table>		

<?php
/*		
<script type="text/javascript">setTimeout("window.close();", 50);
</script>	
*/
?>

</body>

</html>	

<?php
	}	
	else
	{
?>
		<HTML> 		
		<meta http-equiv="refresh" content="0;URL=index.php">  
		</HTML>
<?php	
	}
?>

