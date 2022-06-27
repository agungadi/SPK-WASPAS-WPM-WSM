<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use App\Models\kriteria;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function hitung(Request $request){

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

        return view('admin.waspas.hitung', compact('kriterias','data', 'weight1', 'weight2', 'weight3', 'weight4', 'C1min', 'C1max', 'C2min', 'C2max', 'C3min', 'C3max', 'C4min', 'C4max',));
    }

    public function hitungtest(Request $request){
        $kriteria = kriteria::sum('bobot');

        $w = 5;

        $kriterias = kriteria::orderby('id', 'asc')->get();
        $alternatif = alternatif::orderby('id', 'asc')->get();

        $bobot1 = 2/$kriteria;
        $bobot2 = 2/$kriteria;
        $bobot3 = 1/$kriteria;
        $bobot4 = 2/$kriteria;
        $bobot5 = 3/$kriteria;

        $weight = [];
        $bobot = [];
        $weight = [];
        $minC = [];
        $maxC = [];

        $Cmin = [];
        $Cmax = [];
        foreach ($kriterias as $p) {
            // code
            $weight[] = $p->bobot;
            $bobot[] = $p->bobot/$kriteria;
            $weight[] = [
                'kriterias' => $p->bobot,
            ];

        }

        $mm = 0;
        $men = -1;
        foreach ($alternatif as $a){
            $mm++;
            $men++;
            $minC[] = alternatif::min('C'.$mm);
            $maxC[] = alternatif::max('C'.$mm);


            $Cmin[] =[
                'mapel' => $minC[$men],
            ];
            $Cmax[] =[
                'mapel' => $maxC[$men],
            ];

        }

        // $hasil = $minC[0]/$maxC[0];
        // $hasil1 =[
        //     'mapel' => $hasil,
        // ];

        $produk = alternatif::get();
        $data = alternatif::orderby('nama', 'asc')->get();

        ///Normalisasi

        $value = [];
        $limit = [];
        $inorm = 0 ;
        foreach ($kriterias as $k){
            foreach($alternatif as $a){
                $ca = count($a);
                $ka = count($k);
                $index = $ca + $ka;
                $value[$index] = $value[$index] / $limit[$k];
            }

        }

        $A1 = [0.67 , 0.50, 0.33, 0.33];
        $A2 = [1, 1, 1, 0.33];
        $A3 = [1, 1, 1, 1];
        $sum = [];
        $sum2 = [];
        $sum3 = [];
        $ip = 0;

        foreach ($A1 as $key => $row) {

                $C = "C".$ip;
                // $sum[] += ($row->$C / $Cmax[$key]['mapel']) * $weight[$key]['kriterias'] ;
                $sum2[] += $A1[$key]*$weight[$key]['kriterias'];
                $ip++;
                $sum3[] += pow($A1[$key],$weight[$key]['kriterias']);

        }

        $sum4 = [];
        $sum5 = [];

        foreach ($sum2 as $key => $row) {
            $sum4[] = ($sum2[$key]*0.5);
            $sum5[] = ($sum3[$key]*0.5);
        }

        // $sum6 = [];

        // foreach ($sum2 as $key => $row) {
        //     $sum6[] = $sum4[$key] + $sum4[$key];
        // }
        $total = array_sum($sum3);
        dd($value);
        return view('admin.waspas.hitungtest', compact('hasil1','data', 'weight', 'Cmax'));

    }
}
