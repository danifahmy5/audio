<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\PrayerSchadule;
use App\Models\Schadule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; 

class HomeController extends Controller
{
    private string $prayAudio = 'sholat.mp3';

    public function index()
    {
        $backgrounds = Storage::disk('bg')->allFiles();

        $praySchadule = PrayerSchadule::where('date', '=', date('Y-m-d'))
            ->where(DB::raw("CONCAT(subuh, dhuhur, ashar, manggrip, isya)"), 'LIKE', '%' . date('H:i:00') . '%')->first();
        
        $schadules = Schadule::whereHas('times', function ($q) {
            return $q->whereTime('time', date('H:i:00'))->where('day', date('l'));
        })->where('status', true)->first();
         

        $dirAudio = [];
        // mengecek apakah ada jadwal shalat
        if (!is_null($praySchadule)) {
            $file = Storage::path("public/audio/$this->prayAudio");

            if (File::exists($file)) {
                $dirAudio[] =  [
                    'name' => $this->prayAudio,
                    'audio' => asset("storage/audio/$this->prayAudio"),
                    'cover' => asset('bg') . '/' . $backgrounds[array_rand($backgrounds)],
                    'id' => 0,
                    'artist' => 'Dani fahmy rosyid'
                ];

                $dirAudio[] =  [
                    'name' => 'setelah-sholat.mp3',
                    'audio' => asset("storage/audio/setelah-sholat.mp3"),
                    'cover' => asset('bg') . '/' . $backgrounds[array_rand($backgrounds)],
                    'id' => 1,
                    'artist' => 'Dani fahmy rosyid'
                ];
            }
            //mengambil data audio saat tidak ada data shalat
        } else {

            if (!is_null($schadules)) {

                foreach ($schadules->audio as $key => $value) {
                    $file = Storage::path("public/audio/$value->name");

                    if (File::exists($file)) {
                        $dirAudio[] =  [
                            'name' => $value->name,
                            'audio' => asset("storage/audio/$value->name"),
                            'cover' => asset('bg') . '/' . $backgrounds[array_rand($backgrounds)],
                            'id' => $key,
                            'artist' => 'Dani fahmy rosyid'
                        ];
                    }
                }
                shuffle($dirAudio);
            }
        } 
        
        if (count($dirAudio) < 1) {
            return view('notfound');
        }
        $message = is_null($schadules) ? 'pemberitahuan sholat' : $schadules->name;
        
        Log::alert("run schadule " . $message);
        return view('audio', compact('dirAudio', 'schadules'));
    }

    public function testConnection()
    {
        try {
		$pdo = DB::connection()->getPdo();
		$databaseName = $pdo->query('SELECT DATABASE()')->fetchColumn();
            echo "Koneksi database " . $databaseName . " berhasil!";
        } catch (\Exception $e) {
            die("Koneksi database gagal: " . $e->getMessage());
        }
    }
}
