<?php 
$info = apc_cache_info("user");

foreach ($info as $key => $value) {
	var_dump($key).PHP_EOL;
}
echo "<hr>";
var_dump(getIds());
apc_clear_cache();
apc_clear_cache('user');

function getIds()
{
    $ci = apc_cache_info('user');
    $keys = array();

    foreach ($ci['cache_list'] as $entry) {
        $keys[] = $entry['info'];
    }

    return $keys;
}

if ($_GET["delete"]) {
	foreach(getIds() as $id) {
		apc_delete($id);
		
	}
}
