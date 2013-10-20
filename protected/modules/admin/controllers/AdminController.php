<?php

class AdminController extends Controller {

   public $layout = '//layouts/admin';

   public function checkLogin() {
      if (isset(Yii::app()->user->role) && Yii::app()->user->role = 'admin') {
         return true;
      }else{
         return false;
      }
   }

   public function actionIndex() {

      if ($this->checkLogin()) {
         $data['tab'] = 0;
         $this->render('index', $data);
      }else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionLogin() {
		$this->layout = '//layouts/admin_login';
      if ($this->checkLogin()) {
         $this->redirect(Yii::app()->request->baseUrl . '/admin');
      }else{
         $user = new User();
         $data['user'] = $user;
         if (isset($_POST['User'])) {
            $loginForm = new LoginForm();
            $loginForm->username = $_POST['User']['email'];
            $loginForm->password = $_POST['User']['password'];
            if ($loginForm->validate() && $loginForm->login()) {
               $this->redirect(Yii::app()->request->baseUrl . '/admin');
            }
            else {
               $data['error_msg'] = 'User name or password not match.';
            }
         }
         $data['tab'] = 0;
         $this->render('login', $data);
      }
   }

   public function actionLogout() {
      if ($this->checkLogin()) {
         Yii::app()->user->logout(false);
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionAddSlider() {
      if ($this->checkLogin()) {
         if (isset($_POST['Slider'])) {
            $slider = new Slider();
            $slider->attributes = $_POST['Slider'];
            $slider->is_active = 1;
            $date = new DateTime();
            $slider->upload_date = $date->format("Y-m-d");
            $uploaded_files = CUploadedFile::getInstance($slider, 'image_name');
            if ($slider->save()) {
               if(!empty($uploaded_files)){
               $tmp = explode('.', $uploaded_files);
               $file_extension = strtolower(end($tmp));
               $file_name = Common::generate_filename() . '.' . $file_extension;
               $uploaded_files->saveAs("uploads/slider/$file_name");
               $slider->image_name = $file_name;
               $slider->save();
               }
               Yii::app()->user->setFlash('message', "Data saved!");
               $this->redirect(Yii::app()->request->baseUrl.'/admin/listSlider');
            }else{
               $data['fail_msg'] = 'Fail to add slider.';
            }
         }
         $slider = new Slider();
         $data['slider'] = $slider;
         $this->render('uploadSlider', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }
   public function actionEditSlider($id){
      if ($this->checkLogin()) {
         $slider = Slider::model()->findByPk($id);
            if(!empty($slider)){
               if(isset($_POST['Slider'])){
                  $old_file=$slider->attributes['image_name'];
                  $slider->attributes = $_POST['Slider'];
                  $slider->image_name=$old_file;
                  $uploaded_files= CUploadedFile::getInstance($slider, 'image_name');
                  if ($slider->save()) {
                       if(!empty($uploaded_files)){ // check if uploaded file is set or not
                           $tmp = explode('.', $uploaded_files);
                           $file_extension = strtolower(end($tmp));
                           $file_name = Common::generate_filename() . '.' . $file_extension;
                           $uploaded_files->saveAs('uploads/slider/'.$file_name);
                           $slider->image_name = $file_name;
                           $slider->update();
                           if($old_file!='' && file_exists('uploads/slider/'. $old_file))
                              unlink('uploads/slider/'. $old_file);
                     }
                     Yii::app()->user->setFlash('message', "Data updated!");
                     $this->redirect(Yii::app()->request->baseUrl.'/admin/listSlider');
            
                  }else {
                     $data['fail_msg'] = 'Fail to edit Slider.';
                  }
                }
         $data['slider'] = $slider;
         $this->render('editSlider', $data);

         }
         else{
             Yii::app()->user->setFlash('message', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/listSlider');
         }        
        
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }

}

   public function actionAddGallery() {
      if ($this->checkLogin()) {
         if (isset($_POST['Gallery'])) {
            $gallary = new Gallery();
            $gallary->attributes = $_POST['Gallery'];
            $gallary->is_active = 1;
            $date = new DateTime();
            $gallary->upload_date = $date->format("Y-m-d");
            $uploaded_files = CUploadedFile::getInstance($gallary, 'image_name');
            if ($gallary->save()) {
               if(!empty($uploaded_files)){
               $tmp = explode('.', $uploaded_files);
               $file_extension = strtolower(end($tmp));
               $file_name = Common::generate_filename() . '.' . $file_extension;
               $uploaded_files->saveAs("uploads/gallery/$file_name");
               $gallary->image_name = $file_name;
               $gallary->update();
               }
                Yii::app()->user->setFlash('message', "Data saved!");
               $this->redirect(Yii::app()->request->baseUrl.'/admin/listGallery');
               
            }else {
               $data['fail_msg'] = 'Fail to add gallery.';
            }
         }

         $gallery = new Gallery();
         $data['gallery'] = $gallery;
         $this->render('uploadGallery', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

  public function actionEditGallery($id){

   if ($this->checkLogin()) {
         $gallery = Gallery::model()->findByPk($id);
         
         if(!empty($gallery)){
             if(isset($_POST['Gallery'])){
                  $old_file=$gallery->attributes['image_name'];
                  $gallery->attributes = $_POST['Gallery'];
                  $gallery->image_name=$old_file;
                  $uploaded_files= CUploadedFile::getInstance($gallery, 'image_name');
                  if ($gallery->save()) {
                       if(!empty($uploaded_files)){ // check if uploaded file is set or not
                           $tmp = explode('.', $uploaded_files);
                           $file_extension = strtolower(end($tmp));
                           $file_name = Common::generate_filename() . '.' . $file_extension;
                           $uploaded_files->saveAs('uploads/gallery/'.$file_name);
                           $gallery->image_name = $file_name;
                           $gallery->update();
                           if($old_file!='' && file_exists('uploads/gallery/'. $old_file))
                              unlink('uploads/gallery/'. $old_file);
                     }
                     Yii::app()->user->setFlash('message', "Data updated!");
                     $this->redirect(Yii::app()->request->baseUrl.'/admin/listGallery');
            
                  }else {
                     $data['fail_msg'] = 'Fail to edit Gallery.';
                  }
                }
         $data['gallery'] = $gallery;
         $this->render('editGallery', $data);

         }
         else{
             Yii::app()->user->setFlash('message', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/listGallery');
         }        
        
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }

}


   public function actionListSlider() {
      if ($this->checkLogin()){
         $sliders = Slider::model()->findAllByAttributes(array('is_active' => 1));
         $data['sliders'] = $sliders;
         $this->render('listSlider', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionListGallery() {
      if ($this->checkLogin()) {
         $gallery = Gallery::model()->with('album')->findAllByAttributes(array('is_active' => 1));
         $data['gallery'] = $gallery;
         $this->render('listGallery', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionDeleteSlider($id) {
      if ($this->checkLogin()) {
         $slider = Slider::model()->findByPk($id);
         if (isset($slider)) {
            

            $slider->delete();
             if ($slider->attributes['image_name']!='' && file_exists('uploads/slider/' . $slider->attributes['image_name'])) {
                            unlink('uploads/slider/' . $slider->attributes['image_name']);
         }

         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListSlider');
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         }
      }
   }

   public function actionDeleteGallery($id) {
      if ($this->checkLogin()) {
         $gallery = Gallery::model()->findByPk($id);
         if (isset($gallery)) {
                 if($gallery->delete()){
                     if ($gallery->attributes['image_name']!='' && file_exists('uploads/gallery/' . $gallery->attributes['image_name'])) {
                            unlink('uploads/gallery/' . $gallery->attributes['image_name']);
                         }
                 }
         }

         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListGallery');
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }
   public function actionEditAboutUs() {
      if ($this->checkLogin()) {
         $page = Page::model()->findByAttributes(array('page' => 'aboutus'));
         if (isset($_POST['Page'])) {
            $page->attributes = $_POST['Page'];
            $page->update();
         }
         $data['AboutUs'] = $page;
         $this->render('editAboutPage', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }
   
   public function actionChangePassword(){
      if ($this->checkLogin()) {
         $data = array();
         $user_id = Yii::app()->user->user_id;
         $user = User::model()->findByPk($user_id);
         if(isset($_POST['user'])){
            $old_password = $_POST['user']['old_password'];
            $password = $_POST['user']['new_password'];
            if($user->password == md5($old_password)){
               $user->password = md5($password);
               $user->update();
               $data['success_msg'] = 'password change successfully.';
            }
            else{
               $data['fail_msg'] = 'Old password not match.';
            }
         }

         $this->render('changePassword', $data);
      }
      else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }
   
   public function actionEditUserInfo(){
       if ($this->checkLogin()) {
          $user_id = Yii::app()->user->user_id;
          $user = User::model()->findByPk($user_id);
          if(isset($_POST['User'])){
             $user->attributes = $_POST['User'];
             $user->update();

          }
          $data['user'] = $user;
          $this->render('editUserInfo', $data);
       }
      else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }
   
   public function actionEditContactInfo(){
      if ($this->checkLogin()) {
         $contact_info = ContactInfo::model()->find('id=1');
         if(isset($_POST['ContactInfo'])){
            $contact_info->attributes = $_POST['ContactInfo'];
            $contact_info->update();
         }
         $data['contactInfo'] = $contact_info;
         $this->render('editContactInfo', $data);
      }
      else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   } 
   
   //By RABIN
public function actionAddPage(){
    if ($this->checkLogin()) {
		$page = new Page();
	   $data['page'] = $page;
	   if(isset($_POST['Page'])){
		    $page->attributes = $_POST['Page'];
		       if($page->save()){
               Yii::app()->user->setFlash('message', "Data saved!");
			      $this->redirect(Yii::app()->request->baseUrl.'/admin/listPages');
			   }else{
			 $data['fail_msg'] = 'Fail to add Page.';
		       }
      }
   
   
	$this->render('addPage',$data);
   }
   else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
}

public function actionListPages(){
   if ($this->checkLogin()) {
	$page = Page::model()->findAll();
	$data['pages']=$page;
	$this->render('listPages',$data);
}
 else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
}
public function actionEditPage($id){

   if ($this->checkLogin()) {
         $page = Page::model()->findByPk($id);
         if(!empty($page)){
            if(isset($_POST['Page'])){
               $page->attributes = $_POST['Page'];
               $page->update();
               $this->redirect(Yii::app()->request->baseUrl . '/admin/ListPages');
            }
         $data['page'] = $page;
         $this->render('editPage', $data);

         }
         else{
             Yii::app()->user->setFlash('message', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/ListPages');
         }        
        
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }

}

public function actionDeletePage($id) {
      if ($this->checkLogin()) {
         $page = Page::model()->findByPk($id);
         if (isset($page)) {
            $page->delete();
         }
         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListPages');
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionEditMedia($id){
     if ($this->checkLogin()) {
         $media = Media::model()->findByPk($id);
            if(isset($_POST['Media'])){
               $media->attributes = $_POST['Media'];
                if ($media->update()){
                  Yii::app()->user->setFlash('msg','Media updated successfully.');
                  $this->redirect(Yii::app()->request->baseUrl . '/admin/ListMedia');
               }
               else {
                  Yii::app()->user->setFlash('msg','Fail to update media.');
               }  
               
            }
            
            $data['media'] = $media;
            $this->render('editMedia', $data);
      }
         else{
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         } 
   }
   public function actionListMedia(){
      $media = Media::model()->findAll();
      $data['media']=$media;
      $this->render('listMedia',$data);
   }

   public function actionDeleteMedia($id) {
      if ($this->checkLogin()) {
         $media = Media::model()->findByPk($id);
            if (isset($media)) {
              $media->delete();
               Yii::app()->user->setFlash('msg','Media Deleted successfully.');
            }
            $this->redirect(Yii::app()->request->baseUrl . '/admin/ListMedia');
         }else {
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         }
   }

   public function actionAddNews() {
      if ($this->checkLogin()) {
         if (isset($_POST['News'])) {
            $news = new News();
            $news->attributes = $_POST['News'];

               if ($news->save()) {
                  Yii::app()->user->setFlash('msg','News added successfully.');
                  $this->redirect(Yii::app()->request->baseUrl . '/admin/ListNews');
               }
               else {

                  $data['fail_msg'] = 'Fail to add News.';
                 
               }
         }
            $news = new News();
            $data['news'] = $news;
            $this->render('addNews', $data);
      }
         else {
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         }
   }

   public function actionEditNews($id){
     if ($this->checkLogin()) {
         $news = News::model()->findByPk($id);
            if(isset($_POST['News'])){
               $news->attributes = $_POST['News'];
                if ($news->update()){
                  Yii::app()->user->setFlash('msg','News updated successfully.');
                  $this->redirect(Yii::app()->request->baseUrl . '/admin/ListNews');
               }
               else {
                  Yii::app()->user->setFlash('msg','Fail to update news.');
               }  
            }
            $data['news'] = $news;
            $this->render('editNews', $data);
      }
         else{
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         } 
   }
   public function actionListNews(){
      $news = News::model()->findAll();
      $data['news']=$news;
      $this->render('listNews',$data);
   }

   public function actionDeleteNews($id) {
      if ($this->checkLogin()) {
         $news = News::model()->findByPk($id);
            if (isset($news)) {
              $news->delete();
               Yii::app()->user->setFlash('msg','News Deleted successfully.');
            }
            $this->redirect(Yii::app()->request->baseUrl . '/admin/ListNews');
         }else {
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         }
   }
   public function actionAddBlogs() {
      if ($this->checkLogin()) {
         if (isset($_POST['Blog'])) {
            $blogs = new Blog();
            $blogs->attributes = $_POST['Blog'];

               if ($blogs->save()) {
                  Yii::app()->user->setFlash('msg','Blog added successfully.');
                  $this->redirect(Yii::app()->request->baseUrl . '/admin/ListBlogs');
               }
               else {
                  Yii::app()->user->setFlash('msg','Fail to add blog.');
                  $this->redirect(Yii::app()->request->baseUrl . '/admin/addBlogs');
               }
         }
            $blogs = new Blog();
            $data['blogs'] = $blogs;
            $this->render('addBlogs', $data);
      }
         else {
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         }
   }

   public function actionEditBlogs($id){
     if ($this->checkLogin()) {
         $blogs = Blog::model()->findByPk($id);
            if(isset($_POST['Blog'])){
               $blogs->attributes = $_POST['Blog'];
                if ($blogs->save()){
                  Yii::app()->user->setFlash('msg','Blog updated successfully.');
                  $this->redirect(Yii::app()->request->baseUrl . '/admin/ListBlogs');
               }
               else {
                  Yii::app()->user->setFlash('msg','Fail to update blog.');
               }  
            }
            $data['blogs'] = $blogs;
            $this->render('editBlogs', $data);
      }
         else{
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         } 
   }
   public function actionListBlogs(){
      $blogs = Blog::model()->findAll();
      $data['blogs']=$blogs;
      $this->render('listBlogs',$data);
   }

   public function actionDeleteBlogs($id) {
      if ($this->checkLogin()) {
         $blogs = Blog::model()->findByPk($id);
            if (isset($blogs)) {
              $blogs->delete();
               Yii::app()->user->setFlash('msg','Blog Deleted successfully.');
            }
            $this->redirect(Yii::app()->request->baseUrl . '/admin/ListBlogs');
         }else {
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         }
   }


public function actionAddAlbum(){
    if ($this->checkLogin()) {
      $album = new Album();
      $data['album'] = $album;
      if(isset($_POST['Album'])){
          $album->attributes = $_POST['Album'];
             if($album->save()){
               Yii::app()->user->setFlash('message', "Data saved!");
               $this->redirect(Yii::app()->request->baseUrl.'/admin/listAlbum');
            }else{
          $data['fail_msg'] = 'Fail to add an album.';

             }
      }
   
   
   $this->render('addAlbum',$data);
   }
   else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
}

public function actionListAlbum(){
   if ($this->checkLogin()) {
   $album = Album::model()->findAll();
   $data['album']=$album;
   $this->render('listAlbum',$data);
}
 else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
}
public function actionEditAlbum($id){

   if ($this->checkLogin()) {
         $album = Album::model()->findByPk($id);
         if(!empty($album)){
            if(isset($_POST['Album'])){
               $album->attributes = $_POST['Album'];
               if($album->save())
               $this->redirect(Yii::app()->request->baseUrl . '/admin/listAlbum');
            else
            $data['fail_msg'] = 'Fail to edit an album.';

            }
         $data['album'] = $album;
         $this->render('editAlbum', $data);

         }
         else{
             Yii::app()->user->setFlash('message', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/listAlbum');
         }        
        
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }

}

public function actionDeleteAlbum($id) {
      if ($this->checkLogin()) {
         $album = Album::model()->findByPk($id);
         if (isset($album)) {
            $album->delete();
         }
         $this->redirect(Yii::app()->request->baseUrl . '/admin/listAlbum');
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }


public function actionAddPub(){
    if ($this->checkLogin()) {
      $publication = new Publication();
      $data['publication'] = $publication;
      if(isset($_POST['Publication'])){
            $publication = new Publication();
            $publication->attributes = $_POST['Publication'];
            $publication->files = CUploadedFile::getInstance($publication, 'files');
            if ($publication->save()) {
               $tmp = explode('.', $publication->files);
               $file_extension = strtolower(end($tmp));
               $file_name = Common::generate_filename() . '.' . $file_extension;
               $publication->files->saveAs('publications/'.$file_name);
               $publication->files = $file_name;
               $publication->update();
               Yii::app()->user->setFlash('message', "Data saved!");
               $this->redirect(Yii::app()->request->baseUrl.'/admin/listPub');
      
            }else {
               $data['fail_msg'] = 'Fail to add publication.';
            }
      }
   
   
   $this->render('addPub',$data);
   }
   else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
}

public function actionListPub(){
   if ($this->checkLogin()) {
   $publication = Publication::model()->findAll();
   $data['publication']=$publication;
   $this->render('listPub',$data);
}
 else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
}
public function actionEditPub($id){

   if ($this->checkLogin()) {
         $publication = Publication::model()->findByPk($id);
         
         if(!empty($publication)){
             if(isset($_POST['Publication'])){
                  $old_file=$publication->attributes['files'];
                  $publication->attributes = $_POST['Publication'];
                  $uploaded_files= CUploadedFile::getInstance($publication, 'files');
                  if ($publication->save()) {
                       if(!empty($uploaded_files)){ // check if uploaded file is set or not
                           $tmp = explode('.', $uploaded_files);
                           $file_extension = strtolower(end($tmp));
                           $file_name = Common::generate_filename() . '.' . $file_extension;
                           $uploaded_files->saveAs('publications/'.$file_name);
                           $publication->files = $file_name;
                           $publication->update();
                           if($old_file!='' && file_exists('publications/'. $old_file))
                              unlink('publications/'. $old_file);
                     }
                     Yii::app()->user->setFlash('message', "Data updated!");
                     $this->redirect(Yii::app()->request->baseUrl.'/admin/listPub');
            
                  }else {
                     $data['fail_msg'] = 'Fail to edit publication.';
                  }
                }
         $data['publication'] = $publication;
         $this->render('editPub', $data);

         }
         else{
             Yii::app()->user->setFlash('message', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/listPub');
         }        
        
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }

}

public function actionDeletePub($id) {
      if ($this->checkLogin()) {
         $publication = Publication::model()->findByPk($id);
         if (isset($publication)) {
            if($publication->delete()){
            $old_file=$publication->attributes['files'];
            if($old_file!='' && file_exists('publications/'. $old_file))
            unlink('publications/'. $old_file);

            }
         }
         $this->redirect(Yii::app()->request->baseUrl . '/admin/listPub');
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

public function actionAddPartner() {
      if ($this->checkLogin()) {
         $partner = new Partner();
         if (isset($_POST['Partner'])){
           $partner->attributes = $_POST['Partner'];
           $partner->image = CUploadedFile::getInstance($partner, 'image');
            if ($partner->save()) {
               $tmp = explode('.', $partner->image);
               $file_extension = strtolower(end($tmp));
               $file_name = Common::generate_filename() . '.' . $file_extension;
               $partner->image->saveAs("uploads/partner/$file_name");
               $partner->image = $file_name;
               $partner->update();
               Yii::app()->user->setFlash('msg','Image added successfully.');
               $this->redirect(Yii::app()->request->baseUrl . '/admin/ListPartner');
            }else {
               Yii::app()->user->setFlash('msg','Fail to add image.');
               $this->redirect(Yii::app()->request->baseUrl . '/admin/addPartner');
            }
         }

         
         $data['partner'] = $partner;
         $this->render('addPartner', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionListPartner(){
      if ($this->checkLogin()) {
         $partner = Partner::model()->findAll();
         $data['partner']=$partner;
         $this->render('listPartner',$data);
      }
      else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }
   public function actionDeletePartner($id) {
      if ($this->checkLogin()) {
         $partner = Partner::model()->findByPk($id);
         if (isset($partner)) {
            if (file_exists('uploads/partner/' . $partner->image)) unlink('uploads/partner/' . $partner->image);
               $partner->delete();
               Yii::app()->user->setFlash('msg','Image deleted successfully');
         }
            $this->redirect(Yii::app()->request->baseUrl . '/admin/ListPartner');
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionEditPartner($id){
      if ($this->checkLogin()) {
         $partner = Partner::model()->findByPk($id);
            if(isset($_POST['Partner'])){
               $old_image=$partner->attributes['image'];
               $partner->attributes = $_POST['Partner'];
               if ($partner->save()){

                  $uploaded_image=CUploadedFile::getInstance($partner, 'image');
                  $tmp = explode('.',  $uploaded_image);
                  $file_extension = strtolower(end($tmp));
                  $file_name = Common::generate_filename() . '.' . $file_extension;
                  $uploaded_image->saveAs("uploads/partner/$file_name");
                  $partner->image = $file_name;
                  $partner->update();
                  if ($old_image!='' && file_exists('uploads/partner/' . $old_image)) 
                     unlink('uploads/partner/' . $old_image);
                  Yii::app()->user->setFlash('msg','Partner updated successfully');
                  $this->redirect(Yii::app()->request->baseUrl . '/admin/listPartner');
               }
               else{
                  Yii::app()->user->setFlash('msg','Fail to update partner.');
               }
            }
            $data['partner'] = $partner;
            $this->render('editPartner', $data);
      }
         else{
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }
}
   



















/*public function actionDeletePage(){
$pageId = $_GET['page_id'];
$page = Page::model()->findByPk($pageId);
	if($page->delete()){
		$this->redirect(Yii::app()->request->baseUrl.'/admin/listPages');
		
		}
	}
	*/
/*
public function actionAddSlider(){
	$slider = new Slider();
	$data['slider'] = $slider;
	if (isset($_POST['Slider'])){
	  $slider->attributes = $_POST['Slider'];
	  if ($slider->save()){
		  $this->redirect(Yii::app()->request->baseUrl.'/admin/viewSlider');
		  }else{
			  $this->redirect(Yii::app()->request->baseUrl.'/admin/addSlider');
			  }
		}$this->render('addSlider',$data);
	}

public function actionViewSlider(){
	$slider = Slider::model()->findAll();
	$data['sliders']=$slider;
	$this->render('viewSlider',$data);
}
*/
