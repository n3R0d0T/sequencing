<?php
	// The function header by sending raw excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Defines the name of the export file "codelution-export.xls"
	header("Content-Disposition: attachment; filename=serial_numbers_taken.xls");

	$ulexcel = ''; 		
	if(isset($_GET['ulexcel']))
	{
		if ($_GET['ulexcel'])
		{
			$ulexcel = $_GET['ulexcel'];
		}
	}
	if(isset($_POST['ulexcel']))
	{
		if ($_POST['ulexcel'])
		{
			$ulexcel = $_POST['ulexcel'];
		}
	}
	
	$search_datefrom = ''; 		
	if(isset($_GET['search_datefrom']))
	{
		if ($_GET['search_datefrom'])
		{
			$search_datefrom = $_GET['search_datefrom'];
		}
	}
	if(isset($_POST['search_datefrom']))
	{
		if ($_POST['search_datefrom'])
		{
			$search_datefrom = $_POST['search_datefrom'];
		}
	}

	$search_dateto = '';
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
	
	$search_room = '';
	if(isset($_POST['search_room']))
	{
		if ($_POST['search_room'])
		{
			$search_room = $_POST['search_room'];
		}
	}		
	if(isset($_GET['search_room']))
	{
		if ($_GET['search_room'])
		{
			$search_room = $_GET['search_room'];
		}
	}	
	
	$search_branch = '';
	if(isset($_POST['search_branch']))
	{
		if ($_POST['search_branch'])
		{
			$search_branch = $_POST['search_branch'];
		}
	}		
	if(isset($_GET['search_branch']))
	{
		if ($_GET['search_branch'])
		{
			$search_branch = $_GET['search_branch'];
		}
	}			
	
	$search_name = '';
	if(isset($_POST['search_name']))
	{
		if ($_POST['search_name'])
		{
			$search_name = $_POST['search_name'];
		}
	}	
	if(isset($_GET['search_name']))
	{
		if ($_GET['search_name'])
		{
			$search_name = $_GET['search_name'];
		}
	}
	
	$search_docno = '';
	if(isset($_POST['search_docno']))
	{
		if ($_POST['search_docno'])
		{
			$search_docno = $_POST['search_docno'];
		}
	}	
	if(isset($_GET['search_docno']))
	{
		if ($_GET['search_docno'])
		{
			$search_docno = $_GET['search_docno'];
		}
	}		
	
	include "config829290383029.php"; 	
		
	$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword")or die("cannot connect to server ");
	@mysql_select_db("$dbdatabase")or die("Unable to select database.");
				
	//echo '<br> search_room' . $search_room;	
	//echo '<br> search_branch' . $search_branch;	
	//echo '<br> search_name' . $search_name;	
	//echo '<br> search_dlname' . $search_dlname;	
	//echo '<br> search_ulname_staff' . $search_ulname_staff;	
	//echo '<br> search_docno' . $search_docno;	
		
	if ($search_datefrom != '')
	{
		$search_datefrom = date("Y-m-d", strtotime($search_datefrom));
	}
	
	if ($search_dateto != '')
	{
		$search_dateto = date("Y-m-d", strtotime($search_dateto));	
	}
	

	print("<table border='1' width='100%'>");
	
	print("<TR>\n");
	print("<TD ALIGN='CENTER' VALIGN='CENTER' WIDTH='5%' bgcolor='".$grid_bgcolor."'> 
		   <font color='".$grid_fontcolor."'><strong>#</strong></font></TD>\n");
	print("<TD ALIGN='CENTER' VALIGN='CENTER' WIDTH='10%' bgcolor='".$grid_bgcolor."'> 
		   <font color='".$grid_fontcolor."'><strong>Day</strong></font></TD>\n");
	print("<TD ALIGN='CENTER' VALIGN='CENTER' WIDTH='10%' bgcolor='".$grid_bgcolor."'> 
		   <font color='".$grid_fontcolor."'><strong>Area</strong></font></TD>\n");
	print("<TD ALIGN='CENTER' VALIGN='CENTER' WIDTH='20%' bgcolor='".$grid_bgcolor."'> 
		   <font color='".$grid_fontcolor."'><strong>Section</strong></font></TD>\n");
	print("<TD ALIGN='CENTER' VALIGN='CENTER' WIDTH='10%' bgcolor='".$grid_bgcolor."'> 
		   <font color='".$grid_fontcolor."'><strong>Number</strong></font></TD>\n");
	print("<TD ALIGN='CENTER' VALIGN='CENTER' WIDTH='10%' bgcolor='".$grid_bgcolor."'> 
		   <font color='".$grid_fontcolor."'><strong>Ticket ID</strong></font></TD>\n");
	print("<TD ALIGN='CENTER' VALIGN='CENTER' WIDTH='10%' bgcolor='".$grid_bgcolor."'> 
		   <font color='".$grid_fontcolor."'><strong>Name</strong></font></TD>\n");
	print("<TD ALIGN='CENTER' VALIGN='CENTER' WIDTH='10%' bgcolor='".$grid_bgcolor."'> 
		   <font color='".$grid_fontcolor."'><strong>Daytime Phone</strong></font></TD>\n");
	print("<TD ALIGN='CENTER' VALIGN='CENTER' WIDTH='10%' bgcolor='".$grid_bgcolor."'> 
		   <font color='".$grid_fontcolor."'><strong>Ticket Stamp</strong></font></TD>\n");
	print("<TD ALIGN='CENTER' VALIGN='CENTER' WIDTH='10%' bgcolor='".$grid_bgcolor."'> 
		   <font color='".$grid_fontcolor."'><strong>Ticket Status</strong></font></TD>\n");
	print("</TR>\n");
		
	
				
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
	$resultdb=mysql_query($querydb);
	echo mysql_error();
	//echo $querydb;

	$countdb=1;
	while ($rowdb =  mysql_fetch_array ($resultdb)) 
	{
		print("<tr>");
		
		print("<td align=\"center\" valign=\"middle\">$countdb </td>\n");
					
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

	print("</table>\n");		

	mysql_close($link);	
?>
