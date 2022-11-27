<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamar = Kamar::all();

        return response()->json([
            'message' => 'Data kamar berhasil ditampilkan',
            'data' => $kamar
        ], 200);
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
        $user = auth()->user();
        if($user->role == 'admin') 
        {
            $request->validate([
            'nama_hotel' => 'required',
            'jenis_kamar' => 'required',
            'tipe_bed'=> 'required',
            'harga_kamar' => 'required',
            'deskripsi_kamar'=> 'required'
            ]);

            $kamar = Kamar::create([
                "nama_hotel" => $request->nama_hotel,
                "jenis_kamar" => $request->jenis_kamar,
                "tipe_bed" => $request->tipe_bed,
                "harga_kamar" => $request->harga_kamar,
                "deskripsi_kamar" => $request->deskripsi_kamar  
            ]);

            return response()->json([
                'status' =>'success',
                'message' => 'Kamar berhasil ditambahkan',
                'data' => $kamar
            ], 201);
        } else {
            return response()->json([
                'status' =>'error',
                'message' => 'Anda tidak memiliki akses untuk menambahkan kamar',
            ], 401);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kamar = kamar::find($id);
        if ($kamar) {
            return response()->json([
                'status' => 200,
                'data' => $kamar
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
        $user = auth()->user();
        if ($user->role == 'admin') {
            $request->validate([
            'nama_hotel' => 'required',
            'jenis_kamar' => 'required',
            'tipe_bed'=> 'required',
            'harga_kamar' => 'required',
            'deskripsi_kamar'=> 'required'
            ]);

            $kamar = Kamar::find($id);

            $kamar->update([
            'nama_hotel' => $request->nama_hotel,
            'jenis_kamar' => $request->jenis_kamar,
            'tipe_bed'=> $request->tipe_bed,
            'harga_kamar' => $request->harga_kamar,
            'deskripsi_kamar'=> $request->deskripsi_kamar
            ]);

             return response()->json([
                'status' =>'success',
                'message' => 'Kamar berhasil diupdate',
                'data' => $kamar
            ], 201);
        } else {
            return response()->json([
                'status' =>'error',
                'message' => 'Anda tidak memiliki akses untuk mengupdate kamar',
            ], 401);
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
        $user = auth()->user();
        if ($user->role == 'admin') {
            $kamar = Kamar::find($id);
            $kamar->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Kamar berhasil dihapus',

            ], 200);
        } else{
            return response()->json([
                'status' =>'error',
                'message' => 'Anda tidak memiliki akses untuk menghapus kamar',
            ], 401);
        }
    }
}

