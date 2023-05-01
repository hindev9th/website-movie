<div class="section-title">
	<h5>Reviews</h5>
</div>
<?php if (isset($comments)): ?>
	<?php foreach ($comments as $item): ?>
		<div class="anime__review__item">
			<div class="anime__review__item__pic">
				<img src="<?=base_url()?>assets/img/anime/<?= $item->image == null ? 'avt.png' : $item->image ?>" alt="">
			</div>
			<div class="anime__review__item__text">
				<h6><?= $item->name ?> - <span class="data-time-comment" data-time="<?=$item->createAt?>" ><?= format_time($item->createAt) ?></span></h6>
				<p><?= $item->comment ?></p>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
