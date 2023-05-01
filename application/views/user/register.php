<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="normal__breadcrumb__text">
					<h2>Sign Up</h2>
					<p>Welcome to the official Anime blog.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Normal Breadcrumb End -->

<!-- Signup Section Begin -->
<section class="signup spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="login__form">
					<h3>Register</h3>
					<form action="<?=base_url('register/ajax')?>" id="frm-register" method="post">
						<div class="input__item">
							<input type="email" name="email" placeholder="Email address" required>
							<span class="icon_mail"></span>
						</div>
						<div class="input__item">
							<input type="text" name="name" placeholder="Your Name" required>
							<span class="icon_profile"></span>
						</div>
						<div class="input__item">
							<input type="password" name="password" placeholder="Password" pattern="[A-Za-z0-9@]+" required title="Please enter only letters, numbers, and the @ symbol.">
							<span class="icon_lock"></span>
						</div>
						<button type="submit" class="site-btn">Login Now</button>
					</form>
					<h5>Already have an account? <a href="<?=base_url('login')?>">Log In!</a></h5>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="login__social__links">
					<h3>Login With:</h3>
					<ul>
						<li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With Facebook</a>
						</li>
						<li><a href="#" class="google"><i class="fa fa-google"></i> Sign in With Google</a></li>
						<li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Signup Section End -->
