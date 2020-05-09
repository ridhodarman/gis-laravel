<?php
include '../inc/koneksi.php';
$latit = $_GET["lat"];
$longi = $_GET["lng"];
$rad = $_GET["rad"];

$querysearch = "SELECT msme_building_id, name_of_msme_building ,ST_X(ST_CENTROID(geom)) AS lon, ST_Y(ST_CENTROID(geom)) AS lat,
				ST_DISTANCE_SPHERE(ST_GeomFromText('POINT(" . $longi . " " . $latit . ")',-1), geom) as jarak
				FROM msme_building WHERE ST_DISTANCE_SPHERE(ST_GeomFromText('POINT(" . $longi . " " . $latit . ")',-1),
				geom) <= " . $rad . " ORDER BY jarak
				";

$hasil = pg_query($querysearch);
while ($row = pg_fetch_array($hasil)) {
    $id = $row['msme_building_id'];
    $name = $row['name_of_msme_building'];
    $longitude = $row['lon'];
    $latitude = $row['lat'];
    $dataarray[] = array('id' => $id, 'name' => $name,
        'longitude' => $longitude, 'latitude' => $latitude);
}
echo json_encode($dataarray);