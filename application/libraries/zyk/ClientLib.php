<?php
class ClientLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
		$this->CI->load->model ( 'client/Client_model', 'client_model' ); 
	}

	public function getClientByid($id) {
		return $this->CI->client_model->getClientByid($id);
 	}

	 
	public function getAllClientList(){
		  return $this->CI->client_model->getAllClientList();
 	}

 	public function addClient($params) {
 		$result = $this->CI->client_model->addClient ($params);
 		return $result;
 	}
 	
 	public function addClient_image($params) {
 		$result = $this->CI->client_model->addClient_image ($params);
 		return $result;
 	}
 	public function getClients() {
 		$result = $this->CI->client_model->getClients ();
 		return $result;
 	}
 	public function getClientsbyId($id) {
 		$result = $this->CI->client_model->getClientsbyId ($id);
 		return $result;
 	}
 	/*public function addClientAsUser($data) {  
 		$result = $this->CI->client_model->addClientAsUser ($data);
 		return $result;
 	}
 	public function updateClientAsUser($data) {  
 		$result = $this->CI->client_model->updateClientAsUser ($data);
 		return $result;
 	}*/
 	public function addClientBilling($id) {
 		$result = $this->CI->client_model->addClientBilling ($id);
 		return $result;
 	}
        public function updateClient_image($id) {
 		$result = $this->CI->client_model->updateClient_image ($id);
 		return $result;
 	}
          public function updateClientBilling($id) {
 		$result = $this->CI->client_model->updateClientBilling ($id);
 		return $result;
 	}
            public function updateClient($params) {
 		$result = $this->CI->client_model->updateClient ($params);
 		return $result;
 	}    
    public function delete_client_doc($id) {
        $this->CI->client_model->delete_client_doc($id);
    } 
	
	
}