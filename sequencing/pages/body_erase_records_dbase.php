<?php
	$ulerase_records = 'N';
	if(isset($_SESSION['ulerase_records']))
		$ulerase_records = $_SESSION['ulerase_records'];	

	$uladmin = 'N';
	if(isset($_SESSION['uladmin']))
		$uladmin = $_SESSION['uladmin'];	

	if ($uladmin == 'Y')
		$ulerase_records = 'Y';	

	if ($ulerase_records == 'N')
	{
		include('body_account_not_found.php');
	}
	else
	{
		/*LOG-IN FORM*/
	 	if ($_SESSION['logerase_records'] == '') 
		{
			$_SESSION['logerase_records'] = $_SESSION["ulname"];
			$modulename = 'erase_records';
			$updatedby = $_SESSION["ulname"];
			$logdate = $globaldate;
			$logstamp = $globaldatetime;
			$logtype = 'LOG-IN';
			$query = "INSERT INTO user_log (logdate, logform, logtype, loguser, logstamp) 
					  VALUES ('$logdate', '$modulename', '$logtype', '$updatedby', '$logstamp')";
			mysql_query($query) or die(mysql_error());   	
		}
		/*LOG-IN FORM*/	
		



		$tlsubmit = '';	
		if(isset($_POST['tlsubmit']))
		{
			if ($_POST['tlsubmit'])
			{
				$tlsubmit = $_POST['tlsubmit'];
			}
		}		
		//echo '<br> tlsubmit : ' . $tlsubmit;

		$tlday = '';	
		if(isset($_POST['tlday']))
		{
			if ($_POST['tlday'])
			{
				$tlday = $_POST['tlday'];
			}
		}		
		//echo '<br> tlday : ' . $tlday;
			
		$tlarea = '';	
		if(isset($_POST['tlarea']))
		{
			if ($_POST['tlarea'])
			{
				$tlarea = $_POST['tlarea'];
			}
		}		
		//echo '<br> tlarea : ' . $tlarea;			
				
		$tlsection = '';	
		if(isset($_POST['tlsection']))
		{
			if ($_POST['tlsection'])
			{
				$tlsection = $_POST['tlsection'];
			}
		}			
		//echo '<br> tlsection : ' . $tlsection;



		if (($tlsubmit != '') && ($tlday != '') && ($tlarea != '') && ($tlsection != ''))
		{
			//change status of ticket
			$query_ticket = 
			"DELETE FROM 
				ticket_list 
			WHERE 			
				tlday = '$tlday' and
				tlarea = '$tlarea' and
				tlsection = '$tlsection' ";
			mysql_query($query_ticket) or die('The entry has links to other tables. Cannot continue to process...');  			
		}
		
			
		$querydb  = "SELECT 
					 count(a.tlid) tlcount, 
					 a.tlday, a.tlarea, a.tlsection 
				   FROM 
					 ticket_list a
				   GROUP BY
					 a.tlday, a.tlarea, a.tlsection
				   ORDER BY 
					 a.tlday, a.tlarea, a.tlsection";
		$resultdb = mysql_query($querydb);
		//echo mysql_error();
		$num_count = mysql_num_rows($resultdb);		
		//echo "<br> num_count " . $num_count;
?>	
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Erase Records</h1>
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
Thie module allows the user to remove an entry based on Branch and Section
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
										<th>Section</th>
										<th>Count</th>
										<th>Option</th>
									</tr>
								</thead>
                                <tbody>
                                    
								
<?php
//fetch the results from the database
$countdb = $countdb + 1;
while ($rowdb =  mysql_fetch_array ($resultdb)) 
{
	print("<tr class=\"odd gradeX\">");

	print("<td align=\"center\" valign=\"middle\">$rowdb[tlday] </td>\n");
	print("<td align=\"center\" valign=\"middle\">$rowdb[tlarea]  </td>\n");
	print("<td align=\"center\" valign=\"middle\">$rowdb[tlsection]  </td>\n");
	print("<td align=\"center\" valign=\"middle\">$rowdb[tlcount]  </td>\n");

	print("<td align=\"CENTER\" valign=\"middle\">");
	?>
<form method="post" action="index.php?body=erase_records_dbase">
<INPUT TYPE="hidden" NAME="tlday" VALUE="<?php print($rowdb[tlday]); ?>">
<INPUT TYPE="hidden" NAME="tlarea" VALUE="<?php print($rowdb[tlarea]); ?>">
<INPUT TYPE="hidden" NAME="tlsection" VALUE="<?php print($rowdb[tlsection]); ?>">
<input type="submit" NAME="tlsubmit" VALUE="REMOVE" onclick="return confirm('Are you sure you want to remove this entry?')" />
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