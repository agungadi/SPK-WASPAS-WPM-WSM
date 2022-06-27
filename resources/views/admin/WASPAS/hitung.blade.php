@extends('layouts.dashboard')
@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Bobot</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>{{ $weight1['kriterias'] }}</th>
                    <th>{{ $weight2['kriterias'] }}</th>
                    <th>{{ $weight3['kriterias'] }}</th>
                    <th>{{ $weight4['kriterias'] }}</th>
                </tr>
            </thead>

        </table>

    </div>
</div>

@include('admin.waspas.normalisasi')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Mata Pelajaran</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>WSM</th>
                    <th>WPM</th>
                    <th>WASPAS</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $item)
                <tbody>
                    <tr>
                        <td>{{$item->nama}}</td>
                            {{-- WSM --}}
                            <td>
                                {{(($item->C1 / $C1max['mapel'])*$weight1['kriterias'])+
                                (( $C2min['mapel'] / $item->C2 )*$weight2['kriterias'])+
                                (($item->C3 / $C3max['mapel'])*$weight3['kriterias'])+
                                (($item->C4 / $C4max['mapel'])*$weight4['kriterias'])}}
                            </td>
                            {{-- WPM --}}
                            <td>
                                {{(($item->C1 / $C1max['mapel'])**$weight1['kriterias'])*
                                (( $C2min['mapel'] / $item->C2 )**$weight2['kriterias'])*
                                (($item->C3 / $C3max['mapel'])**$weight3['kriterias'])*
                                (($item->C4 / $C4max['mapel'])**$weight4['kriterias'])}}
                            </td>
                            {{-- Qi --}}
                            <td>
                                {{
                                ((($item->C1 / $C1max['mapel'])*$weight1['kriterias'])+
                                (( $C2min['mapel'] /  $item->C2)*$weight2['kriterias'])+
                                (($item->C3 / $C3max['mapel'])*$weight3['kriterias'])+
                                (($item->C4 / $C4max['mapel'])*$weight4['kriterias']))*0.5
                                    +
                                ((($item->C1 / $C1max['mapel'])**$weight1['kriterias'])+
                                (( $C2min['mapel'] /  $item->C2)**$weight2['kriterias'])+
                                (($item->C3 / $C3max['mapel'])**$weight3['kriterias'])+
                                (($item->C4 / $C4max['mapel'])**$weight4['kriterias']))*0.5

                                }}
                            </td>
                    </tr>
                </tbody>
                @endforeach
            </tbody>
        </table>
     </div>
</div>

@endsection
