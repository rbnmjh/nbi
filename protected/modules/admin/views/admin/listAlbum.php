<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Album > List Album:</h2>
         <?php if(Yii::app()->user->hasFlash('msg')):?>
             <div class="info">
             <?php echo Yii::app()->user->getFlash('msg'); ?>
            </div>
      <?php endif; ?>
         <div class="admin-setting">
            <table class="adminlist">
               <tbody>
                  <tr>
                     <th>#</th>
                     <th align="left"><strong>Title</strong></th>
                     <th align="left">image</th>
                     <th align="left">status</th>
                     <th align="left" width="90">Action</th>
                  </tr>
                  <?php 
                     $count = 1;
                     foreach($album as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count++; ?></td>
                     <td><?php echo $item->album_name; ?></td>
                     <td><a href="<?php echo Yii::app()->request->baseUrl.'/uploads/album/'.$item->image_name; ?>" data-lightbox="image-1">
                      <?php echo CHtml::image(Yii::app()->baseUrl .'/uploads/album/admin-thumbs/'.$item->image_name, 'album'); ?></td></a>
                     <td><?php if($item->status=='0')echo 'unpublished'; 
                               elseif($item->status=='1')echo 'published';
                         ?>
                      </td>   
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/editAlbum/'.$item->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeleteAlbum/'.$item->id; ?>">Delete</a>
                      
                     </td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td colspan="4"> <?php $this->widget('CLinkPager', array(
    'pages' => $pages,
)) ?></td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/addAlbum">
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