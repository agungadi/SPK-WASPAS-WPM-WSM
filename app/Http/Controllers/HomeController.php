<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alternatif;
use App\Models\kriteria;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

   $kriteria = kriteria::sum('bobot');

        $bobot1 = 3.5;
        $bobot2 = 3;
        $bobot3 = 2;
        $bobot4 = 1.5;


        $weight1 = [
            'kriterias' => $bobot1,
        ];
        $weight2 = [
            'kriterias' => $bobot2,
        ];
        $weight3 = [
            'kriterias' => $bobot3,
        ];
        $weight4 = [
            'kriterias' => $bobot4,
        ];


        $minC1 = alternatif::min('C1');
        $maxC1 = alternatif::max('C1');
        $minC2 = alternatif::min('C2');
        $maxC2 = alternatif::max('C2');
        $minC3 = alternatif::min('C3');
        $maxC3 = alternatif::max('C3');
        $minC4 = alternatif::min('C4');
        $maxC4 = alternatif::max('C4');


        $C1min =[
            'mapel' => $minC1,
        ];
        $C1max =[
            'mapel' => $maxC1,
        ];
        $C2min =[
            'mapel' => $minC2,
        ];
        $C2max =[
            'mapel' => $maxC2,
        ];
        $C3min =[
            'mapel' => $minC3,
        ];
        $C3max =[
            'mapel' => $maxC3,
        ];
        $C4min =[
            'mapel' => $minC4,
        ];
        $C4max =[
            'mapel' => $maxC4,
        ];


        // $hasil = $minC1/$maxC1;
        // $hasil1 =[
        //     'mapel' => $hasil,
        // ];


        $data = alternatif::orderby('nama', 'asc')->get();
        $kriterias = kriteria::orderby('nama', 'asc')->get();


        // $norm = 1 / $C2min['mapel'];

        // dd($norm);

        return view('home', compact('kriterias','data', 'weight1', 'weight2', 'weight3', 'weight4', 'C1min', 'C1max', 'C2min', 'C2max', 'C3min', 'C3max', 'C4min', 'C4max',));
    }
}

