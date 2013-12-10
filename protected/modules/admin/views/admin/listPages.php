<?php //Yii::import('system.web.helpers.CString'); ?>
<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">

         <h2>Pages > List pages:</h2>
            <?php if(Yii::app()->user->hasFlash('msg')):?>
               <div class="info">
                  <?php echo Yii::app()->user->getFlash('msg'); ?>
               </div>
            <?php endif; ?>

         <div class="admin-setting">
            <table class="adminlist">
               <tbody>
                  <tr>
                     <th class='CounterColumn'>#</th>
                     <th align="left"><strong>Title</strong></th>
                     <th align="left">Description</th>

                     <th align="left" width="100">Action</th>
                  </tr>
                  <?php 
                     $count = $row_count*$current_page+1;
                     
                     foreach($page as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count;

                      ?></td>
                     <td><?php echo $item->page; ?></td>
                     <td><?php echo CString::truncate($item->content, 60);
   ?></td>   

                     <td><a href="<?php echo Yii::app()->request->baseUrl.'/admin/EditPage/'.$item->id; ?>">Edit</a>
                        &nbsp; &nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeletePage/'.$item->id; ?>">Delete</a>
                      
                     </td>
                  </tr>
                  <?php $count++; } ?>
                  <tr>
                     <td colspan="3"><?php $this->widget('CLinkPager', array(
                        'pages' => $pages,
                        'maxButtonCount'=>'2'
                        ))?></td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/addPage">
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