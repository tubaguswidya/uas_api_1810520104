<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pegawai;
use Validator;
class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        $pegawais = Pegawai::with('Jabatan', 'Golongan')->get();
        return response()->json($pegawais);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id_jabatan' => 'required',
            'id_golongan' => 'required',
            'nama_pegawai' => 'required',
            'status' => 'required',
            'jumlah_anak' => 'required'
        ]);
        if ($validate->passes()){

            $pegawais = Pegawai::create($request->all());
            return response()->json([
                'message' => 'Data Berhasil Disimpan',
                'data' => $pegawais
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
    public function show($pegawais)
    {
        $pegawais = Pegawai::with('jabatan','golongan')->where('id_pegawai', $pegawais)->first();
        return response()->json($pegawais); 
        // {
        //     return $data;
        // }
        // return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
     public function update(Request $request, $pegawais)
    {
        $data = Pegawai::where('id_pegawai', $pegawais)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
                'id_jabatan' => 'required',
                'id_golongan' => 'required',
                'nama_pegawai' => 'required',
                'status' => 'required',
                'jumlah_anak' => 'required'
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
    public function destroy($pegawais)
    {
        $data = Pegawai::where('id_pegawai', $pegawais)->first();
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
