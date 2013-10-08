<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Wine > Add wine items:</h2>
         <div class="admin-setting">
            <?php 
            if(isset($success_msg)){
               echo $success_msg;
            }
            else if(isset($fail_msg)){
               echo $fail_msg;
            }
            
            $form = $this->beginWidget('CActiveForm', array(
                'id'                     => 'add_wine_item_form',
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
                                    <th colspan="2">Add Wine Item:</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Title:<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($wineItem, 'wine_title', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                 </tr>
                                 <tr>
                                    <td> <label for="#">Description:<span>*</span></label></td>
                                    <td>
                                       <span class="text-wrapper">
                                          <?php
                                             echo $form->textArea($wineItem, 'wine_description', array('class'  => 'required text_area', 'maxlength' => '100'));
                                          ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td> <label for="#">Wine:<span>*</span></label></td>
                                    <td>
                                       <span class="text-wrapper">
                                         <?php
                                             $data = Common::getWineList();
                                             echo $form->dropDownList($wineItem, 'wine_id', $data, array('class' => 'required', 'style' => 'width:150px;'));
                                          ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td> <label for="#">Per glass price:<span>*</span></label></td>
                                    <td>
                                       <span class="text-wrapper">
                                          <?php
                                             echo $form->textField($wineItem, 'glass_price', array('class'  => 'required text_area', 'maxlength' => '100'));
                                          ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td> <label for="#">Per bottle price:<span>*</span></label></td>
                                    <td>
                                       <span class="text-wrapper">
                                          <?php
                                             echo $form->textField($wineItem, 'bottle_price', array('class'  => 'required text_area', 'maxlength' => '100'));
                                          ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       &nbsp;
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
