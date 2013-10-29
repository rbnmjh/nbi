<?php $this->pageTitle = Yii::app()->name;?>
<div class="main_content">
	<div class="page_wrap container_10">
		<div class="right_content grid_3">
			<?php $this->renderPartial('//blocks/right_bar'); ?>
		</div><!-- end right_content -->
		<div class="left_content grid_7">
			<h1 class="publication">Publication</h1>
			<div class="publication">
				<?php				
	 				if(!empty($publication)){	 					
					$j=1;
					//$new_count=count($publication);
					foreach ($publication as $value) {?>
						<div class="pub">						
						<div class="left_pub"><?php echo "$j.";?></div>
						<div><a class="right_pub" href="<?php echo Yii::app()->baseUrl.'/publication/view/'.$value->attributes['id'];?>"><?php echo $value->name;?></a></div>
						<div class="right_pub_content" ><?php echo $value->content;?></div>
						</div>
				<?php $j++;	} }?>			
			
			</div>
		</div><!-- end left content -->
	</div>
</div><!-- end main_content -->
