<div class="block_style_one">
	<h2>News / Events</h2>
	<ul>
	<?php	
			$criteria = new CDbCriteria();
            $criteria->alias = 'n';
            $criteria->condition = 'status = "1"';
            $criteria->limit=3;
            $criteria->order = 'n.id DESC';
			$news1 = News::model()->findAll($criteria);
			if(!empty($news1)){
				$i=1;
				$new_count=count($news1);
				foreach ($news1 as $value) {
					$id=$value->attributes["id"];
					$url=YII::app()->createUrl('news/view/'.$id); 
			?>
		<a href="<?php echo $url; ?>">
			<li class=<?php if($i==1)
								echo "first";								
							elseif ($i==$new_count)
								echo "last";
			 ?> >
			<?php echo $value->attributes['title']; ?>
			</li>
		</a>
		<?php $i++;} }?>
		
	</ul>
</div><!-- end block_style_one -->
<div class="block_style_one">
	<h2>Upcomings</h2>
	<ul>
		<li class="first">Get together of (Social) Entrepreneurs & supporters on 12th July 2012</li>
		<li>Get together of (Social) Entrepreneurs & supporters on 12th July 2012</li>
		<li class="last">Get together of (Social) Entrepreneurs & supporters on 12th July 2012</li>
	</ul>
</div><!-- end block_style_one -->
<div class="block_style_one">
	<h2>Blogs</h2>
	<ul>
			<?php 
			$criteria_blog = new CDbCriteria();
            $criteria_blog->alias = 'b';
            $criteria_blog->condition = 'b.status = "1"';
            $criteria_blog->limit=3;
            $criteria_blog->order = 'b.id DESC';
			$blog = Blog::model()->findAll($criteria_blog);
			if(!empty($blog)){
				$j=1;
				$new_count_blog=count($blog);
				foreach ($blog as $blog_value) {
			$id=$blog_value->attributes["id"];
			$blog_url=YII::app()->createUrl('page/blogs/'.$id); 
			?>
		<a href="<?php echo $blog_url; ?>"><li 
			class=<?php if($j==1)
								echo "first";								
							elseif ($j==$new_count_blog)
								echo "last";
			 ?> 
		
			><?php echo $blog_value->attributes['title']; ?></li></a>
				<?php $j++;}} ?>
		
	</ul>
</div><!-- end block_style_one -->