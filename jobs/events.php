<?php
namespace Concrete\Package\RwmFacebookEvents\Job;
use \Concrete\Core\Job\Job as AbstractJob;
use \Concrete\Package\RwmFacebookEvents\Src\FacebookEvents\Utilities\Events as EventListings;

class Events extends AbstractJob
{

    public function getJobName()
    {
        return t("Fetch Facebook Events.");
    }

    public function getJobDescription()
    {
        return t("Gets all upcoming facebook events.");
    }

    public function run()
    {   

        $mtime = microtime();
        $mtime = explode(" ",$mtime);
        $mtime = $mtime[1] + $mtime[0];
        $starttime = $mtime;

        EventListings::getEvents();

        $mtime = microtime();
        $mtime = explode(" ",$mtime);
        $mtime = $mtime[1] + $mtime[0];
        $endtime = $mtime;
        $totaltime = ($endtime - $starttime);
        
        return t($message . ' (Script took: '.round($totaltime, 5).' seconds)');
    }
}