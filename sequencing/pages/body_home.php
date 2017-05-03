<?php   
	$search_datefrom = date('m/d/Y', strtotime(date('Y-m-1')));
	if(isset($_POST['search_datefrom']))
	{
		if ($_POST['search_datefrom'])
		{
			$search_datefrom = $_POST['search_datefrom'];
		}
	}	
	if(isset($_GET['search_datefrom']))
	{
		if ($_GET['search_datefrom'])
		{
			$search_datefrom = $_GET['search_datefrom'];
		}
	}	

	$search_dateto = date('m/d/Y', strtotime($globaldate));
	if(isset($_POST['search_dateto']))
	{
		if ($_POST['search_dateto'])
		{
			$search_dateto = $_POST['search_dateto'];
		}
	}			
	if(isset($_GET['search_dateto']))
	{
		if ($_GET['search_dateto'])
		{
			$search_dateto = $_GET['search_dateto'];
		}
	}			
	
	//echo "<br> search_datefrom " . $search_datefrom . "  search_dateto " . $search_dateto . " search_datefrom " . $search_datefrom . "  search_dateto " . $search_dateto;
	
	
	$search_datefrom2 = date('Y-m-d', strtotime($search_datefrom));
	$search_dateto2 = date('Y-m-d', strtotime($search_dateto));
	
	$branch_count = 0;	
	$querydb  = "SELECT 
				 distinct(tlbranch) 
			   FROM 
				 ticket_list a
			   WHERE
			   	 a.tldate >= '$search_datefrom2' and
			   	 a.tldate <= '$search_dateto2' and ";

	$querydb  = $querydb . " 				 
			 a.tlactive = 'Y' ";
			 
	//echo $querydb . "  " . $querydb;
	$resultdb = mysql_query($querydb);
	//echo mysql_error();
	$branch_count = mysql_num_rows($resultdb);		
	//echo "<br> branch_count " . $branch_count;	
	
	
	
	$total_Serials = 0;
	$querydb  = "SELECT 
				 a.tlid 
			   FROM 
				 ticket_list a
			   WHERE
			   	 a.tldate >= '$search_datefrom2' and
			   	 a.tldate <= '$search_dateto2' and ";

	$querydb  = $querydb . " 				 
			 a.tlactive = 'Y' ";

	$resultdb = mysql_query($querydb);
	//echo mysql_error();
	$total_Serials = mysql_num_rows($resultdb);		
	//echo "<br> total_Serials " . $total_Serials;	
		
	
	$Serial_remaining = 0;
	$querydb  = "SELECT 
				 a.tlid 
			   FROM 
				 ticket_list a
			   WHERE
			   	 a.tldate >= '$search_datefrom2' and
			   	 a.tldate <= '$search_dateto2' and 
				 a.tltaken_date is null and ";

	$querydb  = $querydb . " 				 
			 a.tlactive = 'Y' ";

	$resultdb = mysql_query($querydb);
	//echo mysql_error();
	$Serial_remaining = mysql_num_rows($resultdb);		
	//echo "<br> Serial_remaining " . $Serial_remaining;		
	
	
	
	$Serial_taken = 0;	
	$querydb  = "SELECT 
				 a.tlid 
			   FROM 
				 ticket_list a
			   WHERE
			   	 a.tldate >= '$search_datefrom2' and
			   	 a.tldate <= '$search_dateto2' and 
				 a.tltaken_date is not null and ";

	$querydb  = $querydb . " 				 
			 a.tlactive = 'Y' ";

	$resultdb = mysql_query($querydb);
	//echo mysql_error();
	$Serial_taken = mysql_num_rows($resultdb);		
	//echo "<br> Serial_taken " . $Serial_taken;			


?> 

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Quickview for <?php  echo date("m/d/Y", strtotime($globaldate)); ?>
<?php
	//echo "<br>myblid " . $myblid;
	//echo $vstring;
	//echo "<br> total_Serials " . $total_Serials;
?>
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
			
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php  echo $branch_count; ?> 
									</div>
                                    <div>Area and Section</div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?body=report1_dbase">
                            <div class="panel-footer">
                                <span class="pull-left">View Report</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php  echo $total_Serials; ?> 
									</div>
                                    <div>Ticket ID Issued</div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?body=report2_dbase">
                            <div class="panel-footer">
                                <span class="pull-left">View Report</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>			
				

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php  echo $Serial_taken; ?> 
									</div>
                                    <div>Ticket ID Taken</div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?body=report3_dbase">
                            <div class="panel-footer">
                                <span class="pull-left">View Report</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>					
							
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php  echo $Serial_remaining; ?> 
									</div>
                                    <div>Not Yet Claimed</div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?body=report4_dbase">
                            <div class="panel-footer">
                                <span class="pull-left">View Report</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                
            </div>
            <!-- /.row -->
		
            <div class="row">
                <div class="col-lg-12">
					<div class="panel panel-default">
                        <div class="panel-heading">
						
<form method="post" action="index.php?body=home&mytag=POST">
&nbsp; From (m/d/y)
&nbsp; &nbsp; <INPUT TYPE="text" NAME="search_datefrom" id="date1" alt="date" class="IP_calendar" title="m/d/Y" VALUE="<?php print($search_datefrom); ?>" >
&nbsp; To (m/d/y)
&nbsp; &nbsp; <INPUT TYPE="text" NAME="search_dateto"  id="date2" alt="date" class="IP_calendar" title="m/d/Y" VALUE="<?php print($search_dateto); ?>" >
&nbsp; &nbsp;<input type="submit" value="Filter" />
</form>								
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
		
	$querydb  = $querydb . " 
		   GROUP BY 
		   	 a.tlday, a.tlarea, a.tlsection
		   ORDER BY 
			 a.tlday, a.tlarea, a.tlsection ";			 
	//echo $querydb;
	$resultdb = mysql_query($querydb);
	//echo mysql_error();
	$num_count = mysql_num_rows($resultdb);		
	//echo "<br> num_count " . $num_count;
	//echo "<br> search_datefrom " . $search_datefrom . " search_dateto " . $search_dateto;
	
	//fetch the results from the database
	$countdb = 1;
	while ($rowdb =  mysql_fetch_array ($resultdb)) 
	{
        print("<tr class=\"odd gradeX\">");

		print("<td align=\"left\" valign=\"middle\"> $rowdb[tlday] </td>\n");
		print("<td align=\"left\" valign=\"middle\"> $rowdb[tlarea] </td>\n");
		print("<td align=\"left\" valign=\"middle\"> $rowdb[tlsection] </td>\n");
	
		$Serials = $rowdb[tlcount];
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
			$querytk = $querytk . " and a.tldate >= '$search_datefrom'  ";
		}		   
		
		if ($search_dateto != '')		   
		{
			$querytk = $querytk . " and a.tldate <= '$search_dateto'  ";
		}	
					
		$querytk  = $querytk . " 	 
					 and a.tlday = '$day'  
					 and a.tlarea = '$area'  
					 and a.tlsection = '$sections' 
					 and a.tltaken_date is not null ";
					 
		$resulttk = mysql_query($querytk);
		//echo mysql_error();
		$taken = mysql_num_rows($resulttk);		
		//echo "<br> Serial_taken " . $Serial_taken;			

		$diff = $Serials - $taken;
	
		print("<td align=\"right\" valign=\"middle\">" . number_format($Serials,0) . "</td>\n");
		print("<td align=\"right\" valign=\"middle\">" . number_format($taken,0) . "</td>\n");
		print("<td align=\"right\" valign=\"middle\">" . number_format($diff,0) . "</td>\n");
	
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
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
