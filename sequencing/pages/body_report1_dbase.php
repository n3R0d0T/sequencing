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
                    <h1 class="page-header">Area & Section</h1>
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
<form method="post" action="index.php?body=report1_dbase&mytag=POST">
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
										<th>Total Count</th>
										<th>Taken Count</th>
										<th>Balance</th>									
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
		   		count(a.tlid) tlcount, 
				a.tlday, a.tlarea, a.tlsection
			FROM 
				ticket_list a
			WHERE
				a.tlactive = 'Y' ";
				 
	if ($search_datefrom != '')		   
	{
		$querydb = $querydb . " and a.tldate >= '$search_datefrom'  ";
	}		   
	if ($search_dateto != '')		   
	{
		$querydb = $querydb . " and a.tldate <= '$search_dateto'  ";
	}				
	
	$querydb = $querydb . "	
			GROUP BY 
		   		a.tlday, a.tlarea, a.tlsection
		  	ORDER BY 
				a.tlday, a.tlarea, a.tlsection ";	
						
	$resultdb = mysql_query($querydb);
	echo mysql_error();
	//echo $querydb;
	$numedb = mysql_num_rows($resultdb);	
							 
	$countdb = 1;
	$total_count = 0;
	$total_taken = 0;
	$total_diff = 0;
	while ($rowdb =  mysql_fetch_array ($resultdb)) 
	{
		print("<tr>");

		print("<td align=\"left\" valign=\"middle\"> $rowdb[tlday] </td>\n");
		print("<td align=\"left\" valign=\"middle\"> $rowdb[tlarea] </td>\n");
		print("<td align=\"left\" valign=\"middle\"> $rowdb[tlsection] </td>\n");
	
		$tickets = $rowdb[tlcount];
		$day = $rowdb[tlday];
		$area = $rowdb[tlarea];
		$sections = $rowdb[tlsection];

		$taken = 0;
		$querytk  = "SELECT 
					 a.tlid 
				   FROM 
					 ticket_list a
				   WHERE
				   	 a.tlactive = 'Y' ";
					 
		if ($search_datefrom != '')		   
		{
			$querydb = $querydb . " and a.tldate >= '$search_datefrom'  ";
		}		   
		if ($search_dateto != '')		   
		{
			$querydb = $querydb . " and a.tldate <= '$search_dateto'  ";
		}			
								 
		$querytk  = $querytk . " 				 
 					 and a.tlday = '$day' 
 					 and a.tlarea = '$area' 
 					 and a.tlsection = '$sections' 
					 and a.tltaken_date is not null ";
					 
		//echo "<br> querytk ". $querytk;
		$resulttk = mysql_query($querytk);
		//echo mysql_error();
		$taken = mysql_num_rows($resulttk);		
		//echo "<br> ticket_taken " . $ticket_taken;			

		$diff = $tickets - $taken;
	
		print("<td align=\"right\" valign=\"middle\">" . number_format($tickets,0) . "</td>\n");
		print("<td align=\"right\" valign=\"middle\">" . number_format($taken,0) . "</td>\n");
		print("<td align=\"right\" valign=\"middle\">" . number_format($diff,0) . "</td>\n");
	
		print("</tr>");  
		
		$countdb = $countdb + 1;
		
		$total_count = $total_count + $tickets;
		$total_taken = $total_taken + $taken;
		$total_diff = $total_diff + $diff;
	}  
?>		
								</tbody>			
							</table>		
							
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<td align="center"><strong>Total Count : <?php print( number_format($total_count, 0) ); ?></strong></td>										
										<td align="center"><strong>Total Taken : <?php print( number_format($total_taken, 0) ); ?></strong></td>										
										<td align="center"><strong>Total Balance : <?php print( number_format($total_diff, 0) ); ?></strong></td>										
                                    </tr>									
                                </thead>
                            </table>
                            <!-- /.table-responsive -->
							
							
<?php
$mypage="&mysession=" . session_id() . "&search_datefrom=" . $search_datefrom . "&search_dateto=" . $search_dateto . "&search_room=" . $search_room . "&search_branch=" . $search_branch .  "&search_name=" . $search_name . "&search_docno=" . $search_docno . "&search_mystatus=sent";
?>
							<table>
								<tr>
									<td align="left">
<form method="post" action="body_report1_excel.php?myid=myid<?php print($mypage); ?>&ulexcel=EXCEL" target="_blank">
<input type="submit" value="Convert to Excel" />
</form>									
									</td>

									<td align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</td>
									
									<td align="left">

<form method="post" action="body_report1_print.php?myid=myid<?php print($mypage); ?>&ulprint=PRINT" target="_blank">
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