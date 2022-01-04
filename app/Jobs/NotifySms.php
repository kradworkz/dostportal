<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifySms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_id, $document_id;

    public function __construct($user_id = null, $document_id = null)
    {
        $this->user_id = $user_id;
        $this->document_id = $document_id;
    }

    public function handle()
    {
        $user = User::with('profile')->where('id',$this->user_id)->first();
        $name = $user->profile->firstname.' '.$user->profile->extension.' '.$user->profile->middlename[0].'. '.$user->profile->lastname;
        $mobile = $user->profile->mobile_no;

        $data = Document::where('id', $this->document_id)->first();
        $message = "Hi, ".$name." You have been tagged to the document with  Routing Slip : ".$data->route_slip." and a subject : ".$data->subject.".";

       if(!empty($user)){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.dost9.ph/sms/messages');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $post = array(
                'recipient' => $mobile,
                'message' => $message,
                'title' => 'Trace Notification System'
            );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            
        }
    }
}
