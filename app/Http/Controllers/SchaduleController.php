<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\PrayerSchadule;
use App\Models\Schadule;
use App\Models\SchaduleDetail;
use App\Models\SchaduleTimes;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SchaduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schadules = Schadule::with('times')
            ->paginate(10);

        return view('admin.schadules.index', compact('schadules'));
    }

    public function create(): Response
    {
        $times = File::get('times.json');
        $days = File::get('days.json');
        $files = Audio::all();

        $data = [
            'times' => $schedule->json_decode($times),
            'days' => json_decode($days),
            'files' => $files
        ];


        return response()
            ->view('admin.schadules.create', $data);
    }

    public function show($id)
    {
        $schadule = Schadule::findOrFail($id);

        return response()
            ->view('admin.schadules.show', compact('schadule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'unique:schadules,name'],
            'duration' => ['required'],
            'days' => ['required', 'array'],
            'times' => ['required', 'array'],
            'audio' => ['required', 'array'],
        ]);


        $schadule = Schadule::create([
            'name' => $request->input('name'),
            'volume' => $request->input('volume', 80),
            'duration' => $request->input('duration'),
            'shuffle' => $request->input('shuffle') ? true : false
        ]);

        foreach ($request->input('days') as $day) {
            foreach ($request->input('times') as $key => $time) {
                SchaduleTimes::create([
                    'schadule_id' => $schadule->id,
                    'day' => $day,
                    'time' => $time
                ]);
            }
        }

        foreach ($request->input('audio') as $audio) {
            SchaduleDetail::create([
                'schadule_id' => $schadule->id,
                'audio_id' => $audio
            ]);
        }

        return redirect()->route('schadules.index')
            ->with('message', 'berhasil menambahkan jadwal ' . $request->input('name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schadule = Schadule::findOrFail($id);
        $times = File::get('times.json');
        $days = File::get('days.json');
        $files = Audio::all();
        $selected_days = [];
        $selected_times = [];

        foreach ($schadule->times as $key => $st) {
            if (!in_array($st->day, $selected_days)) {
                $selected_days[] = $st->day;
            }
        }

        foreach ($schadule->times as $key => $st) {
            if (!in_array($st->time, $selected_times)) {
                $selected_times[] = $st->time;
            }
        }

        $data = [
            'times' => json_decode($times),
            'days' => json_decode($days),
            'files' => $files,
            'schadule' => $schadule,
            'selected_times' => $selected_times,
            'selected_days' => $selected_days,
            'selected_audio' => $schadule->audio,
        ];

        // return response()->json($data['selected_times']);

        return response()->view('admin.schadules.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $schadule = Schadule::findOrFail($id);

        $schadule->update([
            'name' => $request->input('name'),
            'volume' => $request->input('volume', 80),
            'duration' => $request->input('duration'),
            'shuffle' => $request->input('shuffle', false)
        ]);

        SchaduleDetail::where(['schadule_id' => $id])->delete();
        SchaduleTimes::where(['schadule_id' => $id])->delete();

        foreach ($request->input('days') as $day) {
            foreach ($request->input('times') as $key => $time) {
                SchaduleTimes::create([
                    'schadule_id' => $id,
                    'day' => $day,
                    'time' => $time
                ]);
            }
        }

        foreach ($request->input('audio') as $audio) {
            SchaduleDetail::create([
                'schadule_id' => $id,
                'audio_id' => $audio
            ]);
        }

        return redirect()->route('schadules.index')
            ->with('message', "berhasil update $schadule->name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SchaduleDetail::where(['schadule_id' => $id])->delete();
        SchaduleTimes::where(['schadule_id' => $id])->delete();

        $schadule = Schadule::findOrFail($id);
        $schadule->delete();

        return redirect()->route('schadules.index')
            ->with('message', "berhasil menghapus $schadule->name");
    }

    public function toggle($id)
    {
        $schadule = Schadule::findOrFail($id);

        $schadule->update([
            'status' => !$schadule->status
        ]);

        return redirect()->route('schadules.index')
            ->with('message', "berhasil update data $schadule->name");
    }
}
