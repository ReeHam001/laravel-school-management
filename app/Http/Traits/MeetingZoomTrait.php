<?php

namespace App\Http\Traits;

use MacsiDigital\Zoom\Facades\Zoom;

trait MeetingZoomTrait
{
    public function createMeeting($request){   // نحنا عملنا التابع

        $user = Zoom::user()->first();

        $meetingData = [
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->password, // auto
            'start_time' => $request->start_time,
            'timezone' => config('zoom.timezone')  // اذا بدنا ناخد التوقيت من الزووم
          // 'timezone' => 'Africa/Cairo'
        ];
        $meeting = Zoom::meeting()->make($meetingData);   // بيعمل ميتنغ على زووم

        $meeting->settings()->make([  // اعدادات الزووم
            'join_before_host' => false,
            'host_video' => false,
            'participant_video' => false,
            'mute_upon_entry' => true,
            'waiting_room' => true,
            'approval_type' => config('zoom.approval_type'),
            'audio' => config('zoom.audio'),
            'auto_recording' => config('zoom.auto_recording')
        ]); // في لسه اعدادات
        // منتحكم باعدادت الزوم من الكود

        return  $user->meetings()->save($meeting);


    }
}
