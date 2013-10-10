<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Menu > List Publication:</h2>
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
                     <th align="left" width="90">Action</th>
                  </tr>
                  <?php 
                     $count = 1;
                     foreach($publication as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count++; ?></td>
                     <td><?php echo $item->name; ?></td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/editPub/'.$item->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeletePub/'.$item->id; ?>">Delete</a>
                      
                     </td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td colspan="2"> <strong>1</strong>&nbsp;|&nbsp;</td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/addPub">
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