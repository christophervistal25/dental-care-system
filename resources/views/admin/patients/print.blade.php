<html>
<head>
  <title>Receipt</title>
  <style>
    @page { margin: 100px 20px; }
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
    .table-collapse {
		border-collapse : collapse;
    }

  </style>
</head>
<body>
  <header>
    <h2><center>APIT-SUBIRI DENTAL CLINIC</center></h2>
    <div style='margin-top : -20px;'>
    	<center><small>Abarca Street, Mangagoy, Bislig City, Surigao del Sur</small></center>
    	<center><small>DR. ELVIE ANGELIE A. SUBERI - Dentist</small></center>
    	<center><small><span>LIC. NO.: 0035574</span> <span style='margin-left :20px;'>NON-VAT Reg. TIN:180-630-790-000</span></small></center>
    	<hr>
    </div>
  </header>
  <main>
  	<br>
 	<table border='1' class='table-collapse'>
 		<thead>
 			<tr>
 				<th>Patient Number</th>
 				<th>Name</th>
 				<th>Email</th>
 				<th>Mobile</th>
 				<th>Registered at</th>
 			</tr>
 		</thead>
 		<tbody>
 			@foreach($patients as $patient)
 			<tr>
 				 <td class="text-center font-weight-bold">{{ $patient->patient_number }}</td>
		        <td class="text-center">{{ $patient->firstname . ' ' . $patient->middlename . ' ' . $patient->lastname }}</td>
		        <td class="text-center">{{ $patient->email }}</td>
		        <td class="text-center">{{ $patient->mobile_no }}</td>
		        <td class="text-center">{{ $patient->created_at->format('l jS \\of F Y') }}</td>
 			</tr>
 			@endforeach
 		</tbody>
 	</table>
  </main>
</body>
</html>