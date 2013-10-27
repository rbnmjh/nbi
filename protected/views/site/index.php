<?php $this->pageTitle = Yii::app()->name;?>
<div class="slider">
	<?php $this->renderPartial('//blocks/slider'); ?>
	<?php
		$criteria = new CDbCriteria();
        $criteria->condition = 'is_active= 1';
        $criteria->order = 'id DESC';
        $slider = Slider::model()->findAll($criteria);
		 	if(!empty($slider)){
				$j=1;
				$new_count=count($slider);
				foreach ($slider as $value) {?>
				
					<figure>						
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/slider/<?php echo $value['image_name']?>" alt="" width='100%' height='400'>
						<figcaption><?php echo $value->attributes['title']; ?></figcaption></a>
					</figure>
			
	<?php $j++;	} }?>
	
</div><!-- end slider -->
<div class="main_content">
	<div class="page_wrap container_10">
		<div class="right_content grid_3">
			<?php $this->renderPartial('//blocks/right_bar'); ?>
		</div><!-- end right_content -->
		<div class="left_content grid_7">
			<?php $this->renderPartial('//blocks/home_message'); ?>
			<?php $this->renderPartial('//blocks/gallery'); ?>
			<?php $this->renderPartial('//blocks/blog'); ?>
		</div><!-- end left content -->
	</div>
</div><!-- end main_content -->
