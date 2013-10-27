<?php
$script = Yii::app()->clientScript;
$script->registerScriptFile(Yii::app()->request->baseUrl . '/media/script/jquery-1.10.2.min.js');
$script->registerScriptFile(Yii::app()->request->baseUrl . '/media/script/lightbox-2.6.min.js');
$script->registerScriptFile(Yii::app()->request->baseUrl . '/media/script/html5.js');
$script->registerCssFile(Yii::app()->request->baseUrl . '/media/stylesheet/slider.css');
$script->registerScriptFile(Yii::app()->request->baseUrl . '/media/script/jquery.js');
$script->registerScriptFile(Yii::app()->request->baseUrl . '/media/javascripts/jquery.easing.js');
$script->registerScriptFile(Yii::app()->request->baseUrl . '/media/javascripts/slider.js');

?>
<script type="text/javascript">
   jQuery(document).ready(function() 
   {
      var buttons = { previous:$('#jslidernews1 .button-previous') ,
         next:$('#jslidernews1 .button-next') };			
      $('#jslidernews1').lofJSidernews( { 
         interval : 4000,
         direction		: 'opacitys',	
         easing			: 'easeInOutExpo',
         duration		: 1200,
         auto		 	: true,
         maxItemDisplay  : 4,
         navPosition     : 'horizontal', // horizontal
         navigatorHeight : 32,
         navigatorWidth  : 80,
         mainWidth		: 1024,
         buttons		: buttons 
      } 
   );	
   });
</script>
<?php
$sliders = Slider::model()->findAll("is_active='1'");

?>

<div id="banner">
   <div id="jslidernews1" class="lof-slidecontent" style="width:1024px; height:400px;">
      <div class="preload"><div></div></div>
      <div class="main-slider-content" style="width:1024px; height:400px;">
         <ul class="sliders-wrap-inner">
            <?php foreach ($sliders as $slider) { ?>
               <li>
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/slider/<?php echo $slider->image_name; ?>" title="<?php echo $slider->title; ?>" >           
               </li> 
               <?php
            }

            ?>
         </ul>  	
      </div>
      <!-- END MAIN CONTENT --> 
      <!-- NAVIGATOR -->
      <div class="navigator-content">
         <div class="button-next"></div>
         <div class="navigator-wrapper">
            <ul class="navigator-wrap-inner">
               <?php foreach ($sliders as $slider) { ?>
                  <li>
                     <img src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/slider/thumbs/<?php echo $slider->image_name; ?>" >           
                  </li> 
                  <?php
               }

               ?>
            </ul>
         </div>
         <div  class="button-previous"></div>
      </div> 
      <div class="button-control"><span></span></div>   
   </div>   
</div>