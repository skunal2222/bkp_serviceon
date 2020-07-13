<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );

class Service_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	/************** code by kunal *******************/

	public function getServiceTypeCharges($data)
	{
		if ($data['st'] == 1) {
			$tbl = TABLES::$PICKUP_CHARGE;
		} else if($data['st'] == 2) {
			$tbl = TABLES::$BREAKDOWN_CHARGE;
		}

		$this->db->where('minkm <=', $data['distance']);
		$this->db->where('maxkm >=', $data['distance']);
		$q = $this->db->get($tbl);
		$result = $q->row_array();
		return $result;
	}
	
	public function getActiveServiceGroupsName($data=ARRAY())
	{
		$this->db->select('id,name');
		if (!empty($data['id'])) {
			$this->db->where_in('id', $data['id']);
		}
		$this->db->from( TABLES::$SERVICE_GROUP);
		$this->db->where('status',1);
		$q = $this->db->get();
		return $q->result_array();
	}

	public function getActiveBikeBrandsByName($data=ARRAY())
	{
		$this->db->select('id,name');
		if (!empty($data['name'])) {
			$this->db->like('name', $data['name'], 'both');
		}
		$this->db->from( TABLES::$BRAND);
		$this->db->where('status',1);
		$q = $this->db->get();
		return $q->result_array();
	}

	public function getModelsByBrandsID($data=ARRAY())
    {
        $this->db->select('id, name');
        $this->db->from(TABLES::$MANUFACTURE);
        if (!empty($data['brandId'])) {
            $this->db->where_in('brand_id',$data['brandId']);
        }
        $this->db->where('status',1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

	/************** code by kunal *******************/

	public function addCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$MENU_MAIN_CATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$MENU_MAIN_CATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Category name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getActiveCategories() {
		$this->db->select ( '*' )->from ( TABLES::$MENU_MAIN_CATEGORY );
		//$this->db->where ( 'status', 1 );
		$this->db->order_by ( 'id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getActiveCategoriesbook() {
		$this->db->select ( '*' )->from ( TABLES::$MENU_MAIN_CATEGORY );
		$this->db->where ( 'status', 1 );
		$this->db->order_by ( 'id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function updateCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$MENU_MAIN_CATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$MENU_MAIN_CATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Category name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getCategoryById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MENU_MAIN_CATEGORY );
		$this->db->where ( 'id', $id );
		$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getEditCategoryById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MENU_MAIN_CATEGORY );
		$this->db->where ( 'id', $id );
		//$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addSubCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'brand_id' => $cat ['brand_id'],
				'model_id' => $cat ['model_id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$MENU_MAIN_SUBCATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$MENU_MAIN_SUBCATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "SubCategory,Brand,Model already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getActiveSubCategories() {
		$this->db->select ( 'a.*,b.name as category,b.id as catid,c.name as brand,c.id as brandid,d.name as model,d.id as modelid', FALSE )->from ( TABLES::$MENU_MAIN_SUBCATEGORY . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' )->join ( TABLES::$BRAND . ' AS c', 'a.brand_id = c.id', 'inner' )->join ( TABLES::$MANUFACTURE . ' AS d', 'a.model_id = d.id', 'inner' );
		//$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getActiveSubCategories1() {
		$this->db->select ( 'a.*,b.name as category,c.name as brand,d.name as model', FALSE )->from ( TABLES::$MENU_MAIN_SUBCATEGORY . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' )->join ( TABLES::$BRAND . ' AS c', 'a.brand_id = c.id', 'inner' )->join ( TABLES::$MANUFACTURE . ' AS d', 'a.model_id = d.id', 'inner' );
		$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getSubCatId($model_id) {
		$this->db->select ( 'a.*,b.name as model_name', FALSE )->from ( TABLES::$MENU_MAIN_SUBCATEGORY . ' AS a' )->join ( TABLES::$MANUFACTURE . ' AS b', 'a.model_id = b.id', 'inner' );
		$this->db->where ( 'a.status', 1 );
		$this->db->where ( 'model_id', $model_id );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function getBrandId($category_id) {
		$this->db->select ( 'a.*', FALSE )->from ( TABLES::$BRAND . ' AS a' );
		$this->db->where ( 'a.status', 1 );
		$this->db->where ( 'category_id', $category_id );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function getModelbyBrandId($brand_id) {
		$this->db->select ( 'a.*', FALSE )->from ( TABLES::$MANUFACTURE . ' AS a' );
		$this->db->where ( 'a.status', 1 );
		$this->db->where ( 'a.brand_id', $brand_id );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function getCatsubcatid($subcat_id) {
		$this->db->select ( 'a.*', FALSE )->from ( TABLES::$CATEGORY_SUBCATEGORY . ' AS a' );
		$this->db->where ( 'a.status', 1 );
		$this->db->where ( 'a.subcategory_id', $subcat_id );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function getCatsubcatid1($subcat_id) {
		$this->db->select ( 'a.*', FALSE )->from ( TABLES::$CATEGORY_SUBCATEGORY . ' AS a' );
		$this->db->where ( 'a.status', 1 );
		$this->db->where_in ( 'a.subcategory_id', $subcat_id );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function getModelbyBrandId1($brand_id) {
		$this->db->distinct ( 'b.name as brand_name' );
		$this->db->select ( 'a.*,b.id as b_id,b.name as brand_name', FALSE )->from ( TABLES::$MANUFACTURE . ' AS a' )->join ( TABLES::$BRAND . ' AS b', 'a.brand_id = b.id', 'inner' );
		$this->db->where_in ( 'a.brand_id', $brand_id );
		$this->db->where ( 'a.status', 1 );
		// $this->db->group_by ('a.brand_id','ASC');
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function getSerCatId($subcategory_id) {
		$this->db->select ( 'a.*,b.name as subcategory', FALSE )->from ( TABLES::$SERVICE . ' AS a' )->join ( TABLES::$MENU_MAIN_SUBCATEGORY . ' AS b', 'a.subcategory_id = b.id', 'inner' );
		$this->db->where ( 'a.subcategory_id', $subcategory_id );
		$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function getSersubCatId($subcategory_id) {
		$this->db->select ( 'a.*,b.name as subcategory', FALSE )->from ( TABLES::$SERVICE . ' AS a' )->join ( TABLES::$CATEGORY_SUBCATEGORY . ' AS b', 'a.catsubcat_id = b.id', 'inner' );
		$this->db->where ( 'a.catsubcat_id', $subcategory_id );
		$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function getSerCatId1($subcategory_id) {
		$this->db->select ( 'a.*,b.name as subcategory', FALSE )->from ( TABLES::$SERVICE . ' AS a' )->join ( TABLES::$MENU_MAIN_SUBCATEGORY . ' AS b', 'a.subcategory_id = b.id', 'inner' );
		$this->db->where_in ( 'a.subcategory_id', $subcategory_id );
		$this->db->where ( 'a.status', 1 );
		// $this->db->order_by ('a.id','ASC');
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function updateSubCategory($cat) {
		/* $data = array ();
		$params = array (
				//'name' => $cat ['name'],
				'id !=' => $cat ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$MENU_MAIN_SUBCATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) { */
			
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$MENU_MAIN_SUBCATEGORY, $cat );
			// echo $this->db->last_query();
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		/* } else {
			$data ['msg'] = "SubCategory name already exists.";
			$data ['status'] = 0;
			return $data;
		} */
	}
	public function getSubCategoryById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MENU_MAIN_SUBCATEGORY );
		$this->db->where ( 'id', $id );
		$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getEditSubCategoryById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MENU_MAIN_SUBCATEGORY );
		$this->db->where ( 'id', $id );
		//$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function addService($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'brand_id' => $cat ['brand_id'],
				'model_id' => $cat ['model_id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$SERVICE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$SERVICE, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Service,Brand,Model,Subcategory already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getActiveServices() {
		$this->db->select ( 'a.*,b.name as category,c.name as brand,d.name as model,e.name as subcategory,f.name as subcat', FALSE )->from ( TABLES::$SERVICE . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' )->join ( TABLES::$BRAND . ' AS c', 'a.brand_id = c.id', 'inner' )->join ( TABLES::$MANUFACTURE . ' AS d', 'a.model_id = d.id', 'inner' )->join ( TABLES::$MENU_MAIN_SUBCATEGORY . ' AS e', 'a.subcategory_id = e.id', 'inner' )->join ( TABLES::$CATEGORY_SUBCATEGORY . ' AS f', 'a.catsubcat_id = f.id', 'inner' );
		//$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$this->db->limit(200);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function updateService($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'brand_id' => $cat ['brand_id'],
				'model_id' => $cat ['model_id'],
				'id !=' => $cat ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$SERVICE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$SERVICE, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Service name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getServiceById($id) {
		$this->db->select ( '*' )->from ( TABLES::$SERVICE );
		$this->db->where ( 'id', $id );
		$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getEditServiceById($id) {
		$this->db->select ( '*' )->from ( TABLES::$SERVICE );
		$this->db->where ( 'id', $id );
		//$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function addcatSubcat($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'brand_id' => $cat ['brand_id'],
				'model_id' => $cat ['model_id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$CATEGORY_SUBCATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$CATEGORY_SUBCATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Service,Brand,Model,Subcategory already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getActivecatSubcat() {
		$this->db->select ( 'a.*,b.name as category,c.name as brand,d.name as model,e.name as subcategory', FALSE )->from ( TABLES::$CATEGORY_SUBCATEGORY . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' )->join ( TABLES::$BRAND . ' AS c', 'a.brand_id = c.id', 'inner' )->join ( TABLES::$MANUFACTURE . ' AS d', 'a.model_id = d.id', 'inner' )->join ( TABLES::$MENU_MAIN_SUBCATEGORY . ' AS e', 'a.subcategory_id = e.id', 'inner' );
		$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getActiveListcatSubcat() {
		$this->db->select ( 'a.*,b.name as category,b.id as catid,c.name as brand,c.id as brandid,d.name as model,d.id as modelid,e.name as subcategory,e.id as subcatid', FALSE )->from ( TABLES::$CATEGORY_SUBCATEGORY . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' )->join ( TABLES::$BRAND . ' AS c', 'a.brand_id = c.id', 'inner' )->join ( TABLES::$MANUFACTURE . ' AS d', 'a.model_id = d.id', 'inner' )->join ( TABLES::$MENU_MAIN_SUBCATEGORY . ' AS e', 'a.subcategory_id = e.id', 'inner' );
		//$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$this->db->limit(200);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function updatecatSubcat($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'brand_id' => $cat ['brand_id'],
				'model_id' => $cat ['model_id'],
				'id !=' => $cat ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$CATEGORY_SUBCATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$CATEGORY_SUBCATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Category of subcategory name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getcatSubcatById($id) {
		$this->db->select ( '*' )->from ( TABLES::$CATEGORY_SUBCATEGORY );
		$this->db->where ( 'id', $id );
		$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getEditcatSubcatById($id) {
		$this->db->select ( '*' )->from ( TABLES::$CATEGORY_SUBCATEGORY );
		$this->db->where ( 'id', $id );
		//$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function addSpare($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'brand_id' => $cat ['brand_id'],
				'model_id' => $cat ['model_id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$SPARE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$SPARE, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Service,Brand,Model already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getActiveSpares() {
		$this->db->select ( 'a.*,b.name as category,c.name as brand,d.name as model,e.name as subcategory', FALSE )->from ( TABLES::$SPARE . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' )->join ( TABLES::$BRAND . ' AS c', 'a.brand_id = c.id', 'inner' )->join ( TABLES::$MANUFACTURE . ' AS d', 'a.model_id = d.id', 'inner' )->join ( TABLES::$MENU_MAIN_SUBCATEGORY . ' AS e', 'a.subcategory_id = e.id', 'inner' );
		//$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$this->db->limit(200);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function updateSpare($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'brand_id' => $cat ['brand_id'],
				'model_id' => $cat ['model_id'],
				'id !=' => $cat ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$SPARE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$SPARE, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Spare name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getSpareById($id) {
		$this->db->select ( '*' )->from ( TABLES::$SPARE );
		$this->db->where ( 'id', $id );
		$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getEditSpareById($id) {
		$this->db->select ( '*' )->from ( TABLES::$SPARE );
		$this->db->where ( 'id', $id );
		//$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function addModel($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$MANUFACTURE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$MANUFACTURE, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Manufacture name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getActiveModels() {
		$this->db->select ( 'a.*,b.name as category,c.name as brand', FALSE )->from ( TABLES::$MANUFACTURE . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' )->join ( TABLES::$BRAND . ' AS c', 'a.brand_id = c.id', 'inner' );
		//$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function updateModel($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$MANUFACTURE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$MANUFACTURE, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Manufacture name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getModelById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MANUFACTURE );
		$this->db->where ( 'id', $id );
		$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getEditModelById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MANUFACTURE );
		$this->db->where ( 'id', $id );
		//$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addBrand($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'category_id' => $cat ['category_id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$BRAND )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$BRAND, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Brand name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getActiveBrands() {
		$this->db->select ( 'a.*,b.name as category', FALSE )->from ( TABLES::$BRAND . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' );
		//$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function updateBrand($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'category_id' => $cat ['category_id'],
				'id !=' => $cat ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$BRAND )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$BRAND, $cat );
			// echo $this->db->last_query();
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Brand name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getBrandById($id) {
		$this->db->select ( 'a.*,b.name as category', FALSE )->from ( TABLES::$BRAND . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' );
		$this->db->where ( 'a.id', $id );
		$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getEditBrandById($id) {
		$this->db->select ( 'a.*,b.name as category', FALSE )->from ( TABLES::$BRAND . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' );
		$this->db->where ( 'a.id', $id );
		//$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addMainStatus($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'parent_id' => $cat ['parent_id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$MAIN_STATUS )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$MAIN_STATUS, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Status name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function updateMainStatus($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'parent_id' => $cat ['parent_id'],
				'id !=' => $cat ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$MAIN_STATUS )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$MAIN_STATUS, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Status name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getActiveMainStatus() {
		$this->db->select ( 'a.id, a.name, a.status, b.id as parent_id, b.name as parent_name' )
		->from ( TABLES::$MAIN_STATUS . ' as a' )
		->join ( TABLES::$MAIN_STATUS . ' as b', 'a.parent_id = b.id', 'Left' );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveMainStatus1() {
		$this->db->select ( '*' )
		->from ( TABLES::$MAIN_STATUS );
		$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getMainStatusById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MAIN_STATUS );
		$this->db->where ( 'id', $id );
		$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		// echo $this->db->last_query();
		return $result;
	}
	
	public function getEditMainStatusById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MAIN_STATUS );
		$this->db->where ( 'id', $id );
		//$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		// echo $this->db->last_query();
		return $result;
	}
	
	public function addstaticSubCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$STATIC_SUBCATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$STATIC_SUBCATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "SubCategory name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getstaticSubCategories() {
		$this->db->select ( '*' )->from ( TABLES::$STATIC_SUBCATEGORY );
		//$this->db->where ( 'status', 1 );
		$this->db->order_by ( 'id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getActivestaticSubCategories() {
		$this->db->select ( '*' )->from ( TABLES::$STATIC_SUBCATEGORY );
		$this->db->where ( 'status', 1 );
		$this->db->order_by ( 'id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function updatestaticSubCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$STATIC_SUBCATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$STATIC_SUBCATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "SubCategory name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getstaticSubCategoryById($id) {
		$this->db->select ( '*' )->from ( TABLES::$STATIC_SUBCATEGORY );
		$this->db->where ( 'id', $id );
		//$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getPackage($order_id)
	{
		$result = 	$this->db->select('a.*,b.remaining_service_count,b.invoice_url,b.id as tbl_user_pack_id,c.vehicle_no,c.id as vehicle_id,d.name as brand,e.name as model,b.expiry_date,b.created_date as subscribe_date,b.remaining_service_count')
					 ->from('packages a')
					 ->join('tbl_user_package b','a.id = b.package_id','inner')
					 ->join('tbl_user_vehicles c','c.id = b.vehicle_id','left')
					 ->join('brand d','d.id = c.brand_id','left')
					 ->join('manufacturer e','e.id = c.model_id','left')
					 ->where('b.order_ids',$order_id)
					 ->where('is_expire',1)
					 ->get()
					 ->result_array();
		if(!empty($result))
		{
			foreach ($result as $key => $value) {
			$result[$key]['service_used'] = $value['service_used_validity'] - $value['remaining_service_count'];
			$orders=  $this->db->select('t.ordercode')
								        ->from('tbl_booking as t')
								        ->join('tbl_booking_services bs','bs.orderid = t.orderid','inner')
								        ->where('bs.is_package_service',$value['tbl_user_pack_id'])
								        ->group_by('bs.orderid')
								        ->order_by('t.orderid','desc')
								        ->get()
								        ->result_array();
				//echo $orders[0]['ordercode']."<br/>";
				$result[$key]['prev_order'] = isset($orders[0]['ordercode']) ? $orders[0]['ordercode']:'';
				//$result[$key]['prev_order']= $orders[0]['ordercode'];
				$services = $this->db->select('s.*,ps.service_used_validity')
									   ->from('package_services ps')
									   ->join('service s','s.id = ps.service_id')
									   ->where('ps.package_id',$value['id'])
									   ->get()
									   ->result_array();
					if(!empty($services))
					{ 
						$service_used = 0;
						foreach ($services as $k => $v) {
							$service_used =$this->db->select('count(service_id) as service_used')->get_where('tbl_booking_services',array('service_id'=>$v['id'],'is_package_service'=>$value['tbl_user_pack_id']))->row('service_used');
							$services[$k]['remaing_service'] = $v['service_used_validity'] - $service_used;
							$services[$k]['service_used'] = $service_used;
						}
					}
				$result[$key]['services'] = $services;
			}
		}
		return $result;
	}
}