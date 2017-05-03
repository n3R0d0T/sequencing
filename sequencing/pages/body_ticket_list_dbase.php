<?php
	$ulticket_search = 'N';
	if(isset($_SESSION['ulticket_search']))
		$ulticket_search = $_SESSION['ulticket_search'];	

	$uladmin = 'N';
	if(isset($_SESSION['uladmin']))
		$uladmin = $_SESSION['uladmin'];	

	if ($uladmin == 'Y')
		$ulticket_search = 'Y';	

	if ($ulticket_search == 'N')
	{
		include('body_account_not_found.php');
	}
	else
	{
		/*LOG-IN FORM*/
	 	if ($_SESSION['logticket_search'] == '') 
		{
			$_SESSION['logticket_search'] = $_SESSION["ulname"];
			$modulename = 'ticket_search';
			$updatedby = $_SESSION["ulname"];
			$logdate = $globaldate;
			$logstamp = $globaldatetime;
			$logtype = 'LOG-IN';
			$query = "INSERT INTO user_log (logdate, logform, logtype, loguser, logstamp) 
					  VALUES ('$logdate', '$modulename', '$logtype', '$updatedby', '$logstamp')";
			mysql_query($query) or die(mysql_error());   	
		}
		/*LOG-IN FORM*/	
		




		$mybox = '';	
		if(isset($_POST['mybox']))
		{
			if ($_POST['mybox'])
			{
				$mybox = $_POST['mybox'];
			}
		}		
		//echo '<br> mybox : ' . $mybox;
				
		$mytlid = '';	
		if(isset($_POST['mytlid']))
		{
			if ($_POST['mytlid'])
			{
				$mytlid = $_POST['mytlid'];
			}
		}			
		//echo '<br> mytlid : ' . $mytlid;

		if (($mybox != '') && ($mytlid != ''))
		{
			//taken , cancel , empty
			$tluser = $_SESSION["ulname"];
			$tlstamp = $globaldatetime;
						
			if ($mybox != 'EMPTY')
			{
				//change status of ticket
				$query_ticket = 
				"UPDATE 
					ticket_list 
				SET 			
					tltaken_date = '$globaldatetime',
					tltaken_status = '$mybox',
					
					tluser = '$tluser',
					tlstamp = '$tlstamp'
				WHERE
					tlid = '$mytlid'";
				mysql_query($query_ticket) or die('The entry has links to other tables. Cannot continue to process...');  			
			}
			else
			{
				//change status of ticket
				$query_ticket = 
				"UPDATE 
					ticket_list 
				SET 			
					tltaken_date = NULL,
					tltaken_status = NULL,
					
					tluser = '$tluser',
					tlstamp = '$tlstamp'
				WHERE
					tlid = '$mytlid'";
				mysql_query($query_ticket) or die('The entry has links to other tables. Cannot continue to process...');  			
			}
		}
		
		
		$mytag = '';	
		if(isset($_GET['mytag']))
		{
			if ($_GET['mytag'])
			{
				$mytag = $_GET['mytag'];
			}
		}	


		$querydb  = "SELECT 
					 * 
				   FROM 
					 ticket_list a
				   ORDER BY 
					 a.tlday, a.tlarea, a.tlsection, a.tlsequence";
		$resultdb = mysql_query($querydb);
		//echo mysql_error();
		$num_count = mysql_num_rows($resultdb);		
		//echo "<br> num_count " . $num_count;
?>	
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Serial Number Search</h1>
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
This module allows you to filter records based on the search parameter									
									</td>
								</tr>
							</table>	
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>Day</th>
										<th>Area</th>
										<th>Number</th>
										<th>Name</th>
										<th>Email</th>
										<th>Daytime Phone</th>
										<th>Ticket ID</th>
										<th>Section</th>
										<th>Purchase Date</th>
										<th>Ticket Stamp</th>
										<th>Ticket Status</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
                                <tbody>
                                    
								
<?php
//fetch the results from the database
$countdb = $countdb + 1;
while ($rowdb =  mysql_fetch_array ($resultdb)) 
{
	print("<tr class=\"odd gradeX\">");

	print("<td align=\"left\" valign=\"middle\">$rowdb[tlday] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[tlarea] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[tlsequence] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[tlcustomer] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[tlemail] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[tlcontact] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[tlticket]  </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[tlsection]  </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[tltransdate]  </td>\n");
	
	if ($rowdb[tltaken_date] == '')
		 print("<td align=\"center\" valign=\"middle\">&nbsp;</td>\n");	
	else print("<td align=\"center\" valign=\"middle\">" .date('m/d/Y h:i:s A', strtotime($rowdb[tltaken_date])). "</td>\n");
	
	if ($rowdb[tltaken_status] == '')
		 print("<td align=\"center\" valign=\"middle\">&nbsp;</td>\n");	
	else print("<td align=\"center\" valign=\"middle\">$rowdb[tltaken_status]</td>\n");

	print("<td align=\"CENTER\" valign=\"middle\">");
	?>
<form method="post" action="index.php?body=ticket_list_dbase">
<INPUT TYPE="hidden" NAME="mytlid" VALUE="<?php print($rowdb[tlid]); ?>">
<INPUT TYPE="hidden" NAME="mybox" VALUE="TAKEN">
<input type="submit" NAME="mysubmit" VALUE="TAKEN" onclick="return confirm('Is this ticket already taken?')" />
</form>		
	<?php
	print("</td>");	
	print("<td align=\"CENTER\" valign=\"middle\">");
	?>
<form method="post" action="index.php?body=ticket_list_dbase">
<INPUT TYPE="hidden" NAME="mytlid" VALUE="<?php print($rowdb[tlid]); ?>">
<INPUT TYPE="hidden" NAME="mybox" VALUE="CANCEL">
<input type="submit" NAME="mysubmit" VALUE="CANCEL" onclick="return confirm('Is this ticket cancelled?')" />
</form>		
	<?php
	print("</td>");	
	print("<td align=\"CENTER\" valign=\"middle\">");
	?>
<form method="post" action="index.php?body=ticket_list_dbase">
<INPUT TYPE="hidden" NAME="mytlid" VALUE="<?php print($rowdb[tlid]); ?>">
<INPUT TYPE="hidden" NAME="mybox" VALUE="EMPTY">
<input type="submit" NAME="mysubmit" VALUE="EMPTY" onclick="return confirm('Do you want to reset this ticket?')" />
</form>		
	<?php	
	print("</td>");	
	print("</tr>");  
	$countdb = $countdb + 1;
}  
?>		
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>						
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php
	}
?>		