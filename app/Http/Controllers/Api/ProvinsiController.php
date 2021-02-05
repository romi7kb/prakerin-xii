<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use Validator;
class ProvinsiController extends Controller
{
    public $messeges = [
        'kode_prov.required'=>'kode provinsi tidak boleh kosong',
        'kode_prov.max'=>'kode provinsi tidak boleh lebih dari 4 karakter',
        'nama_prov.required'=>'nama provinsi tidak boleh kosong',
        'kode_prov.unique'=>'kode provinsi sudah ada',
        'nama_prov.unique'=>'nama provinsi sudah ada',
    ];
    public function index()
    {
        $data = Provinsi::all();
        $response= [
            'success' => true,
            'messege' => 'Semua data Provinsi',
            'data' => $data,
            'message' => 'berhasil',
        ];
        return response()->json($response);
    }
    public function store(Request $request)
    {
        $rules = [
            'id' => 'required|unique:provinsis|max:4',
            'kode_prov' => 'required|unique:provinsis|max:4',
            'nama_prov' => 'required|unique:provinsis',
        ];
        $validasi= Validator::make($request->all(),$rules,$this->messeges);
        if ($validasi->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validasi->errors()
            ],400);
        }else {
            $input = $request->all();
            $provinsi = Provinsi::insert($input);
            if ($provinsi) {
                return response()->json([
                    'success' => true,
                    'message' => 'provinsi Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'provinsi Gagal Disimpan!',
                ], 400);
            }

        }
    }
    public function show($id)
    {
        $provinsi = Provinsi::whereId($id)->first();

        if ($provinsi) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Provinsi!',
                'data'    => $provinsi
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Provinsi Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }
    public function update(Request $request,$id)
    {
        $rules = [
            'id' => 'required|max:4',
            'kode_prov' => 'required|max:4',
            'nama_prov' => 'required',
        ];
        $validasi= Validator::make($request->all(),$rules,$this->messeges);
        if ($validasi->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validasi->errors()
            ],400);
        }else {
            $input = $request->all();
            $provinsi = Provinsi::whereId($id)->update($input);
            if ($provinsi) {
                return response()->json([
                    'success' => true,
                    'message' => 'provinsi Berhasil Diubah!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'provinsi Gagal Diubah!',
                ], 400);
            }

        }
    }
    public function destroy($id)
    {
        $provinsi = Provinsi::whereId($id)->first();
        
        if ($provinsi) {
            $provinsi->delete();
            return response()->json([
                'success' => true,
                'message' => 'Provinsi Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Provinsi Gagal Dihapus! Tidak ditemukan!',
            ], 500);
        }

    }
}
