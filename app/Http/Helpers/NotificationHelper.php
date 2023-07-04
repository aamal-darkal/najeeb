<?php

namespace App\Http\Helpers;

use App\Models\Notification;
use App\Models\Student;
use App\Models\User;

class NotificationHelper
{
    public static function broadcastNotification($title, $body)
    {
        $tokens = User::whereHas('student',function($q){
            $q->where('state', 'current');
        })->get();
        $usersIds = $tokens->pluck('id');
        $students = Student::whereIn('user_id', $usersIds)->get();
        $notification = Notification::create(['title' => $title, 'description' => $body, 'time_publish' => now(), 'created_by' => auth()->id()]);
        $SERVER_API_KEY = 'AAAAK-2cV9k:APA91bG_0iTqiuL8jkrOrPd5SLVrfH-ncsN6L7TA9ywzESej7ACUi4OCVroRDwam7iHj7V77piYyPTCJE3xvThyvyxK5jOTMJsOgd_itFBeHPp_Co6f6RDr1BfRIX-CXR89f6aWYESfd' ;

        foreach ($students as $student)
        {
            $student->notifications()->attach($notification->id);
        }
        $FCMs = [];
        foreach ($tokens as $key => $token) {
            $FCMs[$key] = $token['fcm_token'];
        }

        $data = [
            "registration_ids" => $FCMs, // for All device
            "notification" => array(
                'title' => $title,
                'body' => $body,
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

    public static function userNotification($user_id, $title, $body)
    {

        $student = Student::where('user_id', $user_id)->first();
        $notification = Notification::create(['title' => $title, 'description' => $body, 'time_publish' => now(), 'created_by' => auth()->id()]);
        $SERVER_API_KEY = 'AAAAK-2cV9k:APA91bG_0iTqiuL8jkrOrPd5SLVrfH-ncsN6L7TA9ywzESej7ACUi4OCVroRDwam7iHj7V77piYyPTCJE3xvThyvyxK5jOTMJsOgd_itFBeHPp_Co6f6RDr1BfRIX-CXR89f6aWYESfd' ;

            $student->notifications()->attach($notification->id);

            $FCMs = $student->fcm_token;


        $data = [
            "registration_ids" => $FCMs, // for All device
            "notification" => array(
                'title' => $title,
                'body' => $body,
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

    public static function broadcastLectureNotification($id, $title, $body)
    {
        $ids = Student::select('id')->whereHas('packages', function($q) use ($id){
            return $q->whereHas('subjects', function($q) use ($id){
                return $q->whereHas('weekProgs', function($q) use ($id){
                    return $q->where('subject_id', $id);
                });
            });
        })->get();
        $tokens = User::select('fcm_token')->whereHas('student', function ($q) use ($ids){
            return $q->whereIn('id', $ids);
        })->get();

        $SERVER_API_KEY = 'AAAAK-2cV9k:APA91bG_0iTqiuL8jkrOrPd5SLVrfH-ncsN6L7TA9ywzESej7ACUi4OCVroRDwam7iHj7V77piYyPTCJE3xvThyvyxK5jOTMJsOgd_itFBeHPp_Co6f6RDr1BfRIX-CXR89f6aWYESfd' ;

        $FCMs = [];
        foreach ($tokens as $key => $token) {
            $FCMs[$key] = $token['fcm_token'];
        }

        $data = [
            "registration_ids" => $FCMs, // for All device
            "notification" => array(
                'title' => $title,
                'body' => $body,
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
