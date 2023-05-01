<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Hero Section Begin -->
<section class="hero">
	<div class="container">
		<div class="hero__slider owl-carousel">
			<?php if (isset($sidebar)): ?>
				<?php foreach ($sidebar as $item): ?>
					<div class="hero__items set-bg" data-setbg="<?= base_url() ?>assets/img/hero/hero-1.jpg">
						<div class="row">
							<div class="col-lg-6">
								<div class="hero__text">
									<h2><?= $item->name ?></h2>
									<p class="sidebar-describe"><?= $item->describe ?></p>
									<a href="<?= base_url('movie/' . $item->url) ?>"><span>Watch Now</span> <i
												class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<!-- Hero Section End -->
<!-- Product Section Begin -->
<section class="product spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="trending__product">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8">
							<div class="section-title">
								<h4>New update</h4>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<div class="btn__all">
								<a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
							</div>
						</div>
					</div>
					<div class="row">
						<?php if (isset($new_movies)): ?>
							<?php foreach ($new_movies as $item): ?>
								<div class="col-lg-4 col-md-6 col-sm-6">
									<div class="product__item">
										<div class="product__item__pic set-bg"
											 data-setbg="<?= base_url() ?>assets/img/anime/<?= $item->image ?>">
											<div class="ep"><?= $item->episodes . ' / ' . ($item->totalEpisode > 0 ? $item->totalEpisode : '?') ?></div>
											<div class="comment"><i
														class="fa fa-comments"></i> <?= $item->reviewCount ?></div>
											<div class="view"><i class="fa fa-eye"></i> <?= $item->views ?></div>
										</div>
										<div class="product__item__text">
											<ul class="list-genre" data-genre="<?= $item->genre ?>">

											</ul>
											<h5><a href="<?= base_url('movie/' . $item->url) ?>"><?= $item->name ?></a>
											</h5>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="popular__product">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8">
							<div class="section-title">
								<h4>Featured movies</h4>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<div class="btn__all">
								<a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
							</div>
						</div>
					</div>
					<div class="row">
						<?php if (isset($highlight)): ?>
							<?php foreach ($highlight as $item): ?>
								<div class="col-lg-4 col-md-6 col-sm-6">
									<div class="product__item">
										<div class="product__item__pic set-bg"
											 data-setbg="<?= base_url() ?>assets/img/anime/<?= $item->image ?>">
											<div class="ep"><?= $item->episodes . ' / ' . ($item->totalEpisode > 0 ? $item->totalEpisode : '?') ?></div>
											<div class="comment"><i
														class="fa fa-comments"></i> <?= $item->reviewCount ?></div>
											<div class="view"><i class="fa fa-eye"></i> <?= $item->views ?></div>
										</div>
										<div class="product__item__text">
											<ul class="list-genre" data-genre="<?= $item->genre ?>">

											</ul>
											<h5><a href="<?= base_url('movie/' . $item->url) ?>"><?= $item->name ?></a>
											</h5>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="recent__product">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8">
							<div class="section-title">
								<h4>Movies</h4>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<div class="btn__all">
								<a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
							</div>
						</div>
					</div>
					<div class="row">
						<?php if (isset($movies)): ?>
							<?php foreach ($movies as $item): ?>
								<div class="col-lg-4 col-md-6 col-sm-6">
									<div class="product__item">
										<div class="product__item__pic set-bg"
											 data-setbg="<?= base_url() ?>assets/img/anime/<?= $item->image ?>">
											<div class="ep"><?= $item->episodes . ' / ' . ($item->totalEpisode > 0 ? $item->totalEpisode : '?') ?></div>
											<div class="comment"><i
														class="fa fa-comments"></i> <?= $item->reviewCount ?></div>
											<div class="view"><i class="fa fa-eye"></i> <?= $item->views ?></div>
										</div>
										<div class="product__item__text">
											<ul class="list-genre" data-genre="<?= $item->genre ?>">

											</ul>
											<h5><a href="<?= base_url('movie/' . $item->url) ?>"><?= $item->name ?></a>
											</h5>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="live__product">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8">
							<div class="section-title">
								<h4>Live Action</h4>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<div class="btn__all">
								<a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
							</div>
						</div>
					</div>
					<div class="row">
						<?php if (isset($live_action)): ?>
							<?php foreach ($live_action as $item): ?>
								<div class="col-lg-4 col-md-6 col-sm-6">
									<div class="product__item">
										<div class="product__item__pic set-bg"
											 data-setbg="<?= base_url() ?>assets/img/anime/<?= $item->image ?>">
											<div class="ep"><?= $item->episodes . ' / ' . ($item->totalEpisode > 0 ? $item->totalEpisode : '?') ?></div>
											<div class="comment"><i
														class="fa fa-comments"></i> <?= $item->reviewCount ?></div>
											<div class="view"><i class="fa fa-eye"></i> <?= $item->views ?></div>
										</div>
										<div class="product__item__text">
											<ul class="list-genre" data-genre="<?= $item->genre ?>">
											</ul>
											<h5><a href="<?= base_url('movie/' . $item->url) ?>"><?= $item->name ?></a>
											</h5>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-8">
				<div class="product__sidebar">
					<div class="product__sidebar__view">
						<div class="section-title">
							<h5>Top Views</h5>
						</div>
						<ul class="filter__controls">
							<li data-filter=".day">Day</li>
							<li data-filter=".week">Week</li>
							<li data-filter=".month">Month</li>
							<li class="active" data-filter=".years">Years</li>
						</ul>
						<div class="filter__gallery">
							<?php if (isset($top_day)): ?>
								<?php foreach ($top_day as $item): ?>
									<div class="product__sidebar__view__item set-bg mix day"
										 data-setbg="<?= base_url() ?>assets/img/sidebar/<?= $item->imageSidebar ?>">
										<div class="ep"><?= $item->episodes . ' / ' . ($item->totalEpisode > 0 ? $item->totalEpisode : '?') ?></div>
										<div class="view"><i class="fa fa-eye"></i> <?= $item->views ?></div>
										<h5><a href="<?= base_url('movie/' . $item->url) ?>"><?= $item->name ?></a></h5>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
							<?php if (isset($top_week)): ?>
								<?php foreach ($top_week as $item): ?>
									<div class="product__sidebar__view__item set-bg mix week"
										 data-setbg="<?= base_url() ?>assets/img/sidebar/<?= $item->imageSidebar ?>">
										<div class="ep"><?= $item->episodes . ' / ' . ($item->totalEpisode > 0 ? $item->totalEpisode : '?') ?></div>
										<div class="view"><i class="fa fa-eye"></i> <?= $item->views ?></div>
										<h5><a href="<?= base_url('movie/' . $item->url) ?>"><?= $item->name ?></a></h5>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
							<?php if (isset($top_month)): ?>
								<?php foreach ($top_month as $item): ?>
									<div class="product__sidebar__view__item set-bg mix month"
										 data-setbg="<?= base_url() ?>assets/img/sidebar/<?= $item->imageSidebar ?>">
										<div class="ep"><?= $item->episodes . ' / ' . ($item->totalEpisode > 0 ? $item->totalEpisode : '?') ?></div>
										<div class="view"><i class="fa fa-eye"></i> <?= $item->views ?></div>
										<h5><a href="<?= base_url('movie/' . $item->url) ?>"><?= $item->name ?></a></h5>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
							<?php if (isset($top_year)): ?>
								<?php foreach ($top_year as $item): ?>
									<div class="product__sidebar__view__item set-bg mix years"
										 data-setbg="<?= base_url() ?>assets/img/sidebar/<?= $item->imageSidebar ?>">
										<div class="ep"><?= $item->episodes . ' / ' . ($item->totalEpisode > 0 ? $item->totalEpisode : '?') ?></div>
										<div class="view"><i class="fa fa-eye"></i> <?= $item->views ?></div>
										<h5><a href="<?= base_url('movie/' . $item->url) ?>"><?= $item->name ?></a></h5>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="product__sidebar__comment">
						<div class="section-title">
							<h5>New Comment</h5>
						</div>
						<?php if (isset($comments)): ?>
							<?= count($comments) <= 0 ? '<span style="color: #b7b7b7">There are no reviews yet.</span>' : '' ?>

							<?php foreach ($comments as $item): ?>
								<div class="anime__review__item">
									<div class="anime__review__item__pic">
										<img
												src="<?= base_url() ?>assets/img/anime/<?= $item->image == null ? 'avt.png' : $item->image ?>"
												alt="">
									</div>
									<div class="anime__review__item__text">
										<a href="<?=base_url('movie/'.$item->url)?>" style="color: #ffffff"><?= $item->nameMovie ?></a>
										<h6><?= $item->name ?> - <span class="data-time-comment"
																	   data-time="<?= $item->createAt ?>"><?= format_time($item->createAt) ?></span>
										</h6>
										<p><?= $item->comment ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Product Section End -->
