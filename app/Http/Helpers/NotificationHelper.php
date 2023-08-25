<?php

namespace App\Http\Helpers;

use App\Models\Notification;
use App\Models\Student;
use App\Models\User;

class NotificationHelper
{
    public static function sendNotification($notification , $tokens)
    {                
        
        $SERVER_API_KEY = 'AAAAK-2cV9k:APA91bG_0iTqiuL8jkrOrPd5SLVrfH-ncsN6L7TA9ywzESej7ACUi4OCVroRDwam7iHj7V77piYyPTCJE3xvThyvyxK5jOTMJsOgd_itFBeHPp_Co6f6RDr1BfRIX-CXR89f6aWYESfd' ;       

        $data = [
             "registration_ids" => $tokens, // for All device
            // "registration_ids" => 'dZsYFunMTEeaVgdU7aCllR:APA91bF0BjZJlVHXGpGxkb7sPwVzbmOYXiR-fxuiicmsEyvK2r3M_zRDHqDP-DIA118cPnUj2HW2h-87YVtxKmGmMR8Q_RI0K-3tkcqqQKS7bP5gZ3_mOLAExNdufKCW3kLcwKjY8oDn',
            "notification" => [
                'title' => $notification->title,
                'body' => $notification->body,
                'sound' => "default" // required for sound on ios
            ],
            "priority" => "high",
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    public static function userNotification($user_ids, $notification) // old methods for review
    {
        // insert into db
        $student = Student::wherein('user_id', $user_ids);

        $student->notifications()->attach($notification->id);


        //send to firebase
        $SERVER_API_KEY = 'AAAAK-2cV9k:APA91bG_0iTqiuL8jkrOrPd5SLVrfH-ncsN6L7TA9ywzESej7ACUi4OCVroRDwam7iHj7V77piYyPTCJE3xvThyvyxK5jOTMJsOgd_itFBeHPp_Co6f6RDr1BfRIX-CXR89f6aWYESfd' ;
        $FCMs = $student->fcm_token;

        $data = [
            "registration_ids" => $FCMs, // for All device
            "notification" => array(
                'title' => $notification->title,
                'body' => $notification->body,
                'sound' => "default" // required for sound on ios

            ),
            "priority" => "high",
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    public static function broadcastLectureNotification($subject_id, $notification)
    {
        $students = Student::select('id')->whereHas('subjects', function($q) use ($subject_id){
                    return $q->where('subject_id', $subject_id);
        })->get();
        // insert into db

        foreach ($students as $student)
        {
            $student->notifications()->attach($notification->id);
        }

        //send to firebase
        $tokens = User::select('fcm_token')->whereHas('student', function ($q) use ($students){
            return $q->whereIn('id', $students);
        })->get();

        $SERVER_API_KEY = 'AAAAK-2cV9k:APA91bG_0iTqiuL8jkrOrPd5SLVrfH-ncsN6L7TA9ywzESej7ACUi4OCVroRDwam7iHj7V77piYyPTCJE3xvThyvyxK5jOTMJsOgd_itFBeHPp_Co6f6RDr1BfRIX-CXR89f6aWYESfd' ;

        $FCMs = [];
        foreach ($tokens as $key => $token) {
            $FCMs[$key] = $token['fcm_token'];
        }

        $data = [
            "registration_ids" => $FCMs, // for All device
            "notification" => array(
                'title' => $notification->title,
                'body' => $notification->body,
                'sound' => "default" // required for sound on ios

            ),
            "priority" => "high",
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;

    }

}
