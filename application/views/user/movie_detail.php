<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb__links">
					<a href="<?= base_url() ?>"><i class="fa fa-home"></i> Home</a>
					<span><?= isset($data) ? $data->name : '' ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb End -->
<!-- Anime Section Begin -->
<section class="anime-details spad">
	<div class="container">
		<div class="anime__details__content">
			<div class="row">
				<div class="col-lg-3">
					<div class="anime__details__pic set-bg"
						 data-setbg="<?= base_url() ?>assets/img/anime/<?= isset($data) ? $data->image : '' ?>">
						<div class="comment"><i
									class="fa fa-comments"></i> <?= isset($comments) ? count($comments) : 0 ?>
						</div>
						<div class="view"><i class="fa fa-eye"></i> <?= isset($data) ? $data->views : 0 ?></div>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="anime__details__text">
						<div class="anime__details__title">
							<h3><?= isset($data) ? $data->name : '' ?></h3>
							<span><?= isset($data) ? $data->anotherName : '' ?></span>
						</div>
						<div class="anime__details__rating anime__details__like">
							<div class="like">
								<span class="icon_like"></span>
								<span> <?= isset($data) ? $data->like : '' ?></span>
							</div>
							<div class="dislike">
								<span class="icon_dislike"></span>
								<span> <?= isset($data) ? $data->dislike : '' ?></span>
							</div>
						</div>
						<p><?= isset($data) ? $data->describe : '' ?></p>
						<div class="anime__details__widget">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<ul>
										<li><span>Type:</span> <?= isset($data) ? $data->type : '' ?></li>
										<li><span>Studios:</span> <?= isset($data) ? $data->studios : '' ?></li>
										<li>
											<span>Date aired:</span> <?= isset($data) ? date("d-m-Y", strtotime($data->dateAired)) : '' ?>
										</li>
										<li><span>Status:</span> <?= isset($data) ? $data->status : '' ?></li>
										<li><span>Genre:</span> <?= isset($data) ? $data->genre : '' ?></li>
									</ul>
								</div>
								<div class="col-lg-6 col-md-6">
									<ul>
										<li><span>Like:</span> <?= isset($data) ? $data->like : '' ?></li>
										<li><span>Dislike:</span> <?= isset($data) ? $data->dislike : '' ?></li>
										<li><span>Episodes:</span>
											<?php if (isset($data)):
												echo $data->episodes . ' / ' . ($data->totalEpisode > 0 ? $data->totalEpisode : '?');
											endif; ?>
										</li>
										<li><span>Quality:</span> <?= isset($data) ? $data->quality : '' ?></li>
										<li>
											<span>Views:</span> <?= isset($data) ? number_format($data->views, 0, ',', '.') : '' ?>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="anime__details__btn">
							<?php if ($this->session->has_userdata('customer')): ?>
								<a href="<?= base_url('account/follow') ?>"
								   customer-id="<?= $this->session->userdata('customer')['id'] ?>"
								   movie-id="<?= $data->id ?? '' ?>"
								   id="movie-follow"
								   class="follow-btn"><i class="fa fa-heart-o"></i>
									Follow</a>
							<?php endif; ?>
							<?php if (!$this->session->has_userdata('customer')): ?>
								<a href="<?= base_url('login') ?>" class="follow-btn"><i class="fa fa-heart-o"></i>
									Follow</a>
							<?php endif; ?>
							<a href="<?= base_url() . 'movie/' . (isset($data) && isset($episode) ? $data->url . '/' . $episode->url : '') ?>"
							   class="watch-btn"><span>Watch Now</span> <i
										class="fa fa-angle-right"></i></a>
							<a href="#" class="follow-btn share-btn" data-toggle="modal" data-target="#share-modal"><i
										class="fa fa-share-square-o"></i> Share</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-md-8">
				<div class="anime__details__review">
					<div class="section-title">
						<h5>Reviews</h5>
					</div>
					<?php if (isset($comments)): ?>
						<?= count($comments) <= 0 ? '<span style="color: #b7b7b7">There are no reviews yet.</span>' : '' ?>

						<?php foreach ($comments as $item): ?>
							<div class="anime__review__item">
								<div class="anime__review__item__pic">
									<img src="<?= base_url() ?>assets/img/anime/<?= $item->image == null ? 'avt.png' : $item->image ?>"
										 alt="">
								</div>
								<div class="anime__review__item__text">
									<h6><?= $item->name ?> - <span class="data-time-comment"
																   data-time="<?= $item->createAt ?>"><?= format_time($item->createAt) ?></span>
									</h6>
									<p><?= $item->comment ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="anime__details__form">
					<div class="section-title">
						<h5>Your Comment</h5>
					</div>
					<?php if (!$this->session->has_userdata('customer')): ?>
						<span style="color: #b7b7b7">You need to login to comment.</span>
					<?php endif; ?>
					<?php if ($this->session->has_userdata('customer')): ?>
						<form action="<?= base_url() . 'movie/review/comment' ?>" id="frm_review" method="post">
							<textarea placeholder="Your Comment" name="review" required></textarea>
							<input type="hidden" name="id" value="<?= $data->id ?? '' ?>" readonly>
							<input type="hidden" name="customerId"
								   value="<?= $this->session->userdata('customer')['id'] ?>" readonly>
							<button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
						</form>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="anime__details__sidebar">
					<div class="section-title">
						<h5>you might like...</h5>
					</div>
					<?php if (isset($recommend)): ?>
						<?php foreach ($recommend as $item): ?>
							<div class="product__sidebar__view__item set-bg"
								 data-setbg="<?= base_url() ?>assets/img/<?= !empty($item->imageSidebar) ? 'sidebar/' . $item->imageSidebar : 'anime/' . $item->image ?>">
								<div class="ep">
									<?php if (isset($data)):
										echo $item->episodes . ' / ' . ($item->totalEpisode > 0 ? $item->totalEpisode : '?');
									endif; ?>
								</div>
								<div class="view"><i
											class="fa fa-eye"></i> <?= number_format($item->views, 0, ',', '.') ?></div>
								<h5><a href="<?= base_url() . 'movie/' . $item->url ?>"><?= $item->name ?></a></h5>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Anime Section End -->

<!-- Modal -->
<div class="modal fade" id="share-modal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Share</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="anime__details__btn">
					<a href="https://www.facebook.com/share.php?u=<?= base_url() . (isset($data) ? urlencode($data->url) : '') ?>"
					   class="follow-btn share-btn-item" style="background: #1877f2;margin: 6px;"><i
								class="fa fa-facebook"></i> Facebook</a>
					<a href="https://twitter.com/intent/tweet?url=<?= base_url() . (isset($data) ? urlencode($data->url) : '') ?>"
					   class="follow-btn share-btn-item" style="background: #1da1f2;margin: 6px;"><i
								class="fa fa-twitter"></i> Twitter</a>
					<a href="https://telegram.me/share/url?url=<?= base_url() . (isset($data) ? urlencode($data->url) : '') ?>"
					   class="follow-btn share-btn-item" style="background: #2fa5dc;margin: 6px;"><i
								class="fa fa-telegram"></i> Telegram</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End modal -->

