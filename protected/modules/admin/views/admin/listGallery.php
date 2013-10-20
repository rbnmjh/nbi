<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Gallery > List Gallery:</h2>
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
                     <th align="left">Album Name</th>
                     <th align="left"><strong>Title</strong></th>
                     <th align="left">Description</th>
                     <th align="left">Image</th>
                     <th align="left" width="90">Action</th>
                  </tr>
                  <?php 
                     $count = 1;
                     
                     foreach($gallery as $img){

                  ?>
                  <tr>
                     <td align="center"><?php echo $count++; ?></td>
                     <td><?php echo $img->album->album_name?></td>
                     <td><?php echo $img->title; ?></td>
                     <td><?php echo $img->description; ?></td> 
                     <td><?php echo CHtml::image(Yii::app()->baseUrl .'/uploads/gallery/'.$img->image_name, 'gallery',array("height"=>80, "width"=>80)); ?></td>  
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/editGallery/'.$img->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeleteGallery/'.$img->id; ?>">Delete</a>
                     </td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td colspan="5"> <?php $this->widget('CLinkPager', array(
    'pages' => $pages,
)) ?></td>
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