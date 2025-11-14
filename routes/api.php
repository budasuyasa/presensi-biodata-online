<?php

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('absensi', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string|max:255',
        'nim' => [
            'required',
            'max:225',
            'string',
            function ($attribute, $value, $fail) {
                if (!in_array($value, nimList())) {
                    $fail("NIM tidak ditemukan");
                }
            },
        ],
        'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
        'device' => 'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => $validator->errors()->toArray()
        ], 401);
    }

    $data = $request->only('nama', 'kelas', 'nim', 'jenis_kelamin', 'device');
    $data['agent_info'] = $request->userAgent();

    Biodata::updateOrCreate([
        'nim' => $request->post('nim')
    ], $data);

    return response()->json([
        'status' => 'success',
        'message' => 'Absensi berhasil'
    ]);
});

function nimList()
{
    return [
        '2301010063',
        '2301010064',
        '2301010066',
        '2301010067',
        '2301010068',
        '2301010070',
        '2301010071',
        '2301010073',
        '2301010074',
        '2301010076',
        '2301010077',
        '2301010078',
        '2301010079',
        '2301010080',
        '2301010081',
        '2301010082',
        '2301010085',
        '2301010086',
        '2301010087'
    ];
}
