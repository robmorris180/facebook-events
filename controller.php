<?php
namespace Concrete\Package\RwmFacebookEvents;
use Package;
use AssetList;
use Asset;
use Page;
use SinglePage;
use Exception;
use Job;

class Controller extends Package 
{

    protected $pkgHandle = 'rwm_facebook_events';
    protected $appVersionRequired = '5.7.5.2';
    protected $pkgVersion = '1.0.9';

    public function getPackageDescription() 
    {
        return t("Add Facebook events");
    }

    public function getPackageName() 
    {
        return t("Facebook Events");
    }

    public function install() 
    {
        $pkg = parent::install();
        $this->configurePackage($pkg);
    }

    public function upgrade() 
    {
        $pkg = $this;
        $this->configurePackage($pkg);
        parent::upgrade();
    }

    public function configurePackage($pkg) 
    {
        $page = Page::getByPath('/dashboard/facebook_events/settings');

        if (!is_object($page) || !intval($page->getCollectionID())) {
            $page = SinglePage::add('/dashboard/facebook_events/settings', $pkg);
        }

        if (is_object($page) && intval($page->getCollectionID())) {
            $page->update(array('cName' => t('Settings'), 'cDescription' => t("Settings")));
        } else throw new Exception(t('Error: /dashboard/facebook_events/settings page not created'));

        if(!Job::getByHandle('events')){
            Job::installByPackage('events', $pkg);
        }
    }

}