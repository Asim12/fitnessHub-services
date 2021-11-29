
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_users extends CI_Model {
    
  function __construct() {
      parent::__construct();
      
      // ini_set("display_errors", 1);
      // error_reporting(1);
  }

  public function getUserLocation(){

    $ip = getenv('HTTP_CLIENT_IP') ?:
    getenv('HTTP_X_FORWARDED_FOR') ?:
    getenv('HTTP_X_FORWARDED') ?:
    getenv('HTTP_FORWARDED_FOR') ?:
    getenv('HTTP_FORWARDED') ?:
    getenv('REMOTE_ADDR');            
    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
    $detail  = (array) $details;
    return $detail;
  }


  public function saveContactUs($details){

    $db = $this->mongo_db->customQuery();
    $check = $db->contact_us->insertOne($details);

    return true ;
  }


  public function searchUser($phone = '' , $full_name = ''){

    $db = $this->mongo_db->customQuery();

    if(!empty($phone)){

      $search['phone_number']  =  $phone;
    }

    if(!empty($full_name)){

      $search['full_name']  = $full_name;
    }

    $aggregateQuery = [

      [
        '$match' => $search
      ],

      [
        '$project' => [
          '_id'           =>  ['$toString' => '$_id'],
          'email_address' =>  '$email_address',
          'full_name'     =>  '$full_name',
          'occupation'    =>  '$occupation',
          'age'           =>  '$age',
          'location'      =>  '$location',
          'civil_status'  =>  '$civil_status',
          'profile_image' =>  '$profile_image',
          'bioigraphy'    =>  '$bioigraphy'
        ]
      ],

      [
        '$lookup' => [
          "from" => "user_reviews",
          "let" => [
            "admin_id" =>  '$_id'
          ],
          "pipeline" => [
            [
              '$match' => [
                '$expr' => [
                  '$eq' => [
                    '$admin_id',
                    '$$admin_id'
                  ]
                ],
                
              ],
            ],

            [
              '$project' => [
                '_id'              =>   '$admin_id',
                'reviwer_admin_id' =>   '$reviwer_admin_id',
                'personality'      =>   ['$sum' => '$personality'],
                'data_experience'  =>   ['$sum' => '$data_experience'],
                'authenticity'     =>   ['$sum' => '$authenticity'],
                'total'            =>   ['$sum' => 1]
              ]
            ],
            [
              '$project' => [
                '_id'              =>   '$_id',
                'personality'      =>   ['$divide' => [ '$personality', '$total']],
                'data_experience'  =>   ['$divide' => [ '$data_experience', '$total']] ,
                'authenticity'     =>   ['$divide' => [ '$authenticity', '$total']],
                'reviwer_admin_id' =>   '$reviwer_admin_id',
              ]
            ],
            [
              '$lookup' => [
                "from" => "users",
                "let" => [
                  "admin_id" =>  [ '$toObjectId' => '$reviwer_admin_id']
                ],
                "pipeline" => [
                  [
                    '$match' => [
                      '$expr' => [
                        '$eq' => [
                          '$_id',
                          '$$admin_id'
                        ]
                      ],
                      
                    ],
                  ],
    
                  [
                    '$project' => [
                      '_id'           =>  ['$toString' => '$_id'],
                      'email_address' =>  '$email_address',
                      'full_name'     =>  '$full_name',
                      'occupation'    =>  '$occupation',
                      'age'           =>  '$age',
                      'location'      =>  '$location',
                      'civil_status'  =>  '$civil_status',
                      'profile_image' =>  '$profile_image',
                      'bioigraphy'    =>  '$bioigraphy'
                    ]
                  ],

                  [
                    '$lookup' => [
                      "from" => "user_reviews",
                      "let" => [
                        "admin_id" =>  '$_id'
                      ],
                      "pipeline" => [
                        [
                          '$match' => [
                            '$expr' => [
                              '$eq' => [
                                '$reviwer_admin_id',
                                '$$admin_id'
                              ]
                            ],
                            
                          ],
                        ],
          
                        [
                          '$group' => [
                            '_id'           =>  '$reviwer_admin_id',
                            'rating'        =>  ['$first' => '3']
                          ]
                        ],
                      ],
                      'as' => 'reviewer_reviews'
                    ]
                  ],
                ],
                'as' => 'reviewer_profile'
              ]
            ],

          ],
          'as' => 'reviews'
        ]
      ],

    ];

    $getResult = $db->users->aggregate($aggregateQuery);
    $result    = iterator_to_array($getResult);

    return $result ;

  }//end 


  public function updateProfileData($admin_id ,  $data){
    $db = $this->mongo_db->customQuery();

    if( !empty($data) && !is_null($data) ){

      $whereUpdate['_id'] =   $this->mongo_db->mongoId($admin_id); 
      $db->users->updateOne($whereUpdate, ['$set' => $data] );
    }
    return true;
  }//end


  public function UpdateProfileImage($adminId, $profile_image){
    $db = $this->mongo_db->customQuery();
    if(!empty($profile_image)){
      
      $db->users->updateOne(['_id' => $this->mongo_db->mongoId($adminId) ], ['$set' => ['profile_image' => $profile_image]] );
    }
    return true;
  }

  public function getActiveUsers(){  
    $db = $this->mongo_db->customQuery();

    $startDate = $this->mongo_db->converToMongodttime(date('Y-m-d H:i:s', strtotime('-30 days')));
    $endtDate  = $this->mongo_db->converToMongodttime(date('Y-m-d H:i:s'));
    $activeUsers = [
      [
        '$match' => [
          'user_role'  =>  2,
        ]
      ],
      [
        '$project' =>[

          '_id'   =>  ['$toString' => '$_id'],
        ]
      ],
      [
        '$lookup' => [
          "from" => "user_reviews",
          "let" => [
            "admin_id" =>    '$_id'
          ],
          "pipeline" => [
            [
              '$match' => [
                '$expr' => [
                  '$eq' => [
                    '$admin_id',
                    '$$admin_id'
                  ]
                ],
                'created_date'  => ['$gte' => $startDate ,  '$lte' => $endtDate],
              ],
            ],

            [
              '$group' => [

                '_id' =>  '$admin_id',
              ]
            ],
            [
              '$project' => [
                '_id'   => '$_id',
                'sum' =>  ['$sum' => 1]
              ]
            ]
          ],
          'as' => 'activeUsers'
        ]
      ],
    ];

    $activeUsers        =  $db->users->aggregate($activeUsers);
    $activeUserResponse =  iterator_to_array($activeUsers);
    $activeUsers        =  array_column($activeUserResponse, 'activeUsers');
    $countUser = 0;
    foreach ($activeUsers as $value){
      if(count($value) > 0 ){

        $countUser += 1;
      }
    }
    return $countUser;
  }

  public function getActiveUsersRecordForChart(){
    $db = $this->mongo_db->customQuery();

    $startDate1 = date('Y-m-d 00:00:00', strtotime('-2 days'));
    // echo "<br>Start".$startDate1;

    $startDate = $this->mongo_db->converToMongodttime($startDate1);
    $endtDate  = $this->mongo_db->converToMongodttime(date('Y-m-d 23:59:59', strtotime('-1 days')));

    $first1 = date($startDate1, strtotime('+2 hours'));
    // echo "<br>First".$first1;
    $first    =   $this->mongo_db->converToMongodttime($first1);


    $secound    =   $first->toDateTime()->format("Y-m-d H:i:s");
    $secound1 = date($secound, strtotime('+2 hours'));
    // echo "<br>secound".$secound1;
    $secound    =   $this->mongo_db->converToMongodttime($secound1);


    $activeUsers = [
      [
        '$match' => [
          'user_role'  =>  2,
        ]
      ],
      [
        '$project' =>[

          '_id'   =>  ['$toString' => '$_id'],
        ]
      ],
      [
        '$lookup' => [
          "from" => "user_reviews",
          "let" => [
            "admin_id" =>    '$_id'
          ],
          "pipeline" => [
            [
              '$match' => [
                '$expr' => [
                  '$eq' => [
                    '$admin_id',
                    '$$admin_id'
                  ]
                ],
                'created_date'  => ['$gte' => $startDate ,  '$lte' => $endtDate],
              ],
            ],

            [
              '$group' => [

                '_id'          => '$admin_id',
                'created_date' => ['$first' => '$created_date']
              ]
            ],


            '$addFields' => [
              'first' => [
                '$sum' => [
                  '$cond' => [
                    'if' => ['$lte' => [ '$created_date', $first ] ], // ['$eq' => ['$created_date', $first]],
                    'then' => 1,
                    'else' => 0
                  ]
                ]
              ],
            ],
              
          ],
          'as' => 'activeUsers'
        ]
      ],
    ];

    $activeUsers        =  $db->users->aggregate($activeUsers);
    $activeUserResponse =  iterator_to_array($activeUsers);
    $activeUsers        =  array_column($activeUserResponse, 'activeUsers');

    // echo "<pre>";print_r($activeUsers);
    // die('testing');
    return $activeUsers;
  }

  public function saveDeviceTken($admin_id, $device_token){
    $db = $this->mongo_db->customQuery();

    $db->users->updateOne([ '_id'  =>  $this->mongo_db->mongoId($admin_id)],  ['$set' => ['device_token' => $device_token] ] );
    return true;
  }


  public function sendNotification($reciver_admin_id, $message, $type, $sender_admin_id){
    $db = $this->mongo_db->customQuery();
    
    $tokenUser =  $this->getUserDeviceToken($reciver_admin_id);
    // var_dump($tokenUser);
    if($tokenUser  == false){
      
      return false;
    }else{
      
      $url = 'https://fcm.googleapis.com/fcm/send';
      $serverKey = "AAAALA6kfU4:APA91bEO7p65iWrC3BXMNeTiD0Q5Wpc4edc6hPHQYojHXEgPYJOEQqnlEa070FOeoAdkr9mK-5kCFOTyO4qxU3M6WQwsWRWeuFVYfIYxkF4_cQJERWc-znTnVAqoAMgwMYBbQZV0uhmf";
      $headers = array (
        'Authorization:key=' . $serverKey,
        'Content-Type:application/json'
      );
      
      $getFullName =  $this->getUserFullName($sender_admin_id);
      // Add notification content to a variable for easy reference
      $notifData = [
        'title' => $getFullName,
        'body'  => $message,
      ];
      $dataPayload = [

        'other_data' => $type
      ];
		  
      // Create the api body
      $apiBody = [
        'notification' =>  $notifData,
        'data'         =>  $dataPayload, //Optional
        'to'           =>  $tokenUser
      ];
      $ch = curl_init();
      curl_setopt ($ch, CURLOPT_URL, $url);
      curl_setopt ($ch, CURLOPT_POST, true);
      curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));
      $result = curl_exec($ch);
      curl_close($ch);

      $result = json_decode($result);
      if($result->failure == 0){

        $status =  'success'; 
      }else{

        $status =  'error';
      }
      $insertData = [

        'sender_admin_id'      =>   $sender_admin_id,
        'reciver_admin_id'     =>   $reciver_admin_id,
        'message'              =>   $message,
        'title'                =>   $getFullName,
        'created_date'         =>   $this->mongo_db->converToMongodttime(date('Y-m-d H:i:s')),
        'notification_status'  =>   $status,
        'status'               =>   'pending'
      ];

      if($type == 'message'){

        return $result;
      }else{

        $db->notifications->insertOne($insertData);
      }

      return $result;

    }//end else
		  
	}//end function


  public function getUserDeviceToken($reciver_admin_id){
    $db = $this->mongo_db->customQuery();

    $user     =  $db->users->find(['_id' => $this->mongo_db->mongoId((string)$reciver_admin_id), 'device_token' => ['$exists' => true] ]);
    $userData =  iterator_to_array($user);

    if(count($userData) > 0){

      return ($userData[0]['device_token']);
    }else{

      return false;
    }

  }//end function

  public function getUserFullName($sender_admin_id){
    $db = $this->mongo_db->customQuery();

    $user     =  $db->users->find(['_id' => $this->mongo_db->mongoId((string)$sender_admin_id)]);
    $userData =  iterator_to_array($user);

    if(count($userData) > 0){

      return ($userData[0]['full_name']);
    }else{

      return false;
    }

  }//end function

  public function getNotification($admin_id){
    $db = $this->mongo_db->customQuery();

    $getNotificationData = [
      [
        '$match' => [

          'reciver_admin_id'  => (string)$admin_id
        ]
      ],

      [
        '$project' => [
          '_id'                  =>    ['$toString' => '$_id'],
          'sender_admin_id'      =>   '$sender_admin_id',
          'reciver_admin_id'     =>   '$reciver_admin_id',
          'message'              =>   '$message',
          'title'                =>   '$title',
          'created_date'         =>   '$created_date',
          'status'               =>   '$status'
        ]
      ],
      [
        '$lookup' => [
          'from' => 'users',
          'let' => [
            'admin_id' =>  ['$toObjectId' => '$sender_admin_id' ],
          ],
          'pipeline' => [
            [
              '$match' => [
                '$expr' => [
                  '$eq' => [
                    '$_id',
                    '$$admin_id'
                  ]
                ],
              ],
            ],
            
            [
              '$project' => [
                '_id' => ['$toString'=>    '$_id'],
                'full_name'    =>  '$full_name',
                'profile_image'=>  '$profile_image'
              ]
            ],
          ],
          'as' => 'profile_details'
        ]
      ],
      [
        '$sort'   =>  ['created_date' => -1]
      ],
      ['$limit' => 50]

    ];
    $getNot    =  $db->notifications->aggregate($getNotificationData);
    $getNotRes =  iterator_to_array($getNot);
    return $getNotRes;
  }

  public function UpdatePlan($admin_id,  $plan, $amount, $currency){
    $db = $this->mongo_db->customQuery();

    $db->users->updateOne([ '_id'  => $this->mongo_db->mongoId($admin_id)], ['$set' => ['package'  => $plan, 'pakage_buy_date' => $this->mongo_db->converToMongodttime(date('Y-m-d H:i:s'))  ]]);
    
    $data = [
      'admin_id'      =>  $admin_id,
      'plan'          =>  $plan,
      'amount'        =>  $amount,
      'created_date'  =>  $this->mongo_db->converToMongodttime(date('Y-m-d H:i:s')),
      'currency'      =>  $currency
    ];
    $db->subscriptions->insertOne($data);
    return true;
  }

  public function UpdatePhone($adminId, $phoneNumber){
    $db = $this->mongo_db->customQuery();

    $db->users->updateOne([ '_id'  => $this->mongo_db->mongoId($adminId)], ['$set' => ['phone_number'  => $phoneNumber ]]);
    
    return true;
  }


}//end model
