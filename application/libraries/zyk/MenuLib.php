<?php
class MenuLib {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	public function getRestaurants($map){
		$this->CI->load->model ('restaurants/Menu_model', 'menu');
		$restaurants = $this->CI->menu->getMenuRestaurants($map);
		return $restaurants;
	}
	
	public function uploadSheet($template) {
	
		$this->CI->load->model ('restaurants/Menu_model', 'menu');
		$this->CI->load->model('restaurants/Restaurant_model','restaurant');
		$this->CI->load->model('restaurants/Items_model','items');
		$mcategories = $template['structure'];
		/*add main categories*/
		//print_r($mcategories);
		$category = array();
		foreach($mcategories as $key=>$row)
		{
			if(isset($row['categories']) && count($row['categories']) > 0) {
				$categories = $row['categories'];
				//print_r($categories);
				//exit;
				$csortorder = 1;
				foreach($categories as $key1=>$row1)
				{
					$items = $row1['items'];
					//print_r($items);
					foreach($items as $key3=>$row3)
					{
					$category = array('name'=>$row3['name'],'category_id'=>$row3['category_id'],'brand_id'=>$row3['brand_id'],'model_id'=>$row3['model_id'],'subcategory_id'=>$row3['subcategory_id'],'menu_uploaded'=>1);
					
					$menu_cat_id = $this->CI->menu->addcatofsubcat($category);
					}	
					$csortorder++;
				}
			}
		}
	
		$map['status'] = 1;
		$map['message'] = 'Sheet uploaded successfully.';
		return  $map;
	
	}
	
	public function uploadSpare($template) {
	
		$this->CI->load->model ('restaurants/Menu_model', 'menu');
		$this->CI->load->model('restaurants/Restaurant_model','restaurant');
		$this->CI->load->model('restaurants/Items_model','items');
		$mcategories = $template['structure'];
		$vendor_id = $template['vendor_id'];
		/*add main categories*/
		//print_r($mcategories);
		$category = array();
		foreach($mcategories as $key=>$row)
		{
			if(isset($row['categories']) && count($row['categories']) > 0) {
				$categories = $row['categories'];
				//print_r($categories);
				//exit;
				$csortorder = 1;
				foreach($categories as $key1=>$row1)
				{
					$items = $row1['items'];
					//print_r($items);
					foreach($items as $key3=>$row3)
					{
						$category = array('vendor_id'=>$vendor_id,'name'=>$row3['name'],'category_id'=>$row3['category_id'],'brand_id'=>$row3['brand_id'],'model_id'=>$row3['model_id'],'subcategory_id'=>$row3['subcategory_id'],'catsubcat_id'=>$row3['catsubcat_id'],'price'=>$row3['price'],'tax'=>$row3['tax'],'menu_uploaded'=>1);
							
						$menu_cat_id = $this->CI->menu->addSpare($category);
					}
					$csortorder++;
				}
			}
		}
	
		$map['status'] = 1;
		$map['message'] = 'Sheet uploaded successfully.';
		return  $map;
	
	}
	
