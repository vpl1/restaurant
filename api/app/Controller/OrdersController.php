<?php

App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::import('Jwt', 'Jwt');

class OrdersController extends AppController {

    public $components = array("RequestHandler");

    /*
     *   Function beforeFilter begin when call Controller
     *   Useful: Import Model
     */

    public function beforeFilter() {
        $this->autoRender = false;
        $this->LoadModel('Order');
        $this->LoadModel('b_order_delivery_info');
        $this->LoadModel('OrderFoods');
        $this->LoadModel('OrderStatus');
        $this->LoadModel('AddressType');
        $this->LoadModel('Province');
        $this->LoadModel('CFood');
        $this->LoadModel('User');
    }


    // d_loc

    /*
     *   function getProfile: return the ordered foods by res id and foods id
     *   METHOD: POST
     *   Author: Dinh Loc
     *   API: 17
     */
    public function getListFoods() {
        /* initialize the response data
         */
        $response=array(
            'error'=>array(
                'code'=>404,
                'message'=>"Failed to retrieve menus for this restaurant"
            ),
            'listFoods'=>array()
        );

        /* check the post data existing
         * get the records foreach order id
         * get average rating foreach record
         * return response for mobile requested
         */
        $requests = $this->request->data;
        if ($requests) {
            $res_id= $requests['restaurantId'];
            $foods_id = $requests['listFoodIds'];
            $foods= array();
            if(count($foods_id)>0){ //check have any food id
                for($i=0;$i<count($foods_id);$i++){
                    $food= $this->Order->GetOrderById($res_id,$foods_id[$i]);
                    if($food){
                        $foods=array_merge($foods, $food);
                    }
                }
            }
            $response['listFoods']= $foods;
            $response['error']['message']="Connect successfully";
            $response['error']['code']=0;
        } else {
            $response['error']['message']="No have the post parameters in this request!";
        }
        echo json_encode($response);
    }


    /*
     *   Function: return list ordered
     *   Parameters: res id, user id, month orderm year order
     *   METHOD: GET
     *   Author: Dinh Loc
     *   API: 35
     *   Status: in process
     */
    public function getListOrders(){
        /* initialize the response data
         */
        $response=array(
            'error'=>array(
                'code'=>404,
                'message'=>""
            ),
            'listOrders'=>array()
        );

        $error_mss='';

        /*  check existing post
        *   get data ordered by res id, user id, month, year
        */
        $month      =isset($_GET['month'])          ?   $_GET['month']:null;
        $year       =isset($_GET['year'])           ?   $_GET['year']:null;

        $user_record=(array)json_decode(json_encode($this ->decodeJWT($this->request->header('Token'))));

        var_dump($user_record);die;
        if($user_record['status']==true){
            if($month && $year){
                $error_msg= 'Connect successfully !';

                $user_has   = $this->User->find('first',array('conditions'=>array('id'=>intval($user_record['userId']))));
                $res_id     = $user_has['User']['restaurant_id'];
                if($month && $year){
                    $response['listOrders']     =  $this->Order->GetListOrdered($res_id,$user_has['User']['id'],$month,$year);
                    $response['error'] ['code'] = 0;
                    $error_message              = "Connect successfully";
                }
            }
            else{
                $error_msg='The parameters must have two agrumments: month and year';                
            }
        }
        else{
            $error_mss= 'No have token in this request';
        }
        $response['error']['message']= $error_msg;
        echo json_encode($response);
    }


