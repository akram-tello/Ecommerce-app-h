<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">

		<div class="navbar-header">
			<a href="index.php" class="navbar-brand">E-book Store</a>
		</div>

		<div class="collapse navbar-collapse" id="collapse">

			<form class="navbar-form navbar-left">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search" id="search">
		        </div>
		        <button type="submit" class="btn btn-primary" id="search_btn"><span class="glyphicon glyphicon-search"></span></button>
		     </form>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge" >0</span></a>
					<div class="dropdown-menu" style="width:400px;">
						<div class="panel panel-success">
							<div class="panel-heading" style="background-color: #293B5F !important;" style="background-color: #293B5F !important;">
								<div class="row">
									<div class="col-md-3" style="color: #fff;">No.</div>
									<div class="col-md-3" style="color: #fff;">Product Image</div>
									<div class="col-md-3" style="color: #fff;">Product Name</div>
									<div class="col-md-3" style="color: #fff;">Price in <?php echo CURRENCY; ?></div>
								</div>
							</div>

							<div class="panel-body">
								<div id="cart_product">
								</div>
							</div>
							
							<div class="panel-footer"></div>
						</div>
					</div>
				</li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Login/Register</a>
					<ul class="dropdown-menu">
						<div style="width:300px;">
							<div class="panel panel-primary">
								<div class="panel-heading" style="background-color: #293B5F !important;" style="background-color: #293B5F !important;">Login</div>
								<div class="panel-heading" style="background-color: #293B5F !important;" style="background-color: #293B5F !important;">
									<form onsubmit="return false" id="login">
										<label for="email">Email</label>
										<input type="email" class="form-control" name="email" id="email" required/>
										<label for="email">Password</label>
										<input type="password" class="form-control" name="password" id="password" required/>
										<p><br/></p>
										<input type="submit" class="btn btn-warning" value="Login">
										<a href="registration_form.php?register=1" style="color:white; text-decoration:none;">Create Account Now</a>
									</form>
								</div>
								<div class="panel-footer" id="e_msg"></div>
							</div>
						</div>
					</ul>
				</li>
			</ul>

		</div>
        
	</div>
</div>	