<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campinggrounds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('plz');
            $table->string('ort');
            $table->string('straße');
            $table->string('hausnummer');
            $table->string('telefonnummer');
            $table->time('oeffnungszeitenAnfang');
            $table->time('oeffnungszeitenEnde');
            $table->decimal('preis', 10, 2);
            $table->integer('anzahlFreierPlaetze');
            $table->boolean('WC');
            $table->boolean('dusche');
            $table->boolean('spielplatz');
            $table->boolean('tiereErlaubt');
            $table->boolean('barriereFrei');
            $table->boolean('bademoeglichkeit');
            $table->boolean('kiosk');
            $table->boolean('WLAN');
            $table->boolean('strom');
            $table->boolean('waschmaschine');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campinggrounds');
    }
};
