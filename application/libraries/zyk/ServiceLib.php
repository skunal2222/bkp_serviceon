<?php
class ServiceLib {
	public function __construct() {
		$this->CI = & get_instance ();
	}
	public function getServiceTypeCharges($data) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->getServiceTypeCharges ( $data );
		return $result;
	}

	public function addCategory($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->addCategory ( $cat );
		return $result;
	}
	public function getActiveCategories() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveCategories ();
		return $response;
	}
	public function getActiveSubcategory() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->getActiveSubcategory ();
		return $result;
	}
	public function getSubcatId_new($data) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->getSubcatId_new ($data);
		return $result;
	}
	public function getAllCategories() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getAllCategories ();
		return $response;
	}
	public function getActiveCategoriesbook() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveCategoriesbook ();
		return $response;
	}
	public function updateCategory($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->updateCategory ( $cat );
		return $result;
	}
	public function getCategoryById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getCategoryById ( $cat_id );
		return $response;
	}
	public function getEditCategoryById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getEditCategoryById ( $cat_id );
		return $response;
	}
	public function addSubCategory($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->addSubCategory ( $cat );
		return $result;
	}
	public function getActiveSubCategories() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveSubCategories ();
		return $response;
	}
	public function getActiveServiceGroups() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveServiceGroups ();
		return $response;
	}

	public function getActiveServiceGroupsName($data=ARRAY()) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveServiceGroupsName ($data);
		return $response;
	}
	public function getActiveSubCategories1() { 
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveSubCategories1 ();
		return $response;
	}
	
	public function getSubCatIdAll() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getSubCatIdAll ();
		return $response;
	}

	public function getSubCatId($model_id="") {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getSubCatId ( $model_id );
		return $response;
	}
	public function getBrandId($category_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getBrandId ( $category_id );
		return $response;
	}
	public function getEditBrandById($category_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getEditBrandById ( $category_id );
		return $response;
	}
	public function getModelbyBrandId($brand_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getModelbyBrandId ( $brand_id );
		return $response;
	}
	public function getModelbyBrandId1($brand_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getModelbyBrandId1 ( $brand_id );
		return $response;
	}
	public function getmodelsbybrid($brand_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getmodelsbybrid( $brand_id );
		return $response;
	}
	public function getSerCatId($subcategory_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getSerCatId ( $subcategory_id );
		return $response;
	}
	public function getSersubCatId($subcategory_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getSersubCatId ( $subcategory_id );
		return $response;
	}
	public function getSerCatId1($subcategory_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getSerCatId1 ( $subcategory_id );
		return $response;
	}
        
   	public function getSerCatId3($subcategory_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getSerCatId3 ( $subcategory_id );
		return $response;
	}
	public function getservicesbysubcat($subcategory_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getservicesbysubcat ( $subcategory_id );
		return $response;
	}
	public function updateSubCategory($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->updateSubCategory ( $cat );
		return $result;
	}
	public function getSubCategoryById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getSubCategoryById ( $cat_id );
		return $response;
	}
	public function getEditSubCategoryById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getEditSubCategoryById ( $cat_id );
		return $response;
	}
	public function addcatSubcat($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->addcatSubcat ( $cat );
		return $result;
	}
	public function getActivecatSubcat() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActivecatSubcat ();
		return $response;
	}
	public function getActiveListcatSubcat($vendorid=NULL) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveListcatSubcat ($vendorid);
		return $response;
	}
	public function updatecatSubcat($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->updatecatSubcat ( $cat );
		return $result;
	}
	public function getcatSubcatById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getcatSubcatById ( $cat_id );
		return $response;
	}
	public function getEditcatSubcatById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getEditcatSubcatById ( $cat_id );
		return $response;
	}
	public function addService($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->addService ( $cat );
		return $result;
	}
	public function getActiveServices($id=NULL) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveServices ($id);
		return $response;
	}
	public function getAllActiveServices() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getAllActiveServices ();
		return $response;
	}
	public function updateService($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->updateService ( $cat );
		return $result;
	}
	public function getServiceById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getServiceById ( $cat_id );
		return $response;
	}
	public function getEditServiceById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getEditServiceById ( $cat_id );
		return $response;
	}
	public function addModel($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->addModel ( $cat );
		return $result;
	}
	public function getActiveModels($sortBy=NULL) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveModels ($sortBy);
		return $response;
	}
	public function updateModel($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->updateModel ( $cat );
		return $result;
	}
	public function getModelById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getModelById ( $cat_id );
		return $response;
	}
	public function getEditModelById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getEditModelById ( $cat_id );
		return $response;
	}
	public function getCatsubcatid($subcat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getCatsubcatid ( $subcat_id );
		return $response;
	}	
	
	public function getCatsubcatid1($subcat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getCatsubcatid1 ( $subcat_id );
		return $response;
	}
	public function getServiceGroup($data) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getServiceGroup ( $data );
		return $response;
	}

	public function addBrand($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->addBrand ( $cat );
		return $result;
	}
	public function getActiveBrands($sortBy=NULL) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveBrands ($sortBy);
		return $response;
	}
	public function updateBrand($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->updateBrand ( $cat );
		return $result;
	}
	public function getBrandById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getBrandById ( $cat_id );
		return $response;
	}
	public function addSpare($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->addSpare ( $cat );
		return $result;
	}
	public function getActiveSpares($id=NULL) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveSpares ($id);
		return $response;
	}
	public function updateSpare($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->updateSpare ( $cat );
		return $result;
	}
	public function getSpareById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getSpareById ( $cat_id );
		return $response;
	}
	public function getEditSpareById($cat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getEditSpareById ( $cat_id );
		return $response;
	}
	public function addMainStatus($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->addMainStatus ( $cat );
		return $result;
	}
	public function updateMainStatus($cat) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->updateMainStatus ( $cat );
		return $result;
	}
	public function getActiveMainStatus() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveMainStatus ();
		return $response;
	}
	
	public function getActiveMainStatus1() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActiveMainStatus1 ();
		return $response;
	}
	public function getMainStatusById($status_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getMainStatusById ( $status_id );
		return $response;
	}
	public function getEditMainStatusById($status_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getEditMainStatusById ( $status_id );
		return $response;
	}
	
	public function addstaticSubCategory($params) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->addstaticSubCategory ( $params );
		return $result;
	}
	public function getstaticSubCategories() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getstaticSubCategories ();
		return $response;
	}
	public function getActivestaticSubCategories() {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getActivestaticSubCategories ();
		return $response;
	}
	public function getstaticSubCategoryById($id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$response = $this->CI->servicemodel->getstaticSubCategoryById ( $id );
		return $response;
	}
	public function updatestaticSubCategory($params) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->updatestaticSubCategory ( $params );
		return $result;
	}
    public function getspare($params) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		return $this->CI->servicemodel->getspare( $params );
	}
    public function getSubCatId3($param) {
        $this->CI->load->model ( 'service/Service_model', 'servicemodel' );
    return $this->CI->servicemodel->getSubCatId3( $param );
    }
     public function getsparelistbyparams($model_id,$subcat_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		return $this->CI->servicemodel->getsparelistbyparams( $model_id,$subcat_id );
	}
	public function getBookingServicesbyserviceid($service_id) {
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		return $this->CI->servicemodel->getBookingServicesbyserviceid( $service_id );
	}

	public function getStaticServiceGroup($value='')
	{
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		return $this->CI->servicemodel->getStaticServiceGroup( $value );	
	}

	public function addStaticServiceGroup($params='')
	{
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->addStaticServiceGroup ( $params );
		return $result;	
	}

	public function updateStaticServiceGroup($params='')
	{
		$this->CI->load->model ( 'service/Service_model', 'servicemodel' );
		$result = $this->CI->servicemodel->updateStaticServiceGroup ( $params );
		return $result;	
	}
	
}