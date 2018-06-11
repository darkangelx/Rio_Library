<title>Rio's Library Admin</title>
<?php include 'general/style-includes.php'; ?>

<body>
	<div class="login-container">
		<div class="login-box animated fadeInDown">

			<div class="row">
        	<?php if (isset($error)): ?>
                <div class="alert col-md-12" style='background-color:e53935; boder: 3px solid c62828;'>
                    <div class="col-md-1" style='color:FAFAFA; pading:10p;'>
                        <i class="icon fa fa-ban"></i>
                    </div>
                    <div class="col-md-10" style="color:FAFAFA;"><?php echo $error?></div>
                </div>    
        	<?php else: ?>  
                <div class="alert alert-info alert-dismissible" style="visibility:hidden">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-info"></i>
                    Enter Your Account   
                </div>
        	<?php endif; ?>
    		</div>

			<div class="login-body">
				<div class="login-title"><strong>Log In</strong> to your account</div>
				<form action="<?php echo base_url().'admin_login/submit_login';?>" class="form-horizontal" method="post">
					<?php if($redirect) echo "<input type='hidden' value='".$redirect."' name='redirect'/>"; ?>
					<div class="form-group has-feedback">
						<div class="col-md-12">
							<input type="text" class="form-control" name="username" placeholder="Username"/>
							<span class="glyphicon glyphicon-envelope form-control-feedback" style="color:#3398E8"></span>
						</div>
					</div>
					<div class="form-group has-feedback">
						<div class="col-md-12">
							<input type="password" class="form-control" name="password" placeholder="Password"/>
							<span class="glyphicon glyphicon-lock form-control-feedback" style="color:#3398E8"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<a href="#" class="btn btn-link btn-block">Forgot your password?</a>
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-info btn-block">Log In</button>
						</div>
					</div>
				</form>
			</div>
			<div class="login-footer">
				<div class="pull-left">
					&copy; 2018 Rio's Library
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('general/script-includes'); ?>
</body>
