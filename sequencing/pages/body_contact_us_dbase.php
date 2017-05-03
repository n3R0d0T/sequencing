<?php
	$ulcontactus_list = 'N';
	if(isset($_SESSION['ulcontactus_list']))
		$ulcontactus_list = $_SESSION['ulcontactus_list'];	

	$uladmin = 'N';
	if(isset($_SESSION['uladmin']))
		$uladmin = $_SESSION['uladmin'];	

	if ($uladmin == 'Y')
		$ulcontactus_list = 'Y';	

	if ($ulcontactus_list == 'N')
	{
		include('body_account_not_found.php');
	}
	else
	{
		/*LOG-IN FORM*/
	 	if ($_SESSION['logcontactus_list'] == '') 
		{
			$_SESSION['logcontactus_list'] = $_SESSION["ulname"];
			$modulename = 'contactus_list';
			$updatedby = $_SESSION["ulname"];
			$logdate = $globaldate;
			$logstamp = $globaldatetime;
			$logtype = 'LOG-IN';
			$query = "INSERT INTO user_log (logdate, logform, logtype, loguser, logstamp) 
					  VALUES ('$logdate', '$modulename', '$logtype', '$updatedby', '$logstamp')";
			mysql_query($query) or die(mysql_error());   	
		}
		/*LOG-IN FORM*/	
		
		$mytag = '';	
		if(isset($_GET['mytag']))
		{
			if ($_GET['mytag'])
			{
				$mytag = $_GET['mytag'];
			}
		}	
		
		$search_email = '';
		$search_email = $_POST["search_email"];	
		
		if(isset($_GET['search_email']))
		{
			if ($_GET['search_email'])
			{
				$search_email = $_GET['search_email'];
			}
		}	

		$search_name = '';
		$search_name = $_POST["search_name"];	
		
		if(isset($_GET['search_name']))
		{
			if ($_GET['search_name'])
			{
				$search_name = $_GET['search_name'];
			}
		}	
		
		$search_contact = '';
		$search_contact = $_POST["search_contact"];	
		
		if(isset($_GET['search_contact']))
		{
			if ($_GET['search_contact'])
			{
				$search_contact = $_GET['search_contact'];
			}
		}
		

		$cuid = '';
		$cuid = $_POST["cuid"];	
		
		if(isset($_GET['cuid']))
		{
			if ($_GET['cuid'])
			{
				$cuid = $_GET['cuid'];
			}
		}		
		
		$mystatus = '';
		$mystatus = $_POST["mystatus"];	
		
		if(isset($_GET['mystatus']))
		{
			if ($_GET['mystatus'])
			{
				$mystatus = $_GET['mystatus'];
			}
		}
		
		if (($mystatus != '') and ($cuid != ''))
		{
			$mytag = '';
			$cuuser = $_SESSION["ulname"];
			$custamp = $globaldatetime;

			if ($mystatus == 'read') {$mytag = 'R';}
			if ($mystatus == 'action') {$mytag = 'A';}
			if ($mystatus == 'remove') {$mytag = 'N';}
			
			if (($mytag != '') && ($mytag != 'N'))
			{
				$query = 
					"UPDATE 
						contact_us 
					SET 
						cuactive = '$mytag',
						cuapprove_by = '$cuuser',
						cuapprove_date = '$custamp'
					WHERE
						cuid = '$cuid'";
				mysql_query($query) or die('The entry has links to other tables. Cannot continue to process...');  
			}
			else
			{
				$query = 
					"DELETE	FROM contact_us WHERE cuid = '$cuid'";
				mysql_query($query) or die('The entry has links to other tables. Cannot continue to process...');  
			}
		}		
					
		$querydb  = "SELECT 
					 * 
				   FROM 
					 contact_us a
				   ORDER BY 
					 a.contact_stamp";
		$resultdb = mysql_query($querydb);
		//echo mysql_error();
		$num_count = mysql_num_rows($resultdb);		
		//echo "<br> num_count " . $num_count;
?>	
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Contact Us Messages</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
<?php
/*						
							<table width="100%">
								<tr>
									<td align="left">
<form method="post" action="index.php?body=contact_us_dbase">
Filter Name
<INPUT TYPE="TEXT" NAME="search_name" VALUE="<?php print($search_name); ?>" SIZE="25" MAXLENGTH="20">
&nbsp;&nbsp;&nbsp;
Filter Email
<INPUT TYPE="TEXT" NAME="search_email" VALUE="<?php print($search_email); ?>" SIZE="15" MAXLENGTH="20">
&nbsp;&nbsp;&nbsp;
Filter Contact No.
<INPUT TYPE="TEXT" NAME="search_contact" VALUE="<?php print($search_contact); ?>" SIZE="25" MAXLENGTH="20">
&nbsp;&nbsp;&nbsp;
<input type="submit" value="Filter" />
</form>									
*/
?>
Table Information
									</td>
									<td align="right">&nbsp;

									</td>
								</tr>
							</table>	
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>Subject</th>
										<th>Name</th>
										<th>Mobile</th>
										<th>Email</th>
										<th width="15%">Message</th>
										<th>Date Stamp</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
//fetch the results from the database
$countdb = $countdb + 1;
while ($rowdb =  mysql_fetch_array ($resultdb)) 
{
	print("<tr>");

	print("<td align=\"left\" valign=\"middle\">$rowdb[contact_subject] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[contact_name] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[contact_mobile] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[contact_email] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[contact_desc] </td>\n");
	print("<td align=\"left\" valign=\"middle\">" . date('m/d/Y h:i:s A', strtotime($rowdb[contact_stamp])) . "</td>");

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