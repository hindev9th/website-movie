<!doctype html>
<html lang="zxx">
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
								<?php $select = $select ?? 0; ?>
								<li class="<?= $select == 1 ? 'active' : '' ?>"><a href="<?=base_url() ?>">Homepage</a></li>
								<li class="<?= $select == 2 ? 'active' : '' ?>"><a href="<?=base_url('genre')?>">Genres <span class="arrow_carrot-down"></span></a>
									<ul class="dropdown genre-dropdown p-2">
										<?php foreach (getAllGenres() as $item): ?>
											<li class="border mb-1 mr-1"><a href="<?=base_url('genre?genre='.$item->name)?>" class="header-genre-item"><?= $item->name ?></a></li>
										<?php endforeach; ?>
									</ul>
								</li>
								<li class="<?= $select == 3 ? 'active' : '' ?>"><a href="./blog.html">Our Blog</a></li>
								<li class="<?= $select == 4 ? 'active' : '' ?>"><a href="#">Contacts</a></li>
								<?php if ($this->session->has_userdata('customer')): ?>
									<div class="mobile-menu-account">
										<a href="<?=base_url().'logout'?>" class="header-login">Logout</a>
									</div>
								<?php endif; ?>
							</ul>
						</nav>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="header__right account-and-search">
						<a  class="search-switch"><span class="icon_search"></span></a>
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
										<li><a href="<?=base_url().'logout'?>" id="logout">Logout</a></li>
									</ul>
								</li>
							</ul>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div id="mobile-menu-wrap"></div>
		</div>
	</header>
	<!-- Header End -->
