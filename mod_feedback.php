<?php

/**
 * Web Query Module Entry Point
 * 
 * @package    Joomla
 * @subpackage Modules
 * @license    MIT
 * @link
 *     
 */
 
// No direct access
defined('_JEXEC') or die;

// Load vendors
include 'vendor/autoload.php';

// Load helpers
include 'helpers/db.php';
include 'helpers/mailer.php';

// Gather FuelPHP
use Fuel\Validation\Validator;

// Check for post data
if($service = JRequest::getVar('service', false, 'post') or $rantrave = JRequest::getVar('rantrave', false, 'post') ){

    // Check honeypot
    if( ! empty($_POST['birthday']) ){
        return true;
    }

    // Validate
    $val = new Validator;
    $val->addField('name')->required();
    $val->addField('number')->required()->number();
    $val->addField('email')->required()->email();

    // What form was completed
    switch(true){

        // *** SERVICE ENQUIRY *** //
        case $service :

            // Validate extra
            $val->addField('type')->required();
            $result = $val->run($service);
            if($result->isValid()){

                // Set subject of mailer
                $subject = "Service request";

                // Set post data
                $post = $service;
            }

            else{
                return false;
            }

        break;

        // *** RANT OR RAVE *** //
        case $rantrave :

            // Validate extra
            $val->addField('rant_or_rave')->required();
            $result = $val->run($rantrave);
            if($result->isValid()){

                // Set subject of mailer
                $subject = $rantrave['rant_or_rave'];

                // Set post data
                $post = $rantrave;
            }

            else{
                return false;
            }

        break;

        // *** Nothing *** //
        default :
        return false;
    }

    // Save data
    FeedbackHelperDb::save($post);

    // Email data
    FeedbackHelperMailer::send(
        array(
            $params->get('to_a'), 
            $params->get('to_b'), 
            $params->get('to_c')
        ),
        array(
            $params->get('cc_a'), 
            $params->get('cc_b'), 
            $params->get('cc_c')
        ),
        array(
            $params->get('bcc_a'), 
            $params->get('bcc_b'), 
            $params->get('bcc_c')
        ),
        $subject,
        $post
    );

    // We done
    print '<div class="ui success message"><i class="ui circular checkmark icon"></i>Sent successfully, we will be in touch.</div>';
}

// Display data
ob_start();
    require JModuleHelper::getLayoutPath('mod_feedback', 'default');
    $get = ob_get_contents();
ob_end_clean();
print preg_replace("({{ ?form ?}})", $get, $params->get('template'));