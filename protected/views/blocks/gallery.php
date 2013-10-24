<section>
	<h1>Photo Gallery</h1>
	<ul class="gallery">
		<?php 
			$criteria = new CDbCriteria();
            $criteria->alias = 'g';
            $criteria->condition = 'status = 1';
            $criteria->limit=3;
            $criteria->order = 'g.id DESC';
            $album = Album::model()->findAll($criteria);

			if(!empty($album)){
				$j=1;
				$new_count=count($album);

				foreach ($album as $value) { //$url=Yii::app()->request->baseUrl; ?>
					<li class="<?php if($j==$new_count){ echo "last";} ?>">
			<figure>
				<a href='<?php echo Yii::app()->request->baseUrl; ?>/gallery/view/<?php echo $value->attributes["id"]?>'>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/album/<?php echo $value->attributes['image_name']?>" alt="" width='214' height='124'>
				<figcaption><?php echo $value->attributes['album_name']; ?></figcaption></a>
			</figure>
		</li>
	<?php $j++;	} }?>
		
		
	</ul>
	<a class="read_more" href="<?php echo Yii::app()->request->baseUrl; ?>/album/show/">See More</a>
</section>
