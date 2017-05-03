<?php
	//$tmstamp = date('Y-m-d H:i:s');
			
		
	/*	
	if ($user == "root")
	{
		$globalcurrent_mktime = time();

		$globaldatetime = time();
		$globaldate = date("Y-m-d", $globaldatetime);

		$globaldatetime = time();
		$globaldatetime = date('Y-m-d H:i:s', $globaldatetime);
	}
	else
	if ($user == "cindys_jon") 
	{
		$globalcurrent_mktime = time();

		$globaldatetime = time();
		$globaldate = date("Y-m-d", $globaldatetime);

		$globaldatetime = time();
		$globaldatetime = date('Y-m-d H:i:s', $globaldatetime);	
	}
	else
	{
		$globalcurrent_mktime = time();	

		$globaldatetime = time()+(3600*13);
		$globaldate = date("Y-m-d", $globaldatetime);	

		$globaldatetime = time()+(3600*13);
		$globaldatetime = date('Y-m-d H:i:s', $globaldatetime);
	}	
	*/			
	
			
	$globalcurrent_mktime = time();

	$globaldatetime = time();
	$globaldate = date("Y-m-d", $globaldatetime);

	$globaldatetime = time();
	$globaldatetime = date('Y-m-d H:i:s', $globaldatetime);				
		
 	//20160904
	//as per jhonny the date in the computer
	//is 4 hours advance
	/*
	{
		$globalcurrent_mktime = time();	
	
		$globaldate_raw = time()-(3600*4);
		$globaldate = date("Y-m-d", $globaldate_raw);	
	
		$globaldatetime_raw = time()-(3600*4);
		$globaldatetime = date('Y-m-d H:i:s', $globaldatetime_raw);
	}
	*/

	/*
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";

	echo "SERVER CURRENT TIME <br>";
	echo "SAVING " . date("Y-m-d h:i:s", $globalcurrent_mktime) . "<br>";
	echo "VIEWING " . date("Y-m-d h:i:s a", $globalcurrent_mktime) . "<br>";
	echo "MANILA DATE TIME <br>";
	echo "globaldatetime_raw " . $globaldatetime_raw . "<br>";
	echo "globaldatetime " . $globaldatetime . "<br>";
	echo "MANILA DATE " . "<br>";
	echo "globaldate_raw " . $globaldate_raw . "<br>";
	echo "globaldate " . $globaldate . "<br>";
	echo "uluser_list " . $_SESSION['uluser_list'] . "<br>"; 
	echo "<br>";
	*/
?>	
	