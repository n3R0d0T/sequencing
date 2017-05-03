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
		$mystatus = '';	
		if(isset($_GET['mystatus']))
		{
			if ($_GET['mystatus'])
			{
				$mystatus = $_GET['mystatus'];
			}
		}
		//echo '<br> mystatus : ' . $mystatus;
		
		$mybox = '';	
		if(isset($_GET['mybox']))
		{
			if ($_GET['mybox'])
			{
				$mybox = $_GET['mybox'];
			}
		}
		//echo '<br> mybox : ' . $mybox;
				
		$coid = 0;	
		if(isset($_GET['coid']))
		{
			if ($_GET['coid'])
			{
				$coid = $_GET['coid'];
			}
		}
		//echo '<br> coid : ' . $coid;

		if ($mystatus != 'sent')
		{	
			if ($mybox == 'add') 
			{
$coid = 0;
$coname = '';
$coaddr = '';
$cophone = '';
$cofax = '';
$coemail = '';
$comobile = '';
$cowebsite = '';

$coevent_name = '';
$coevent_tag = '';
$coevent_logo = '';
$coevent_print = '';

$coactive = 'Y';
$couser = $_SESSION["ulname"];
$costamp = $globaldatetime;

$formtitle = 'ADD RECORD';			
			}
			else
			if (($mybox == 'edit') or ($mybox == 'del'))
			{
				$query = " SELECT *
						   FROM company_list 
						   WHERE coid='$coid'";
				$result = mysql_query($query);
				echo mysql_error();				
				while ($row =  mysql_fetch_array ($result)) 
				{
$coid = $row[coid];
$coname = $row[coname];
$coaddr = $row[coaddr];
$cophone = $row[cophone];
$cofax = $row[cofax];
$coemail = $row[coemail];
$comobile = $row[comobile];
$cowebsite = $row[cowebsite];

$coevent_name = $row[coevent_name];
$coevent_tag = $row[coevent_tag];
$coevent_logo = $row[coevent_logo];
$coevent_print = $row[coevent_print];

$coactive = $row[coactive];
$couser = $row[couser];
$costamp = $row[costamp];
				}
				 
				mysql_query($query) or die('Error, insert query failed');  
		
				if ($mybox == 'edit') 
				{
					$formtitle = 'MODIFY RECORD';			
				}
				
				if ($mybox == 'del')
				{
					$formtitle = 'REMOVE RECORD';			
				}
			}	
?>	
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Company List - <?php echo $formtitle; ?></h1>
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
Basic Information
									</td>
									<td align="right">
<a href="index.php?body=company_list_dbase">
Back to Company List
</a>	
									</td>
								</tr>
							</table>
                        </div>
						
					<?php
					if (($mybox == 'add') or ($mybox == 'edit'))
					{
					?>						
						
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
<form role="form" method="post" action="index.php?body=company_list_addeditdel&mystatus=sent&mybox=<?php print($mybox); ?>&coid=<?php print($coid); ?>" enctype="multipart/form-data">
	<div class="form-group">
		<label>Company Name</label>
		<input class="form-control" placeholder="Enter company name" name="coname"  value="<?php print ("$coname"); ?>"  maxlength="50" >
	</div>
	<div class="form-group">
		<label>Address</label>
		<textarea class="form-control" rows="4" name="coaddr" ><?php print("$coaddr"); ?></textarea>	
	</div>
	<div class="form-group">
		<label>Telephone</label>
		<input class="form-control" placeholder="Enter telephone" name="cophone"  value="<?php print ("$cophone"); ?>"  maxlength="50" >
	</div>
	<div class="form-group">
		<label>Fax No.</label>
		<input class="form-control" placeholder="Enter fax number" name="cofax"  value="<?php print ("$cofax"); ?>"  maxlength="50" >
	</div>
	<div class="form-group">
		<label>Mobile No.</label>
		<input class="form-control" placeholder="Enter mobile #" name="comobile"  value="<?php print ("$comobile"); ?>"  maxlength="50" >
	</div>
	<div class="form-group">
		<label>Email</label>
		<input class="form-control" type="email" placeholder="Enter email" name="coemail"  value="<?php print ("$coemail"); ?>"   maxlength="50" >
	</div>	
	<div class="form-group">
		<label>Website</label>
		<input class="form-control" placeholder="Enter website" name="cowebsite" value="<?php print ("$cowebsite"); ?>"   maxlength="50">
	</div>	
	
	<div class="form-group">
		<label>Event Name</label>
		<input class="form-control" placeholder="Enter Event Name" name="coevent_name"  value="<?php print ("$coevent_name"); ?>"  maxlength="50" >
	</div>
	<div class="form-group">
		<label>Event Date/Place</label>
		<input class="form-control" placeholder="Enter Date or Place" name="coevent_tag"  value="<?php print ("$coevent_tag"); ?>"   maxlength="50" >
	</div>	
	<div class="form-group">
		<label>Event Form Logo</label>
		<input class="form-control" type="text" name="coevent_logo" value="<?php print("$coevent_logo"); ?>" /> 
		<br>
		<input type="file" name="fileToUpload" id="fileToUpload">		
	</div>		
	<div class="form-group">
		<label>Event Print Logo</label>
		<input class="form-control" type="text" name="coevent_print" value="<?php print("$coevent_print"); ?>" /> 
		<br>
		<input type="file" name="fileToUpload_print" id="fileToUpload_print">		
	</div>		
	
	
	<div class="form-group">
		<label>Active</label>
		<select class="form-control" name='coactive'>
			<option><?php print ("$coactive"); ?></option>	
			<option>Y</option>	
			<option>N</option>	
			<option></option>	
		</select>		
	</div>	
	
	<div class="form-group">
		<label>Last Updated By / On </label>
		<br>
		<?php print ("$couser"); ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php print ("$costamp"); ?>
	</div>
						
	<input type="hidden" name="coid" value="<?php print ("$coid"); ?>" />
	<button type="submit" class="btn btn-default">Save</button>
	<button type="reset" class="btn btn-default">Reset</button>
</form>		
                                </div>		
                                <!-- /.col-lg-6 (nested) -->																								
							</div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
						
					<?php
					}
					else
					{
					?>		
									
						<div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
<form role="form" method="post" action="index.php?body=company_list_addeditdel&mystatus=sent&mybox=<?php print($mybox); ?>&coid=<?php print($coid); ?>">
	<div class="form-group">
		<label>Company Name</label>
		<br>
		<?php print ("$coname"); ?>
	</div>
	<input type="hidden" name="coid" value="<?php print ("$coid"); ?>" />
	<input type="hidden" name="coname" value="<?php print ("$coname"); ?>" />
	<button type="submit" class="btn btn-default">Delete Record</button>
</form>		
                                </div>		
                                <!-- /.col-lg-6 (nested) -->																								
							</div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->

					<?php
					}
					?>						
						
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
<?php
		}
		else
		{
$coid = $_POST['coid'];
$coname = $_POST['coname'];
$coaddr = $_POST['coaddr'];
$cophone = $_POST['cophone'];
$cofax = $_POST['cofax'];
$coemail = $_POST['coemail'];
$comobile = $_POST['comobile'];
$cowebsite = $_POST['cowebsite'];

$coevent_name = $_POST['coevent_name'];
$coevent_tag = $_POST['coevent_tag'];
$coevent_logo = $_POST['coevent_logo'];
$coevent_print = $_POST['coevent_print'];

$coactive = $_POST['coactive'];
$couser = $_SESSION["ulname"];
$costamp = $globaldatetime;

//echo "<br> coid " . $coid;

if ($mybox == 'add') 
{
	$formtitle = 'ADD RECORD';			
}
else
if ($mybox == 'edit') 
{
	$formtitle = 'MODIFY RECORD';			
}

if ($mybox == 'del')
{
	$formtitle = 'REMOVE RECORD';			
}
?>	

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Company List - <?php echo $formtitle; ?></h1>
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
Basic Information
									</td>
									<td align="right">
<a href="index.php?body=company_list_dbase">
Back to Company List
</a>	
									</td>
								</tr>
							</table>
                        </div>
							
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
	<div class="form-group">
		<label>Company Name</label>
		<br />
		 <? print("$coname"); ?>
	</div>
	

	<div class="form-group">
		<label>Event Form Logo</label>
		<br />
<?php	
//if they DID upload a file...
if($_FILES['fileToUpload']['name'])
{
	$coevent_logo = $_FILES['fileToUpload']['name'];	
	
	//if no errors...
	if(!$_FILES['fileToUpload']['error'])
	{
		//now is the time to modify the future file name and validate the file
		$valid_file = true;
		$new_file_name = strtolower($_FILES['fileToUpload']['tmp_name']); //rename file
		if($_FILES['fileToUpload']['size'] > (1024000)) //can't be larger than 1 MB
		{
			$valid_file = false;
			$message = 'Oops!  Your file\'s size is to large.';
		}

		//if the file has passed the test
		if($valid_file)
		{
			//move it to where we want it to be
			$currentdir = getcwd();
			$target = $currentdir .'/events/' . basename($_FILES['fileToUpload']['name']);
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target);
			$message = 'Congratulations!  Your file was accepted.';
		}
	}
	//if there is an error...
	else
	{
		//set that to be the returned message
		$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['fileToUpload']['error'];
	}
}

