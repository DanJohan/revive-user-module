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

      if(isset($params['new_name']) && $params['new_name'] ==true) { 
        $new_name =  time().'_'.uniqid(mt_rand(1000,9999)).'_'.$_FILES[$file]['name'];
        $config['file_name'] =  $new_name;
      }else{
          $config['encrypt_name'] =true;   
      }
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
      $this->load->library('sequence');
      $post_data = $this->session->userdata('post_data');
      if(!empty($post_data))
        {
          $car_data = array(
            'user_id'=>$this->session->userdata('user_id'),
            'brand_id'=>$post_data['brand_id'],
            'model_id'=>$post_data['model_id'],
            'registration_no'=>$post_data['reg_no'],
          );
          $car_id = $this->CarModel->insert($car_data);
         
          if($car_id) {
            $location = $this->session->userdata('location');
            //dd($location);
            if($location == "delhi"){
             echo $service_center = '1';
            }
            else if($location == "noida"){
              $service_center = '2';
            }
           else if($location == "gurugram"){
              $service_center = '3';
            }
            
            $this->sequence->createSequence('order');
            $sequence = $this->sequence->getNextSequence();
            if($this->session->has_userdata('service_cat_id')) {
              $service_cat_id = $this->session->userdata('service_cat_id');
            }
            if(!empty($post_data['loaner_vehicle'])){
               if($post_data['loaner_vehicle'] == '1'){
                  $net_pay_amount = $post_data['taxtotal'] + 500;
               }

            }
            else {
                    $net_pay_amount = $post_data['taxtotal'];
               }
            $order_data = array(
              'order_no' =>$sequence['sequence'],
              'hash'=> md5(uniqid(true)),
              'pick_up_date' => date('Y-m-d',strtotime($post_data['pick_up_date'])),
              'pick_up_time' => $post_data['pick_up_time'],
              'service_type' => $service_cat_id,
              'service_center' => $service_center,
              'sub_total' => $post_data['subtotal'],
              'net_pay_amount' => $net_pay_amount,
              'channel' => '1',
              'user_id'=> $this->session->userdata('user_id'),
              'car_id'=>  $car_id,
              'payment_type_id' => $payment_type,
              'paid' => '0',
              'loaner_vehicle' => $post_data['loaner_vehicle'],
              'created_at' =>date('Y-m-d H:i:s')
          );

          //dd($order_data);
          $order_id = $this->OrderModel->insert($order_data);
          $this->sequence->updateSequence();
          $customer_data = array(
            'order_id' => $order_id,
            'name'=>$post_data['name'],
            'email'=>$post_data['email'],
            'phone'=>$post_data['phone'],
            'address'=>$post_data['address']."\n".$post_data['landmark'],
           );

         $this->CustomerDetailModel->insert($customer_data);
         $order_items = $this->basket->getItems();
          if(!empty($order_items)) {
            foreach ($order_items as $index => $order_item) {
              foreach($order_item as $item) {
                $order_item_data[] = array(
                    'order_id'=>$order_id,
                    'service_id'=> $item['id'],
                    'name' => $item['attributes']['service'],
                    'price' =>$item['attributes']['price'],
                );
              }
            }

            if(!empty($order_item_data)){
              $this->OrderItemModel->insert_batch($order_item_data);
            }
          }

          $order_detail = $this->OrderModel->getById($order_id);
          $this->basket->clear();
          redirect('cart/confirmed/'.$order_detail['id']);

        }
      }
    }  
  }
?>