<?php
require('../config/lti_key.php');
function validateRequest() {
    /*
    Validate that the LTI key and secret match what the LMS sent.
    Keys and secrets are used as credentials for OAuth.
    OAuth signs the requests to ensure integrity.

    You can (and should) change the key and secret to something only
    you as the LTI service provider and the client using the LMS know.

    We need to find a way to keep the token for verification before moving
    this into production. For the moment, this just does a very basic
    first-time verification that we aren't state-checking like we should on each
    request.
    */
    global $key, $secret;
    $store = new TrivialOAuthDataStore();
    $store->add_consumer($key, $secret);
    $server = new OAuthServer($store);
    $method = new OAuthSignatureMethod_HMAC_SHA1();
    $server->add_signature_method($method);
    $request = OAuthRequest::from_request();

    try {
        $server->verify_request($request);
    } catch (Exception $e) {
        echo("<p><b>Error:</b> Invalid request</p>");
        echo($e->getMessage());
        exit;
    }
}
if (! isset($_SESSION['source_id'])) {
    validateRequest();
    // Someone could just set these client-side. We need to use tokens
    // when in production. This works for a demo.
    $_SESSION['source_id'] = $_POST['lis_result_sourcedid'];
    $_SESSION['service_url'] = $_POST['lis_outcome_service_url'];
}

// Need to get a templating system up. One may already be in this project.
echo "<html><body><code>";
var_dump($_SESSION);
var_dump($_POST);
echo "</code></body></html>";