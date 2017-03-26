<?php
namespace Concrete\Package\RwmFacebookEvents\Controller\SinglePage\Dashboard\FacebookEvents;
use \Concrete\Core\Page\Controller\DashboardPageController;
use Config;

defined('C5_EXECUTE') or die("Access Denied.");
class Settings extends DashboardPageController
{

    public function view() 
    {
        $this->set('fb_page_id', h(Config::get('rwm_facebook_events.fb_page_id')));
        $this->set('access_token', h(Config::get('rwm_facebook_events.access_token')));
    }

    public function save_settings()
    {
        if ($this->post()) {

            Config::save('rwm_facebook_events.fb_page_id', $this->post('fb_page_id'));
            Config::save('rwm_facebook_events.access_token', $this->post('access_token'));

            $this->redirect('/dashboard/facebook_events/settings', 'config_saved');

        }
    }

    public function config_saved()
    {
        $this->set('message', t('Settings saved'));
        $this->view();
    }

}