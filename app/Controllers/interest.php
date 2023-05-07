<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\interestModel;

header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE"); 
$method = $_SERVER['REQUEST_METHOD']; 
    if($method == "OPTIONS"){ 
        die(); 
    }


class interest extends ResourceController
{
    use ResponseTrait;

    protected  $modelName = 'App\Models\interestModel';
	protected  $format = 'json';

    public function index(){
        $model = new interestModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $model = new interestModel();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

   
    public function create()
    {
        $model = new interestModel();
        $mobile = $this->request->getVar('request'); 
			$web = json_decode(file_get_contents('php://input'), TRUE);

			if(isset($mobile)){

				$result = $model->insert($mobile);
				$mobile['post_id'] =  $result;
				
				return $this->respondCreated($result);	

			}else if(isset($web)){

				$result = $model->insert($web);
				return $this->respondCreated($result);	

			}else{
				echo('No parameter Found'); die();
			}
    }

    public function update($id = null){
        $model = new interestModel();
        $mobile = $this->request->getVar('request'); 
        $web = json_decode(file_get_contents('php://input'), TRUE);
        if(isset($mobile)){

             $model->save($mobile);
            
            return $this->respond($mobile);	

         }else if(isset($web)){

             $model->save($web);
            
            return $this->respond($web);	

         }else{
             echo('No parameter Found'); die();
         }

    }

    public function delete($id = null)
    {
        $model = new interestModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
         
    }



}