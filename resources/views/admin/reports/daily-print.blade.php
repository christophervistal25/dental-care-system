<html>

<head>
    <title>Appointment Confirmation</title>
    <style type="text/css" media="all">
        /*     @page { margin: 100px 25px; } */
        /*header { position: fixed; top: -100px; left: 0px; right: 0px; height: 50px; }*/
        /*footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }*/
        p {
            page-break-after: always;
        }

        p:last-child {
            page-break-after: never;
        }

        .text-center {
            text-align: center;
        }

        .table-collapse {
            border-collapse: collapse;
        }

        .text-capitalize {
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <h2>
        <center>{{ config('app.name') }}</center>
    </h2>
    <center>{{ config('app.address') }}</center>
    <hr>

    <main>
        @php $overAllTotal = 0 @endphp
        @foreach ($reports as $service => $report)
            @php $totalFees = 0 @endphp
            <table class="table-collapse" border='1' style='width :100%;'>
                <thead>
                    <tr>
                        <th colspan='3' class='text-center'>{{ $service }}</td>
                    </tr>
                    <tr>
                        <th>Patient name</th>
                        <th>Fee</th>
                        <th>Examination Date</th>
                    </tr>
                </thead>
                @foreach ($report as $r)
                    <tbody>
                        <tr>
                            <td>{{ $r->patient->firstname }} {{ $r->patient->middlename }} {{ $r->patient->lastname }}
                            </td>
                            <td class='text-capitalize'>{{ $r->payments->fee }}</td>
                            <td>{{ $r->created_at->format('F d, Y') }}</td>
                            @php $totalFees += $r->payments->fee; @endphp
                        </tr>
                    </tbody>
                @endforeach
                <tr>
                    <th colspan='1'>Total</th>
                    <th colspan='2'>{{ $totalFees }}.00</th>
                    @php $overAllTotal += $totalFees @endphp
                </tr>
            </table>
            <br>
        @endforeach
        <table class='table-collapse' border='1' style='width : 100%'>
            <thead>
                <tr>
                    <th>Total Fees</th>
                    <th>{{ $overAllTotal }}.00</th>
                </tr>
                <tr>
                    <th>Total No. of patients</th>
                    <th>{{ $noOfPatients }}</th>
                </tr>
            </thead>
        </table>

        <br>

        @foreach ($services as $service)
            <table class='table-collapse' border='1' style='width:100%;'>
                <thead>
                    <tr>
                        <th colspan='3'>{{ $service }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan='3' class='text-center'>No available data</td>
                    </tr>
                </tbody>
            </table>
            <br>
        @endforeach

    </main>
</body>

</html>
