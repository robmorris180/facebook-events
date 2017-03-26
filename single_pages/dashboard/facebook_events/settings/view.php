<?php 
    defined('C5_EXECUTE') or die("Access Denied.");
    $form = Core::make('helper/form');
?>

<form action="<?php echo $view->action('save_settings'); ?>" method="post">
    
    <fieldset>
        <legend><?php  echo t('Facebook Page ID'); ?></legend> 
        <div class="form-group">   
            <label for="fb_page_id"><?php echo t('Facebook Page ID'); ?></label>
            <?php echo $form->text('fb_page_id', $fb_page_id); ?>
            <span class="help-block">
                <?php echo t('Find you Facebook page ID by clicking on the link below:'); ?>
                <a href="http://findmyfbid.com/" target="_blank"><?php echo t('Find my facebook ID'); ?></a>
            </span>
        </div>

    </fieldset>

    <fieldset>
        <legend><?php  echo t('Access Token'); ?></legend> 
        <div class="form-group">
            <label for="access_token"><?php echo t('Access token'); ?></label>
            <?php echo $form->text('access_token', $access_token); ?>
        </div>
    </fieldset>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-success" type="submit"><?php echo t('Save')?></button>
        </div>
    </div>

</form>