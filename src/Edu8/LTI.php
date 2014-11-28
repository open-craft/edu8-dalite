<?php
namespace Edu8;

require_once '../OAuth/OAuth.php';
require_once '../OAuth/TrivialOAuthDataStore.php';
require_once '../config/lti_key.php';

class LTI {
    const SESSION_PARAMETER = "lti";
    
    const USER_ID_PARAMETER = "user_id";
    const SOURCED_ID_PARAMETER = "lis_result_sourcedid";
    const OUTCOME_SERVICE_ID_PARAMETER = "lis_outcome_service_url";
    const ASSIGNMENT_ID_PARAMETER = "custom_assignment_id";
    
    public $user_id;
    public $sourced_id;
    public $outcome_service_id;
    public $assignment_id;
    
    private $_correct_answers = 0;
    private $_total_answers = 0;
    
    public function __construct($user_id, $sourced_id, $outcome_service_id, $assigment_id) {
        $this->user_id = $user_id;
        $this->sourced_id = $sourced_id;
        $this->outcome_service_id = $outcome_service_id;
        $this->assignment_id = $assigment_id;
    }
    
    public static function validateRequest() {
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
        $store = new \TrivialOAuthDataStore();
        $store->add_consumer(KEY, SECRET);
        $server = new \OAuthServer($store);
        $method = new \OAuthSignatureMethod_HMAC_SHA1();
        $server->add_signature_method($method);
        $request = \OAuthRequest::from_request();

        $server->verify_request($request);
    }
    
    public static function parseRequest() {
        LTI::validateRequest(); // let the exceptions through, so that caller can decide what to do
        
        $user_id = filter_input(INPUT_POST, LTI::USER_ID_PARAMETER, FILTER_SANITIZE_STRING);
        $sourced_id = filter_input(INPUT_POST, LTI::SOURCED_ID_PARAMETER, FILTER_SANITIZE_STRING);
        $outcome_service_id = filter_input(INPUT_POST, LTI::OUTCOME_SERVICE_ID_PARAMETER, FILTER_SANITIZE_URL);
        $assigment_id = filter_input(INPUT_POST, LTI::ASSIGNMENT_ID_PARAMETER, FILTER_SANITIZE_NUMBER_INT);
        return new LTI($user_id, $sourced_id, $outcome_service_id, $assigment_id);
    }
    
    public function accumulateGrade($correct){
        $this->_total_answers += 1;
        if ($correct) {
            $this->_correct_answers += 1;
        }
    }
    
    public function resetGrade(){
        $this->_total_answers = 0;
        $this->_correct_answers = 0;
    }
    
    public function sendGrade() {
        $grade = 0;
        if ($this->_total_answers > 0) {
            $grade = $this->_correct_answers / $this->_total_answers;
        }
        $message_id = uniqid();
        $response_xml = sprintf(
                LTI::LTI_GRADE_RESPONSE_TEMPLATE, 
                LTI::XMLNS, 
                $message_id,
                $this->sourced_id,
                $grade
        );
        
        echo "<pre>".htmlentities($response_xml)."</pre>";
    }
    
    const XMLNS = "http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0";
    
    const LTI_GRADE_RESPONSE_TEMPLATE = <<<DOC
<?xml version = "1.0" encoding = "UTF-8"?>
<imsx_POXEnvelopeRequest xmlns = "%s">
  <imsx_POXHeader>
    <imsx_POXRequestHeaderInfo>
      <imsx_version>V1.0</imsx_version>
      <imsx_messageIdentifier>%s</imsx_messageIdentifier>
    </imsx_POXRequestHeaderInfo>
  </imsx_POXHeader>
  <imsx_POXBody>
    <replaceResultRequest>
      <resultRecord>
        <sourcedGUID>
          <sourcedId>%s</sourcedId>
        </sourcedGUID>
        <result>
          <resultScore>
            <language>en-us</language>
            <textString>%s</textString>
          </resultScore>
        </result>
      </resultRecord>
    </replaceResultRequest>
  </imsx_POXBody>
</imsx_POXEnvelopeRequest>
DOC;
}