<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Menu > Edit menu:</h2>
         <div class="admin-setting">
            <?php 
            if(isset($success_msg)){
               echo $success_msg;
            }
            else if(isset($fail_msg)){
               echo $fail_msg;
            }

            $form = $this->beginWidget('CActiveForm', array(
                'id'                     => 'edti_contact_form',
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
                                    <th colspan="2">Edit contact information:</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Company Name:<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($contactInfo, 'company_name', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Address:<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($contactInfo, 'address', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Phone Number:<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($contactInfo, 'phone', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Email:<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($contactInfo, 'email', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                  <tr>
                                    <td><label for="#">Web site:<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($contactInfo, 'website', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td> <label for="#">Description:<span>*</span></label></td>
                                    <td>
                                       <span class="text-wrapper">
                                          <?php
                                             echo $form->textArea($contactInfo, 'description', array('class'  => 'required text_area'));
                                          ?>
                                       </span>
                                    </td>
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
