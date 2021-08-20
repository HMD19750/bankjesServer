<?php

namespace Database\Seeders;

use App\Models\Bankje;
use Illuminate\Database\Seeder;

class schuilHutSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $strJsonFileContents = file_get_contents("database/seeders/json/export shelters netherlands.geojson");
        $array = json_decode($strJsonFileContents, true);
        foreach ($array["features"] as $object) {
            if ($object["geometry"]["type"] == "Point") {
                $latitude = (float)$object["geometry"]["coordinates"][1];
                $longitude = (float)$object["geometry"]["coordinates"][0];
                $bankje = new Bankje;
                $bankje->typeBankje = "schuilhut";
                $bankje->Latitude = $latitude;
                $bankje->Longitude = $longitude;
                $bankje->save();
            }
        }
print("Nederlandse schuilhutten geladen\n");

$strJsonFileContents = file_get_contents("database/seeders/json/export shelters belgium.geojson");
$array = json_decode($strJsonFileContents, true);
foreach ($array["features"] as $object) {
    if ($object["geometry"]["type"] == "Point") {
        $latitude = (float)$object["geometry"]["coordinates"][1];
        $longitude = (float)$object["geometry"]["coordinates"][0];
        $bankje = new Bankje;
        $bankje->typeBankje = "schuilhut";
        $bankje->Latitude = $latitude;
        $bankje->Longitude = $longitude;
        $bankje->save();
    }
}
print("Belgische schuilhutten geladen\n");


    }
}