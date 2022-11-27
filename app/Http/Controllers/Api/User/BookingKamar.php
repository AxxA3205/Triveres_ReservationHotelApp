<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kamar;
use App\Models\Transaksi;

class BookingKamar extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $kamar = Kamar::find($request->id_kamars);
        if ($user->role == 'user') {
            $booking = Transaksi::create([
                'id_kamar' => $request->id_kamars,
                'id_user' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'check_in' => $request->check_in,
                'durasi' => $request->durasi,
                'total_harga' => $request->durasi * $kamar->harga_kamar
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Pesanan berhasil ditambahkan',
                'data' => $booking
            ], 201);
        } else {
            return response([
            'status' => 'Error',
            'message' => 'Anda bukan user',
            'data' => $booking
        ], 401);
        }
    }
}
