<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu');?>
   <div class="center_content">
      <div class="right_content">
         <h2>Slider > Add slider:</h2>
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
                'id'                     => 'slider_form',
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
                                    <th colspan="2">Add Slider Images:</th>
                                 </tr>
                                 <tr>
                                    <td>Name</td>
                                    <td>
                                       <?php
                                          echo $form->textField($slider, 'title', array('class' => 'text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Image name<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->fileField($slider, 'image_name', array('size' => '10', 'class' => 'required text_area'));
                                       ?>
                                       &nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>&nbsp;
                                    <td>
                                       <input type="submit" value="Submit">
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

  $("#slider_form").validate({
    errorElement: "div",
    errorPlacement: function(error, element) {
        element.after(error);
    },
                  rules: {                  
                  'Slider[image_name]': "required",                
                },
                messages:{
                  'Slider[image_name]': "Field required",
                }
    });
}); 
</script>