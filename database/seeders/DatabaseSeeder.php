<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        foreach([["Admin", "admin"],["Claire", "grube"],["Wilma", "lecken"],["Sergej", "fährlich"],["Peer", "verser"],["Haddamah", "gaffada"]] as $e){
            \App\Models\User::factory()->create([
                'name' => $e[0],
                'email' => strtolower($e[0])."@".$e[1].".com",
                'password' => Hash::make($e[1])
            ]);
        };
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('admin')
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Claire',
        //     'email' => 'claire@grube.com',
        //     'password' => Hash::make('grube')
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Wilma',
        //     'email' => 'wilma@lecken.com',
        //     'password' => Hash::make('lecken')
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Sergej',
        //     'email' => 'sergey@fährlich.com',
        //     'password' => Hash::make('fährlich')
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Peer',
        //     'email' => 'peer@verser.com',
        //     'password' => Hash::make('verser')
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Haddamah ',
        //     'email' => 'haddamah@gaffada.com',
        //     'password' => Hash::make('gaffada')
        // ]);

        foreach([["Nature Camping", "18403", "Nature", "Naturestreet", "5", "0436543", "00:00", "24:00",  "22.00", "11", True, True, False, True, True, True, True, False, True, True, "https://www.usnews.com/object/image/00000172-0a48-dd19-af73-dfc9adc60000/1-intro.jpg?update-time=1589312815886&size=responsive640"],
            ["Forest Camping", "24500", "Neuwald", "Neuer Waldweg", "13", "04046387387436543", "08:00", "21:00", "20.00", "7", True, True, True, True, True, False, True, True, True, False, "https://eurekacamping.johnsonoutdoors.com/sites/default/files/tent-camping-at-sunset.jpg"],
            ["NOK Camping", "24768", "Rendsburg", "Kanalstraße", "66a", "04356374356", "06:00", "22:00", "12.80", "35", True, True, True, True, False, True, False, False, True, True, "https://mediafiles.urlaubsguru.de/wp-content/uploads/2015/04/three-friends-camping-on-mountain-at-sunset-istock_48107094_xlarge-2.jpg"],
            ["Neumünster Camping", "24536", "Neumünster", "Hauptstraße", "18a", "0785486732", "07:00", "21:00", "16.50", "52", True, True, False, False, True, False, True, True, True, True, "https://www.fnp.de/bilder/2020/09/04/90037396/23894747-teilweise-kann-wildcampen-in-deutschland-richtig-teuer-werden-3sfe.jpg"],
            ["Bordesholm Camping", "25235", "Bordesholm", "Dorfstraße", "12", "075837443543", "08:00", "20:00", "13.50", "24", True, True, True, True, True, True, False, False, False, False, "https://blog-6aa0.kxcdn.com/wp-content/uploads/2021/02/camping-reiseziele-in-deutschland-titel-bild.jpg"],
            ["Kieler Campingparadies", "28764", "Kiel", "Achterbahn", "65", "04376587353", "10:00", "19:00", "75.60", "45", True, True, False, False, False, False, True, False, False, False, "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCTvreuZjNlKBC3gZGOCjPMnrjfpZxzeYHDhmhGTIVwa3IzRXoUaeUMRAPlyGRQb30Jw4&usqp=CAU"]] as $e){
            \App\Models\Campingground::factory()->create([
                'name' => $e[0],
                'plz' => $e[1],
                'ort' => $e[2],
                'straße' => $e[3],
                'hausnummer' => $e[4],
                'telefonnummer' => $e[5],
                'oeffnungszeitenAnfang' => $e[6],
                'oeffnungszeitenEnde' => $e[7],
                'preis' => $e[8],
                'anzahlFreierPlaetze' => $e[9],
                'WC' => $e[10],
                'dusche' => $e[11],
                'spielplatz' => $e[12],
                'tiereErlaubt' => $e[13],
                'barrierefrei' => $e[14],
                'bademoeglichkeit' => $e[15],
                'kiosk' => $e[16],
                'WLAN' => $e[17],
                'strom' => $e[18],
                'waschmaschine' => $e[19],
                'bildURL' => $e[20]
            ]);
        }

        \App\Models\Rating::factory()->create([
            'bewertung' => '3',
            'user_id' => 2,
            'campingground_id' => 3
        ]);
        \App\Models\Rating::factory()->create([
            'bewertung' => '2',
            'user_id' => 2,
            'campingground_id' => 2
        ]);
        \App\Models\Rating::factory()->create([
            'bewertung' => '5',
            'user_id' => 1,
            'campingground_id' => 4
        ]);
        \App\Models\Rating::factory()->create([
            'bewertung' => '4',
            'user_id' => 3,
            'campingground_id' => 1
        ]);
     }
}
