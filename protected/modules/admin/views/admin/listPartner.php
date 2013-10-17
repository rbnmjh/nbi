<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Partner > List Partner:</h2>
            <?php if(Yii::app()->user->hasFlash('msg')):?>
               <div class="info">
                  <?php echo Yii::app()->user->getFlash('msg'); ?>
            </div>
      <?php endif; ?>
         <div class="admin-setting">
            <table class="adminlist">
               <tbody>
                  <tr>
                     <th width="35">#</th>
                     <th align="left"><strong>Title</strong></th>
                     <th align="left"><strong>Description</strong></th>            
                     <th align="left" width="100">Action</th>
                  </tr>
                  <?php 
                     $count = 1;
                     foreach($partner as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count++; ?></td>
                     <td><?php echo $item->name; ?></td>
                     <td><?php echo $item->image; ?></td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/editPartner/'.$item->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeletePartner/'.$item->id; ?>">Delete</a>
                      
                     </td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td colspan="3"> <strong>1</strong>&nbsp;|&nbsp;</td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/addPartner">
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