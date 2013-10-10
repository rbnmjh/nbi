<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Media > List Media:</h2>
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
                     <th align="left">Description</th>
                     <th align="left">status</th>
                     <th align="left" width="100">Action</th>
                  </tr>
                  <?php 
                     $count = 1;
                     
                     foreach($media as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count++; ?></td>
                     <td><?php echo $item->name; ?></td>
                     <td><?php echo strip_tags($item->content); ?></td> 
                      <td><?php  if($item->status==1)echo 'published';
                                 elseif ($item->status==0)echo 'unpublished';
                                    
                          ?>
                     </td> 
                     <td><a href="<?php echo Yii::app()->request->baseUrl.'/admin/EditMedia/'.$item->id; ?>">Edit</a>
                        &nbsp; &nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeleteMedia/'.$item->id; ?>">Delete</a>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td colspan="4"> <strong>1</strong>&nbsp;|&nbsp;</td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/addMedia">
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