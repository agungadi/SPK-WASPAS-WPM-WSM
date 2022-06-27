@extends('layouts.dashboard')
@section('content')


<!-- DataTales Example -->
<div class="col-md-12">
	<h1 class="text-center">Grafik SPK Mata Pelajaran</h1>
    <div class="col-md-12">
        <div id="chart"></div>
    </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Mata Pelajaran</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered sortable" id="" width="100%" cellspacing="0">
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
                        <td class="kategori">{{$item->nama}}</td>
                            {{-- WSM --}}
                            <td class="winner">
                                {{(($item->C1 / $C1max['mapel'])*$weight1['kriterias'])+
                                (( $C2min['mapel'] / $item->C2 )*$weight2['kriterias'])+
                                (($item->C3 / $C3max['mapel'])*$weight3['kriterias'])+
                                (($item->C4 / $C4max['mapel'])*$weight4['kriterias'])}}
                            </td>
                            {{-- WPM --}}
                            <td class="wpm">
                                {{(($item->C1 / $C1max['mapel'])**$weight1['kriterias'])*
                                (( $C2min['mapel'] / $item->C2 )**$weight2['kriterias'])*
                                (($item->C3 / $C3max['mapel'])**$weight3['kriterias'])*
                                (($item->C4 / $C4max['mapel'])**$weight4['kriterias'])}}
                            </td>
                            {{-- Qi --}}
                            <td class="waspas">
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

<script type="text/javascript">



$(document).ready(function(){

    var tables = document.querySelectorAll("table.sortable"),
    table,
    thead,
    headers,
    i,
    j;

for (i = 0; i < tables.length; i++) {
    table = tables[i];

    if (thead = table.querySelector("thead")) {
        headers = thead.querySelectorAll("th");

        for (j = 0; j < headers.length; j++) {
            headers[j].innerHTML = "<a href='#'>" + headers[j].innerText + "</a>";
        }

        thead.addEventListener("click", sortTableFunction(table));
    }
}

/**
 * Create a function to sort the given table.
 */
function sortTableFunction(table) {
    return function(ev) {
        if (ev.target.tagName.toLowerCase() == 'a') {
            sortRows(table, siblingIndex(ev.target.parentNode));
            ev.preventDefault();
        }
    };
}

/**
 * Get the index of a node relative to its siblings — the first (eldest) sibling
 * has index 0, the next index 1, etc.
 */
function siblingIndex(node) {
    var count = 0;

    while (node = node.previousElementSibling) {
        count++;
    }

    return count;
}

/**
 * Sort the given table by the numbered column (0 is the first column, etc.)
 */
function sortRows(table, columnIndex) {
    var rows = table.querySelectorAll("tbody tr"),
        sel = "thead th:nth-child(" + (columnIndex + 1) + ")",
        sel2 = "td:nth-child(" + (columnIndex + 1) + ")",
        classList = table.querySelector(sel).classList,
        values = [],
        cls = "",
        allNum = true,
        val,
        index,
        node;

    if (classList) {
        if (classList.contains("date")) {
            cls = "date";
        } else if (classList.contains("number")) {
            cls = "number";
        }
    }

    for (index = 0; index < rows.length; index++) {
        node = rows[index].querySelector(sel2);
        val = node.innerText;

        if (isNaN(val)) {
            allNum = false;
        } else {
            val = parseFloat(val);
        }

        values.push({ value: val, row: rows[index] });
    }

    if (cls == "" && allNum) {
        cls = "number";
    }

    if (cls == "number") {
        values.sort(sortNumberVal);
        values = values.reverse();
    } else if (cls == "date") {
        values.sort(sortDateVal);
    } else {
        values.sort(sortTextVal);
    }

    for (var idx = 0; idx < values.length; idx++) {
        table.querySelector("tbody").appendChild(values[idx].row);
    }
}

/**
 * Compare two 'value objects' numerically
 */
function sortNumberVal(a, b) {
    return sortNumber(a.value, b.value);
}

/**
 * Numeric sort comparison
 */
function sortNumber(a, b) {
    return a - b;
}

/**
 * Compare two 'value objects' as dates
 */
function sortDateVal(a, b) {
    var dateA = Date.parse(a.value),
        dateB = Date.parse(b.value);

    return sortNumber(dateA, dateB);
}

/**
 * Compare two 'value objects' as simple text; case-insensitive
 */
function sortTextVal(a, b) {
    var textA = (a.value + "").toUpperCase();
    var textB = (b.value + "").toUpperCase();

    if (textA < textB) {
        return -1;
    }

    if (textA > textB) {
        return 1;
    }

    return 0;
}



var wsm = [];
var wpm = [];
var waspas =[];
var kategori = [];
$('table .winner').each(function () {
    wsm.push(Number($(this).text()));
})
$('table .wpm').each(function () {
    wpm.push(parseFloat($(this).text()).toFixed(5));
})
$('table .waspas').each(function () {
    waspas.push(Number($(this).text()));
})
$('table .kategori').each(function () {
    kategori.push($(this).text());
})
console.log(kategori);




var options = {
  chart: {
    type: 'bar'
  },
  series: [{
      name: 'WSM',
      data: wsm

    }, {
      name: 'WPM',
      data: wpm
    },
    {
      name: 'Waspas',
      data: waspas
    }

  ],
  xaxis: {
    categories: kategori,
  },
  plotOptions: {
    bar: {
      dataLabels: {
        orientation: 'vertical',
        position: 'center' // bottom/center/top
      }
    }
  },
  dataLabels: {
    style: {
      colors: ['#000000']
    },
    offsetY: 15, // play with this value
  },
}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();

});
    </script>
    @endsection
