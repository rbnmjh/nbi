<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Publication > Add Publication:</h2>
         <div class="admin-setting">
            <?php 
            if(isset($success_msg)){
               echo $success_msg;
            }
            else if(isset($fail_msg)){
               echo $fail_msg;
            }

            $form = $this->beginWidget('CActiveForm', array(
                'id'                     => 'add_publication',
                'enableClientValidation' => false,
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
                                    <th colspan="2">Add Publication:</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Name<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($publication, 'name', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">File<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->fileField($publication, 'files', array('size' => '10', 'class' => 'required text_area'));
                                       ?>
                                       &nbsp;</td>
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
<script>
  $(function(){
    $.validator.addMethod('empty', function(value, element) {
        return (value === '');
    }, "This field must remain empty!");

  $("#add_publication").validate({
    errorElement: "div",
    errorPlacement: function(error, element) {
        element.after(error);
    },
                  rules: {        
                  'Publication[name]': "required",          
                  'Publication[files]': "required",                
                },
                messages:{
                  'Publication[name]': "Field required",
                  'Publication[files]': "Field required",
                }
    });
}); 
</script>