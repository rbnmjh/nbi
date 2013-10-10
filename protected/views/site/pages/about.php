<?php
/* @var $this SiteController */

/*$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>

<?php print_r($page) ;?>
<h1>About</h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __FILE__; ?></code>.</p>
*/
$this->pageTitle = Yii::app()->name;?><?php //print_r($page) ; die();?>
<div class="slider">
	<?php //$this->renderPartial('//blocks/slider'); ?>
</div><!-- end slider -->
<div class="main_content">
	<div class="page_wrap container_10">
		<div class="right_content grid_3">
					
			<?php $this->renderPartial('//blocks/right_bar'); ?>
		</div><!-- end right_content -->
		<div class="left_content grid_7">
			<h1><?php echo $page['page_title']; ?></h1>
			<div> <?php echo $page['content'];?></div>
		</div><!-- end left content -->
	</div>
</div><!-- end main_content -->


