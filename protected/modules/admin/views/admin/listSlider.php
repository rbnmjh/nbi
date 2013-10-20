<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Slider > List sliders:</h2>
         <?php if(Yii::app()->user->hasFlash('message')):?>
             <div class="info">
             <?php echo Yii::app()->user->getFlash('message'); ?>
            </div>
      <?php endif; ?>

         <div class="admin-setting">
            <table class="adminlist">
               <tbody>
                  <tr>
                     <th>#</th>
                     <th align="left"><strong>Title</strong></th>
                     <th align="left">Image Name</th>
                     <th align="left" width="90">Action</th>
                  </tr>
                  <?php 
                     $count = 1;
                     foreach($sliders as $slider){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count++; ?></td>
                     <td><?php echo $slider->title; ?></td>
                     <td><a href="<?php echo Yii::app()->request->baseUrl.'/uploads/slider'.$slider->image_name; ?>" target="_blank" style="color:#333333;"><?php echo $slider->image_name; ?></a></td>   
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/EditSlider/'.$slider->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeleteSlider/'.$slider->id; ?>">Delete</a>
                     </td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td colspan="3"> <strong>1</strong>&nbsp;|&nbsp;</td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/AddSlider">
                           <strong>Add New</strong>
                        </a>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>  
      </div> 
   </div> 
   <div class="clear"></div>
</div>