	public function uploadService($template) {
	
		$this->CI->load->model ('restaurants/Menu_model', 'menu');
		$this->CI->load->model('restaurants/Restaurant_model','restaurant');
		$this->CI->load->model('restaurants/Items_model','items');
		$mcategories = $template['structure'];
		$vendor_id = $template['vendor_id'];
		/*add main categories*/
		//print_r($mcategories);
		$category = array();
		foreach($mcategories as $key=>$row)
		{
			if(isset($row['categories']) && count($row['categories']) > 0) {
				$categories = $row['categories'];
				//print_r($categories);
				//exit;
				$csortorder = 1;
				foreach($categories as $key1=>$row1)
				{
					$items = $row1['items'];
					//print_r($items);
					foreach($items as $key3=>$row3)
					{
						$category = array('vendor_id'=>$vendor_id,'name'=>$row3['name'],'category_id'=>$row3['category_id'],'brand_id'=>$row3['brand_id'],'model_id'=>$row3['model_id'],'subcategory_id'=>$row3['subcategory_id'],'catsubcat_id'=>$row3['catsubcat_id'],'price'=>$row3['price'],'tax'=>$row3['tax'],'menu_uploaded'=>1);
							
						$menu_cat_id = $this->CI->menu->addService($category);
					}
					$csortorder++;
				}
			}
		}
	
		$map['status'] = 1;
		$map['message'] = 'Sheet uploaded successfully.';
		return  $map;
	
	}
	
	
	public function updateitems($items) {
		$this->CI->load->model('restaurants/Menu_model','menus');
		$item_batch = array();
		$price_batch = array();
		$restid = 0;
		
		
		foreach($items as $item)
		{
			$restid = $item['restid'];
			if(!empty($item['vat_tax'])) {
				$vat_tax = $item['vat_tax'];
			} else {
				$vat_tax = 0;
			}
			if(!empty($item['service_tax'])) {
				$service_tax = $item['service_tax'];
			} else {
				$service_tax = 0;
			}
			if(empty($item['image'])) {
				$item['image'] = '';
			}
			$item_batch [] = array('id'=>$item['id'],'name'=>$item['name'],'sortorder'=>$item['sortorder'],'restid'=>$item['restid'],'menu_cat_id'=>$item['menu_cat_id'],'description'=>$item['description'],'video_url'=>'','image'=>$item['image'],'vat_tax'=>$vat_tax,'service_tax'=>$service_tax);
			$price_batch [] = $item['price'];
			
			
			
		}
		
		$this->CI->load->model('restaurants/Items_model','items');
		$this->CI->items->updateMenuItems($item_batch);
		$this->CI->items->updateMenuItemPrices($price_batch);
		if($restid > 0) {
			$this->CI->load->model('restaurants/Restaurant_model','restaurant');
			$this->CI->restaurant->updateRestaurantDetails(array('id'=>$restid,'menu_uploaded'=>1));
		}
		$map['message'] = 'items updated successfully';
		$map['status'] = 1;
		
		// ***************For Log Details****************************
		$log[0]['comment'] = '';
		$log[0]['page_name'] = 'Restaurant  Menu Edit';
		$log[0]['field_name'] = "Update Menu Items";
		$log[0]['restid'] = $restid;
		$log[0]['old_value'] = '';
		$log[0]['new_value'] = '';
		$log[0]['updated_by'] = $_SESSION['adminsession']['id'];
		$log[0]['updated_datetime']=date("Y-m-d H:i:s");
		$this->addMenuPublishLogs($log);
		
		return $map;
	}
	
	public function completemenu($restid) {
		$this->CI->load->model('restaurants/Menu_model','menu');
		$this->CI->load->model('restaurants/Items_model','items');
		$batch = array();
		$batch = json_decode($this->CI->items->getMenuItems($restid)[0]['menu'],true);
		return $batch;
	}
	
