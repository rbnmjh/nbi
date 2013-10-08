<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Gallery > List Gallery:</h2>
         <div class="admin-setting">
            <table class="adminlist">
               <tbody>
                  <tr>
                     <th>#</th>
                     <th align="left"><strong>Title</strong></th>
                     <th align="left">Description</th>
                     <th align="left" width="50">Action</th>
                  </tr>
                  <?php 
                     $count = 1;
                     foreach($gallery as $img){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count++; ?></td>
                     <td><?php echo $img->title; ?></td>
                     <td><a href="<?php echo Yii::app()->request->baseUrl.'/uploads/'.$img->image_name; ?>" target="_blank" style="color:#333333;"> <?php echo $img->image_name; ?></a></td>   
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeleteGallery/'.$img->id; ?>">Delete</a>
                     </td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td colspan="3"> <strong>1</strong>&nbsp;|&nbsp;</td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/AddGallery">
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