//you get the following information for each file:
//echo "<br> name : " . $_FILES['fileToUpload']['name'];
//echo "<br> size : " . $_FILES['fileToUpload']['size'];
//echo "<br> type : " . $_FILES['fileToUpload']['type'];
//echo "<br> tmp_name : " . $_FILES['fileToUpload']['tmp_name'];
echo "Event Form Logo Name : " . $coevent_logo;
?>		
	</div>	
	

	<div class="form-group">
		<label>Event Print Logo</label>
		<br />
<?php	
//if they DID upload a file...
if($_FILES['fileToUpload_print']['name'])
{
	$coevent_print = $_FILES['fileToUpload_print']['name'];	
	
	//if no errors...
	if(!$_FILES['fileToUpload_print']['error'])
	{
		//now is the time to modify the future file name and validate the file
		$valid_file = true;
		$new_file_name = strtolower($_FILES['fileToUpload_print']['tmp_name']); //rename file
		if($_FILES['fileToUpload_print']['size'] > (1024000)) //can't be larger than 1 MB
		{
			$valid_file = false;
			$message = 'Oops!  Your file\'s size is to large.';
		}

		//if the file has passed the test
		if($valid_file)
		{
			//move it to where we want it to be
			$currentdir = getcwd();
			$target = $currentdir .'/events/' . basename($_FILES['fileToUpload_print']['name']);
			move_uploaded_file($_FILES['fileToUpload_print']['tmp_name'], $target);
			$message = 'Congratulations!  Your file was accepted.';
		}
	}
	//if there is an error...
	else
	{
		//set that to be the returned message
		$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['fileToUpload_print']['error'];
	}
}

