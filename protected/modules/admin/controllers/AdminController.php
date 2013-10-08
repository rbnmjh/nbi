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
            $slider->image_name = CUploadedFile::getInstance($slider, 'image_name');
            if ($slider->save()) {
               $tmp = explode('.', $slider->image_name);
               $file_extension = strtolower(end($tmp));
               $file_name = Common::generate_filename() . '.' . $file_extension;
               $slider->image_name->saveAs("uploads/$file_name");
               $slider->image_name = $file_name;
               $slider->update();
               $data['success_msg'] = 'slider added successfully.';
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

   public function actionAddGallery() {
      if ($this->checkLogin()) {
         if (isset($_POST['Gallery'])) {
            $gallary = new Gallery();
            $gallary->attributes = $_POST['Gallery'];
            $gallary->is_active = 1;
            $date = new DateTime();
            $gallary->upload_date = $date->format("Y-m-d");
            $gallary->image_name = CUploadedFile::getInstance($gallary, 'image_name');
            if ($gallary->save()) {
               $tmp = explode('.', $gallary->image_name);
               $file_extension = strtolower(end($tmp));
               $file_name = Common::generate_filename() . '.' . $file_extension;
               $gallary->image_name->saveAs("uploads/$file_name");
               $gallary->image_name = $file_name;
               $gallary->update();
               $data['success_msg'] = 'Slider added successfully.';
            }else {
               $data['fail_msg'] = 'Fail to add slider.';
            }
         }

         $gallery = new Gallery();
         $data['gallery'] = $gallery;
         $this->render('uploadGallery', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionListSliders() {
      if ($this->checkLogin()) {
         $sliders = Slider::model()->findAllByAttributes(array('is_active' => 1));
         $data['sliders'] = $sliders;
         $this->render('listSlider', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionListGallery() {
      if ($this->checkLogin()) {
         $gallery = Gallery::model()->findAllByAttributes(array('is_active' => 1));
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
            if (file_exists('uploads/' . $slider->image_name)) unlink('uploads/' . $slider->image_name);

            $slider->delete();
         }

         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListSliders');
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionDeleteGallery($id) {
      if ($this->checkLogin()) {
         $gallery = Gallery::model()->findByPk($id);
         if (isset($gallery)) {
            if (file_exists('uploads/' . $gallery->image_name)) unlink('uploads/' . $gallery->image_name);

            $gallery->delete();
         }

         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListGallery');
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionAddMenu() {
      if ($this->checkLogin()) {
         if (isset($_POST['MenusWine'])) {
            $menu = new MenusWine();
            $menu->attributes = $_POST['MenusWine'];
            $menu->type = 'menu';
            if ($menu->save()) {
               $data['success_msg'] = 'menu added successfully.';
            }else {
               $data['fail_msg'] = 'Fail to add menu.';
            }
         }

         $menu = new MenusWine();
         $data['menu'] = $menu;
         $this->render('addMenu', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionAddWine() {
      if ($this->checkLogin()) {
         if (isset($_POST['MenusWine'])) {
            $menu = new MenusWine();
            $menu->attributes = $_POST['MenusWine'];
            $menu->type = 'wine';
            if ($menu->save()) {
               $data['success_msg'] = 'menu added successfully.';
            }else {
               $data['fail_msg'] = 'Fail to add menu.';
            }
         }

         $menu = new MenusWine();
         $data['wine'] = $menu;
         $this->render('addWine', $data);
      }else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionListMenus() {
      if ($this->checkLogin()) {
         $menus = MenusWine::model()->findAllByAttributes(array('type'         => 'menu'));
         $data['menus'] = $menus;
         $this->render('listMenus', $data);
      }else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionListWines() {
      if ($this->checkLogin()) {
         $menus = MenusWine::model()->findAllByAttributes(array('type'         => 'wine'));
         $data['wines'] = $menus;
         $this->render('listWines', $data);
      }else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionDeleteMenu($id) {
      if ($this->checkLogin()) {
         $menus = MenusWine::model()->findByPk($id);
         if (isset($menus)) {
            $menus->delete();
         }

         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListMenus');
      }
      else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionDeleteWine($id) {
      if ($this->checkLogin()) {
         $wines = MenusWine::model()->findByPk($id);
         if (isset($wines)) {
            $wines->delete();
         }

         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListWines');
      }else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionAddMenuItems() {
      if ($this->checkLogin()) {
         if (isset($_POST['MenuItems'])) {
            $menuItem = new MenuItems();
            $menuItem->attributes = $_POST['MenuItems'];
            $date = new DateTime();
            $menuItem->update_date = $date->format("Y-m-d");
            if ($menuItem->save()) {
               $data['success_msg'] = 'menu item added successfully.';
            }
            else {
               $data['fail_msg'] = 'Fail to add menu item.';
            }
         }

         $menuItem = new MenuItems();
         $data['menuItem'] = $menuItem;
         $this->render('addMenuItem', $data);
      }
      else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionAddWineItems() {
      if ($this->checkLogin()) {
         if (isset($_POST['WineItems'])) {
            $wineItem = new WineItems();
            $wineItem->attributes = $_POST['WineItems'];
            $date = new DateTime();
            $wineItem->update_date = $date->format("Y-m-d");
            if ($wineItem->save()) {
               $data['success_msg'] = 'menu added successfully.';
            }
            else {
               $data['fail_msg'] = 'Fail to add menu.';
            }
         }

         $wineItem = new WineItems();
         $data['wineItem'] = $wineItem;
         $this->render('addWineItem', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionListMenuItems() {
      if ($this->checkLogin()) {
         $menus = MenuItems::model()->findAll();
         $data['menuItems'] = $menus;
         $this->render('listMenuItems', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionListWineItems() {
      if ($this->checkLogin()) {
         $menus = WineItems::model()->findAll();
         $data['wineItems'] = $menus;
         $this->render('listWineItems', $data);
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionDeleteMenuItems($id) {
      if ($this->checkLogin()) {
         $menuItem = MenuItems::model()->findByPk($id);
         if (isset($menuItem)) {
            $menuItem->delete();
         }
         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListMenuItems');
      }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionDeleteWineItems($id) {
      if ($this->checkLogin()) {
         $wineItem = WineItems::model()->findByPk($id);
         if (isset($wineItem)) {
            $wineItem->delete();
         }

         $this->redirect(Yii::app()->request->baseUrl . '/admin/ListWineItems');
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
		$page = new Page();
	$data['page'] = $page;
	if(isset($_POST['Page'])){
		$page->attributes = $_POST['Page'];
		if($page->save()){
         $data['success_msg'] = 'Page added successfully.';
			//$this->redirect(Yii::app()->request->baseUrl.'/admin/addPages');
			}else{
			 $data['fail_msg'] = 'Fail to add Page.';
			 }
	}
	$this->render('addPage',$data);
}

public function actionListPages(){
	$page = Page::model()->findAll();
	$data['pages']=$page;
	$this->render('listPages',$data);
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
}