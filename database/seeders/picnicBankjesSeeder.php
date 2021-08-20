<?php

namespace Database\Seeders;

use App\Models\Bankje;
use Illuminate\Database\Seeder;

class picnicBankjesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $strJsonFileContents = file_get_contents("database/seeders/json/export picnictables belgium.geojson");
        $array = json_decode($strJsonFileContents, true);
        foreach ($array["features"] as $object) {
            if ($object["geometry"]["type"] == "Point"){
                $latitude = (float)$object["geometry"]["coordinates"][1];
                $longitude = (float)$object["geometry"]["coordinates"][0];
                $bankje = new Bankje;
                $bankje->typeBankje = "picnicbankje";
                $bankje->Latitude = $latitude;
                $bankje->Longitude = $longitude;
                $bankje->save();            
            }
        }
        print("Belgische picnictafels geladen\n");

        $strJsonFileContents = file_get_contents("database/seeders/json/export picnictables nederland.geojson");
        $array = json_decode($strJsonFileContents, true);
        foreach ($array["features"] as $object) {
            if ($object["geometry"]["type"] == "Point"){
                $latitude = (float)$object["geometry"]["coordinates"][1];
                $longitude = (float)$object["geometry"]["coordinates"][0];
                $bankje = new Bankje;
                $bankje->typeBankje = "picnicbankje";
                $bankje->Latitude = $latitude;
                $bankje->Longitude = $longitude;
                $bankje->save();            
            }

        }
        print("Nederlandse picnictafels geladen\n");
    }
}

