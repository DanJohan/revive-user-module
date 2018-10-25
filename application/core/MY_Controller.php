<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
  protected $data = array();

  public function __construct()
  {
    parent::__construct();
    require_once APPPATH.'config/MY_constants.php';
     $GLOBALS['cart_count'] = $this->basket->getTotalItem();

  }

  protected function render($the_view = NULL,$data=array(), $layout = 'layouts/main')
  {
    $data['view'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$data, TRUE);
    $this->load->view($layout, $data);
  }


  protected function renderJson($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
  }

  public function do_upload($file,$path,$params=array())
  {
      $config['upload_path'] = $path;
      $config['allowed_types']= (isset($params['allowed_types']))?$params['allowed_types']:'jpg|png|jpeg';
      $config['max_size']= (isset($params['max_size']))?$params['max_size']:0;
      $config['max_width'] =(isset($params['max_width']))?$params['max_width']:0;
      $config['max_height']=(isset($params['max_height']))?$params['max_height']: 0;

     // if(isset($params['encrypt_name']) && $params['encrypt_name'] ==true) { 
      $config['encrypt_name'] =true;   
     // }else{
      // $new_name =  time().uniqid(rand()).'_'.$_FILES[$file]['name'];
       // $new_name = time().mt_rand(1000,9999).'_'.$_FILES[$file]['name'];
      //  $config['file_name'] =  $new_name;
     // }

      $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload($file))
      {
             return array('error' => $this->upload->display_errors());

      }
      else
      {
            return array('upload_data' => $this->upload->data());

      }
  }

    protected function order_store($payment_type,$payment_id=null){
      $post_data = $this->session->userdata('post_data');
     // dd($post_data);
      if(!empty($post_data))
        {
          $model_id= $this->session->userdata('model_id');
          $data =array();
          $data['car_detail']= $this->CarModelsModel->getCarByModelId($model_id);
          dd($data);
         
          $this->CarModelsModel->insert($car_data);

         
    }
  }
}


?>