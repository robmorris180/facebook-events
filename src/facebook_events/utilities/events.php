<?php
namespace Concrete\Package\RwmFacebookEvents\Src\FacebookEvents\Utilities;
use Concrete\Package\RwmFacebookEvents\Src\FacebookEvents\Event;
use Config;

class Events
{

    public static function getEvents()
    {   

        $fb_page_id = Config::get('rwm_facebook_events.fb_page_id');
        $access_token = Config::get('rwm_facebook_events.access_token');

        $fields = 'id,name,start_time,cover';

        $today = date('Y-m-d');
 
        $json_link = 'https://graph.facebook.com/v2.8/' . $fb_page_id . '/events/?fields=' . $fields . '&access_token=' . $access_token .'&since=' . $today .'';
         
        $json = file_get_contents($json_link);

        $obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

        $event_count = count($obj['data']);
 
        for($x = 0; $x < $event_count; $x++){

            $event = array(
                'id'    =>  $obj['data'][$x]['id'],
                'title' =>  $obj['data'][$x]['name'],
                'time'  =>  $obj['data'][$x]['start_time'],
                'cover' =>  $obj['data'][$x]['cover']['source']   
            );

            Event::saveEvent($event);

        }

        return true;

    }

}