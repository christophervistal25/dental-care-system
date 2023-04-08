<html>
<head>
  <title>Receipt</title>
  <style>
    @page { margin: 100px 50px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px; height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .text-center { text-align:center; }
    .font-weight-bold { font-weight: bold; }
    .text-right { text-align: right; }
    .text-left { text-align: left; }
    .underline { 
    	width : 100%;
    	border-bottom : 1px solid black; 

    }

  </style>
</head>
<body>
  <header>
    <h3><center>SUBERI-APIT DENTAL CLINIC</center></h3>
    <div style='margin-top : -20px;'>
    	<center><small>Abarca Street, Mangagoy, Bislig City, Surigao del Sur</small></center>
    	<center><small>DR. ELVIE ANGELIE A. SUBERI - Dentist</small></center>
    	<center><small><span>LIC. NO.: 0035574</span> <span style='margin-left :20px;'>NON-VAT Reg. TIN:180-630-790-000</span></small></center>
    	<hr>
    </div>
  </header>
  {{-- <footer>footer on each page</footer> --}}
  <main>
  	<br>
		<h3>List of all appointments ({{ Carbon\Carbon::parse(str_replace('-', '/', $date))->format('M d, Y') }})</h3>
		<table border="1" width="100%" style="border-collapse: collapse;">
			<thead>
				<tr>
					<th>Time</th>
					<th>Patient</th>
					<th>Service</th>
				</tr>
			</thead>
			<tbody>
				@foreach($doctor->appointments as $appointment)
				<tr>
					<td>{{ $appointment->start_date->format('H:i A') }} - {{ $appointment->end_date->format('H:i A') }}</td>
					<td>{{ ucfirst($appointment->patients[0]->firstname) }} {{ ucfirst($appointment->patients[0]->middlename) }} {{ ucfirst($appointment->patients[0]->lastname)}}</td>
					<td>{{ $appointment->service->name }}</td>
				</tr>
				@endforeach
			
				

			</tbody>
		</table>
  </main>
</body>
</html>