    /*
     *   Function:  insert an order into order list
     *   Parameters: json request
     *   METHOD: GET
     *   Author: Dinh Loc
     *   API: 28
     *   Status: Pending
     */
    public function postOrder(){
        $response = array(
                'error'=> array(
                            'code'=>404,
                            'message'=>'No data request'
                        ),
                'order'=>array()
                );

        if($this->request->data){
            $data= $this->request->data;

            /*  insert order item
            */
            $user_record=(array)json_decode(json_encode($this ->decodeJWT($this->request->header('Token'))));
            $user_has   = $this->User->find('first',array('conditions'=>array('id'=>intval($user_record['userId']))));
            $order_insert_item= array(
                'id'                =>'OR'.date('YmdHis'),
                'sub_total'         =>0,
                'user_id'           =>$user_record['userId'],
                'order_status_id'   =>1, // pending is default
                'order_date'        =>date('Y-m-d H:i:s'),
                'create_time'       =>date('Y-m-d H:i:s'),
                'update_time'       =>date('Y-m-d H:i:s'),
                'restaurant_id'     =>$user_has['User']['restaurant_id']
            );
            $this->Order->save($order_insert_item);

            /*  insert order food items by order id
            */
            $listFoods=$data['listFoods'];
            for($i=0;$i<count($listFoods);$i++){
                $food_record = $this->CFood->find('first',array('conditions'=>array('id'=>$listFoods[$i]['id'])));
                $order_food_insert_item=array(
                    'price'         =>$food_record['CFood']['price'],
                    'amount'        =>$listFoods[$i]['amount'],
                    'order_id'      =>$order_insert_item['id'],
                    'food_id'       =>$food_record['CFood']['id'],
                    'create_time'   =>date('Y-m-d H:i:s'),
                    'update_time'   =>date('Y-m-d H:i:s')
                    );
                $this->OrderFoods->create();
                $this->OrderFoods->save($order_food_insert_item);
                $order_insert_item['sub_total']+=$order_food_insert_item['price']* $order_food_insert_item['amount'];
            }

            /*  insert order delivery items by order id
            */
            $delivery_request= $data['deliveryInfo'];

            $order_delivery_insert_item = array(
                'order_id'          =>$order_insert_item['id'],
                'first_name'        =>$delivery_request['firstName'],
                'last_name'         =>$delivery_request['lastName'],
                'address'           =>$delivery_request['address'],
                'email'             =>$delivery_request['email'],
                'note'              =>$delivery_request['note'],
                'phone'             =>$delivery_request['phone'],
                'province_id'       =>$data['deliveryInfo']['district'],
                'address_type_id'   =>$delivery_request['addressType']
                );
            $this->b_order_delivery_info->save($order_delivery_insert_item);
            /* update total price for order inserted
            */
            $this->Order ->set(array('sub_total' => $order_insert_item['sub_total']));
            $this->Order ->save();
            /* when post an order completed,
            *   response to client the status requested
            */
            $response['order']=$order_insert_item;
            $response['error']['code']=0;
            $response['error']['message'] = "Connect successfully";
        }

        echo json_encode($response);
    }

    /*
     *   Function:  get detail info for an order
     *   Parameters: json request
     *   METHOD: GET
     *   Author: Dinh Loc
     *   API: 36
     *   Status: done
     */
    public function getOrderDetail(){
        $response = array(
            'error'     => array(
                        'code'      =>404,
                        'message'   =>'No data request'
                    ),
            'order'     =>array(),
        );
        if(isset($_GET['restaurantId']) && isset($_GET['orderId'])){
            $response['error']['code']=0;
            $response['error']['message'] = 'Connect successfully';

            /*  get data record for each info item
            */
            $order_record= $this->Order->find('first',array('conditions'=>array('id'=>$_GET['orderId'])))['Order'];
            $order_delivery_record= $this->b_order_delivery_info->find('first',array(
                'conditions'=>array('order_id'=>$_GET['orderId'])))['b_order_delivery_info'];
            $order_foods_records= $this->OrderFoods->find('all',array(
                'conditions'=>array('order_id'=>$_GET['orderId'])));
            $province_record= $this->Province->ProvinceById($order_delivery_record['province_id']);

            /*  get order delivery item
            */
            $delivery_result= array(
                'userId'        => $order_delivery_record['order_id'],
                'firstName'     => $order_delivery_record['first_name'],
                'lastName'      => $order_delivery_record['last_name'],
                'province'      => $province_record['parent_id'],
                'district'      => $province_record['id'],
                'address'       => $order_delivery_record['address'],
                'phone'         => $order_delivery_record['phone'],
                'email'         => $order_delivery_record['email'],
                'addressType'   => $this->AddressType->AddressTypeById($order_delivery_record['address_type_id'])['id'],
                'note'          => $order_delivery_record['note']
                );

            /*  get list foods ordered items
            */
            $listFoods_result= array();
            for($i=0;$i<count($order_foods_records);$i++){
                $food_record = $this->CFood->find('first',array('conditions'=>array('id'=>$order_foods_records[$i]['OrderFoods']['food_id'])))['CFood'];
                array_push($listFoods_result,array(
                    'id'        =>$order_foods_records[$i]['OrderFoods']['id'],
                    'imageUrl'  =>$order_foods_records[$i]['OrderFoods']['id'],
                    'rateString'=> $this->Order->GetRateAFood($food_record['id']),
                    'name'      =>$food_record['name'],
                    'price'     =>$order_foods_records[$i]['OrderFoods']['price'],
                    ));
            }


            /*  get order item
            */
            $order_result=array(
                'id'            =>$order_record['id'],
                'orderCode'     =>$order_record['id'],
                'orderDate'     =>$order_record['create_time'],
                'status'        =>$this->OrderStatus->find('first',array('conditions'=>array('id'=>$order_record['order_status_id'])))['OrderStatus']['name'],
                'fee'           =>0,
                'subTotal'      =>$this->Order->GetSUMPrice($order_foods_records),
                'total'         =>0,
                'shipDate'      =>0,
                'receiveDate'   =>0,
                'deliveryInfo'  =>$delivery_result,
                'listFoods'     => $listFoods_result
                );

            $response['order'] = $order_result;
        }
        echo json_encode($response);
    }

    //end d_loc
}