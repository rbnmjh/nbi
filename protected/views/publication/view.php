<?php $this->pageTitle = Yii::app()->name;?>
<div class="main_content">
	<div class="page_wrap container_10">
		<div class="right_content grid_3">
			<?php $this->renderPartial('//blocks/right_bar'); ?>
		</div><!-- end right_content -->
		<div class="left_content grid_7">
			
			
		<h1 class="pub_view_top"><?php echo $view->attributes['name']; ?></h1>
		<div class="pub_view_bottom"><?php echo $view->attributes['content']; ?></div>
	<?php if(!empty($view->attributes['files'])){ ?>
		<div class="related">
			<a class="related" href='<?php echo Yii::app()->baseUrl.'/uploads/publication/'.$view->attributes["files"]; ?>'>Related files</a>

		</div>
		<?php }?>
		</div><!-- end left content -->
	</div>
</div><!-- end main_content -->