<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu');?>
   <div class="center_content">
      <div class="right_content">
         <h2>Partner > Edit Partner:</h2>
         <div class="admin-setting">
            <?php 
            if(isset($success_msg)){
               echo $success_msg;
            }
            else if(isset($fail_msg)){
               echo $fail_msg;
            }

            $form = $this->beginWidget('CActiveForm', array(
                'id'                     => 'partner_form',
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
                                    <th colspan="2">Edit Partner Images:</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Name<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($partner, 'name', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 
                                    
                                 </tr>
                                 <tr>
                                    <td>&nbsp;Image File:&nbsp;</td>
                                    <td>
                                      <?php echo CHtml::image(Yii::app()->baseUrl.'/uploads/partner/' .$partner->image,'partner',array("height"=>100, "width"=>100));?>
                                       <?php
                                          echo $form->fileField($partner, 'image', array('size' => '10', 'class' => 'required text_area'));
                                       ?>
                                       &nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>&nbsp;
                                    <td>
                                       <input type="submit" value="Update">
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

  $("#partner_form").validate({
    errorElement: "div",
    errorPlacement: function(error, element) {
        element.after(error);
    },
                  rules: {
                  
                  'Partner[name]': "required",
                  }
    });
}); 
</script> 