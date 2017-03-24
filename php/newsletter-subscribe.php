<?php
/*
Name: 			Newsletter Subscribe
Written by: 	Okler Themes - (http://www.okler.net)
Version: 		4.3.1
*/

require_once('mailchimp/mailchimp.php');

// Step 1 - Set the apiKey - How get your Mailchimp API KEY - http://kb.mailchimp.com/article/where-can-i-find-my-api-key
$apiKey 	= '8feece7a95f69feab18aa8d1f58e8c21-us14';

// Step 2 - Set the listId - How to get your Mailchimp LIST ID - http://kb.mailchimp.com/article/how-can-i-find-my-list-id
$listId 	= 'f6b86cf5f6';

$MailChimp = new \Drewm\MailChimp($apiKey);

$result = $MailChimp->call('lists/subscribe', array(
                'id'                => $listId,
                'email'             => array('email'=>$_POST['email']),
                'merge_vars'        => array('FNAME'=>'', 'LNAME'=>''), // Step 3 (Optional) - Vars - More Information - http://kb.mailchimp.com/merge-tags/using/getting-started-with-merge-tags
                'double_optin'      => false,
                'update_existing'   => false,
                'replace_interests' => false,
                'send_welcome'      => false,
            ));

if (in_array('error', $result)) {
    $arrResult = array ('response'=>'error','message'=>$result['error']);
} else {
    $arrResult = array ('response'=>'success');
}

echo json_encode($arrResult);