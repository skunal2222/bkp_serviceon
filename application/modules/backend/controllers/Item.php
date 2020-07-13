<?php 
class Item extends MX_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		error_reporting(0);
	}



	public function index($cat_id=0) {
		$this->load->library('zyk/ItemLib');
		if($cat_id == 0) {
			$items = array();
		} else {
			$items = $this->itemlib->getItemByCatId($cat_id);
		}
		$categories = $this->itemlib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set('cat_id',$cat_id);
		$this->template->set('items',$items);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
						->title ( 'Administrator | Items' )
						->set_partial ( 'header', 'partials/header' )
						->set_partial ( 'leftnav', 'items/menu' )
						->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/ItemList');
	}
	
	public function newItem() {
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/General');
		$categories = $this->itemlib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Items' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/ItemAdd');
	}
	
	public function newRate() {
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/General');
	
		$categories = $this->itemlib->getActiveCategories();
		$ratecards = $this->itemlib->getActiveRatecard();
		$this->template->set('categories',$categories);
		$this->template->set('ratecards',$ratecards);
		$this->template->set('cat_id',$categories[0]['id']);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Ratecard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/RateAdd');
	}
	
	public function newRate1($cat_id=0) {
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/General');
		if($cat_id == 0) {
			$products = array();
		} 
		else {
			$products = $this->itemlib->getActiveProducts($cat_id);
		}
		$categories = $this->itemlib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set('products',$products);
		$this->template->set('cat_id',$cat_id);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Ratecard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/RateAdd');
	}
	
	public function newVendor() {
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/General');
	
		$categories = $this->itemlib->getActiveCategories();
		$vendors = $this->itemlib->getActiveVendor();
		$this->template->set('categories',$categories);
		$this->template->set('vendors',$vendors);
		$this->template->set('cat_id',$categories[0]['id']);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/VendorAdd');
	}
	
	public function newVendor1($cat_id=0) {
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/General');
		if($cat_id == 0) {
			$products = array();
		} 
		else {
			$products = $this->itemlib->getActiveProducts($cat_id);
		}
		$categories = $this->itemlib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set('products',$products);
		$this->template->set('cat_id',$cat_id);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/VendorAdd');
	}
	
	public function addItem() {
		$this->load->library('zyk/ItemLib');
		$item = $this->input->post('item');
		$item['status'] = 1;
		$item['created_on'] = date('Y-m-d H:i:s');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/items/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$item['image'] =  $item_image['image'];
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
		$result = $this->itemlib->addItem($item);
		if ($result['status'] == 1) {
			$categories = $this->itemlib->getCategoryById($item['cat_id']);
			$dack = array();
			$dack['crm_sku_id'] = $result['id'];
			$dack['item_name'] = $item['name'];
			$dack['item_category'] = $categories[0]['name'];
			if($item['cat_id'] == 2) {
				$dack['uom'] = 'KG';
			} else {
				$dack['uom'] = 'Quantity';
			}
			$dack['rate'] = $item['price'];
			$this->load->library ( 'zyk/Dack' );
			$resp = $this->dack->addItemToDack($dack);
			if($resp['Response'] == 'Success') {
				$itemu = array();
				$itemu['id'] = $result['id'];
				$itemu['name'] = $item['name'];
				$itemu['cat_id'] = $item['cat_id'];
				$itemu['dack_sku_id'] = $resp['DACK_SKU_ID'];
				$this->itemlib->updateItem($itemu);
			}
			$response['status'] = 1;
			$response['msg'] = 'Item added successfully';
			echo json_encode($response);
		} else {
			$errors = array();
			$error = array("item_sizes"=>'Failed to add items.');
			if (! empty ( $error )) {
				array_push ( $errors, $error );
			}
			$response['errormsg'] = $errors;
			$response['status'] = 0;
			$response['msg'] = 'Failed to add items';
			echo json_encode($response);
		}
		
	}
	
	public function addRate() {
		$this->load->library('zyk/ItemLib');
		$ratecard = $this->input->post('ratecard');
		$prod_chk = $this->input->post('prod_chk');
		$name = $this->input->post('name');
		$prod_price = $this->input->post('prod_price');
		$rate_price = $this->input->post('rate_price');
		
		for($i = 0; $i < count($prod_chk); $i++)
		{
			$para = array();
			$para['cat_id']=$ratecard['cat_id'];
			$para['ratecard_name']=$ratecard['ratecard_name'];
			$para['product_id'] = $prod_chk[$i];
			$para['product_name'] =$this->input->post('name'.$prod_chk[$i]);
			$para['product_price'] =$this->input->post('prod_price'.$prod_chk[$i]);
			$para['price'] =$this->input->post('rate_price'.$prod_chk[$i]);
			$para['status']=1;
			$para['created_on']=date('Y-m-d H:i:s');
		    $paras[] = $para;
		
		}
		//print_r($paras);
		//exit;
		$result = $this->itemlib->addRate($paras);
		if ($result['status'] == 1) {
			
			$response['status'] = 1;
			$response['msg'] = 'Ratecard added successfully';
			echo json_encode($response);
		} else {
			
			$response['status'] = 0;
			$response['msg'] = 'Failed to add items';
			echo json_encode($response);
		}
		
	}
	
	public function addVendor() {
		$this->load->library('zyk/ItemLib');
		$vendor = $this->input->post('vendor');
		$vendor['status'] = 1;
		$vendor['created_on'] = date('Y-m-d H:i:s');
	
		$result = $this->itemlib->addVendor($vendor);
		if ($result['status'] == 1) {
			
			$response['status'] = 1;
			$response['msg'] = 'Vendor added successfully';
			echo json_encode($response);
		} else {
			
			$response['status'] = 0;
			$response['msg'] = 'Failed to add items';
			echo json_encode($response);
		}
		
	}
	
	public function editItem($itemid) {
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/General');
		$categories = $this->itemlib->getActiveCategories();
		$items = $this->itemlib->getItemById($itemid);
		$this->template->set('categories',$categories);
		$this->template->set('item',$items[0]);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Items' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/ItemEdit');
	}
	
	public function editRate($itemid) {
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/General');
		$categories = $this->itemlib->getActiveCategories();
		$ratecards = $this->itemlib->getActiveRatecard();
		$items = $this->itemlib->getRateById($itemid);
		$this->template->set('categories',$categories);
		$this->template->set('ratecards',$ratecards);
		$this->template->set('item',$items[0]);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Items' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/RateEdit');
	}
	
	public function editVendor($itemid) {
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/General');
		$categories = $this->itemlib->getActiveCategories();
		$vendors = $this->itemlib->getActiveVendor();
		$items = $this->itemlib->getVendorById($itemid);
		$this->template->set('categories',$categories);
		$this->template->set('vendors',$vendors);
		$this->template->set('item',$items[0]);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Items' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/vendorEdit');
	}
	
	public function updateItem() {
		$this->load->library('zyk/ItemLib');
		$item = $this->input->post('item');
		$item['updated_on'] = date('Y-m-d H:i:s');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/items/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$item['image'] =  $item_image['image'];
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
		$result = $this->itemlib->updateItem($item);
		if ($result['status'] == 1) {
			$items = $this->itemlib->getItemById($item['id']);
			$categories = $this->itemlib->getCategoryById($item['cat_id']);
			$dack = array();
			$dack['crm_sku_id'] = $item['id'];
			$dack['item_name'] = $item['name'];
			$dack['item_category'] = $categories[0]['name'];
			if($item['cat_id'] == 2) {
				$dack['uom'] = 'KG';
			} else {
				$dack['uom'] = 'Quantity';
			}
			$dack['rate'] = $item['price'];
			$dack['dack_sku_id'] = $items[0]['dack_sku_id'];
			$this->load->library ( 'zyk/Dack' );
			$resp = $this->dack->updateItemToDack($dack);
			$response['status'] = 1;
			$response['msg'] = 'Item updated successfully';
			echo json_encode($response);
		} else {
			$errors = array();
			$error = array("item_sizes"=>'Failed to add items.');
			if (! empty ( $error )) {
				array_push ( $errors, $error );
			}
			$response['errormsg'] = $errors;
			$response['status'] = 0;
			$response['msg'] = 'Failed to add items';
			echo json_encode($response);
		}
	
	}
	
	public function rateUpdate() {
		$this->load->library('zyk/ItemLib');
		$item = $this->input->post('item');
		$item['updated_on'] = date('Y-m-d H:i:s');
		
		$result = $this->itemlib->rateUpdate($item);
		if ($result['status'] == 1) {
			
			$response['status'] = 1;
			$response['msg'] = 'Item updated successfully';
			echo json_encode($response);
		} else {
			
			$response['status'] = 0;
			$response['msg'] = 'Failed to add items';
			echo json_encode($response);
		}
	
	}
	
	public function vendorUpdate() {
		$this->load->library('zyk/ItemLib');
		$item = $this->input->post('item');
		$item['updated_on'] = date('Y-m-d H:i:s');
		
		$result = $this->itemlib->vendorUpdate($item);
		if ($result['status'] == 1) {
			
			$response['status'] = 1;
			$response['msg'] = 'Item updated successfully';
			echo json_encode($response);
		} else {
			
			$response['status'] = 0;
			$response['msg'] = 'Failed to add items';
			echo json_encode($response);
		}
	
	}
	
	public function turnOnItem($id) {
		$this->load->library('zyk/ItemLib');
		$result = $this->itemlib->turnOnItem($id);
		if ($result) {
			$items = $this->itemlib->getItemById($id);
			$categories = $this->itemlib->getCategoryById($items[0]['cat_id']);
			$dack = array();
			$dack['crm_sku_id'] = $id;
			$dack['item_name'] = $items[0]['name'];
			$dack['item_category'] = $categories[0]['name'];
			if($items[0]['cat_id'] == 2) {
				$dack['uom'] = 'KG';
			} else {
				$dack['uom'] = 'Quantity';
			}
			$dack['rate'] = $items[0]['price'];
			$this->load->library ( 'zyk/Dack' );
			$resp = $this->dack->addItemToDack($dack);
			if($resp['Response'] == 'Success') {
				$itemu = array();
				$itemu['id'] = $id;
				$itemu['dack_sku_id'] = $resp['DACK_SKU_ID'];
				$itemu['name'] = $items[0]['name'];
				$itemu['cat_id'] = $items[0]['cat_id'];
				$this->itemlib->updateItem($itemu);
			}
		}
	}
	public function turnOffItem($id) {
		$this->load->library('zyk/ItemLib');
		$item = array();
		$item['status'] = 0;
		$item['id'] = $id;
		$result = $this->itemlib->turnOffItem($id);
		if ($result) {
			$items = $this->itemlib->getItemById($id);
			$dack = array();
			$dack['dack_sku_id'] = $items[0]['dack_sku_id'];
			$this->load->library ( 'zyk/Dack' );
			$resp = $this->dack->deleteItemToDack($dack);
		}
	}
	
	public function getCategoryList() {
		$this->load->library('zyk/ItemLib');
		$categories = $this->itemlib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Category' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/CategoryList');
	}
	
	public function newCategory() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Category' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/CategoryAdd');
	}
	
	public function addCategory() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$item['created_on'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ItemLib');
		$response = $this->itemlib->addCategory($params);
		echo json_encode($response);
	}
	
	
	public function editCategory($id) {
		$this->load->library('zyk/ItemLib');
		$categories = $this->itemlib->getCategoryById($id);
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/CategoryEdit');
	}
	
	public function updateCategory() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$item['updated_on'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ItemLib');
		$response = $this->itemlib->updateCategory($params);
		echo json_encode($response);
	} 
	
	public function getRatecardList() {
		$this->load->library('zyk/ItemLib');
		$ratecards = $this->itemlib->getActiveRatecard1();
		$this->template->set('ratecards',$ratecards);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Ratecard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/RatecardList');
	}
	
	public function rateCards($cat_id=0) {
		$this->load->library('zyk/ItemLib');
		if($cat_id == 0) {
			$items = $this->itemlib->getRatelist();
		} 
		else {
			$items = $this->itemlib->getRateByCatId($cat_id);
		}
		$categories = $this->itemlib->getActiveCategories();
		$ratecards = $this->itemlib->getActiveRatecard();
		$this->template->set('categories',$categories);
		$this->template->set('ratecards',$ratecards);
		$this->template->set('cat_id',$cat_id);
		$this->template->set('rate_id',$items[0]['id']);
		$this->template->set('items',$items);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
						->title ( 'Administrator | Items' )
						->set_partial ( 'header', 'partials/header' )
						->set_partial ( 'leftnav', 'items/menu' )
						->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/Ratecard');
	}
	
	public function rateCards1($rate_id=0) {
		$this->load->library('zyk/ItemLib');
		if($rate_id == 0) {
			$items = $this->itemlib->getRatelist();
		} 
		else {
			$items = $this->itemlib->getRateId($rate_id);
		}
		$categories = $this->itemlib->getActiveCategories();
		$ratecards = $this->itemlib->getActiveRatecard();
		$this->template->set('categories',$categories);
		$this->template->set('ratecards',$ratecards);
		$this->template->set('cat_id',$items[0]['cat_id']);
		$this->template->set('rate_id',$rate_id);
		$this->template->set('items',$items);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
						->title ( 'Administrator | Items' )
						->set_partial ( 'header', 'partials/header' )
						->set_partial ( 'leftnav', 'items/menu' )
						->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/Ratecard');
	}
	
	
	
	public function newRatecard() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Ratecard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/RatecardAdd');
	}
	
	public function addRatecard() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$item['created_on'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ItemLib');
		$response = $this->itemlib->addRatecard($params);
		echo json_encode($response);
	}
	
	public function editRatecard($id) {
		$this->load->library('zyk/ItemLib');
		$ratecards = $this->itemlib->getRatecardById($id);
		$this->template->set('ratecards',$ratecards);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Ratecard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'items/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/RatecardEdit');
	}
	
	public function updateRatecard() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$item['updated_on'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ItemLib');
		$response = $this->itemlib->updateRatecard($params);
		echo json_encode($response);
	}
	public function searchItem($type,$cat,$brand,$model,$subcat,$vendorid) {
		$product_name = $this->input->get('name');
		//echo "id=".$id;
		//echo "name=".$product_name;
		$params = array();
		//$params['id'] = $id;
        $type = isset($_SESSION['type']) ? $_SESSION['type'] : $type;
		$params['type'] = $type;
		$params['category_id'] = $cat;
		$params['brand_id'] = $brand;
		$params['model_id'] = $model;
		$params['subcategory_id'] = $subcat;
		$params['vendor_id'] = $vendorid;
		$params['product_name'] = $product_name;
		
		$this->load->library('zyk/ItemLib');
		$response = $this->itemlib->searchItemName($params);
		echo json_encode($response);
	}
	
	public function getItem($id,$type,$cat,$brand,$model,$subcat,$vendorid) {
		$this->load->library('zyk/ItemLib');
		//print_r($id);
		//print_r($rateid);
                $type = isset($_SESSION['type']) ? $_SESSION['type'] : $type;
		$response = $this->itemlib->getItemById($id,$type,$cat,$brand,$model,$subcat,$vendorid);
		//print_r($response);
		echo json_encode($response[0]);
	}
	
	public function vendor($cat_id=0) {
		$this->load->library('zyk/ItemLib');
		if($cat_id == 0) {
			$items = $this->itemlib->getVendorlist();
		} 
		else {
			$items = $this->itemlib->getVendorByCatId($cat_id);
		}
		$categories = $this->itemlib->getActiveCategories();
		$vendors = $this->itemlib->getActiveVendor();
		$this->template->set('categories',$categories);
		$this->template->set('vendors',$vendors);
		$this->template->set('cat_id',$cat_id);
		$this->template->set('vendor_id',$items[0]['id']);
		$this->template->set('items',$items);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
						->title ( 'Administrator | Items' )
						->set_partial ( 'header', 'partials/header' )
						->set_partial ( 'leftnav', 'items/menu' )
						->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/vendor');
	}
	
	public function vendor1($vendor_id=0) {
		$this->load->library('zyk/ItemLib');
		if($vendor_id == 0) {
			$items = $this->itemlib->getVendorlist();
		} 
		else {
			$items = $this->itemlib->getVendorId($vendor_id);
		}
		$categories = $this->itemlib->getActiveCategories();
		$vendors = $this->itemlib->getActiveVendor();
		$this->template->set('categories',$categories);
		$this->template->set('vendors',$vendors);
		$this->template->set('cat_id',$items[0]['cat_id']);
		$this->template->set('vendor_id',$vendor_id);
		$this->template->set('items',$items);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
						->title ( 'Administrator | Items' )
						->set_partial ( 'header', 'partials/header' )
						->set_partial ( 'leftnav', 'items/menu' )
						->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('items/vendor');
	}
	
}