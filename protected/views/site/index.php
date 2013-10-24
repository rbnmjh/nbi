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
	<?php $this->widget('application.extensions.slider.slider');?>
 
	<?php $this->widget('ext.slider.slider');?>
	<?php
        $this->widget('ext.slider.slider', array(
            'container'=>'slideshow',
            'width'=>960, 
            'height'=>240, 
            'timeout'=>6000,
            'infos'=>true,
            'constrainImage'=>true,
            'images'=>array('01.jpg','02.jpg','03.jpg','04.jpg'),
            'alts'=>array('First description','Second description','Third description','Four description'),
            'defaultUrl'=>Yii::app()->request->hostInfo
            )
        );
        ?>
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
