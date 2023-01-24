<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $audio = Audio::paginate(10);

        return response()
            ->view('admin.audio.index', compact('audio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
        return response()
            ->view('admin.audio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->file('audio'));
        $request->validate([
            'audio' => ['required', 'array']
        ]);

        $file = $request->file('audio');
        $count = 0;

        foreach ($file as $key => $value) {

            $name = $value->getClientOriginalName();

            $file = Storage::path("public/audio/$name");

            if (File::exists($file)) {
                $name = time() . '-' . $name;
            }
            // upload file
            $value->storePubliclyAs('audio', $name, 'public');
            // insert database
            Audio::create([
                'name' => $name
            ]);

            $count++;
        }

        return redirect()
            ->route('audio.index')
            ->with('message', "berhasil menambahkan $count audio");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $audio = Audio::findOrFail($id);

        $file = Storage::path("public/audio/$audio->name");

        if (File::exists($file)) {
            File::delete($file);
        }

        $audio->delete();

        return redirect()
            ->route('audio.index')
            ->with('message', "berhasil menghapus audio");
    }
}
