<?PHP
/**
 * API specific class file for the Whoosh Traffic! Rank Tracker.
 */

require_once('Whooshtraffic.php');

class Ranktracker extends Whooshtraffic
{
    private $api = 'ranktracker';
    
    public function fetch($keywords)
    {
        $data = http_build_query(array("keywords" => $keywords));
        
        $result = $this->rest_call($this->api, Null, Null, Null, 'POST', $data);
        return $this->decode_result($result[0]);
    }
}