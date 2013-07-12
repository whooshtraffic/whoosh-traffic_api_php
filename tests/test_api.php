<?PHP

require_once('../Ranktracker.php');
require_once('../KeywordResearch.php');

$rt = new Ranktracker('koHBYmkd5WySho2ijIx4cu6C7nlorP5Z8WqXl8A9PcRJdaIMv/JaS', 'Jibt78OGZcAwHln');

$data = <<<'EOT'
<?xml version="1.0" encoding="UTF-8"?>
<pair>
  <url>http://example.com</url>
  <keyword>a keyword</keyword>
  <locale>87505</locale>
</pair>
EOT;

$data1 = <<<'EOT'
<?xml version="1.0" encoding="UTF-8"?>
<pair>
  <url>http://someurl.com</url>
  <keyword>yet another keyword</keyword>
</pair>
EOT;

//echo print_r($rt->get_quota());
//echo print_r($rt->get_all("ranked"));
//echo print_r($rt->get_all("unranked"));
//echo print_r($rt->get_all());
//echo print_r($rt->get(530440));
//echo print_r($rt->count());
//echo print_r($rt->checksum_all());
//echo print_r($rt->exists(530440));
//echo print_r($rt->timeline_exists(530442));
//echo print_r($rt->create($data));
echo print_r($rt->update(531135, $data1));