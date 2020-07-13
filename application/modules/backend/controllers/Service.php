<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
Class Service extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ServiceLib', 'servicelib');
	}
	
	public function service() {
	
		$categories = $this->servicelib->getAllCategories();
		$subcategories = $this->servicelib->getActiveSubCategories();
		$services = $this->servicelib->getActiveServices();
		$spares = $this->servicelib->getActiveSpares();
		$brands = $this->servicelib->getActiveBrands();
		$models = $this->servicelib->getActiveModels();
		$catsubcats = $this->servicelib->getActiveListcatSubcat();
		$this->template->set('models',$models);
		$this->template->set('brands',$brands);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('catsubcats',$catsubcats);
		$this->template->set('services',$services);
		$this->template->set('spares',$spares);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Services' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/mainservice');
	}

	public function newCategory() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
	   // echo $this->template->build ('partials/service/AddCategory');
	    $this->template->build ('partials/service/AddCategory');
	}
	
	public function addCategory() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/category/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->servicelib->addCategory($params);
		echo json_encode($response);
	}

	public function getCategoryList() {
		$categories = $this->servicelib->getActiveCategoriesbook();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Category' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/category/CategoryList');
	}

	public function updateCategory() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['status'] = $this->input->post('status');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->servicelib->updateCategory($params);
		echo json_encode($response);
	}
	
	public function editCategory() {
		$id=$this->input->post('id');
		$categories = $this->servicelib->getEditCategoryById($id);
		$this->template->set('categories',$categories);
	//	print_r($categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/EditCategory');
	}
	
	public function newSubCategory() {
		$categories = $this->servicelib->getActiveCategoriesbook();
		$sub_categories = $this->servicelib->getActivestaticSubCategories();
		$this->template->set('categories',$categories);
		$this->template->set('sub_categories',$sub_categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/AddSubCategory');
	}
	
	public function addSubCategory() {
		$params = array();
		$name = $this->input->post('name');
		$namearr= explode(",",$name);
		$params['sub_id'] = $namearr[0];
		$params['name'] = $namearr[1];
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/subcategory/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				//exit;
			}
		}
		$response = $this->servicelib->addSubCategory($params);
		echo json_encode($response);
	}
	
	public function getSubCategoryList() {
		$subcategories = $this->servicelib->getActiveSubCategories();
		$this->template->set('subcategories',$subcategories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | SubCategory' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/category/SubCategoryList');
	}
	
	public function updateSubCategory() {
		$params = array();
		$params['id'] = $this->input->post('id');
		//$params['name'] = $this->input->post('name');
		$name = $this->input->post('name');
		$namearr= explode(",",$name);
		$params['sub_id'] = $namearr[0];
		$params['name'] = $namearr[1];
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['status'] = $this->input->post('status');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->servicelib->updateSubCategory($params);
		echo json_encode($response);
	}
	
	public function editSubCategory() {
		$id=$this->input->post('id');
		$categories = $this->servicelib->getActiveCategoriesbook();
		$subcategories = $this->servicelib->getEditSubCategoryById($id);
		$brands = $this->servicelib->getActiveBrands();
		$models = $this->servicelib->getActiveModels();
		$sub_categories = $this->servicelib->getActivestaticSubCategories();
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('brands',$brands);
		$this->template->set('models',$models);
		$this->template->set('sub_categories',$sub_categories);
		//	print_r($categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/EditSubCategory');
	}
	
	public function newService($vendor_id) {
		$this->load->library('zyk/ServiceLib');
		$categories = $this->servicelib->getActiveCategoriesbook();
		$servicetype = $this->servicelib->getSubCatIdAll();
		$servicegroup = $this->servicelib->getActiveServiceGroupsName();
		$vendor_id = $this->input->post('vendor_id');
		$this->template->set('vendor_id',$vendor_id);
		$this->template->set('servicetype',$servicetype);
		$this->template->set('categories',$categories);
		$this->template->set('servicegroup',$servicegroup);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/AddService');
	}
	
	public function addService() {
		
		$params = array();
		$params['vendor_id'] = (!empty($this->input->post('vendor_id')))?$this->input->post('vendor_id'):'';
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id');
		$params['catsubcat_id'] = $this->input->post('catsubcat_id');
		$params['price'] = $this->input->post('price');
		$params['tax'] = $this->input->post('tax');
		//$params['tax'] = 18;
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
		 
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['service_icon'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->servicelib->addService($params);
		echo json_encode($response);
	}
	

	public function updateService() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id');
		$params['catsubcat_id'] = $this->input->post('catsubcat_id');
		$params['price'] = $this->input->post('price');
		$params['tax'] = $this->input->post('tax');
		$params['status'] = $this->input->post('status');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['service_icon'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				//exit;
			}
		}
		$response = $this->servicelib->updateService($params);
		echo json_encode($response);
	}
	
	
	public function editServices() {
		$id=$this->input->post('id');
		$categories = $this->servicelib->getActiveCategoriesbook();
		//$subcategories = $this->servicelib->getActiveSubCategories(); 
		$brands = $this->servicelib->getActiveBrands();
		$models = $this->servicelib->getActiveModels();
		$catsubcategories = $this->servicelib->getActivecatSubcat();
		$services = $this->servicelib->getEditServiceById($id);

		$subcategories = $this->servicelib->getSubCatIdAll();
		$servicegroup = $this->servicelib->getActiveServiceGroupsName();
		$this->template->set('servicegroup',$servicegroup);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('services',$services);
		$this->template->set('brands',$brands);
		$this->template->set('models',$models);
		$this->template->set('catsubcategories',$catsubcategories);
		//	print_r($categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/EditService');
	}	
	
	public function newCatsubcat() {
		$this->load->library('zyk/ServiceLib');
		
		$categories = $this->servicelib->getActiveCategoriesbook();
		$subcategories = $this->servicelib->getActiveSubCategories();
		$services = $this->servicelib->getActiveServices();
		$servicegroup = $this->servicelib->getActiveServiceGroupsName();
		$this->template->set('servicegroup',$servicegroup);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/AddcatSubcat');
	}
	
	public function addCatsubcat() {
	
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
	
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['service_icon'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->servicelib->addcatSubcat($params);
		echo json_encode($response);
	}
	
	
	public function updateCatsubcat() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id');
		$params['status'] = $this->input->post('status');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['service_icon'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->servicelib->updateCatsubcat($params);
		echo json_encode($response);
	}
	
	
	public function editCatsubcat() {
		$id=$this->input->post('id');
		$categories = $this->servicelib->getActiveCategoriesbook();
		//$subcategories = $this->servicelib->getActiveSubCategories(); 

		$brands = $this->servicelib->getActiveBrands();
		$models = $this->servicelib->getActiveModels();
		$catsubcats = $this->servicelib->getEditcatSubcatById($id);
		 
		$subcategories = $this->servicelib->getSubCatId($catsubcats[0]['model_id']);
 
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('catsubcats',$catsubcats);
		$this->template->set('brands',$brands);
		$this->template->set('models',$models);
		//	print_r($categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/EditcatSubcat');
	}
	
	public function newSpare($vendor_id) {
		$this->load->library('zyk/ServiceLib');
		$categories = $this->servicelib->getActiveCategoriesbook();
		$servicetype = $this->servicelib->getSubCatIdAll();
		$servicegroup = $this->servicelib->getActiveServiceGroupsName();
		$vendor_id = $this->input->post('vendor_id');
		$this->template->set('servicegroup',$servicegroup);
		$this->template->set('servicetype',$servicetype);
		$this->template->set('categories',$categories);
		$this->template->set('vendor_id',$vendor_id);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/addSpare');
	}
	
	public function addSpare() {
	
		$params = array();
		$params['vendor_id'] = (!empty($this->input->post('vendor_id')))?$this->input->post('vendor_id'):'';
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id');
		// $params['catsubcat_id'] = $this->input->post('catsubcat_id');
		$params['price'] = $this->input->post('price');
		$params['tax'] = $this->input->post('tax');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
	
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['service_icon'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->servicelib->addSpare($params);
		echo json_encode($response);
	}
	
	
	public function updateSpare() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id');
		// $params['catsubcat_id'] = $this->input->post('catsubcat_id');
		$params['price'] = $this->input->post('price');
		$params['tax'] = $this->input->post('tax');
		$params['status'] = $this->input->post('status');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['service_icon'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->servicelib->updateSpare($params);
		echo json_encode($response);
	}
	
	
	public function editSpare() {
		$id=$this->input->post('id');
		$categories = $this->servicelib->getActiveCategoriesbook();
		$catsubcategories = $this->servicelib->getActivecatSubcat();
		//$subcategories = $this->servicelib->getActiveSubCategories();
		$brands = $this->servicelib->getActiveBrands();
		$models = $this->servicelib->getActiveModels();
		$spares = $this->servicelib->getEditSpareById($id);

		$subcategories = $this->servicelib->getSubCatIdAll();
		$servicegroup = $this->servicelib->getActiveServiceGroupsName();
		$this->template->set('servicegroup',$servicegroup);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('catsubcategories',$catsubcategories);
		$this->template->set('spares',$spares);
		$this->template->set('brands',$brands);
		$this->template->set('models',$models);
		//	print_r($categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/editSpare');
	}
	
	public function subcategorybycatid() {		
		$id = $this->input->post('model_id');				
		$this->load->library('zyk/ServiceLib', 'servicelib');		
		$subcat = $this->servicelib->getSubCatId($id);			
		echo json_encode($subcat);	
	} 
	  public function subcategorybycatid3() {		
                $this->load->library('zyk/ServiceLib', 'servicelib');		
		echo json_encode($this->servicelib->getSubCatId3($this->input->post('model_id')));			
		
	} 
        public function subcategorybycatid2() {		
		$id = $this->input->post('model_id');				
		$this->load->library('zyk/ServiceLib', 'servicelib');		
		$subcat['subcat'] = $this->servicelib->getSubCatId($id);
                $subcat['spare'] = $this->servicelib->getspare($id);
		echo json_encode($subcat);	
	} 
	public function brandbycatid() {
		$id = $this->input->post('cat_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$brands = $this->servicelib->getBrandId($id);
		echo json_encode($brands);
	}
	
	public function modelbybrandid() {
		$id = $this->input->post('brand_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getModelbyBrandId($id);
		echo json_encode($subcat);
	}

	public function getmodelsbybrid() {
		$id = $this->input->post('brand_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$models = $this->servicelib->getmodelsbybrid($id);
		echo json_encode($models);
	}

	
	
	public function modelbybrandid1() {
		$id = $this->input->post('brand_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getModelbyBrandId1($id);
		echo json_encode($subcat);
	}
	
	public function servicebycatid() {
		$id = $this->input->post('subcat_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getSerCatId($id);
		echo json_encode($subcat);
	}
	
	public function servicebysubcatid() {
		$id = $this->input->post('subcat_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getSersubCatId($id);
		echo json_encode($subcat);
	}
	
	public function servicebycatid1() {
		$id = $this->input->post('subcat_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getSerCatId1($id);
		echo json_encode($subcat);
	}
    
    public function servicebycatid3() {
		$id = $this->input->post('subcat_id');  
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getSerCatId3($id); 
		echo json_encode($subcat);
	}

	 public function getservicesbysubcat() {
		$id = $this->input->post('subcat_id');  
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getservicesbysubcat($id); 
		echo json_encode($subcat);
	}
	
	public function catsubcatbyid() {
		$id = $this->input->post('subcat_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getCatsubcatid($id);
		echo json_encode($subcat);
	}
	
	public function catsubcatbyid1() {
		$id = $this->input->post('subcat_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getCatsubcatid1($id);
		echo json_encode($subcat);
	}
	public function getsparelistbyparams() {
		$model_id = $this->input->post('model_id');
		$subcat_id = $this->input->post('subcategory_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$spares = $this->servicelib->getsparelistbyparams($model_id,$subcat_id); 
		echo json_encode($spares);
	}
	
	public function newModel() {
		$categories = $this->servicelib->getActiveCategoriesbook();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/AddModel');
	}
	
	public function addModel() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
	
		$response = $this->servicelib->addModel($params);
		echo json_encode($response);
	}
	
	public function getModelList() {
		$models = $this->servicelib->getActiveModels();
		$this->template->set('models',$models);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Category' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/service/ModelList');
	}
	
	public function updateModel() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
	    $params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['status'] = $this->input->post('status');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
		
		$response = $this->servicelib->updateModel($params);
		echo json_encode($response);
	}
	
	public function editModel() {
		$id=$this->input->post('id');
		$models = $this->servicelib->getEditModelById($id);
		$categories = $this->servicelib->getActiveCategoriesbook();
		$brands = $this->servicelib->getActiveBrands();
		$this->template->set('categories',$categories);
		$this->template->set('brands',$brands);
		$this->template->set('models',$models);
		//	print_r($categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/EditModel');
	}
	
	public function newBrand() {
		$categories = $this->servicelib->getActiveCategoriesbook();
		$this->template->set('categories',$categories); 
		$this->template->set('brand','brand');
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/AddBrand');
	}
	
	public function addBrand() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/category/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$this->load->library('zyk/ServiceLib');
	
		$response = $this->servicelib->addBrand($params);
		echo json_encode($response);
	}
	
	
	public function updateBrand() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['status'] = $this->input->post('status');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$this->load->library('zyk/ServiceLib');
	
		$response = $this->servicelib->updateBrand($params);
		echo json_encode($response);
	}
	
	public function editBrand() {
		$id=$this->input->post('id');
		$brands = $this->servicelib->getEditBrandById($id);
		$categories = $this->servicelib->getActiveCategoriesbook();
		$this->template->set('categories',$categories);
		$this->template->set('brands',$brands);
		//	print_r($categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('partials/service/EditBrand');
	}
	
	public function getMainStatusList() {
		$categories = $this->servicelib->getActiveMainStatus();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | MainStatus' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/MainStatusList');
	}
	
	public function newMainStatus() {
		
		$categories = $this->servicelib->getActiveMainStatus();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Category' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/MainStatusAdd');
	}
	
	public function addMainStatus() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['parent_id'] = $this->input->post('parent_id');
		$params['email_content'] = $this->input->post('email_content');
		$params['sms_content'] = $this->input->post('sms_content');
		
		$params['sort_order'] = $this->input->post('sort_order');
		$params['status'] = $this->input->post('status');
		$params['date_added'] = date('Y-m-d H:i:s');
		$params['is_customer'] = $this->input->post('is_customer');
		$params['is_mechanic'] = $this->input->post('is_mechanic');
			
		$response = $this->servicelib->addMainStatus($params);
		echo json_encode($response);
	}
	
	public function editMainStatus($id) {
	
		$categories = $this->servicelib->getEditMainStatusById($id);
		$this->template->set('categories',$categories);
		$parentcategory = $this->servicelib->getActiveMainStatus();
		$this->template->set('pcategory',$parentcategory);
		
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | MainStatusEdit' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/MainStatusEdit');
	}
	
	public function updateMainStatus() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['parent_id'] = $this->input->post('parent_id');
		$params['email_content'] = $this->input->post('email_content');
		$params['sms_content'] = $this->input->post('sms_content');
		
		$params['sort_order'] = $this->input->post('sort_order');
		$params['status'] = $this->input->post('status');
		$params['date_modified'] = date('Y-m-d H:i:s');
		$params['is_customer'] = $this->input->post('is_customer');
		$params['is_mechanic'] = $this->input->post('is_mechanic');
		
		$response = $this->servicelib->updateMainStatus($params);
		echo json_encode($response);
	}

	public function newstaticSubCategory() {
		//$categories = $this->servicelib->getActiveCategoriesbook();
		//$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Services' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/StaticSubCategoryAdd');
		//$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		//$this->template->build ('partials/service/AddSubCategory');
	}
	
	public function addstaticSubCategory() {
		$params = array();
		$params['name'] = $this->input->post('name');
		//$params['category_id'] = $this->input->post('category_id');
		//$params['brand_id'] = $this->input->post('brand_id');
		//$params['model_id'] = $this->input->post('model_id');
		$params['status'] = $this->input->post('status');;
		$params['created_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
		/*if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/subcategory/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}*/
		$response = $this->servicelib->addstaticSubCategory($params);
		echo json_encode($response);
	}
	
	public function getstaticSubCategoryList() {
		$subcategories = $this->servicelib->getstaticSubCategories();
		$this->template->set('subcategories',$subcategories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | SubCategory' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/StaticSubCategoryList');
	}
	
	public function editstaticSubCategory($id) {
		//$id=$this->input->post('id');
		$subcategories = $this->servicelib->getstaticSubCategoryById($id);
		$this->template->set('subcategories',$subcategories);
		//	print_r($categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | SubCategory' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/StaticSubCategoryEdit');
	}
	
	public function updatestaticSubCategory() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['status'] = $this->input->post('status');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ServiceLib');
		/*if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		} */
		$response = $this->servicelib->updatestaticSubCategory($params);
		echo json_encode($response);
	}
	
	public function addServiceFromOrder() {
	
		$params = array();
		$params['name'] = $this->input->post('servicename');
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id');
		$params['catsubcat_id'] = $this->input->post('catsubcat_id');
		$params['price'] = $this->input->post('price');
		$params['tax'] = $this->input->post('tax');
		//$params['tax'] = 18;
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
	
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['service_icon'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->servicelib->addService($params);
		echo json_encode($response);
	}
	
	public function addSpareFromOrder() {
	
		$params = array();
		$params['name'] = $this->input->post('sparename');
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id');
		$params['price'] = $this->input->post('price');
		$params['tax'] = $this->input->post('tax');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
	
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['service_icon'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->servicelib->addSpare($params);
		echo json_encode($response);
	}

	public function getStaticServiceGroupList()
	{
		$servicegroup = $this->servicelib->getStaticServiceGroup();
		$this->template->set('servicegroup',$servicegroup);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | ServiceGroup' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/StaticServiceGroupList');
	}

	public function newStaticServiceGroup()
	{
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Services' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/StaticServiceGroupAdd');
	}

	public function addStaticServiceGroup()
	{
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = $this->input->post('status');
		$this->load->library('zyk/ServiceLib');
		$response = $this->servicelib->addStaticServiceGroup($params);
		echo json_encode($response);
	}

	public function editStaticServiceGroup($id=null)
	{
		$servicegroup = $this->servicelib->getStaticServiceGroup($id);
		$this->template->set('servicegroup',$servicegroup);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Service Group' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('service/StaticServiceGroupEdit');
	}

	public function updateStaticServiceGroup()
	{
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['status'] = $this->input->post('status');
		$this->load->library('zyk/ServiceLib');
		$response = $this->servicelib->updateStaticServiceGroup($params);
		echo json_encode($response);
	}
	
}


