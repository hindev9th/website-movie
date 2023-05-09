<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb__links">
					<a href="<?= base_url() ?>"><i class="fa fa-home"></i> Home</a>
					<span><?= isset($search) ? 'search: ' . $search : 'Genres' ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb End -->

<!-- Product Section Begin -->
<section class="product-page spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="product__page__content">
					<div class="product__page__title">
						<div class="row">
							<div class="col-lg-8 col-md-8 col-sm-6">
								<div class="section-title">
									<h4>Genres</h4>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6">
								<div class="product__page__filter">
									<p>Order by:</p>
									<select class="filter-select">
										<option <?= !isset($order) ? 'selected' : '' ?>  value="ASC">A-Z</option>
										<option <?= isset($order) && $order == 'DESC' ? 'selected' : '' ?> value="DESC">Z-A</option>
										<option <?= isset($order) && $order == 'update' ? 'selected' : '' ?> value="update">New update</option>
										<option <?= isset($order) && $order == 'movies' ? 'selected' : '' ?> value="movies">New movies</option>
									</select>
								</div>
								<input type="hidden" class="search-value" value="<?= $search ?? '' ?>" readonly>
							</div>
						</div>
						<div class="row">
							<ul class="filter-genre-dropdown p-2">
								<?php foreach (getAllGenres() as $item) : ?>
									<li>
										<input type="checkbox" <?= isset($filter) && $filter == $item->name ? 'checked' : '' ?>  id="genre-<?= $item->id ?>" class="genre-item"
											   value="<?= $item->name ?>">
										<label for="genre-<?= $item->id ?>"
											   disabled="disabled"><?= $item->name ?></label>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="row" id="movie-filter">
						<?php foreach (($data ?? null) as $item): ?>
							<div class="col-lg-4 col-md-6 col-sm-6">
								<div class="product__item">
									<div class="product__item__pic set-bg"
										 data-setbg="<?= base_url() ?>assets/img/anime/<?= $item->image ?>">
										<div class="ep"><?= $item->episodes . ' / ' . ($item->totalEpisode > 0 ? $item->totalEpisode : '?') ?></div>
										<div class="comment"><i class="fa fa-comments"></i> <?= $item->reviewCount ?>
										</div>
										<div class="view"><i class="fa fa-eye"></i> <?= $item->views ?></div>
									</div>
									<div class="product__item__text">
										<ul class="list-genre">
											<?php $genres = explode(', ',($item->genre ?? '')) ?>
											<?php foreach ($genres as $genre): ?>
												<li><?=$genre?></li>
											<?php endforeach; ?>
										</ul>
										<h5><a href="<?= base_url('movie/' . $item->url) ?>"><?= $item->name ?></a></h5>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="product__pagination">
					<?php

					$countRow = ($countAll ?? 1) / 18;
					$current_page = $current_page ?? 1;
					$iFirst = $current_page >= 4 && $countRow > 5 ? $current_page - 2 : 1;
					$end = $countRow > 5 ? $iFirst + 4 : $countRow;

					for ($i = $iFirst; $i <= $end; $i++): ?>
						<a href="#"
						   class="page-genre <?= $current_page == ($i) ? 'current-page' : '' ?>"><?= $i ?></a>
						<?php if ($i == 5): ?>
							<a href="#" class="next-page-genre"><i class="fa fa-angle-double-right"></i></a>
						<?php endif; ?>
					<?php endfor; ?>
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
										<a href="<?= base_url('movie/' . $item->url) ?>"
										   style="color: #ffffff"><?= $item->nameMovie ?></a>
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
