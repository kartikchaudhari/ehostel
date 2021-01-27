<?php

/*
    for more visit:
    http://sab99r.com/blog/firebase-cloud-messaging-fcm-php-backend/
    https://phpadvices.com/send-push-notification-to-android-using-php-and-firebase/
*/

class FCM {
    private $url = "https://fcm.googleapis.com/fcm/send";
    private $server_key="AAAAaHUCxOk:APA91bFcfp6sSaMUXicIdsm-u_vmAVS4HQ_x_IOd4iFfrT7hwI7O_Vi0Ph-REIEJExoPP4DkEkmGABN2B2x66RXZ89aijcKU7DhLIn9sk1cwgmiR2RtvyffiAeLjS-Lp45xfuB29s2Ip";

    function __construct() { }
   
  
    public function send_notification($registatoin_ids, $notification,$device_type) {
      if($device_type == "Android"){
            $fields = array();
            $fields['data'] = $notification;
            if(is_array($registatoin_ids)){
                $fields['registration_ids'] = $registatoin_ids;
            }else{
              $fields['to'] = $registatoin_ids;
            }
      } 
      else {
            $fields = array();
            $fields['notification'] = $notification;
            if(is_array($registatoin_ids)){
                $fields['registration_ids'] = $registatoin_ids;
            }else{
              $fields['to'] = $registatoin_ids;
            }
      }
      // Firebase API Key
      $headers = array(
                        'Authorization:key='.$this->server_key.'',
                        'Content-Type:application/json');
      
      // Open connection
      $ch = curl_init();
      // Set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $this->url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Disabling SSL Certificate support temporarly
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);
      if ($result === FALSE) {
          die('Curl failed: ' . curl_error($ch));
      }
      
      //uncomment below line for debuggin purpose
      //print_r($result);
      
      curl_close($ch);
  }
}   
?>