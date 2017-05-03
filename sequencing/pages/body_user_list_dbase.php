<?php
	$uluser_list = 'N';
	if(isset($_SESSION['uluser_list']))
		$uluser_list = $_SESSION['uluser_list'];	

	$uladmin = 'N';
	if(isset($_SESSION['uladmin']))
		$uladmin = $_SESSION['uladmin'];	

	if ($uladmin == 'Y')
		$uluser_list = 'Y';	

	if ($uluser_list == 'N')
	{
		include('body_account_not_found.php');
	}
	else
	{
		/*LOG-IN FORM*/
	 	if ($_SESSION['loguser_list'] == '') 
		{
			$_SESSION['loguser_list'] = $_SESSION["ulname"];
			$modulename = 'user_list';
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
		
		$myblid = $_SESSION['myblid'];
		$uluser_list = $_SESSION['uluser_list'];
			
		$querydb  = "SELECT 
					 * 
				   FROM 
					 user_list a
				   WHERE
					 a.ulname LIKE '%$search_text%' ";
					 
		$querydb  = $querydb . "  
				   ORDER BY 
					 a.ulname";
		$resultdb = mysql_query($querydb);
		//echo mysql_error();
		$num_count = mysql_num_rows($resultdb);		
		//echo "<br> num_count " . $num_count;
?>	
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User List</h1>
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
<form method="post" action="index.php?body=user_list_dbase">
Filter By User Name
<INPUT TYPE="TEXT" NAME="search_text" VALUE="<?php print($search_text); ?>" SIZE="25" MAXLENGTH="50">
<input type="submit" value="Filter" />
</form>									
*/
?>
Table Information
									</td>
									<td align="right">
<a title="Add a new entry?" href="index.php?body=user_list_addeditdel&mybox=add">
Add Record
</a>
									</td>
								</tr>
							</table>	
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th width="20%">Name</th>
										<th width="20%">Phone</th>
										<th width="20%">Email</th>
										<th width="20%">Mobile</th>
										<th>Active</th>
										<th>User/Stamp</th>
										<th>Modify</th>
										<th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
								
<?php
//fetch the results from the database
$countdb = $countdb + 1;
while ($rowdb =  mysql_fetch_array ($resultdb)) 
{
	print("<tr class=\"odd gradeX\">");

	print("<td align=\"left\" valign=\"middle\">$rowdb[ulname]</td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[ulphone]</td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[ulemail]</td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[ulmobile] </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[ulactive]  </td>\n");
	print("<td align=\"left\" valign=\"middle\">$rowdb[uluser]  <br>" .date('m/d/Y h:i:s A', strtotime($rowdb[ulstamp])). "</td>\n");

	print("<td align=\"CENTER\" valign=\"middle\">[ <a title=\"Update entry?\" href=\"index.php?body=user_list_addeditdel&mybox=edit&ulid=$rowdb[ulid]\"> Upd </a> ] </td>");
	print("<td align=\"CENTER\" valign=\"middle\">[ <a title=\"Delete this entry?\" href=\"index.php?body=user_list_addeditdel&mybox=del&ulid=$rowdb[ulid]\"> Del </a> ] </td>");

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