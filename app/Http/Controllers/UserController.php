<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Imports\UserImport;
use App\Models\ClasessModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $title = 'Evoting';
    protected $siswa = 'Siswa';
    protected $menu = 'User';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function halaman()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Upload User',
            'label' => 'User Import',
        ];
        return view('user.halaman')->with($data);
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'excelFile' => 'required|mimes:xls,xlsx',
        ]);


        $file = $request->file('excel_file'); // 'excel_file' is the name attribute of the input file
        dd($file);

        $import = new UserImport;
        Excel::import($import, $file, null, \Maatwebsite\Excel\Excel::XLSX);

        // dd($file);

        return view('user.data_import');
    }

    public function hasil_import()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'submenu' => 'Bursa Opname',
            'label' => 'Hasil Import',
            'produkexcel' => User::all()
        ];

        return view('user.data_import')->with($data);
    }

    public function get_data_pengguna(Request $request)
    {
        $userdata = DB::table('users')
            ->select('name', 'email', 'users.id', 'nis', 'roles', 'class_name', 'class_level')
            ->leftJoin('clasess', 'clasess.id', 'users.class_id')
            ->where('roles', '=', 'siswa')
            ->whereNull('users.deleted_at')
            ->orderBy('users.id', 'DESC');


        // if ($request->get('search_manual') != null) {
        //     $search = $request->get('search_manual');
        //     // $search_rak = str_replace(' ', '', $search);
        //     $userdata->where(function ($where) use ($search) {
        //         $where
        //             ->orWhere('name', 'like', '%' . $search . '%')
        //             ->orWhere('email', 'like', '%' . $search . '%')
        //             ->orWhere('nis', 'like', '%' . $search . '%')
        //             ->orWhere('roles', 'like', '%' . $search . '%');
        //         // ->orWhere('id_supplier', 'like', '%' . $search . '%');
        //     });

        //     $search = $request->get('search');
        //     // $search_rak = str_replace(' ', '', $search);
        //     if ($search != null) {
        //         $userdata->where(function ($where) use ($search) {
        //             $where
        //                 ->orWhere('name', 'like', '%' . $search . '%')
        //                 ->orWhere('email', 'like', '%' . $search . '%')
        //                 ->orWhere('nis', 'like', '%' . $search . '%')
        //                 ->orWhere('roles', 'like', '%' . $search . '%');
        //             // ->orWhere('id_supplier', 'like', '%' . $search . '%');
        //         });
        //     }
        // } else {
        //     if ($request->get('name') != null) {
        //         $name = $request->get('name');
        //         $userdata->where('name', '=', $name);
        //     }
        //     if ($request->get('email') != null) {
        //         $email = $request->get('email');
        //         $userdata->where('email', '=', $email);
        //     }
        //     if ($request->get('name') != null) {
        //         $name = $request->get('name');
        //         $userdata->where('name', '=', $name);
        //     }
        // }

        return DataTables::of($userdata)
            ->addColumn('class', function ($userdata) {
                if ($userdata->class_name) {
                    $class = $userdata->class_name . ' - ' . $userdata->class_level;
                } else {
                    $class = '-';
                }
                return $class;
            })
            ->addColumn('action', 'user.akse')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->siswa,
            'label' => $this->siswa,
        ];
        return view('user.list')->with($data);
    }

    public function alluser()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
        ];
        return view('user.alluser')->with($data);
    }

    public function get_data_all(Request $request)
    {
        $userdata = DB::table('users')
            ->whereNull('users.deleted_at')
            ->orderBy('users.id', 'DESC');

        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('nis', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('roles', 'like', '%' . $search . '%');
                // ->orWhere('id_supplier', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $userdata->where(function ($where) use ($search) {
                    $where
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('nis', 'like', '%' . $search . '%')
                        ->orWhere('nik', 'like', '%' . $search . '%')
                        ->orWhere('roles', 'like', '%' . $search . '%');
                    // ->orWhere('id_supplier', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('name') != null) {
                $name = $request->get('name');
                $userdata->where('name', '=', $name);
            }
            if ($request->get('email') != null) {
                $email = $request->get('email');
                $userdata->where('email', '=', $email);
            }
            if ($request->get('name') != null) {
                $name = $request->get('name');
                $userdata->where('name', '=', $name);
            }
        }

        return DataTables::of($userdata)
            ->addColumn('action', 'user.aksiall')
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
            'kelas' => ClasessModel::All()
        ];
        return view('user.input')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email',
            'telepon' => 'required|unique:users,phone',
        ]);

        DB::beginTransaction();
        try {
            $osis = new User();
            $osis->name = $request->nama;
            $osis->email = $request->email;
            if ($request->avatar) {
                $fileName = Carbon::now()->format('ymdhis') . '_' . str::random(25) . '.' . $request->avatar->extension();
                $osis->avatar = $fileName;
                $request->avatar->move(public_path('avatar'), $fileName);
            }
            $osis->password =  bcrypt('12345');
            $osis->pin = 1234;
            $osis->nis = $request->nis ?? 0;
            $osis->nik = $request->nik ?? 0;
            $osis->address = $request->alamat;
            $osis->phone = $request->telepon;
            $osis->roles = $request->role;
            $osis->class_id = $request->kelas;
            $osis->save();

            DB::commit();
            AlertHelper::addAlert(true);
            if ($request->flag == 'tambah_siswa') {
                return redirect('/pengguna');
            } else {
                return redirect('/alluser');
            }
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }

    public function tambah_siswa(Request $request)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->siswa,
            'label' => $this->siswa,
            'kelas' => ClasessModel::All()
        ];
        return view('user.tambah_siswa')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
            'data' => User::findOrFail($id),
            'kelas' => ClasessModel::all(),
        ];
        return view('user.edit')->with($data);
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
        DB::beginTransaction();
        try {
            $osis1 = User::findOrFail($id);
            $osis1->name = $request->nama;
            $osis1->email = $request->email;
            $osis1->password =  bcrypt('12345');
            if ($request->avatar) {
                $fileName = Carbon::now()->format('ymdhis') . '_' . str::random(25) . '.' . $request->avatar->extension();
                $osis1->avatar = $fileName;
                $request->avatar->move(public_path('avatar'), $fileName);
            }
            $osis1->pin =  1234;
            $osis1->nis = $request->nis;
            $osis1->nik = $request->nik;
            $osis1->address = $request->alamat;
            $osis1->phone = $request->telepon;
            $osis1->roles = $request->role;
            $osis1->class_id = $request->kelas;
            $osis1->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/alluser');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
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
        DB::beginTransaction();
        try {
            $hapus = User::findorfail($id);
            $hapus->deleted_at = Carbon::now();
            $hapus->save();

            DB::commit();
            AlertHelper::deleteAlert(true);
            return back();
        } catch (\Throwable $err) {
            DB::rollBack();
            AlertHelper::deleteAlert(false);
            return back();
        }
    }

    public function profil()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'profil' => User::where('id', Auth::user()->id)->first()
        ];

        return view('user.profil')->with($data);
    }


    public function updateProfil(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email|max:50',
            'nis' => 'max:15',
            'pin' => 'required|numeric|max:9999',
            'role' => 'required|in:guru,siswa,Administrator',
            'nik' => 'max:15',
            'password' => 'nullable|max:60',
            'alamat' => 'max:50',
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->nis = $request->nis;
            $user->pin = $request->pin;
            $user->roles = $request->role;
            $user->nik = $request->nik;
            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->address = $request->alamat;
            $user->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/profil');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }
}
