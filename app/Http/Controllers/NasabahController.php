<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Http\Requests\StoreNasabahRequest;
use App\Http\Requests\UpdateNasabahRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('nik')) {
            $nik = request('nik');
            $nasabah = Nasabah::where('nik', $nik)->first();
        } else {
            $nasabah = Nasabah::all();
        }

        return response()->json([
            'message' => 'OK',
            'data' => $nasabah,
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNasabahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNasabahRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        // insert data
        $nasabah = new Nasabah;
        $nasabah->id = Str::uuid();
        $nasabah->nik = $validated['nik'];
        $nasabah->nama = $validated['nama'];
        $nasabah->alamat = $validated['alamat'];
        $nasabah->tempat_lahir = $validated['tempat_lahir'];
        $nasabah->tanggal_lahir = $validated['tanggal_lahir'];
        $nasabah->no_handphone = $validated['no_handphone'];
        $nasabah->save();

        return response()->json([
            'message' => 'Data nasabah berhasil disimpan',
            'data' => $validated,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNasabahRequest  $request
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNasabahRequest $request, Nasabah $nasabah)
    {
        // update data
        $nasabah->nik = $request['nik'];
        $nasabah->nama = $request['nama'];
        $nasabah->alamat = $request['alamat'];
        $nasabah->tempat_lahir = $request['tempat_lahir'];
        $nasabah->tanggal_lahir = $request['tanggal_lahir'];
        $nasabah->no_handphone = $request['no_handphone'];
        $nasabah->save();

        return response()->json([
            'message' => "Data nasabah berhasil dirubah",
            'data' => $nasabah,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();

        return response()->json([
            'message' => "Data nasabah berhasil dihapus",
            'data' => $nasabah,
        ], Response::HTTP_OK);
    }
}
