<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu');?>
   <div class="center_content">
      <div class="right_content">
         <h2>Gallery > Edit Gallery:</h2>
         <div class="admin-setting">
            <?php 
            if(isset($success_msg)){
               echo $success_msg;
            }
            else if(isset($fail_msg)){
               echo $fail_msg;
            }

            $form = $this->beginWidget('CActiveForm', array(
                'id'                     => 'gallary_form',
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
                                    <th colspan="2">Edit Gallery Images:</th>
                                 </tr>
 
                                  <tr>
                                    <td><label for="#">Album<span>*</span></label></td>
                                    <td>
                                       <?php 
                                       echo $form->dropDownList($gallery,'album_id', CHtml::listData(Album::model()->findAll(), 'id', 'album_name'), array('class'=>'required','empty'=>'select Type'));
                                        ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Title</td>
                                    <td>
                                       <?php
                                          echo $form->textField($gallery, 'title', array('class' => ' text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td> <label for="#">Description:</label></td>
                                    <td>
                                       <span class="text-wrapper">
                                          <?php
                                             echo $form->textArea($gallery, 'description', array('class'  => ' text_area'));
                                          ?>
                                       </span>
                                    </td>
                                 </tr>
                                    
                                 </tr>
                                 <tr>
                                    <td><label for="#">Image File<span>*</span></label></td>
                                    <td><?php echo CHtml::image(Yii::app()->baseUrl.'/uploads/gallery/' .$gallery->image_name,'gallery',array("height"=>100, "width"=>100));?>
                                       <?php
                                          echo $form->fileField($gallery, 'image_name', array('size' => '10', 'class' => 'required text_area'));
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
    $.validator.addMethod('filesize', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return this.optional(element) || (element.files[0].size <= param) 
});
    $.validator.addMethod('empty', function(value, element) {
        return (value === '');
    }, "This field must remain empty!");

  $("#gallary_form").validate({
    errorElement: "div",
    errorPlacement: function(error, element) {
        element.after(error);
    },
                  rules: {
                  
                  'Gallery[album_id]': "required",
                  'Gallery[image_name]':{
                     required: {
                    depends: function (element) {
                        return $("#Gallery_image_name").is(":filled");
                    }},
                      extension: "jpg|jpeg|png|bmp|gif",
                      filesize: 2097152
                      }
                  
                  },
                  messages: {
                    'Gallery[album_id]': "Please select the album name",
                    'Gallery[image_name]': { filesize:'Must be less than 2 mb',extension: 'Please select the image  with a valid extension(jpg,jpeg,png,bmp,gif)'},
                    
                  }

    });



}); 
</script> 