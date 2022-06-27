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
                    @foreach ($widget as $widgets)

                    <th>{{ $widgets['kriterias'] }}</th>
                    @endforeach

                </tr>
            </thead>

        </table>

    </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Produk</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>WSM</th>
                    <th>WPM</th>
                    <th>Qi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $item)
                <tbody>
                    <tr>
                        <td>{{$item->nama}}</td>
                            {{-- WSM --}}


                            <td>
                                {{-- {{}}
                                @foreach ($Cmax as $key => $Cmaxs)
                                {{

                                     (($item->C1 / $Cmaxs['produks'])*$widget[$key]['kriterias']).+.


                                }}
                                @endforeach --}}

                            </td>


                            {{-- WPM --}}
                            <td>

                            </td>
                            {{-- Qi --}}
                            <td>

                            </td>
                    </tr>
                </tbody>
                @endforeach
            </tbody>
        </table>
     </div>
</div>

@endsection