	public function publishmenu($data) {
		//print_r($data);
		$comment = $data['comment'];
		$restid = $data['restid'];
		
		$map['restid'] = $restid;
		$this->CI->load->model('restaurants/Menu_model','menus');
		$this->CI->load->model('restaurants/Restaurant_model','restaurant');
		$batch = array();
		$this->CI->load->model('restaurants/items_model','items');
		$this->CI->load->model('restaurants/options_model','options');
		$mcategories = $this->CI->menus->getMainCategoriesForRestaurant($map);
		$categories = $this->CI->menus->getCategoriesForRestaurant($map);
		$items = $this->CI->items->getPublishedMenuItemsForRestaurant($map);
		$ocategories = $this->CI->options->getItemOptionCategoriesForMenu($map);
		$options = $this->CI->options->getItemOptionsForMenu($map);
			
		/* group options under categories first, then link these to items below*/
		$subitems = array();
		$custom = array();
		$group = array();
		$cats = array();
		$item = array();
		$subitems = array();
		$choices = array();
		$i = 0;
		foreach($mcategories as $key=>$row) {
			$group [$i] = $row;
			$c = 0;
			foreach($categories as $key1=>$row1)
			{
				if($row1['menu_mcat_id'] == $row['id'])
				{
					$cats[$c] = $row1;
					foreach($items as $key2=>$row2)
					{
						if($row2['menu_cat_id'] == $row1['id'])
						{
							$choices = array();
							/* size grouping has to be done here*/
							foreach($ocategories as $key3=>$row3)
							{
								if($row2['option_id'] == $row3['option_id'])
								{
									foreach($options as $key4=>$row4)
									{
										if($row3['new_sub_item_key'] == $row4['new_sub_item_key'])
										{
											$subitems [] = $row4;
										}
									}
									if(!empty($subitems) && count($subitems) > 0)
										$row3['subitems'] = $subitems;
									unset($subitems);
									$choices [] = $row3;
								}
							}
							if(count($choices) > 0)
								$row2['options'] = $choices;
							unset($choices);
							$item [$row2['id']][$row2['size'].'_'.$row2['id']] = $row2;
						}
					}
					if(!empty($item) && count($item) > 0)
						$cats[$c]['items'] = $item;
					if(empty($item) || count($item) <=0) {
						unset($cats[$c]);
					}else {
						$c++;
					}
					unset($item);
				}
			}
			if(count($cats) > 0)
				$group [$i]['categories']  = $cats;
			if(count($cats) <=0) {
				unset($group [$i]);
			}else {
				$i++;
			}
			unset($cats);
		}
		$batch [] = array('menu'=>json_encode($group),'restid'=>$map['restid'],'menu_id'=>$map['restid'],'last_publish_date'=>date('Y-m-d'));
		$this->CI->menus->purgeMenuFromStorage( $map['restid'] );
		$this->CI->menus->addMenuToStorage( $batch );
		$log[0]['comment'] = $comment;
		$log[0]['page_name'] = 'Menu List';
		$log[0]['field_name'] = "publish menu";
		$log[0]['restid'] = $map['restid'];
		$log[0]['old_value'] = '0';
		$log[0]['new_value'] = '1';
		$log[0]['updated_by'] = $_SESSION['adminsession']['id'];
		$log[0]['updated_datetime']=date("Y-m-d H:i:s");
		$this->addMenuPublishLogs($log);
		//print_r($batch);
		$this->CI->restaurant->updateRestaurantConfig(array('restid'=>$map['restid'],'menu'=>1));
		$this->CI->restaurant->updateRestaurantDetails(array('id'=>$map['restid'],'menu_uploaded'=>2));
		
	}
	
	public function getMenuTemplate($restid) {
		$map['restid'] = $restid;
		$type = 'old';
		$this->CI->load->model('restaurants/Menu_model','menus');
		switch($type)
		{
			case 'new':
				$data['mcategories'] = $this->CI->menus->getMainCategoriesForNewRestaurant($map);
				$data['categories'] = $this->CI->menus->getCategoriesForNewRestaurant($map);
				break;
	
			case 'old':
				$data['mcategories'] = $this->CI->menus->getMainCategoriesForRestaurant($map);
				$data['categories'] = $this->CI->menus->getCategoriesForRestaurant($map);
				break;
		}
		return $data;
	}
	
	public function getMenuItems($restid) {
		$this->CI->load->model('restaurants/Items_model','items');
		$items = $this->CI->items->getMenuItemsForRestaurant($restid);
		return $items;
	}
	
	public function addsection($type,$data) {
		switch($type)
		{
			case 'maincategory':
				$this->CI->load->model('restaurants/Menu_model','menus');
				$id = $this->CI->menus->addMainCategory($data);
	
				break;
	
			case 'category':
				$this->CI->load->model('restaurants/Menu_model','menus');
				$id = $this->CI->menus->addCategory($data);
					
				break;
		}
		 
		$map['id'] = $id;
		$map['type'] = $type;
		$map['name'] = $data['name'];
		$map['msg'] = 'Added successfully.';
		return $map;
	}
	
