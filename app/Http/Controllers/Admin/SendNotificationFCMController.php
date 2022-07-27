<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendNotificationFCMController extends Controller
{
    public function sendPushNotification($id = null) {  
			$fcm_token = 'AAAArd5hIIQ:APA91bF1sooeQMnf-ig1Cqp-iRpfCGCyJZWB0EfWoyuNYS-eQL7olwX1qQm0LQMvD4_XCA5VaMQOcS8nkk1dGtsbhFr9MVuoKzlQwH-VHKv_D4lIaPKfm0jZu_Qw_VbGiEXaW1mPiMsI';
			$title = 'TESTE';
			$message = 'OLÁ';

			$url = "https://fcm.googleapis.com/fcm/send";            
			$header = [
			'authorization: key='.$fcm_token,
				'content-type: application/json'
			];    
	
			$postdata = '{
				"to" : "' . $fcm_token . '",
					"notification" : {
						"title":"' . $title . '",
						"text" : "' . $message . '"
					},
				"data" : {
					"id" : "'.$id.'",
					"title":"' . $title . '",
					"description" : "' . $message . '",
					"text" : "' . $message . '",
					"is_read": 0
				  }
			}';
	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	
			$result = curl_exec($ch);    
			curl_close($ch);
	
			return $result;
		}
        
}
