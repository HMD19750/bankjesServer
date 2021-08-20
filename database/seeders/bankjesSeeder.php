<?php

namespace Database\Seeders;

use App\Models\Bankje;
use Illuminate\Database\Seeder;

class bankjesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $strJsonFileContents = file_get_contents("database/seeders/json/export bankjes nederland 1.geojson");
        $array = json_decode($strJsonFileContents, true);
        foreach ($array["features"] as $object) {
            if ($object["geometry"]["type"] == "Point") {
                $latitude = (float)$object["geometry"]["coordinates"][1];
                $longitude = (float)$object["geometry"]["coordinates"][0];
                $bankje = new Bankje;
                $bankje->typeBankje = "bankje";
                $bankje->Latitude = $latitude;
                $bankje->Longitude = $longitude;
                $bankje->save();
            }
        }
print("Nederlandse bankjes deel 1 geladen\n");

$strJsonFileContents = file_get_contents("database/seeders/json/export bankjes nederland 2.geojson");
$array = json_decode($strJsonFileContents, true);
foreach ($array["features"] as $object) {
    if ($object["geometry"]["type"] == "Point") {
        $latitude = (float)$object["geometry"]["coordinates"][1];
        $longitude = (float)$object["geometry"]["coordinates"][0];
        $bankje = new Bankje;
        $bankje->typeBankje = "bankje";
        $bankje->Latitude = $latitude;
        $bankje->Longitude = $longitude;
        $bankje->save();
    }
}
print("Nederlandse bankjes deel 2 geladen\n");

$strJsonFileContents = file_get_contents("database/seeders/json/export bankjes nederland 3.geojson");
$array = json_decode($strJsonFileContents, true);
foreach ($array["features"] as $object) {
    if ($object["geometry"]["type"] == "Point") {
        $latitude = (float)$object["geometry"]["coordinates"][1];
        $longitude = (float)$object["geometry"]["coordinates"][0];
        $bankje = new Bankje;
        $bankje->typeBankje = "bankje";
        $bankje->Latitude = $latitude;
        $bankje->Longitude = $longitude;
        $bankje->save();
    }
}
print("Nederlandse bankjes deel 3 geladen\n");

$strJsonFileContents = file_get_contents("database/seeders/json/export bankjes belgie.geojson");
$array = json_decode($strJsonFileContents, true);
foreach ($array["features"] as $object) {
    if ($object["geometry"]["type"] == "Point") {
        $latitude = (float)$object["geometry"]["coordinates"][1];
        $longitude = (float)$object["geometry"]["coordinates"][0];
        $bankje = new Bankje;
        $bankje->typeBankje = "bankje";
        $bankje->Latitude = $latitude;
        $bankje->Longitude = $longitude;
        $bankje->save();
    }
}
print("Belgische bankjes geladen\n");


    }
}
