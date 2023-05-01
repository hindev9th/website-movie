<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb__links">
					<a href="./index.html"><i class="fa fa-home"></i> Home</a>
					<a href="<?= base_url('movie/') . ($data->movieUrl ?? '') ?>"><?= $data->movieName ?? '' ?></a>
					<span><?= $data->name ?? '' ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb End -->

<!-- Anime Section Begin -->
<section class="anime-details spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="anime__video__player">
					<video id="player" playsinline
						   data-poster="<?= base_url() ?>assets/videos/poster/<?= $data->poster ?? '' ?>"
						   data-movie-id="<?= $data->movieId ?? '' ?>" data-id="<?= $data->id ?? '' ?>">
						<source src="<?= base_url() ?>assets/videos/<?= $data->video ?? '' ?>"
								type="<?= $data->type ?? '' ?>"/>
						<!-- Captions are optional -->
						<!--						<track kind="captions" label="English captions" src="#" srclang="en"-->
						<!--							   default />-->
					</video>
				</div>
				<div class="anime__details__episodes">
					<div class="section-title">
						<h5>List Name</h5>
					</div>
					<?php if (isset($episodes)): ?>
						<?php foreach ($episodes as $item): ?>
							<a href="<?= base_url() . 'movie/' . ($data->movieUrl ?? '') . '/' . $item->url; ?>"
							   class="<?= isset($data) ? ($data->id == $item->id ? 'active' : '') : '' ?>">
								<?= $item->name ?>
							</a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<div class="anime__details__review">
					<div class="section-title">
						<h5>Reviews</h5>
						<?php if ($this->session->has_userdata('customer')): ?>
							<div class="anime__details__rating anime__details__like">
								<div class="like">
									<a href="<?= base_url('movie/view/like/') ?>"
									   customer-id="<?= $this->session->userdata('customer')['id'] ?>"
									   movie-id="<?= $data->id ?? '' ?>" status="1" id="review-like"
									   class="icon_like like_and_dislike <?= isset($like) && $like->status == 1 ? 'active' : '' ?>"></a>
									<span id="number-like"> <?= $data->like ?? '' ?></span>
								</div>
								<div class="dislike">
									<a href="<?= base_url('movie/view/like/') ?>"
									   customer-id="<?= $this->session->userdata('customer')['id'] ?>"
									   movie-id="<?= $data->id ?? '' ?>" status="0" id="review-dislike"
									   class="icon_dislike like_and_dislike <?= isset($like) && $like->status == 0 ? 'active' : '' ?>"></a>
									<span id="number-dislike"> <?= $data->dislike ?? '' ?></span>
								</div>
							</div>
						<?php endif; ?>
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
							<textarea placeholder="Your Comment" name="review"></textarea>
							<input type="hidden" name="id" value="<?= $data->id ?? '' ?>" readonly>
							<input type="hidden" name="customerId"
								   value="<?= $this->session->userdata('customer')['id'] ?>" readonly>
							<button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Anime Section End -->
