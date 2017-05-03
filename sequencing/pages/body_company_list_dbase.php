<?php 
	$ulcompany_list = 'N';
	if(isset($_SESSION['ulcompany_list']))
		$ulcompany_list = $_SESSION['ulcompany_list'];	

	$uladmin = 'N';
	if(isset($_SESSION['uladmin']))
		$uladmin = $_SESSION['uladmin'];	

	if ($uladmin == 'Y')
		$ulcompany_list = 'Y';	

	if ($ulcompany_list == 'N')
	{
		include('body_account_not_found.php');
	}
	else
	{
		/*LOG-IN FORM*/
	 	if ($_SESSION['logcompany_list'] == '') 
		{
			$_SESSION['logcompany_list'] = $_SESSION["ulname"];
			$modulename = 'company_list';
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
		
		$search_text = '';
		$search_text = $_POST["search_text"];	
		
		if(isset($_GET['search_text']))
		{
			if ($_GET['search_text'])
			{
				$search_text = $_GET['search_text'];
			}
		}	
			
		$querydb  = "SELECT 
					 a.* 
				   FROM 
					 company_list a
				   WHERE
					 a.coname LIKE '%$search_text%' 
				   ORDER BY 
					 a.coname";
		$resultdb = mysql_query($querydb);
		//echo mysql_error();
		$num_count = mysql_num_rows($resultdb);		
		//echo "<br> num_count " . $num_count;
?>	
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Company List</h1>
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
<?php
/*						
<form method="post" action="index.php?body=company_list_dbase">
Filter By Company Name
<INPUT TYPE="TEXT" NAME="search_text" VALUE="<?php print($search_text); ?>" SIZE="25" MAXLENGTH="50">
<input type="submit" value="Filter" />
</form>									
*/
?>
Table Information
									</td>
									<td align="right">
<?php 
if ($num_count == 1) 
{
	print("&nbsp;");
}
else
{
?>
	<a title="Add a new entry?" href="index.php?body=company_list_addeditdel&mybox=add">
	Add Record
	</a>
<?php
}
?>
									</td>
								</tr>
							</table>	
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>Company </th>
										<th>Address</th>
										<th>Telephone</th>
										<th>Fax</th>
										<th>Mobile</th>
										<th>Email</th>
										<th>Website</th>
										<th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
								
<?php
//fetch the results from the database
$countdb = $countdb + 1;
while ($rowdb =  mysql_fetch_array ($resultdb)) 
{
	print("<tr>");

	print("<td align=\"left\" valign=\"middle\">$rowdb[coname] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[coaddr] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[cophone] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[cofax] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[comobile] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[coemail] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[cowebsite] </td>\n");

	print("<td align=\"CENTER\" valign=\"middle\">");
	print("[ <a title=\"Update entry?\" href=\"index.php?body=company_list_addeditdel&mybox=edit&coid=$rowdb[coid]\"> Update </a> ] 
	<br><br>
			[ <a title=\"Delete this entry?\" href=\"index.php?body=company_list_addeditdel&mybox=del&coid=$rowdb[coid]\"> Delete </a> ]");
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