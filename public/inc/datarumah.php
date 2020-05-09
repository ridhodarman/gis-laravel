<?php
header('content-type: application/json');
header("access-control-allow-origin: *");
include('koneksi.php');
$sql  = "SELECT  
			ST_AsGeoJSON(geom) AS geometry,
			house_building_id,
			owner_id
		FROM house_building
		";
$geojson = array(
	'type'      => 'FeatureCollection',
	'features'  => array()
);
$query = pg_query($sql);
if(pg_num_rows($query)==0) return 0;
while($rows=pg_fetch_assoc($query)){
	$feature = array(
		"type" => 'Feature',
		'geometry' => json_decode($rows['geometry'], true),
		'jenis' => "House",
		'properties' => array(
			'id' => $rows['house_building_id'],
			'nama' => "null"
		)
	);
	array_push($geojson['features'], $feature);
}
echo json_encode($geojson);