<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel = Hotel::all();
        return $hotel;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Hotel::create([
            "nama_hotel" => $request->nama_hotel,
            "deskripsi" => $request->deskripsi,
            "jenis_kamar" => $request->jenis_kamar,
            "lokasi" => $request->lokasi
        ]);

        return response()->json([
            'success' =>201,
            'message' => 'data berhasil disimpan',
            'data' => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel = hotel::find($id);
        if ($hotel) {
            return response()->json([
                'status' => 200,
                'data' => $hotel
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id atas' . $id . ' tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $hotel = hotel::find($id);
        if($hotel){
            $hotel->nama_hotel = $request->nama_hotel ? $request->nama_hotel : $hotel->nama_hotel;
            $hotel->deskripsi = $request->deskripsi ? $request->deskripsi : $hotel->deskripsi;
            $hotel->jenis_kamar = $request->jenis_kamar ? $request->jenis_kamar : $hotel->jenis_kamar;
            $hotel->lokasi = $request->lokasi ? $request->lokasi : $hotel->lokasi;
            $hotel->save();
            return response()->json([
                'status' => 200,
                'data' => $hotel
            ], 200);
        }else{
            return response()->json([
                'status' =>404,
                'message'=> $id . ' tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = hotel::where('id', $id)->first();
        if ($hotel) {
            $hotel->delete();
            return response()->json([
                'status' =>200,
                'data' => $hotel
            ],200);
        }else{
            return response()->json([
                'status' =>404,
                'message' => 'id' . $id .' tidak ditemukan'
            ],404);
        }
    }
}
