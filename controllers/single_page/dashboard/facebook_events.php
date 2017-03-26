<?php 
namespace Concrete\Package\RwmFacebookEvents\Controller\SinglePage\Dashboard;
use Concrete\Core\Page\Controller\DashboardPageController;

defined('C5_EXECUTE') or die(_("Access Denied."));
class FacebookEvents extends DashboardPageController {

    public function __construct() {
        $this->redirect('/dashboard/facebook_events/settings');
    }

}