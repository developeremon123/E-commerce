<?php include "inc/header.php";?>
<?php 
	$login = Session::get('customerlogin');
	if ($login == true) {
		header("Location: oorderdetails.php");
	}
	if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['login'])) {
		$cmr_log = $cmr->cmr_log($_POST);
	}       
?>
 <div class="main">
    <div class="content">
    	<div class="login_panel">
			<?php 
				if (isset($cmr_log)) {
					echo $cmr_log;
				}
			?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post">
				<input name="email" placeholder="Enter your email address" type="text" >
				<input name="password" placeholder="Enter your password" type="password">
				<div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
			</form>
        </div>
		<?php 
			if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['register'])) {
				$cmr_reg = $cmr->cmr_reg($_POST);
			}       
		?>
    	<div class="register_account">
			<?php 
				if (isset($cmr_reg)) {
					echo $cmr_reg;
				}
			?>
    		<h3>Register New Account</h3>
    		<form action="" method="post" >
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Name">
								</div>
								<div>
									<input type="text" name="city" placeholder="City">
								</div>
								<div>
									<input type="text" name="zip" placeholder="Zip-Code">
								</div>
								<div>
									<input type="text" name="email" placeholder="Email">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Address">
								</div>
								<div>
									<input type="text" name="country" placeholder="Country">
								</div>		        
								<div>
									<input type="text" name="phone" placeholder="Phone">
								</div>
								<div>
									<input type="text" name="password" placeholder="Password">
								</div>
							</td>
		    			</tr> 
		    		</tbody>
				</table> 
				<div class="search">
					<div>
						<button class="grey" name="register">Create Account</button>
					</div>
				</div>
				<div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php include "inc/footer.php";?>
