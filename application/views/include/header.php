<head>
	<meta charset="UTF-8">
	<meta name="description" content="Anime Template">
	<meta name="keywords" content="Anime, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<base href="<?=base_url()?>">
	<title><?= $title ?? '' ?></title>
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
	<?php $this->load->view("include/head") ?>
</head>

<body>
	<!-- Page Preloder -->
	<div id="preloder" style="display: none;">
		<div class="loader" style="display: none;"></div>
	</div>
	<!-- Header Section Begin -->
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-2">
					<div class="header__logo">
						<a href="<?= base_url() ?>">
							<img src="<?= base_url() ?>assets/img/logo.svg" alt="" width="93" height="23">
						</a>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="header__nav">
						<nav class="header__menu mobile-menu">
							<ul>
								<li class="active"><a href="<?=base_url() ?>">Homepage</a></li>
								<li><a href="./categories.html">Categories <span class="arrow_carrot-down"></span></a>
									<ul class="dropdown">
										<li><a href="./categories.html">Categories</a></li>
										<li><a href="./anime-details.html">Anime Details</a></li>
										<li><a href="./anime-watching.html">Anime Watching</a></li>
										<li><a href="./blog-details.html">Blog Details</a></li>
										<li><a href="<?=base_url().'register'?>">Register</a></li>
										<li><a href="<?=base_url().'login'?>">Login</a></li>
									</ul>
								</li>
								<li><a href="./blog.html">Our Blog</a></li>
								<li><a href="#">Contacts</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="header__right account-and-search">
						<a href="#" class="search-switch"><span class="icon_search"></span></a>
						<?php if (!$this->session->has_userdata('customer')): ?>
							<a href="<?=base_url().'login'?>" class="header-login"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
						<?php endif; ?>
						<?php if ($this->session->has_userdata('customer')):?>
						<div class="header__menu mobile-menu">
							<ul>
								<li><a href="<?=base_url().'account'?>" class="account"><span class="icon_profile"></span></a>
									<ul class="dropdown account-dropdown">
										<li><a href="./anime-watching.html">Account</a></li>
										<li><a href="./categories.html">Follow</a></li>
										<li><a href="./anime-details.html">History</a></li>
										<li><a href="<?=base_url().'logout'?>" id="logout">Logout</a></li>
									</ul>
								</li>
							</ul>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div id="mobile-menu-wrap">
				<div class="slicknav_menu"><a href="#" aria-haspopup="true" role="button" tabindex="0"
											  class="slicknav_btn slicknav_collapsed"><span
							class="slicknav_menutxt">MENU</span><span class="slicknav_icon"><span
								class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span><span
								class="slicknav_icon-bar"></span></span></a>
					<nav class="slicknav_nav slicknav_hidden" aria-hidden="true" role="menu" style="display: none;">
						<ul>
							<li class="active"><a href="<?=base_url() ?>" role="menuitem">Homepage</a></li>
							<li class="slicknav_collapsed slicknav_parent"><a href="#" role="menuitem" aria-haspopup="true"
																			  tabindex="-1"
																			  class="slicknav_item slicknav_row"><a
										href="./categories.html">Categories <span class="arrow_carrot-down"></span></a>
									<span class="slicknav_arrow">►</span></a>
								<ul class="dropdown slicknav_hidden" role="menu" aria-hidden="true" style="display: none;">
									<li><a href="./categories.html" role="menuitem" tabindex="-1">Categories</a></li>
									<li><a href="./anime-details.html" role="menuitem" tabindex="-1">Anime Details</a></li>
									<li><a href="./anime-watching.html" role="menuitem" tabindex="-1">Anime Watching</a>
									</li>
									<li><a href="./blog-details.html" role="menuitem" tabindex="-1">Blog Details</a></li>
									<li><a href="./signup.html" role="menuitem" tabindex="-1">Sign Up</a></li>
									<li><a href="./login.html" role="menuitem" tabindex="-1">Login</a></li>
								</ul>
							</li>
							<li><a href="./blog.html" role="menuitem">Our Blog</a></li>
							<li><a href="#" role="menuitem">Contacts</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- Header End -->
