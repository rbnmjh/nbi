<?php $this->pageTitle = Yii::app()->name;?>
<div class="main_content">
	<div class="page_wrap container_10">
		<div class="right_content grid_3">
			<?php $this->renderPartial('//blocks/right_bar'); ?>
		</div><!-- end right_content -->
		<div class="left_content grid_7">
			<h1 class="album">Album  </h1>
			<ul class="gallery">
				<?php
				
		 				if(!empty($album)){
						$j=1;
						$new_count=count($album);
							foreach ($album as $value) {?>
									
							<li class="<?php $rem=$j%3; if($rem==0){ echo "last";} ?>">
								<figure>
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/gallery/view/<?php echo $value->attributes['id']?>">
									<img src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/album/<?php echo $value['image_name']?>" alt="<?php echo $value['album_name']; ?>" width='214' height='124'>
									<figcaption><?php echo $value->attributes['album_name']; ?></figcaption></a>
								</figure>
						</li>
				<?php $j++;	} }?>

				
			</ul>
			<?php // }?>
		</div><!-- end left content -->
	</div>
</div><!-- end main_content -->