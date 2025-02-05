<?php

namespace App\Http\Controllers;

use App\Models\PrayerSchadule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PraySchaduleController extends Controller
{

    public function index(Request $request)
    {
        $monthList = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $month = $request->query('month', date('m'));
        $praySchadules = PrayerSchadule::whereMonth('date', $month)
            ->paginate(10)->withQueryString();

        return response()->view('admin.prayer.index', compact('praySchadules', 'month', 'monthList'));
    }

    public function changeAudio(Request $request)
    {
        $request->validate(['audio' => ['required', 'mimes:mp3']]);

        $file = Storage::path('public/storage/adzan.mp3');
        if (File::exists($file)) {
            File::delete($file);
        }

        $request->file('audio')
            ->storePubliclyAs('audio', 'adzan.mp3', 'public');

        return redirect()->route('pray.index')->with('msg', 'berhasing mengganti audio');
    }

    public function updatePraySchaduleV2()
    {
        $date = Carbon::now();
        $year = $date->year;
        $month = $date->month;
        $request = Http::get("https://api.myquran.com/v2/sholat/jadwal/1604/$year/$month");
        if ($request->successful()) {
            $response = $request->object();
            $insertData = [];
            foreach ($response->data->jadwal as $key => $schadule) {
                $newDate = $schadule->date;
                if (PrayerSchadule::whereDate('date', $newDate)->count() < 1) {
                    $insertData[] = [
                        'subuh' =>  $this->_formatTimeSchadule($schadule->subuh),
                        'dhuhur' => $this->_formatTimeSchadule($schadule->dzuhur),
                        'ashar' => $this->_formatTimeSchadule($schadule->ashar),
                        'manggrip' => $this->_formatTimeSchadule($schadule->maghrib),
                        'isya' => $this->_formatTimeSchadule($schadule->isya),
                        'date' => $newDate
                    ];
                }
            }
            PrayerSchadule::insert($insertData);
        }else {
            Log::error("======================error update pray schadule=================");
            Log::error($request->body());
        }

        return redirect()->route('pray.index');



    }

    public function updatePraySchadule()
    {
        $error = 0;
        $success = 0;
        $startDate = 1;

        $date = Carbon::now();
        $daysInMonth = Carbon::now()->daysInMonth;

        for ($i = $startDate; $i <= $daysInMonth; $i++) {
            $newDate = Carbon::create($date->year, $date->month, $i)->format('Y-m-d');
            $request = Http::get("https://api.banghasan.com/sholat/format/json/jadwal/kota/744/tanggal/$newDate");
            dd($request->body());

            if ($request->successful()) {
                $schedule = $request->object()->jadwal->data;
                if (PrayerSchadule::whereDate('date', $newDate)->count() < 1) {
                    PrayerSchadule::create([
                        'subuh' =>  $this->_formatTimeSchadule($schedule->subuh),
                        'dhuhur' => $this->_formatTimeSchadule($schedule->dzuhur),
                        'ashar' => $this->_formatTimeSchadule($schedule->ashar),
                        'manggrip' => $this->_formatTimeSchadule($schedule->maghrib),
                        'isya' => $this->_formatTimeSchadule($schedule->isya),
                        'date' => $newDate
                    ]);
                }
                $success++;
            } else {
                $error++;
            }
        }

        Log::info("berhasil update jadwal shalat success $success error $error");
        return redirect()->route('pray.index');
    }

    private function _formatTimeSchadule($time)
    {

        $minutesAvaiable = [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60];
        $dateNow = date('Y-m-d');
        $date = date_create($dateNow . $time)->modify('-10 minutes');
        $time =  $date->format('H:i');
        $minute = (int)explode(':', $time)[1];
        //jika menit tidak sesuai jadwal
        if (!in_array($minute, $minutesAvaiable)) {
            while (!in_array($minute, $minutesAvaiable)) {
                $date->modify('-1 minutes');
                $minute--;
            }
            return $date->format('H:i');
        }
        return $date->format('H:i');
    }
}
