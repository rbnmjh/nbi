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
               require 'media/image_lib/WideImage.php';
               $image = WideImage::load("uploads/slider/$file_name");
               $resized_pic = $image->resize(1024, 400, 'outside')->crop('center', 'center', 1024, 400);
               $resized_pic->saveToFile("uploads/slider/$file_name");
               $thumbs_pic = $image->resize(70, 25, 'outside')->crop('center', 'center', 70, 25);
               $thumbs_pic->saveToFile("uploads/slider/thumbs/$file_name");
               $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
               $admin_thumbs_pic->saveToFile("uploads/slider/admin-thumbs/$file_name");
               
               $slider->image_name = $file_name;
               $slider->save();
               }
               Yii::app()->user->setFlash('msg', "Slider image added successfully.");
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
                           require 'media/image_lib/WideImage.php';
                           $image = WideImage::load("uploads/slider/$file_name");
                           $thumbs_pic = $image->resize(70, 25, 'outside')->crop('center', 'center', 70, 25);
                           $thumbs_pic->saveToFile("uploads/slider/thumbs/$file_name");
                           $thumbs_pic_admin = $image->resize(120,60, 'outside')->crop('center', 'center', 120, 60);
                           $thumbs_pic_admin->saveToFile("uploads/slider/admin-thumbs/$file_name");
                           $slider->image_name = $file_name;
                           $slider->update();
                           if($old_file!='' && file_exists('uploads/slider/'. $old_file))
                              unlink('uploads/slider/'. $old_file);
                           if($old_file!='' && file_exists('uploads/slider/thumbs/'. $old_file))
                              unlink('uploads/slider/thumbs/'. $old_file);
                           if($old_file!='' && file_exists('uploads/slider/admin-thumbs/'. $old_file))
                              unlink('uploads/slider/admin-thumbs/'. $old_file);
                     }
                     Yii::app()->user->setFlash('msg', "Slider image updated successfully.");
                     $this->redirect(Yii::app()->request->baseUrl.'/admin/listSlider');
            
                  }else {
                     $data['fail_msg'] = 'Fail to edit Slider.';
                  }
                }
         $data['slider'] = $slider;
         $this->render('editSlider', $data);

         }
         else{
             Yii::app()->user->setFlash('msg', "Unable to edit requested page.");
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
               require 'media/image_lib/WideImage.php';
               $image = WideImage::load("uploads/gallery/$file_name");
               $thumbs_pic = $image->resize(214, 124, 'outside')->crop('center', 'center', 214, 124);
               $thumbs_pic->saveToFile("uploads/gallery/thumbs/$file_name");
               $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
               $admin_thumbs_pic->saveToFile("uploads/gallery/admin-thumbs/$file_name");
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
                           require 'media/image_lib/WideImage.php';
                           $image = WideImage::load("uploads/gallery/$file_name");
                           $thumbs_pic = $image->resize(214, 124, 'outside')->crop('center', 'center', 214, 124);
                           $thumbs_pic->saveToFile("uploads/gallery/thumbs/$file_name");
                           $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
                           $admin_thumbs_pic->saveToFile("uploads/gallery/admin-thumbs/$file_name");
                           $gallery->image_name = $file_name;
                           $gallery->update();
                           if($old_file!='' && file_exists('uploads/gallery/'. $old_file))
                              unlink('uploads/gallery/'. $old_file);
                           if($old_file!='' && file_exists('uploads/gallery/thumbs/'. $old_file))
                              unlink('uploads/gallery/thumbs/'. $old_file);
                           if($old_file!='' && file_exists('uploads/gallery/admin-thumbs/'. $old_file))
                              unlink('uploads/gallery/admin-thumbs/'. $old_file);
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
         $criteria = new CDbCriteria();
            $criteria->alias = 'slider';
            $criteria->condition = 'is_active = 1';
            $criteria->order = 'slider.id DESC';
            $count=Slider::model()->count($criteria);
            $pages=new CPagination($count);
            $pages->pageSize=2;     // results per page
            $pages->applyLimit($criteria);
            $models = Slider::model()->findAll($criteria);

            $this->render('listSlider', array(
               'sliders' => $models,
               'pages' => $pages
            ));
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionListGallery() {
      if ($this->checkLogin()) {

            $criteria = new CDbCriteria();
            $criteria->alias = 'g';
            $criteria->condition = 'is_active = 1';
            $criteria->order = 'g.id DESC';
            $criteria->with = array('album');
            $count=Gallery::model()->count($criteria);
            $pages=new CPagination($count);

               // results per page
            $pages->pageSize=4;
            $pages->applyLimit($criteria);
            $models = Gallery::model()->findAll($criteria);

            $this->render('listGallery', array(
               'gallery' => $models,
               'pages' => $pages
            ));
         }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionDeleteSlider($id) {
      if ($this->checkLogin()) {
         $slider = Slider::model()->findByPk($id);
         if (isset($slider)) {       
            $slider->delete();
             if ($slider->attributes['image_name']!='' && file_exists('uploads/slider/' . $slider->attributes['image_name'])) 
                            unlink('uploads/slider/' . $slider->attributes['image_name']);
             if ($slider->attributes['image_name']!='' && file_exists('uploads/slider/thumbs/'.$slider->attributes['image_name']))
               unlink('uploads/slider/thumbs/' .$slider->attributes['image_name']);
             if ($slider->attributes['image_name']!='' && file_exists('uploads/slider/admin-thumbs/'.$slider->attributes['image_name']))
               unlink('uploads/slider/admin-thumbs/' .$slider->attributes['image_name']);
             }
         

         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListSlider');
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         }
      
   }

   public function actionDeleteGallery($id) {
      if ($this->checkLogin()) {
         $gallery = Gallery::model()->findByPk($id);
         if (isset($gallery)) {
                 if($gallery->delete()){
                     if ($gallery->attributes['image_name']!='' && file_exists('uploads/gallery/' . $gallery->attributes['image_name'])) 
                            unlink('uploads/gallery/' . $gallery->attributes['image_name']);
                     if ($gallery->attributes['image_name']!='' && file_exists('uploads/gallery/thumbs/' . $gallery->attributes['image_name'])) 
                            unlink('uploads/gallery/thumbs/' . $gallery->attributes['image_name']);    
                     if ($gallery->attributes['image_name']!='' && file_exists('uploads/gallery/admin-thumbs/' . $gallery->attributes['image_name'])) 
                            unlink('uploads/gallery/admin-thumbs/' . $gallery->attributes['image_name']); 
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
               Yii::app()->user->setFlash('msg', "Page added successfully.");
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
      $criteria = new CDbCriteria();
      $criteria->order = 'id DESC';
      $count=Page::model()->count($criteria);
      $pages=new CPagination($count);

         // results per page
      $pages->pageSize=5;


      $pages->applyLimit($criteria);
      $models = Page::model()->findAll($criteria);
      $this->render('listPages', array(
         'page' => $models,
         'pages' => $pages,
         'row_count'=>$pages->pageSize,
         'current_page'=>$pages->currentPage
      )); 
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
               Yii::app()->user->setFlash('msg', "Page updated successfully.");
               $this->redirect(Yii::app()->request->baseUrl . '/admin/ListPages');
            }
         $data['page'] = $page;
         $this->render('editPage', $data);

         }
         else{
             Yii::app()->user->setFlash('msg', "Unable to edit requested page.");
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
         Yii::app()->user->setFlash('msg', "Page deleted successfully.");
         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListPages');
      }else {
         Yii::app()->user->setFlash('msg', "Unable to delete page.");
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionAddMedia() {
      if ($this->checkLogin()) {
         if (isset($_POST['Media'])) {
            $media = new Media();
            if($_POST['Media']['status']==''){
               $_POST['Media']['status']=1;
            }
            $media->attributes = $_POST['Media'];
               if ($media->save()) {
                  Yii::app()->user->setFlash('msg','Media added successfully.');
                  $this->redirect(Yii::app()->request->baseUrl . '/admin/ListMedia');
               }
               else {
                  $data['fail_msg'] = 'Fail to add media.';
               }
         }
            $media = new Media();
            $data['media'] = $media;
            $this->render('addMedia', $data);
      }
         else {
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
   if ($this->checkLogin()) {      
      $criteria = new CDbCriteria();
      $criteria->order = 'id DESC';
      $count=Media::model()->count($criteria);
      $pages=new CPagination($count);

         // results per page
      $pages->pageSize=5;
      $pages->applyLimit($criteria);
      $models = Media::model()->findAll($criteria);
      $this->render('listMedia', array(
         'media' => $models,
         'pages' => $pages
      ));    
   }else{
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         }
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
            if($_POST['News']['status']==''){
               $_POST['News']['status']=1;
            }
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
      if ($this->checkLogin()) {      
      $criteria = new CDbCriteria();
      $criteria->order = 'id DESC';
      $count=News::model()->count($criteria);
      $pages=new CPagination($count);

         // results per page
      $pages->pageSize=2;
      $pages->applyLimit($criteria);
      $models = News::model()->findAll($criteria);
      $this->render('listNews', array(
         'news' => $models,
         'pages' => $pages
      ));    
   }else{
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         }
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
            if($_POST['Blog']['status']==''){
               $_POST['Blog']['status']=1;
            }
            $blogs->attributes = $_POST['Blog'];
               if ($blogs->save()) {
                  Yii::app()->user->setFlash('msg','Blog added successfully.');
                  $this->redirect(Yii::app()->request->baseUrl . '/admin/ListBlogs');
               }
               else {
                   $data['fail_msg'] = 'Fail to add blog.';
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
      if ($this->checkLogin()) {      
      $criteria = new CDbCriteria();
      $criteria->order = 'id DESC';
      $count=Blog::model()->count($criteria);
      $pages=new CPagination($count);

         // results per page
      $pages->pageSize=2;
      $pages->applyLimit($criteria);
      $models = Blog::model()->findAll($criteria);
      $this->render('listBlogs', array(
         'blogs' => $models,
         'pages' => $pages
      ));    
   }else{
            $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
         }
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
       if (isset($_POST['Album'])) {
            $album = new Album();
            if($_POST['Album']['status']==''){
               $_POST['Album']['status']=1;
            }
            $album->attributes = $_POST['Album'];
            $uploaded_files = CUploadedFile::getInstance($album, 'image_name');
            if ($album->save()) {
               if(!empty($uploaded_files)){
               $tmp = explode('.', $uploaded_files);
               $file_extension = strtolower(end($tmp));
               $file_name = Common::generate_filename() . '.' . $file_extension;
               $uploaded_files->saveAs("uploads/album/$file_name");
               require 'media/image_lib/WideImage.php';
               $image = WideImage::load("uploads/album/$file_name");
               $thumbs_pic = $image->resize(214, 124, 'outside')->crop('center', 'center', 214, 124);
               $thumbs_pic->saveToFile("uploads/album/thumbs/$file_name");
               $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
               $admin_thumbs_pic->saveToFile("uploads/album/admin-thumbs/$file_name");
               $album->image_name = $file_name;
               $album->update();
               }
                Yii::app()->user->setFlash('msg', "Album added successfully.");
               $this->redirect(Yii::app()->request->baseUrl.'/admin/listAlbum');
               
            }else {
               $data['fail_msg'] = 'Fail to add an album.';
            }
         }
      $album = new Album();
      $data['album'] = $album;   
   $this->render('addAlbum',$data);
   }
   else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
}

public function actionListAlbum(){
   if ($this->checkLogin()) {
      $criteria = new CDbCriteria();
            $criteria->alias = 'album';
            $criteria->condition = 'status= 1';
            $criteria->order = 'album.id DESC';
            $count=Album::model()->count($criteria);
            $pages=new CPagination($count);
            $pages->pageSize=4;     // results per page
            $pages->applyLimit($criteria);
            $models = Album::model()->findAll($criteria);

            $this->render('listAlbum', array(
               'album' => $models,
               'pages' => $pages
            ));
   //$album = Album::model()->findAll();
   //$data['album']=$album;
   //$this->render('listAlbum',$data);
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
                  $old_file=$album->attributes['image_name'];
                  $album->attributes = $_POST['Album'];
                  $album->image_name=$old_file;
                  $uploaded_files= CUploadedFile::getInstance($album, 'image_name');
                  if ($album->save()) {
                       if(!empty($uploaded_files)){ // check if uploaded file is set or not
                           $tmp = explode('.', $uploaded_files);
                           $file_extension = strtolower(end($tmp));
                           $file_name = Common::generate_filename() . '.' . $file_extension;
                           $uploaded_files->saveAs('uploads/album/'.$file_name);
                           require 'media/image_lib/WideImage.php';
                           $image = WideImage::load("uploads/gallery/$file_name");
                           $thumbs_pic = $image->resize(214, 124, 'outside')->crop('center', 'center', 214, 124);
                           $thumbs_pic->saveToFile("uploads/gallery/thumbs/$file_name");
                           $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
                           $admin_thumbs_pic->saveToFile("uploads/gallery/admin-thumbs/$file_name");
                           $album->image_name = $file_name;
                           $album->update();
                           if($old_file!='' && file_exists('uploads/album/'. $old_file))
                              unlink('uploads/album/'. $old_file);
                           if($old_file!='' && file_exists('uploads/album/thumbs/'. $old_file))
                              unlink('uploads/album/thumbs/'. $old_file);
                           if($old_file!='' && file_exists('uploads/album/admin-thumbs/'. $old_file))
                              unlink('uploads/album/admin-thumbs/'. $old_file);
                     }
                     Yii::app()->user->setFlash('msg', "Album updated successfully.");
                     $this->redirect(Yii::app()->request->baseUrl.'/admin/listAlbum');
            
                  }else {
                     $data['fail_msg'] = 'Fail to edit album.';
                  }
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
         $album = Album::model()->with('galleries')->findByPk($id);
         $gallery_list=$album->galleries;
         $gallery_image_name_list=array();
         foreach ($gallery_list as $key => $value) {            
            $gallery_image_name_list[]=$value->attributes['image_name'];
         }
         $old_file=$album->attributes['image_name'];
         if (isset($album)) {
            if($album->delete()){
               $old_file=$album->attributes['image_name'];

               if($old_file!='' && file_exists('uploads/album/'. $old_file))
                  unlink('uploads/album/'. $old_file);
               if($old_file!='' && file_exists('uploads/album/thumbs/'. $old_file))
                  unlink('uploads/album/thumbs/'. $old_file);
               if($old_file!='' && file_exists('uploads/album/admin-thumbs/'. $old_file))
                  unlink('uploads/album/admin-thumbs/'. $old_file);
                if(!empty($gallery_image_name_list)){
                  foreach ($gallery_image_name_list as $gal_img) {
                     if($gal_img!='' && file_exists('uploads/gallery/'. $gal_img))
                            unlink('uploads/gallery/'. $gal_img);
                     if($gal_img!='' && file_exists('uploads/gallery/thumbs/'. $gal_img))
                            unlink('uploads/gallery/thumbs/'. $gal_img);
                     if($gal_img!='' && file_exists('uploads/gallery/admin-thumbs/'. $gal_img))
                            unlink('uploads/gallery/admin-thumbs/'. $gal_img);
               }
               
              
              } 

            }
            
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
            $uploaded_files = CUploadedFile::getInstance($publication, 'files');
            if ($publication->save()) {
               if($uploaded_files!=""){
                  $tmp = explode('.', $publication->files);
                  $file_extension = strtolower(end($tmp));
                  $file_name = Common::generate_filename() . '.' . $file_extension;
                  $uploaded_files->saveAs('uploads/publication/'.$file_name);
                  $publication->files = $file_name;
                  $publication->save();
               }
               Yii::app()->user->setFlash('msg', "Data added successfully.");
               $this->redirect(Yii::app()->request->baseUrl.'/admin/listPub');
         
            }else {
               $data['fail_msg'] = 'Fail to add publication.';
            }
      }
   $this->render('addPub',$data);
   }
   else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
}

public function actionListPub(){
   if ($this->checkLogin()) {
      $criteria = new CDbCriteria();
      $criteria->order = 'id DESC';
      $count=Publication::model()->count($criteria);
      $pages=new CPagination($count);
      $pages->pageSize=4;     // results per page
      $pages->applyLimit($criteria);
      $models = Publication::model()->findAll($criteria);

      $this->render('listPub', array(
         'publication' => $models,
         'pages' => $pages
      ));
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
                        $uploaded_files->saveAs('uploads/publication/'.$file_name);
                        $publication->files = $file_name;
                        $publication->update();
                        if($old_file!='' && file_exists('uploads/publications/'. $old_file))
                              unlink('uploads/publication/'. $old_file);
                     }
                     Yii::app()->user->setFlash('msg', "Data updated successfully.");
                     $this->redirect(Yii::app()->request->baseUrl.'/admin/listPub');
            
                  }else {
                     $data['fail_msg'] = 'Fail to edit publication.';
                  }
                }
         $data['publication'] = $publication;
         $this->render('editPub', $data);

         }
         else{
             Yii::app()->user->setFlash('msg', "Unable to edit requested page.");
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
            if($old_file!='' && file_exists('uploads/publication/'. $old_file))
            unlink('uploads/publication/'. $old_file);

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
               require 'media/image_lib/WideImage.php';
               $image = WideImage::load("uploads/partner/$file_name");               
               $thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
               $thumbs_pic->saveToFile("uploads/partner/thumbs/$file_name");
               $partner->image = $file_name;
               $partner->save();
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
         $criteria = new CDbCriteria();
            $criteria->order = 'id DESC';
            $count=Partner::model()->count($criteria);
            $pages=new CPagination($count);
            $pages->pageSize=4;     // results per page
            $pages->applyLimit($criteria);
            $models = Partner::model()->findAll($criteria);

            $this->render('listPartner', array(
               'partner' => $models,
               'pages' => $pages
            ));
         //$partner = Partner::model()->findAll();
         //$data['partner']=$partner;
         //$this->render('listPartner',$data);
      }
      else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }
   public function actionDeletePartner($id) {
      if ($this->checkLogin()) {
         $partner = Partner::model()->findByPk($id);
         if (isset($partner)) {
            if ($partner->attributes['image']!='' && file_exists('uploads/partner/' . $partner->image)) 
               unlink('uploads/partner/' . $partner->image);
            if ($partner->attributes['image']!='' && file_exists('uploads/partner/thumbs/' . $partner->image)) 
               unlink('uploads/partner/thumbs/' . $partner->image);
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
                  require 'media/image_lib/WideImage.php';
                  $image = WideImage::load("uploads/partner/$file_name");               
                  $thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
                  $thumbs_pic->saveToFile("uploads/partner/thumbs/$file_name");
                  $partner->image = $file_name;
                  $partner->update();
                  if ($old_image!='' && file_exists('uploads/partner/' . $old_image)) 
                     unlink('uploads/partner/' . $old_image);
                  if ($old_image!='' && file_exists('uploads/partner/thumbs/' . $old_image)) 
                     unlink('uploads/partner/thumbs/' . $old_image);
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
   