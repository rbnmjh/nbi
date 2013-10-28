<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Album > Edit Album:</h2>
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
                'id'                     => 'edit_album',
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
                                    <th colspan="2">Edit album</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Name<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($album, 'album_name', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>

                                  <tr>
                                    <td><label for="#">Image File<span class="required">*</span></label></td>
                                    <td>
                                      <?php echo CHtml::image(Yii::app()->baseUrl .'/uploads/album/'.$album->image_name, 'album',array("height"=>100, "width"=>100)); ?>
                                       <?php
                                          echo $form->fileField($album, 'image_name', array('size' => '10', 'class' => 'text_area'));
                                       ?>
                                        
                                       &nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Status<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->radioButtonList($album, 'status', array('0'=> 'unpublished', '1' => 'published'), array('separator'=>''));
                                       ?>
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
<script>
  $(function(){
    $.validator.addMethod('filesize', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return this.optional(element) || (element.files[0].size <= param) 
});
    $.validator.addMethod('empty', function(value, element) {
        return (value === '');
    }, "This field must remain empty!");

  $("#edit_album").validate({
    errorElement: "div",
    errorPlacement: function(error, element) {
        element.after(error);
    },
                  rules: {
                  
                  'Album[album_name]': "required",
                  'Album[image_name]':{
                    required: {
                    depends: function (element) {
                        return $("#Album_image_name").is(":filled");
                    }},
                      extension: "jpg|jpeg|png|bmp|gif",
                      filesize: 2097152
                      }
                  
                  },
                  messages: {
                    'Album[album_name]': "Please select the album name",
                    'Album[image_name]': {required: 'Required!', filesize:'Image must be less than 2 mb',extension: 'Please select the image  with a valid extension(jpg,jpeg,png,bmp,gif)'},
                    
                  }

    });



}); 
</script> 