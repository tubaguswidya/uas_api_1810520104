<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jabatan;
use Validator;
class JabatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        $jabatans = Jabatan::all();
        return response()->json($jabatans);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
            'tunjangan_jabatan' => 'required'
        ]);
        if ($validate->passes()){

            $jabatans = Jabatan::create($request->all());
            return response()->json([
                'message' => 'Data Berhasil Disimpan',
                'data' => $jabatans
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
     public function show($jabatans)
    {
        $data = Jabatan::where('id_jabatan', $jabatans)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
    public function update(Request $request, $jabatans)
    {
        $data = Jabatan::where('id_jabatan', $jabatans)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
            'tunjangan_jabatan' => 'required'
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
    public function destroy($jabatans)
    {
        $data = Jabatan::where('id_jabatan', $jabatans)->first();
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
