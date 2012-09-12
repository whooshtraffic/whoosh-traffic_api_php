<?PHP
/**
 * This library provides a very basic wrapper around the RESTful
 * Whoosh Traffic! API. Currently, the only API supported is the Rank
 * Tracker API. Other API's are to follow soon.
 */

require_once('includes/Curl.php');

class Whooshtraffic
{
    const WHOOSH_URL = "https://secure.whooshtraffic.com/";
    
    public $api_key;
    public $api_login;
    public $response_mime;
    
    public $response;
    
    public function __construct($api_key, $api_login, $response_mime="json")
    {
        $this->api_key = $api_key;
        $this->api_login = $api_login;
        
        if(!in_array($response_mime, array('json', 'xml')))
        {
            throw new Exception('Response mime type must be one of "json" or "xml".');
        }
        
        $this->response_mime = $response_mime;
    }
    
    /**
     * Private method for building the RESTful api calls, making them,
     * and returning the results to the caller.
     */
    protected function rest_call($api, $segment=Null, $object=Null, $action=Null, $method='GET', $data=Null)
    {
        if(!in_array($method, array('GET', 'POST', 'PUT', 'DELETE', 'HEAD')))
        {
            throw new Exception('The supplied method is not valid.');
        }
        
        $uri = Whooshtraffic::WHOOSH_URL . $api;
        
        // Append any resources to the URI
        if($segment) { $uri .= '/' . $segment; }
        if($object)  { $uri .= '/' . $object; }
        if($action)  { $uri .= '/' . $action; }
        
        $data = is_array($data) ? http_build_query($data) : $data;
        
        $options = array(
            CURLOPT_FAILONERROR      => False,
            CURLOPT_FOLLOWLOCATION   => True,
            CURLOPT_RETURNTRANSFER   => True,
            CURLOPT_FRESH_CONNECT    => True,
            CURLOPT_FORBID_REUSE     => True,
            
            // Set our request method explicitly, even if it's the default
            CURLOPT_CUSTOMREQUEST    => $method,
            CURLOPT_URL              => $uri,
            CURLOPT_HTTPAUTH         => CURLAUTH_BASIC,
            CURLOPT_USERPWD          => $this->api_login.':'.$this->api_key,
            CURLOPT_HTTPHEADER       => array('Accept: application/vnd.whoosh.api+'.$this->response_mime),
            CURLOPT_SSL_VERIFYHOST   => 2        
        );
        
        // Easy pancakes
        if(in_array($method, array('POST', 'PUT')))
        {
            $options[CURLOPT_POSTFIELDS] = $data;
        }
        
        // HEAD gets special treatment, which is stupid
        if($method == 'HEAD')
        {
            unset($options[CURLOPT_CUSTOMREQUEST]);
            $options[CURLOPT_NOBODY] = True;
        }
        
        // Instantiate our curl object
        $curl = new Curl($options);
        
        $result = $curl->execute(array(22));
        $status = $curl->status($code=Null);
        $response = array($result, $status);
        
        $this->response = $response;
        
        if(!in_array($status['http_code'], array(200, 201, 202, 204, 300)))
        {
            throw new Exception($status['http_code'] . ' ' . $result);
        }
        
        return $response;
    }
}