<?php

namespace App\Http\Controllers\Penpos;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenposController extends Controller
{
    public function index()
    {
        // Ambil Nama Value nya aja
        $maps = Auth::user()->maps()
            ->get()
            ->pluck('name')
            ->toArray();

        // Tim yg udh main
        $results = Auth::user()
            ->teams()
            ->get();
//                    ->pluck('id')
//                    ->toArray();
        $idYgUdhMain = $results->pluck('id')->toArray();

        // Tim yg blm main
        $belumMain = Team::whereNotIn('id', $idYgUdhMain)->get();

//        dd($results);

        return view('penpos.index', compact('maps', 'results', 'belumMain'));
    }

    public function status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'statusPos' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('penpos')->with("error", "Data yang diisikan belum lengkap");
        } else {
            $status = $request->get("statusPos");
            $post = User::find(Auth::user()->id);
            $post->status = $status;
            $post->save();

            return redirect()->back()->with("success", "Ubah status berhasil");
        }
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            // $request->session()->flash('valid', 'false');
            return redirect()->route('penpos')->with("error", "Data yang diisikan belum lengkap!");
        } else {
            DB::beginTransaction();
            try {
                $group_id = $request->get("team");
                $status = $request->get("status");
                $post_id = Auth::user()->id;

                Auth::user()->teams()->attach([
                   $group_id => ['result' => $status]
                ]);

//                $result = new Result();
//                $result->group_id = $group_id;
//                $result->result = $status;
//                $result->post_id = $post_id;
//                $result->save();

                $post = User::find(Auth::user()->id);
                $post->status = "Kosong";
                $post->save();
                DB::commit();
                return redirect()->back()->with("success", "Input data berhasil!");
            } catch (\Exception $x) {
                DB::rollBack();
                return redirect()->back()->with("error", "Input data gagal!");
            }
        }
    }
}
