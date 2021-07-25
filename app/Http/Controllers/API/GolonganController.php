<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Golongan;
use Validator;

class GolonganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        $golongans = Golongan::all();
        return response()->json($golongans);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tunjangan_nikah' => 'required',
            'tunjangan_anak' => 'required',
            'upah_makan' => 'required',
            'lembur' => 'required',
            'asuransi' => 'required'
        ]);
        if ($validate->passes()){

            $golongans = Golongan::create($request->all());
            return response()->json([
                'message' => 'Data Berhasil Disimpan',
                'data' => $golongans
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
     public function show($golongans)
    {
        $data = Golongan::where('id_golongan', $golongans)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
    public function update(Request $request, $golongans)
    {
        $data = Golongan::where('id_golongan', $golongans)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
                'tunjangan_nikah' => 'required',
                'tunjangan_anak' => 'required',
                'upah_makan' => 'required',
                'lembur' => 'required',
                'asuransi' => 'required'
        ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Berhasil Disimpan',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Gagal Disimpan',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data tidak ditemukan'
        ], 404);
    }
    public function destroy($golongans)
    {
        $data = Golongan::where('id_golongan', $golongans)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ], 404);
            # code...
        }
        
        $data->delete();
        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 200);
    }
}
