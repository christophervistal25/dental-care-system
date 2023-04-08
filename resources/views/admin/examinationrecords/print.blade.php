<html>

<head>
    <title>Examination Records</title>
    <style>
        @page {
            margin: 100px 50px;
        }

        header {
            position: fixed;
            top: -100px;
            left: 0px;
            right: 0px;
            height: 60px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            background-color: lightblue;
            height: 50px;
        }

        p {
            page-break-after: always;
        }

        p:last-child {
            page-break-after: never;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    {{--   <header>
    <h2><center>SUBERI-APIT DENTAL CLINIC</center></h2>
    <center>Abarca Street, Mangagoy, Bislig City, Surigao del Sur</center>
    <center>DR. ELVIE ANGELIE A. SUBERI - Dentist</center>
    <hr>
  </header> --}}
    {{-- <footer>footer on each page</footer> --}}
    <header>
        <h2>
            <center>APIT-SUBIRI DENTAL CLINIC</center>
        </h2>
        <div style='margin-top : -20px;'>
            <center><small>Abarca Street, Mangagoy, Bislig City, Surigao del Sur</small></center>
            <center><small>DR. ELVIE ANGELIE A. SUBERI - Dentist</small></center>
            <center><small><span>LIC. NO.: 0035574</span> <span style='margin-left :20px;'>NON-VAT Reg.
                        TIN:180-630-790-000</span></small></center>
            <hr>
        </div>
    </header>
    <main>
        <br>
        <div>Chief Complaint ________________________________________________________________</div>
        <div>Other Findings &nbsp;&nbsp;&nbsp;________________________________________________________________</div>
        <br>
        <table border="1" width="100%" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th class="center">Date</th>
                    <th class="center">Tooth</th>
                    <th class="center">Surface</th>
                    <th class="center">Treatment Record</th>
                    <th class="center">Fee</th>
                    <th class="center">Paid</th>
                    <th class="center">Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <td class="center">{{ $record->created_at->format(' jS \\of M h:i A Y') }}</td>
                        <td class="center">{{ $record->teeths->pluck('tooth_description')->implode(', ') }}</td>
                        <td class="center">{{ $record->teeths->pluck('surface')->implode(', ') }}</td>
                        <td class="center">{{ $record->teeths->pluck('treatment')->implode(', ') }}</td>
                        <td class="center" style='font : DejaVu Sans'>&#8369;{{ $record->payments->fee }}</td>
                        <td class="center" style='font : DejaVu Sans'>&#8369;{{ $record->payments->paid }}</td>
                        <td class="center" style='font : DejaVu Sans'>
                            &#8369;{{ $record->payments->fee - $record->payments->paid }}.00</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>
