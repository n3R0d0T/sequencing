<!DOCTYPE html>
<!-- saved from url=(0061)https://bootstrapthemes.co/demo/html/backyard/demo/index.html -->

<?php
	$my_ticket_id = '';	
	if(isset($_POST['my_ticket_id']))
	{
		if ($_POST['my_ticket_id'])
		{
			$my_ticket_id = $_POST['my_ticket_id'];
		}
	}
	//echo '<br> my_ticket_id : ' . $my_ticket_id;

	include "./pages/config829290383029.php"; 
	$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword")or die("cannot connect to server ");
	@mysql_select_db("$dbdatabase")or die("Unable to select database.");

	//echo '<br> globaldate : ' . $globaldate;
	//echo '<br> globaldatetime : ' . $globaldatetime;

	$coname = '';
	$coaddr = '';
	$coevent_name = '';
	$coevent_tag = '';
	$coevent_logo = '';
	$coevent_print = '';

	$query_show = " 
		SELECT *
		FROM company_list a
		WHERE a.coactive = 'Y' ";
	$result_show = mysql_query($query_show) or die('Error : purchase_list Show Entry : ' . mysql_error());	
	while ($row_show =  mysql_fetch_array ($result_show)) 
	{
		$coname = $row_show[coname];
		$coaddr = $row_show[coaddr];
		$coevent_name = $row_show[coevent_name];
		$coevent_tag = $row_show[coevent_tag];
		$coevent_logo = $row_show[coevent_logo];
		$coevent_print = $row_show[coevent_print];
	}
			

	//check if ticket exists
	$my_ticket_message = '';
	$my_ticket_id = mysql_real_escape_string($my_ticket_id);
	
	$tlid = '';

	if ($my_ticket_id != '')
	{
		$querydb  = "
			   SELECT  
				 *
			   FROM 
				 ticket_list a
			   WHERE
				 a.tlticket = '$my_ticket_id' ";			 
		$resultdb = mysql_query($querydb);
		while ($rowdb =  mysql_fetch_array ($resultdb)) 
		{
			$tlid = $rowdb[tlid];
			$tltaken_status = $rowdb[tltaken_status];
		}
		
		//check if ticket exists
		//$tltaken_status =   TAKEN    CANCEL
		if ($tlid == '')
		{
		    //Change the message to "No line up sequence available!"
			$my_ticket_message = 'Ticket ID does not exists!';
		}
		else
		if ($tltaken_status == 'CANCEL')
		{
			$my_ticket_message = 'Ticket ID already cancelled!';
		}
		else				
		{							
			$my_ticket_message = "Ticket ID accepted!";

			?>	
			<HTML> 		
			<meta http-equiv="refresh" content="0;URL=accepted.php?my_ticket_id=<?php print($my_ticket_id); ?>">  
			</HTML>
			<?php
		}
		
	}
	
	mysql_close($link);		
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

        <!-- /.website title -->
        <title><?php print($coname); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- CSS Files -->
        <link href="./index_files/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="./index_files/font-awesome.min.css" rel="stylesheet">
        <link href="./index_files/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="./index_files/animate.css" rel="stylesheet" media="screen">
        <link href="./index_files/owl.theme.css" rel="stylesheet">
        <link href="./index_files/owl.carousel.css" rel="stylesheet">

        <link href="./index_files/css-index.css" rel="stylesheet" media="screen">
       

        <!-- Google Fonts -->
        <link rel="stylesheet" href="./index_files/css">

    </head>	

    <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader -->
        
        <div id="top"></div>    

            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">

                            <!-- /.logo -->
                            <div class="logo wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;"> 
<?php
	//echo " <br> ulpicture " . $_SESSION['ulpicture'];
	if ($coevent_logo != '')
	{						
?>
		<img src="./pages/events/<?php print($coevent_logo); ?>" alt="logo" width="200px">
<?php
	}
	else
	{						
?>
		<img src="./index_files/logo.png" alt="logo">
<?php
	}
?>

							</div>

                            <!-- /.main title -->
                            <h1 class="wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
                               
<?php
	//echo " <br> ulpicture " . $_SESSION['ulpicture'];
	if ($coevent_logo != '')
	{						
?>
		 <?php print($coevent_name); ?>
<?php
	}
	else
	{						
?>
		 BTS LIVE TRILOGY EPISODE III: THE WINGS TOUR IN MANILA 
<?php
	}
?>								
                            </h1>

                            <!-- /.header paragraph -->
                            <div class="landing-text wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
<?php
	//echo " <br> ulpicture " . $_SESSION['ulpicture'];
	if ($coevent_tag != '')
	{						
?>
		<p><?php print($coevent_tag); ?></p>
<?php
	}
	else
	{						
?>
		<p>May 6th - 7th, 2017 | MOA Arena</p>
<?php
	}
?> 
                                
                            </div>				  

                            <!-- /.header button 
                            <div class="head-btn wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
                                <a href="https://bootstrapthemes.co/demo/html/backyard/demo/index.html#feature" class="btn-primary">Features</a>
                                <a href="https://bootstrapthemes.co/demo/html/backyard/demo/index.html#download" class="btn-default">Download</a>
                            </div>-->



                        </div> 

                        <!-- /.form form -->
                        <div class="col-md-5">

                            <div class="signup-header wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                                <h3 class="form-title text-center">Generate Printout</h3>
								
<form class="form-header" action="index.php" role="form" method="POST" id="#">
	<div class="form-group">
		<input class="form-control input-lg" name="my_ticket_id" id="name" type="text" maxlength="8" placeholder="Enter Ticket ID" required="Please enter ticket ID!" autofocus>
	</div>
	<div class="form-group last">
		<input type="submit" class="btn btn-warning btn-block btn-lg" value="Submit">
	</div>
	<p class="privacy text-center"></p>
</form>
								
<?php
	if ($my_ticket_message != '') 
	{
		echo '<br>';
		echo '<font size="+2">' . $my_ticket_message . '</font>';
		echo '<br>';
		echo '<br>';
	}	
?>										
                            </div>				

                        </div>
                    </div>
                </div> 
            </div> 
        </div>

       



        <!-- /.javascript files -->
        <script src="./index_files/jquery.js"></script>
        <script src="./index_files/bootstrap.min.js"></script>
        <script src="./index_files/custom.js"></script>
        <script src="./index_files/jquery.sticky.js"></script>
        <script src="./index_files/wow.min.js"></script>
        <script src="./index_files/owl.carousel.min.js"></script>
        <script>
                                    new WOW().init();
        </script>
    
<script type="text/javascript">( function(){ window.SIG_EXT = {}; } )()</script></body></html>