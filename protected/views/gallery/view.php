<?php $this->pageTitle = Yii::app()->name;?>
<div class="main_content">
	<div class="page_wrap container_10">
		<div class="right_content grid_3">
			<?php $this->renderPartial('//blocks/right_bar'); ?>
		</div><!-- end right_content -->
		<div class="left_content grid_7">
			<h1 class="gallery">Album >> <?php echo $album_name; ?></h1>
 			<ul class="gallery">
				<?php

 				if(!empty($view)){
				$j=1;
				$new_count=count($view);

				foreach ($view as $value) {//$url=Yii::app()->request->baseUrl; ?>
					<li class="<?php $rem=$j%3; if($rem==0){ echo "last";} ?>">
			<figure>
				<a href="<?php echo Yii::app()->request->baseUrl; ?>/uploads/gallery/<?php echo $value['image_name']?>" data-lightbox="image-1">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/gallery/thumbs/<?php echo $value['image_name']?>" alt="">
				<figcaption><?php echo $value['title']; ?></figcaption></a>
				</a>
			</figure>
		</li>
	<?php $j++;	} }?>
		
 				
				
			</ul>
			<?php // }?>
		</div><!-- end left content -->
	</div>
</div><!-- end main_content -->