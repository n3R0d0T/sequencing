     <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        
                        <h3 class="panel-title">
	
<?php
	if ($invalid_access == 'N')
	{
?>	
	<br>
	<br>
	<strong>&bull; User code or password is not valid!</strong>
	<br>
<?php
	}
	else
	{
?>	
<?php
	}
?>						
						LOGIN TO CONTINUE</h3></center>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="index.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usename" name="ucode" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="upass" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div> 