	function updateCategory($data) {
		$this->CI->load->model('restaurants/Menu_model','menu');
		$this->CI->menu->updateMenuCat($data);
		$data['msg'] = 'updated successfully';
		return $data;
	}
	
	function updateMainCategory($data) {
		$this->CI->load->model('restaurants/Menu_model','menu');
		$this->CI->menu->updateMainMenuCat($data);
		$data['msg'] = 'updated successfully';
		print_r($this->getMenuTemplate($data['restid']));
		return $data;
	}
	
	function addMenuOptions($template) {
		/* entire menu structure*/
		$map['restid'] = $template['restid'];
		$options = array();
		$cbatch = array();
		$price_batch = array();
		$item_options = array();
		$this->CI->load->model('restaurants/Options_model','options');
		$structure = $template['structure'];
		//print_r($structure);
		//exit;
		if($template['type'] == 'group') /* new option categories as well as options*/
		{
			foreach($structure as $ocategories)
			{
				$category = array('id'=>$ocategories['id'],'option_cat_name'=>$ocategories['option_cat_name'],'sortorder'=>$ocategories['sortorder'],'description'=>$ocategories['description'],'optional_flag'=>$ocategories['optional_flag'],'choice_type'=>$ocategories['choice_type'],'min_options'=>$ocategories['min_options'],'max_options'=>$ocategories['max_options']);
				$item_options [] = array('id'=>$ocategories['id'],'has_options'=>1);
				/*add category and update subitem key*/
				$option_cat_id = $this->CI->options->addItemOptionCategory( $category );
				$category['new_sub_item_key'] = $category['id'].'_'.$ocategories['size'].'_'.$option_cat_id;
				$category['option_cat_id'] = $option_cat_id;
				$batch [] = $category;
	
				/* add options */
				foreach($ocategories['options'] as $item) {
					if(empty($item['image'])) {
						$item['image'] = '';
					}
					$options = array('sub_item_name'=>$item['sub_item_name'],'image'=>$item['image'],'description'=>$item['description']);
					$options['new_sub_item_key'] = $category['id'].'_'.$ocategories['size'].'_'.$option_cat_id;
						
					/* add option and link price for batch insert*/
					$sub_item_id = $this->CI->options->addItemOption($options);
					$item['price']['sub_item_id'] = $sub_item_id;
					$price_batch [] = $item['price'];
					unset($options);
				}
				unset($category);
			}
			$this->CI->options->updateItemOptionCategories($batch);
			$this->CI->options->addItemOptionPrices($price_batch);
			$this->CI->options->upgradeItems($item_options);
		}
		if($template['type'] == 'single') /* only options added to an existing option category*/
		{
			foreach($structure as $option)
			{
				if(empty($option['image'])) {
					$option['image'] = '';
				}
				$options = array('sub_item_name'=>$option['sub_item_name'],'image'=>$option['image'],'description'=>$option['descriptions'],'new_sub_item_key'=>$option['new_sub_item_key']);
					
				/* add option and link price for batch insert*/
				$sub_item_id = $this->CI->options->addItemOption($options);
				$option['price']['sub_item_id'] = $sub_item_id;
				$price_batch [] = $option['price'];
				unset($options);
			}
			$this->CI->options->addItemOptionPrices($price_batch);
		}
	
		$map['message'] = 'items added successfully';
		$map['restid'] = $map['restid'];
		unset($batch);unset($price_batch);unset($item_options);
		return $map;
	}
	
