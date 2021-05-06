<?php

namespace Modules\Anggota\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AnggotaController extends Controller
{
    public function getListAnggota()
    {
        $anggotas = MyHelper::apiGet('anggota')['data'] ?? [];
        return DataTables::of($anggotas)
        ->editColumn('user.userdata.profile_photo_url', "anggota::index.thumb") 
        ->editColumn('user.name', $user['name']??'') 
        ->editColumn('jabatan.name', $jabatan['name']??'') 
        ->editColumn('divisi.name', $divisi['name']??'') 
        ->editColumn('cabang.name', $cabang['name']??'') 
        ->editColumn('join_date', $join_date??'') 
        ->editColumn('sk_pengangkatan', $sk_pengangkatan??'') 
        ->editColumn('nik', $nik??'') 
        ->addColumn('actions', "anggota::index.action") 
        ->rawColumns(['user.userdata.profile_photo_url','actions'])
        ->make();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('anggota::index');
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
        $roles = MyHelper::apiGet('role')['data'] ?? [];

        return view('anggota::create',  compact('cabang', 'divisi', 'jabatan', 'roles'));
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
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'profile_photo' => ['nullable','image:jpeg,png,jpg','max:2048'],
            // 'phone' => ['nullable', 'numeric', 'min:8','max:15']
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $anggota = [
            'first_name'            => $request->first_name,
            'last_name'             => $request->last_name,
            'email'                 => $request->email,
            'roles'                 => $request->role,
            'nick_name'             => $request->nick_name,
            'place_of_birth'        => $request->place_of_birth,
            'birthday'              => $request->birthday,
            'address'               => $request->address,
            'national_id'           => $request->national_id,
            'license_id'            => $request->license_id,
            'marriage'              => $request->marriage,
            'profile_photo'         => $request->profile_photo,
            'divisi'                => $request->divisi,
            'cabang'                => $request->cabang,
            'jabatan'               => $request->jabatan,
            'divisi'                => $request->divisi,
            'cabang'                => $request->cabang,
            'jabatan'               => $request->jabatan,
            'join_date'             => $request->join_date,
            'sk_pengangkatan'       => $request->sk_pengangkatan,
            'nik'                   => $request->nik,
            'phone'                 => $request->phone,
            'status'                => $request->status,
            'password'              => $request->password??1234
        ];

        $newAnggota = MyHelper::apiPostWithFile('anggota', $anggota, $request);
        // return $newAnggota ;
        if(isset($newAnggota['status']) ) {
            if($newAnggota['status'] == 'success') {
                return redirect()->route('anggota.index')->with('message', $newAnggota['message']);
            } elseif($newAnggota['status'] == 'failed'){
                return redirect()->back()->with('error', $newAnggota['message'])->withInput();
            }
        }

        return redirect()->back()->withErrors($newAnggota['error'])->withInput();

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $anggota = MyHelper::apiGet('anggota/' . $id)['data'] ?? [];
                if(!$anggota) {
            return redirect()->back();
        }
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
        $roles = MyHelper::apiGet('role')['data'] ?? [];
        $anggota = MyHelper::apiGet('anggota/' . $id)['data'] ?? [];
        if(!$anggota) {
            return redirect()->back();
        }
        $superadmin = MyHelper::hasAccess([1], session('roles'));

        return view('anggota::edit',  compact('cabang', 'divisi', 'jabatan', 'anggota','roles', 'superadmin'));
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
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'profile_photo' => ['nullable','image:jpeg,png,jpg,gif,svg','max:2048'],
            // 'phone' => ['nullable', 'numeric', 'min:8','max:15']
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
            'roles'             => $request->role,
            'nick_name'         => $request->nick_name,
            'place_of_birth'    => $request->place_of_birth,
            'birthday'          => $request->birthday,
            'address'           => $request->address,
            'national_id'       => $request->national_id,
            'license_id'        => $request->license_id,
            'marriage'          => $request->marriage,
            'profile_photo'     => $request->profile_photo,
            'divisi'            => $request->divisi,
            'cabang'            => $request->cabang,
            'jabatan'           => $request->jabatan,
            'divisi'            => $request->divisi,
            'cabang'            => $request->cabang,
            'jabatan'           => $request->jabatan,
            'join_date'         => $request->join_date,
            'sk_pengangkatan'   => $request->sk_pengangkatan,
            'nik'               => $request->nik,
            'phone'             => $request->phone,
            'status'            => $request->status,

        ];
        if($request->password && !empty($request->password)) {
            $anggota['password']    = $request->password;
        }
        $newAnggota = MyHelper::apiPostWithFile('anggota/'.$id.'/update', $anggota, $request);

        if(isset($newAnggota['status']) ) {
            if($newAnggota['status'] == 'success') {
                return redirect()->route('anggota.index')->with('message', $newAnggota['message']);
            } elseif($newAnggota['status'] == 'failed'){
                return redirect()->route('anggota.index')->with('error', $newAnggota['message']);
            }
        }
        return redirect()->back()->withErrors($newAnggota['error'])->withInput();

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
