<?php
namespace Modules;

class MainServices {

    static function sendMailApi($bodyEmail) {

      $curl = curl_init();
  
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mailgun.net/v3/emailconf.paylesscar.com.mx/messages',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $bodyEmail,
        CURLOPT_HTTPHEADER => array(
          'Authorization: Basic YXBpOmZhNjY5M2ZkODQ3ODI1MDlhMTcxYzUyYWEzNDhiNjBlLTRiMWFhNzg0LTI1MzY0M2Jk'
        ),
      ));
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      // echo $response;
      return $response;
    }
    static function loadtest() {return 'data';}
}

?>