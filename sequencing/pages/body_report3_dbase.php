<?php
	$uladmin = 'N';
	if(isset($_SESSION['uladmin']))
		$uladmin = $_SESSION['uladmin'];	

	if ($uladmin == 'N')
	{
		include('body_account_not_found.php');
	}
	else
	{

		$mytag = '';	
		if(isset($_GET['mytag']))
		{
			if ($_GET['mytag'])
			{
				$mytag = $_GET['mytag'];
			}
		}	
		

		$search_datefrom = '';
		$search_datefrom = $_POST["search_datefrom"];	
		
		if(isset($_GET['search_datefrom']))
		{
			if ($_GET['search_datefrom'])
			{
				$search_datefrom = $_GET['search_datefrom'];
			}
		}	

		$search_dateto = '';
		$search_dateto = $_POST["search_dateto"];	
		
		if(isset($_GET['search_dateto']))
		{
			if ($_GET['search_dateto'])
			{
				$search_dateto = $_GET['search_dateto'];
			}
		}			
		
		$search_room = '';
		$search_room = $_POST["search_room"];	
		
		if(isset($_GET['search_room']))
		{
			if ($_GET['search_room'])
			{
				$search_room = $_GET['search_room'];
			}
		}	

		$search_branch = '';
		$search_branch = $_POST["search_branch"];	
		
		if(isset($_GET['search_branch']))
		{
			if ($_GET['search_branch'])
			{
				$search_branch = $_GET['search_branch'];
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
		
		$search_docno = '';
		$search_docno = $_POST["search_docno"];	
		
		if(isset($_GET['search_docno']))
		{
			if ($_GET['search_docno'])
			{
				$search_docno = $_GET['search_docno'];
			}
		}	
?>	
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Serial Numbers Taken</h1>
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
<form method="post" action="index.php?body=report3_dbase&mytag=POST">
From (m/d/y)
<INPUT TYPE="TEXT" NAME="search_datefrom" VALUE="<?php print($search_datefrom); ?>" SIZE="7" MAXLENGTH="20">
&nbsp;
To (m/d/y)
<INPUT TYPE="TEXT" NAME="search_dateto" VALUE="<?php print($search_dateto); ?>" SIZE="7" MAXLENGTH="20">
&nbsp;
<input type="submit" value="Filter" />
</form>									
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
										<th>Number</th>
										<th>Ticket ID</th>
										<th>Name</th>
										<th>Daytime Phone</th>
										<th>Ticket Stamp</th>
										<th>Ticket Status</th>
                                    </tr>
                                </thead>
                                <tbody>
								
<?php
	//20160904
	if ($search_datefrom != '')
	{
		$search_datefrom = date("Y-m-d", strtotime($search_datefrom));
	}
	
	if ($search_dateto != '')
	{
		$search_dateto = date("Y-m-d", strtotime($search_dateto));	
	}

	//fetch the results from the database
	$querydb  = "
			SELECT  
		   		*
			FROM 
				ticket_list a
			WHERE
				a.tlactive = 'Y' and
				 a.tltaken_date is not null ";
				 
	if ($search_datefrom != '')		   
	{
		$querydb = $querydb . " and a.tldate >= '$search_datefrom'  ";
	}		   
	if ($search_dateto != '')		   
	{
		$querydb = $querydb . " and a.tldate <= '$search_dateto'  ";
	}				
	
	$querydb = $querydb . "	
		  	ORDER BY 
				a.tlbranch, a.tlsection, a.tlsequence ";	
						
	$resultdb = mysql_query($querydb);
	echo mysql_error();
	//echo $querydb;
	$numedb = mysql_num_rows($resultdb);	
							 
	$countdb = 1;
	while ($rowdb =  mysql_fetch_array ($resultdb)) 
	{
		print("<tr>");
			
		print("<td align=\"left\" valign=\"middle\">$rowdb[tlday] </td>\n");
		print("<td align=\"left\" valign=\"middle\">$rowdb[tlarea] </td>\n");
		print("<td align=\"left\" valign=\"middle\">$rowdb[tlsection]  </td>\n");
		print("<td align=\"left\" valign=\"middle\">$rowdb[tlsequence]  </td>\n");
		print("<td align=\"left\" valign=\"middle\">$rowdb[tlticket]  </td>\n");
		print("<td align=\"left\" valign=\"middle\">$rowdb[tlcustomer]  </td>\n");
		print("<td align=\"center\" valign=\"middle\">$rowdb[tlcontact]  </td>\n");
		
		if ($rowdb[tltaken_date] == '')
			 print("<td align=\"center\" valign=\"middle\">&nbsp;</td>\n");	
		else print("<td align=\"center\" valign=\"middle\">" .date('m/d/Y h:i:s A', strtotime($rowdb[tltaken_date])). "</td>\n");
		
		if ($rowdb[tltaken_status] == '')
			 print("<td align=\"center\" valign=\"middle\">&nbsp;</td>\n");	
		else print("<td align=\"center\" valign=\"middle\">$rowdb[tltaken_status]</td>\n");
	
		print("</tr>");  
		
		$countdb = $countdb + 1;
	}  
?>		
								</tbody>			
							</table>		
							
                            <!-- /.table-responsive -->
							
<?php
$mypage="&mysession=" . session_id() . "&search_datefrom=" . $search_datefrom . "&search_dateto=" . $search_dateto . "&search_room=" . $search_room . "&search_branch=" . $search_branch .  "&search_name=" . $search_name . "&search_docno=" . $search_docno . "&search_mystatus=sent";
?>
							<table>
								<tr>
									<td align="left">
<form method="post" action="body_report3_excel.php?myid=myid<?php print($mypage); ?>&ulexcel=EXCEL" target="_blank">
<input type="submit" value="Convert to Excel" />
</form>									
									</td>

									<td align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</td>
									
									<td align="left">

<form method="post" action="body_report3_print.php?myid=myid<?php print($mypage); ?>&ulprint=PRINT" target="_blank">
<input type="submit" value="Preview Report" />
</form>									
									</td>
								</tr>
							</table>	
														
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