//you get the following information for each file:
//echo "<br> name : " . $_FILES['fileToUpload_print']['name'];
//echo "<br> size : " . $_FILES['fileToUpload_print']['size'];
//echo "<br> type : " . $_FILES['fileToUpload_print']['type'];
//echo "<br> tmp_name : " . $_FILES['fileToUpload_print']['tmp_name'];
echo "Event Print Logo Name : " . $coevent_print;
?>		
	</div>		
	
	<div class="form-group">
		<label>Result</label>
		<br />
		<? 
		if ($mybox != 'del')
		{
			if ($coid == 0) 
			{
$query = 
"INSERT INTO company_list (
coid,
coname,
coaddr,
cophone,
cofax,
coemail,
comobile,
cowebsite,

coevent_name,
coevent_tag,
coevent_logo,
coevent_print,

coactive,
couser,
costamp
) 
VALUES 
(
'$coid',
'$coname',
'$coaddr',
'$cophone',
'$cofax',
'$coemail',
'$comobile',
'$cowebsite',

'$coevent_name',
'$coevent_tag',
'$coevent_logo',
'$coevent_print',

'$coactive',
'$couser',
'$costamp'
)";

			}
			else
			{
				$query = 
"UPDATE 
company_list 
SET 
coname = '$coname',
coaddr = '$coaddr',
cophone = '$cophone',
cofax = '$cofax',
coemail = '$coemail',
comobile = '$comobile',
cowebsite = '$cowebsite',

coevent_name = '$coevent_name',
coevent_tag = '$coevent_tag',
coevent_logo = '$coevent_logo',
coevent_print = '$coevent_print',

coactive = '$coactive',
couser = '$couser',
costamp = '$costamp'
WHERE
coid = '$coid'";
			}
		}
		else
		if ($mybox == 'del')
		{
			$query = 
"DELETE FROM 
company_list 
WHERE
coid = '$coid'";
		}
		
		mysql_query($query) or die(mysql_error());  

/*
		mysql_query($query) or die('The entry has links to other tables. Cannot continue to process...');  
*/
		?>				
		<HTML> 		
		<meta http-equiv="refresh" content="0;URL=index.php?body=company_list_dbase">  
		</HTML>
	</div>
                                </div>		
                                <!-- /.col-lg-6 (nested) -->																								
							</div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->						
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<?php	
		}
	}
?>			