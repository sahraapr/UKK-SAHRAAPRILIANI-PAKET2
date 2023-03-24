<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('_petugas.masyarakat.index');
    }

    public function getMasyarakat()
    {
        $data = Masyarakat::get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $id = $row->id;
            $edit = route('petugas.masyarakat.edit', $id);

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
            'nik' => 'required|min:16|max:16|unique:masyarakat,nik',
            'nama' => 'required',
            'telp' => 'required|unique:masyarakat,telp',
            'username' => 'required|unique:masyarakat,username',
            'password' => 'required|min:8'
        ]);

        Masyarakat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => Hash::make($request->password),
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
        $data = Masyarakat::findOrFail($id);

        return view('_petugas.masyarakat.edit', compact('data'));
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
        $data = Masyarakat::findOrFail($id);

        $validate = $request->validate([
            'nik' => 'required|min:16|max:16|unique:masyarakat,nik,'.$data->id,
            'nama' => 'required',
            'telp' => 'required|unique:masyarakat,telp,'.$data->id,
            'username' => 'required|unique:masyarakat,username,'.$data->id,
            'password' => $request->password ? 'min:8' : ''
        ]);

        $data->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $data->password
        ]);

        alert()->success('Berhasil!', 'Data berhasil diubah')->persistent(true, false)->autoClose(3000);

        return redirect()->route('petugas.masyarakat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Masyarakat::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus',
            'success' => true
        ]);
    }
}