	public function updateMenuOptions($template) {
		$map['restid'] = $template['restid'];
		$options = array();
		$cbatch = array();
		$price_batch = array();
		$options_batch = array();
		$purge_batch = array();
		$this->CI->load->model('restaurants/Options_model','options');
		
		/*add main categories*/
		$structure = $template['structure'];
		foreach($structure as $ocategories)
		{
			$category = array('option_cat_id'=>$ocategories['option_cat_id'],'new_sub_item_key'=>$ocategories['new_sub_item_key'],'id'=>$ocategories['id'],'option_cat_name'=>$ocategories['option_cat_name'],'sortorder'=>$ocategories['sortorder'],'description'=>$ocategories['description'],'optional_flag'=>$ocategories['optional_flag'],'choice_type'=>$ocategories['choice_type'],'min_options'=>$ocategories['min_options'],'max_options'=>$ocategories['max_options']);
			/*add category and update subitem key*/
			$batch [] = $category;
		
			/* add options */
			foreach($ocategories['options'] as $item) {
				if(empty($item['image'])) {
					$item['image'] = '';
				}
				$options = array('sub_item_id'=>$item['sub_item_id'],'sub_item_name'=>$item['sub_item_name'],'image'=>$item['image'],'description'=>$item['description']);
				/* sub_item_id has a one to many relation ship with price table, so delete the old ones first*/
				$purge_batch [] = $item['sub_item_id'];
				/* add option and link price for batch insert*/
				$price_batch [] = $item['price'];
				$options_batch [] = $options;
				unset($options);
			}
			unset($category);
		}
		$this->CI->options->updateItemOptionCategories($batch);
		$this->CI->options->updateItemOptions($options_batch);
		$this->CI->options->deleteItemOptionPrices($purge_batch);
		$this->CI->options->addItemOptionPrices($price_batch);
		$map['message'] = 'items added successfully';
		return $map;
	}
	
	public function getOptionTemplate($map) {
		$map['template'] = 'yes';
		$this->CI->load->model('restaurants/Options_model','options');
		$data['categories'] = $this->CI->options->getItemOptionCategoriesForMenu( $map );
		$data['options'] = $this->CI->options->getItemOptionsForMenu( $map );
		return $data;
	}
	
	public function editCategorySortorder($id,$sortorder) {
		$data = array('id'=>$id,'sortorder'=>$sortorder);
		$this->CI->load->model('restaurants/Menu_model','menu');
		$this->CI->menu->updateMenuSortOrder($data);
	}
	public function addRestaurantLogs($olddata,$newdata,$page)
	{
	
		unset($newdata['created_date']);
		$i = 0;
		$j = 0;
		$log[] = array();
		foreach($newdata as $key2=>$value2)
		{
	
			foreach($olddata[0] as $key1 => $value1)
			{
				if($key1==$key2)
				{
					if($value1!=$value2)
					{
						$log[$j]['comment'] = '';
						$log[$j]['page_name'] = $page;
						$log[$j]['field_name'] = $key1;
						$log[$j]['restid'] = $newdata['restid'];
						$log[$j]['old_value'] = $value1;
						$log[$j]['new_value'] = $value2;
						$log[$j]['updated_by'] = $_SESSION['adminsession']['id'];
						$log[$j]['updated_datetime']=date("Y-m-d H:i:s");
						$j++;
					}
					$i++;
				}
			}
				
		}
		$this->CI->load->model ('restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->addRestaurantLogs($log);
	
	}
	public function addMenuPublishLogs($log)
	{
		$this->CI->load->model ('restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->addRestaurantLogs($log);
	}
	
	public function turnOffItem ($size_id,$restid) {
		$this->CI->load->model('restaurants/Items_model','items');
		$this->CI->items->turnOffItem($size_id);
		$data = array();
		$data['comment'] = "Item (".$size_id.") Turned Off From Client";
		$data['restid'] = $restid;
		$this->publishmenu($data);
	}
	
	public function turnOnItem ($size_id,$restid) {
		$this->CI->load->model('restaurants/Items_model','items');
		$this->CI->items->turnOnItem($size_id);
		$data = array();
		$data['comment'] = "Item (".$size_id.") Turned Off From Client";
		$data['restid'] = $restid;
		$this->publishmenu($data);
	}
}
