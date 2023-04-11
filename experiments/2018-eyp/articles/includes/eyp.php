<section class="eyp">
	<h2 class="eyp__title">Why and how we’re covering this topic</h2>

	<?php foreach($eyp as $section): ?>
		<h3 class="eyp__subtitle"><?php echo $section['title'];?></h3>
		<div class="eyp__content"><?php echo $section['content'];?></div>
	<?php endforeach; ?>
</section>