<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Publication > Edit Publication:</h2>
         <p class="note">Fields with <span class="required">*</span> are required.</p>
         <div class="admin-setting">
            <?php 
            if(isset($success_msg)){
               echo $success_msg;
            }
            else if(isset($fail_msg)){
               echo $fail_msg;
            }

            $form = $this->beginWidget('CActiveForm', array(
                'id'                     => 'edit_publication',
                'enableClientValidation' => true,
                'enableAjaxValidation'   => false, //turn on ajax validation on the client side
                'clientOptions'          => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions'      => array(
                    'onsubmit'   => 'return true;',
                    'enctype'    => 'multipart/form-data',
                    'onkeypress' => " if(event.keyCode == 13){} "
                ),
              ));

            ?>
            <table cellspacing="0" cellpadding="5" border="0" width="100%">
                  <tbody>
                     <tr>
                        <td valign="top">
                           <table class="adminform">
                              <tbody>
                                 <tr>
                                    <th colspan="2">Edit Publication:</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Name<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($publication, 'name', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">File<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                        $tmp = explode('.', $publication->files);
                                        $file_extension = strtolower(end($tmp));
                                        if($file_extension=='pdf')
                                            echo CHtml::link(CHtml::encode($publication->files), 
                                                             Yii::app()->baseUrl . '/publications/' . $publication->files,
                                                              array('target'=>'_blank')); 
                                        else
                                            echo CHtml::link(CHtml::encode($publication->files), 
                                                             Yii::app()->baseUrl . '/publications/' . $publication->files); 
                                            
                                          echo $form->fileField($publication, 'files', array('size' => '10', 'class' => 'required text_area'));
                                       ?>
                                       &nbsp;</td>
                                 </tr>
                                 
                                 
                                 <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                       <?php echo CHtml::submitButton('submit', array('value' => 'Update')); ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="right" colspan="2">&nbsp;</td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            <?php $this->endWidget(); ?>
         </div>  
      </div> 
   </div> 
   <div class="clear"></div>
</div>
