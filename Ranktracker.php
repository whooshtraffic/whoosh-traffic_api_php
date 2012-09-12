<?PHP
/**
 * API specific class file for the Whoosh Traffic! Rank Tracker.
 */

require_once('Whooshtraffic.php');

class Ranktracker extends Whooshtraffic
{
    private $api = 'ranktracker';
    private $seg = 'pairs';
    
    public function get_all($type=Null)
    {
        if(in_array($type, array('ranked', 'unranked')))
        {
            $result = $this->rest_call($this->api, $this->seg, $type);
        } else {
            $result = $this->rest_call($this->api, $this->seg);
        }
        
        return $this->decode_result($result[0]);
    }
    
    public function get($id, $type=Null)
    {
        if(in_array($type, array('ranked', 'unranked')))
        {        
            $result = $this->rest_call($this->api, $this->seg, $id, $type);
        } else {
            $result = $this->rest_call($this->api, $this->seg, $id);
        }
        
        return $this->decode_result($result[0]);
    }
    
    public function count($type=Null)
    {
        if(in_array($type, array('ranked', 'unranked')))
        {        
            $result = $this->rest_call($this->api, $this->seg, $type.'_count');
        } else {
            $result = $this->rest_call($this->api, $this->seg, 'count');
        }
        
        return $this->decode_result($result[0]);
    }
    
    public function checksum_all($type=Null)
    {
        if(in_array($type, array('ranked', 'unranked')))
        {        
            $result = $this->rest_call($this->api, $this->seg, $type.'_checksum');
        } else {
            $result = $this->rest_call($this->api, $this->seg, 'checksum');
        }
        
        return $result[0];
    }
    
    public function exists($id)
    {
        $result = $this->rest_call($this->api, $this->seg, $id, Null, 'HEAD');
        
        // If no 404 exception was thrown then we succeeded
        return True;
    }
    
    public function timeline_exists($id)
    {
        $result = $this->rest_call($this->api, $this->seg, $id, 'timeline', 'HEAD');
        
        // If no 404 exception was thrown then we succeeded
        return True;
    }
    
    public function create($data)
    {
        $result = $this->rest_call($this->api, $this->seg, Null, Null, 'POST', $data);
        return $this->decode_result($result[0]);
    }
    
    public function update($id, $data)
    {
        $result = $this->rest_call($this->api, $this->seg, $id, Null, 'PUT', $data);
        
        // If it succeeds (no exception thrown) then it was updated
        return True;
    }
    
    public function delete($id)
    {
        $result = $this->rest_call($this->api, $this->seg, $id, Null, 'DELETE');
        
        // If it succeeds (no exception thrown) then it was deleted
        return True;
    }
    
    /**
     * This method handles a number of the generic methods:
     *   1. GET timeline
     *   2. GET settings
     *   3. GET cache
     *   4. GET checksum (for single pair)
     *
     */
    public function __call($name, $args)
    {
        $id = $args[0];
        $result = $this->rest_call($this->api, $this->seg, $id, $name);
        
        switch($name)
        {
            case 'timeline':
                return $this->decode_result($result[0]);
            case 'settings':
                return $this->decode_result($result[0]);
            case 'cache':
            case 'checksum':
                return $result[0];
        }
    }
    
    private function decode_result($result)
    {
        if($this->response_mime == 'json')
        {
            return json_decode($result, True);
        } else {
            return new SimpleXMLElement($result);
        }
    }
}