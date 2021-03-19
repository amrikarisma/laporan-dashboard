<?php

namespace Modules\Settings\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $id_user = session('id_user');
        $cabang = MyHelper::apiGet('cabang?pluck=1')['data'] ?? [];
        $divisi = MyHelper::apiGet('divisi?pluck=1')['data'] ?? [];
        $jabatan = MyHelper::apiGet('jabatan?sort=asc&pluck=1')['data'] ?? [];
        $roles = MyHelper::apiGet('role')['data'] ?? [];
        $profile = MyHelper::apiGet('profile')['data'] ?? [];
        if(!$profile) {
            return redirect()->back();
        }
        return view('settings::index', compact('cabang', 'divisi', 'jabatan', 'profile','roles'));
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
            'profile_photo' => ['nullable','image:jpeg,png,jpg,gif,svg','max:2048'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $checkAnggota = MyHelper::apiGet('anggota/'.$id)['data']??[];

        if(!$checkAnggota) {
            return redirect()->route('anggota.index');
        }

        $anggota = [
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'email'             => $request->email,
            'password'          => 'harusdiganti',
            'roles'             => $request->role,
            'nick_name'         => $request->nick_name,
            'place_of_birth'    => $request->place_of_birth,
            'birthday'          => $request->birthday,
            'address'           => $request->address,
            'national_id'       => $request->national_id,
            'license_id'        => $request->license_id,
            'marriage'          => $request->marriage,
            'divisi'            => $request->divisi,
            'cabang'            => $request->cabang,
            'jabatan'           => $request->jabatan,
            'divisi'            => $request->divisi,
            'cabang'            => $request->cabang,
            'jabatan'           => $request->jabatan,
            'join_date'         => $request->join_date,
            'sk_pengangkatan'   => $request->sk_pengangkatan,
            'nik'               => $request->nik,
            'password'          => $request->password,
        ];
        if(isset($request->profile_photo) && !empty($request->profile_photo)) {
            $anggota['profile_photo'] = $request->profile_photo;
        }
        // return $anggota;
        $newAnggota = MyHelper::apiPostWithFile('anggota/'.$id.'/update', $anggota, $request);

        if(isset($newAnggota['status']) ) {
            if($newAnggota['status'] == 'success') {
                return redirect()->route('settings.index')->with('message', $newAnggota['message']);
            } elseif($newAnggota['status'] == 'failed'){
                return redirect()->route('settings.index')->with('error', $newAnggota['message']);
            }
        }
        return redirect()->back()->withErrors($newAnggota['error'])->withInput();
    }
}
