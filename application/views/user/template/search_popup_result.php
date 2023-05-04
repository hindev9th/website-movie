<?php if (isset($data)) : ?>
	<?php foreach ($data as $item) : ?>
		<li class="item">
			<img src="<?= base_url() ?>assets/img/sidebar/<?=$item->imageSidebar?>" width="100" height="80" style="margin-right: 10px;">
			<div class="item-detail">
				<a href="<?=base_url('movie/'.$item->url)?>"><?=$item->name?></a>
				<p><?=$item->genre?></p>
			</div>
		</li>
	<?php endforeach; ?>
	<?php if (count($data) <= 0) : ?>
		<li class="item">
			<p>Not found.</p>
		</li>
	<?php endif; ?>
<?php endif; ?>
