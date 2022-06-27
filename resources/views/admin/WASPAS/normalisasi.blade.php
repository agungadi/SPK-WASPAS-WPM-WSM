<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Normalisasi</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>C1</th>
                    <th>C2</th>
                    <th>C3</th>
                    <th>C4</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $item)
            <tbody>


                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->C1 / $C1max['mapel'] }}</td>
                                <td>{{ $C2min['mapel'] /  $item->C2}}</td>
                                <td>{{ $item->C3 / $C3max['mapel'] }}</td>
                                <td>{{ $item->C4 / $C4max['mapel'] }}</td>

                </tr>
            </tbody>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
