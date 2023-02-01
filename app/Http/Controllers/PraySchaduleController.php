<?php

namespace App\Http\Controllers;

use App\Models\PrayerSchadule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PraySchaduleController extends Controller
{

    public function index(Request $request)
    {
        $startDate = $request->query('start_date', date('Y-m-1'));
        $endDate = $request->query('end_date', date('Y-m-15'));
        $praySchadules = PrayerSchadule::whereBetween('date', [$startDate, $endDate])
            ->paginate(10)->withQueryString();

        return response()->view('admin.prayer.index', compact('praySchadules'));
    }

    public function updatePraySchadule()
    {
        $startDate = 1;
        $success = 0;
        $error = 0;
        $date = Carbon::now();
        $daysInMonth = Carbon::now()->daysInMonth;

        for ($i = $startDate; $i <= $daysInMonth; $i++) {
            $newDate = Carbon::create($date->year, $date->month, $i)->format('Y-m-d');
            $request = Http::get("https://api.banghasan.com/sholat/format/json/jadwal/kota/744/tanggal/$newDate");

            if ($request->successful()) {
                $schedule = $request->object()->jadwal->data;
                PrayerSchadule::create([
                    'subuh' =>  $this->_formatTimeSchadule($schedule->subuh),
                    'dhuhur' => $this->_formatTimeSchadule($schedule->dzuhur),
                    'ashar' => $this->_formatTimeSchadule($schedule->ashar),
                    'manggrip' => $this->_formatTimeSchadule($schedule->maghrib),
                    'isya' => $this->_formatTimeSchadule($schedule->isya),
                    'date' => $newDate
                ]);
                $success++;
            } else {
                $error++;
            }
        }

        Log::info("berhasil update jadwal shalat success $success error $error");
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
