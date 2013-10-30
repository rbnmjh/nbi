<?php $this->pageTitle = Yii::app()->name;?>
<div class="main_content">
	<div class="page_wrap container_10">
		<div class="right_content grid_3">
			<?php $this->renderPartial('//blocks/right_bar'); ?>
		</div><!-- end right_content -->
		<div class="left_content grid_7">
			<h1><?php echo $news['title']; ?></h1>
			<div> <?php echo $news['content'];?></div>
		</div><!-- end left content -->
	</div>
</div><!-- end main_content -->