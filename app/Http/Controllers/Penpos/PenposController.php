<?php

namespace App\Http\Controllers\Penpos;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    }

    public function submit(Request $request)
    {

    }
}
