<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('_petugas.administrator.index');
    }

    public function getAdministrator()
    {
        $data = Petugas::where('level', 'administrator')->get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $id = $row->id_petugas;
            $edit = route('petugas.administrator.edit', $id);

            $actionbtn = '<a href="'. $edit .'" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                            <a href="javascript:void(0)" onclick="deleteData(\''. $id .'\')" class="btn btn-sm btn-danger"><i
                                    class="far fa-trash-alt"></i></a>';
            return $actionbtn;
        })
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_petugas' => 'required',
            'telp' => 'required|unique:petugas,telp',
            'username' => 'required|unique:petugas,username',
            'password' => 'required|min:8',
            'status' => 'required'
        ]);

        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level' => 'administrator',
            'status' => $request->status
        ]);

        alert()->success('Berhasil!', 'Data berhasil ditambahkan')->persistent(true, false)->autoClose(3000);

        return back();
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
        $data = Petugas::findOrFail($id);

        return view('_petugas.administrator.edit', compact('data'));
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
        $data = Petugas::findOrFail($id);

        $validate = $request->validate([
            'nama_petugas' => 'required',
            'telp' => [
                'required',
                Rule::unique('petugas', 'telp')->ignore($data->id_petugas, 'id_petugas')
            ],
            'username' => [
                'required',
                Rule::unique('petugas', 'username')->ignore($data->id_petugas, 'id_petugas')
            ],
            'password' => $request->password ? 'min:8' : ''
        ]);

        $data->update([
            'nama_petugas' => $request->nama_petugas,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $data->password
        ]);

        alert()->success('Berhasil!', 'Data berhasil diubah')->persistent(true, false)->autoClose(3000);

        return redirect()->route('petugas.administrator');
    }

    public function changeStatus(Request $request)
    {
        $data = Petugas::findOrFail($request->id);

        $data->status = $request->status;
        $data->save();

        return response()->json(['success' => 'Status berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Petugas::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus',
            'success' => true
        ]);
    }
}
