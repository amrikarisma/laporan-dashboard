<?php

namespace Modules\Anggota\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $anggotas = MyHelper::apiGet('anggota')['data'] ?? [];

        return view('anggota::index', compact('anggotas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $cabang = MyHelper::apiGet('cabang?pluck=1')['data'] ?? [];
        $divisi = MyHelper::apiGet('divisi?pluck=1')['data'] ?? [];
        $jabatan = MyHelper::apiGet('jabatan?sort=asc&pluck=1')['data'] ?? [];

        return view('anggota::create',  compact('cabang', 'divisi', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email'=> $request->email,
            'password' => 'harusdiganti',
            'role' => 'users',
            'nick_name' => $request->nick_name,
            'place_of_birth' => $request->place_of_birth,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'national_id' => $request->national_id,
            'license_id' => $request->license_id,
            'marriage' => $request->marriage,
            'profile_photo' => $request->file('profile_photo'),
            'divisi'     => $request->divisi,
            'cabang'     => $request->cabang,
            'jabatan'     => $request->jabatan,
        ];

        $newuser = MyHelper::apiPost('register', $user);
        // return $newuser;
        if(isset($newuser['status']) && $newuser['status'] == 'success'){
            $anggota = [
                'user_id'       => $newuser['data']['id'],
                'divisi'     => $request->divisi,
                'cabang'     => $request->cabang,
                'jabatan'     => $request->jabatan,
                'join_date'     => $request->join_date,
                'sk_pengangkatan'     => $request->sk_pengangkatan,
                'nik'     => $request->nik,
            ];

            $newAnggota = MyHelper::apiPost('anggota', $anggota);

            return redirect()->route('anggota.index')->with('message', $newAnggota['message']);

        }
        // return $newuser;
        return redirect()->back()->withErrors($newuser['error'])->withInput();

        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $anggota = MyHelper::apiGet('anggota/' . $id)['data'] ?? [];
        // return $anggota;
        return view('anggota::show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $cabang = MyHelper::apiGet('cabang?pluck=1')['data'] ?? [];
        $divisi = MyHelper::apiGet('divisi?pluck=1')['data'] ?? [];
        $jabatan = MyHelper::apiGet('jabatan?sort=asc&pluck=1')['data'] ?? [];

        $anggota = MyHelper::apiGet('anggota/' . $id)['data'] ?? [];

        return view('anggota::edit',  compact('cabang', 'divisi', 'jabatan', 'anggota'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $anggota = MyHelper::apiGet('anggota/'.$id)['data']??[];

        if(!$anggota) {
            return redirect()->route('anggota.index');
        }

        $user = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email'=> $request->email,
            'password' => 'harusdiganti',
            'role' => 'users',
            'nick_name' => $request->nick_name,
            'place_of_birth' => $request->place_of_birth,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'national_id' => $request->national_id,
            'license_id' => $request->license_id,
            'marriage' => $request->marriage,
            'profile_photo' => $request->file('profile_photo'),
            'divisi'     => $request->divisi,
            'cabang'     => $request->cabang,
            'jabatan'     => $request->jabatan,
        ];
        $updateUser = MyHelper::apiPost('user/'.$anggota['user']['id'].'?_method=put', $user);

        if(isset($updateUser['status']) && $updateUser['status'] == 'success'){
            $anggota = [
                'user_id'           => $updateUser['data']['id'],
                'divisi'            => $request->divisi,
                'cabang'            => $request->cabang,
                'jabatan'           => $request->jabatan,
                'join_date'         => $request->join_date,
                'sk_pengangkatan'   => $request->sk_pengangkatan,
                'nik'               => $request->nik,
            ];

            $newAnggota = MyHelper::apiRequest('PUT','anggota', $anggota);

            return redirect()->route('anggota.index')->with('message', $newAnggota['message']);

        }
        // return $updateUser;
        return redirect()->back()->withErrors($updateUser['error'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
