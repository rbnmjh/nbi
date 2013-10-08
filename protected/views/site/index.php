<?php $this->pageTitle = Yii::app()->name;?>
<div class="slider">
	<?php $this->renderPartial('//blocks/slider'); ?>
</div><!-- end slider -->
<div class="main_content">
	<div class="page_wrap container_10">
		<div class="right_content grid_3">
<?php echo $name['name'];?>
			<?php $this->renderPartial('//blocks/right_bar'); ?>
		</div><!-- end right_content -->
		<div class="left_content grid_7">
			<?php $this->renderPartial('//blocks/home_message'); ?>
			<?php $this->renderPartial('//blocks/gallery'); ?>
			<?php $this->renderPartial('//blocks/blog'); ?>
		</div><!-- end left content -->
	</div>
</div><!-- end main_content -->
