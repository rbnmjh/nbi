<?php $this->pageTitle = Yii::app()->name;?>
<div class="main_content">
	<div class="page_wrap container_10">
		<div class="right_content grid_3">
			<?php $this->renderPartial('//blocks/right_bar'); ?>
		</div><!-- end right_content -->
		<div class="left_content grid_7">
		<h1 class="partner">Partner  </h1>
			<ul class="gallery">
				<?php
				
		 				if(!empty($partner)){
							$j=1;
							foreach ($partner as $value) {?>									
							<li class="<?php $rem=$j%3; if($rem==0){ echo "last";} ?>">
								<figure>
									<img src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/partner/<?php echo $value->attributes['image']?>" alt="<?php echo $value->attributes['name'] ?>" width='214' height='124'>
									<figcaption><?php echo $value->attributes['name']; ?></figcaption>
								</figure>
							</li>
				<?php 		$j++;	} }?>

				
			</ul>
		</div><!-- end left content -->
	</div>
</div><!-- end main_content -->