<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Publication > List Publication:</h2>
         <?php if(Yii::app()->user->hasFlash('msg')):?>
             <div class="info">
             <?php echo Yii::app()->user->getFlash('msg'); ?>
            </div>
      <?php endif; ?>
         <div class="admin-setting">
            <table class="adminlist">
               <tbody>
                  <tr>
                     <th width="20">#</th>
                     <th align="left" width="50"><strong>Title</strong></th>
                     <th align="left"><strong>Description</strong></th>
                     <th align="left" width="200"><strong>Files</strong></th>            
                     <th align="left" width="90">Action</th>
                  </tr>
                  <?php 
                     $count = 1;
                     foreach($publication as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count++; ?></td>
                     <td><?php echo $item->name; ?></td>
                     <td><?php echo $item->content; ?></td>
                     <td><?php $tmp = explode('.', $item->files);
                               $file_extension = strtolower(end($tmp));
                               if($file_extension=='pdf')
                                 echo CHtml::link(CHtml::encode($item->files), 
                                       Yii::app()->baseUrl . '/uploads/publication/' . $item->files,
                                       array('target'=>'_blank')); 
                              else
                                 echo CHtml::link(CHtml::encode($item->files), 
                                       Yii::app()->baseUrl . '/uploads/publication/' . $item->files); 

                                       ?>
                     </td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/editPub/'.$item->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeletePub/'.$item->id; ?>">Delete</a>
                      
                     </td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td colspan="4"><?php $this->widget('CLinkPager', array(
    'pages' => $pages,
)) ?></td>
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