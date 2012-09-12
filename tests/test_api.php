<?PHP

require_once('../Ranktracker.php');

$rt = new Ranktracker('QK1SsrVurJ5gUEBgLX9VOerNGyF8pIVETe1mYoo26WxM1nPXqMP6q', 'Jibt78OGZcAwHln');

echo '<h1>Get All</h1>';
echo var_dump($rt->get_all());
echo "<br /><br />";

echo '<h1>Get All Ranked</h1>';
echo var_dump($rt->get_all('ranked'));
echo "<br /><br />";

echo '<h1>Get All Unranked</h1>';
echo var_dump($rt->get_all('unranked'));
echo "<br /><br />";

echo '<h1>Get One</h1>';
echo var_dump($rt->get(159344));
echo "<br /><br />";

echo '<h1>Count All</h1>';
echo var_dump($rt->count());
echo "<br /><br />";

echo '<h1>Count All Ranked</h1>';
echo var_dump($rt->count('ranked'));
echo "<br /><br />";

echo '<h1>Count All Unranked</h1>';
echo var_dump($rt->count('unranked'));
echo "<br /><br />";

echo '<h1>Checksum All</h1>';
echo var_dump($rt->checksum_all());
echo "<br /><br />";

echo '<h1>Checksum All Ranked</h1>';
echo var_dump($rt->checksum_all('ranked'));
echo "<br /><br />";

echo '<h1>Checksum All Unranked</h1>';
echo var_dump($rt->checksum_all('unranked'));
echo "<br /><br />";

echo '<h1>Exists</h1>';
echo var_dump($rt->exists(159344));
echo "<br /><br />";

echo '<h1>Timeline Exists</h1>';
echo var_dump($rt->exists(159344));
echo "<br /><br />";

echo '<h1>Create</h1>';
$data = '<?xml version="1.0" encoding="UTF-8"?>
<pair>
  <url>http://ixmat.us</url>
  <keyword>a keyword</keyword>
</pair>';
echo var_dump($rt->create($data));
echo "<br /><br />";

echo '<h1>Update</h1>';
$data = '<?xml version="1.0" encoding="UTF-8"?>
<pair>
  <url>http://ixmat.us</url>
  <keyword>porno</keyword>
</pair>';
echo var_dump($rt->update(161691, $data));
echo "<br /><br />";


echo '<h1>Delete</h1>';
echo var_dump($rt->delete(161691));
echo "<br /><br />";
