<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Menu > Add Album:</h2>
         <div class="admin-setting">
            <?php 
            if(isset($success_msg)){
               echo $success_msg;
            }
            else if(isset($fail_msg)){
               echo $fail_msg;
            }

            $form = $this->beginWidget('CActiveForm', array(
                'id'                     => 'add_album',
                'enableClientValidation' => true,
                'enableAjaxValidation'   => false, //turn on ajax validation on the client side
                'clientOptions'          => array(
                    'validateOnSubmit' => false,
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
                                    <th colspan="2">Add album:</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Name<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($album, 'album_name', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Status<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->radioButtonList($album, 'status', array('0'=> 'unpublished', '1' => 'published'), array('separator'=>''));
                                       ?>
                                    </td>
                                 </tr>
                                 
                                 
                                 <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                       <?php echo CHtml::submitButton('submit', array('value' => 'Add')); ?>
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
