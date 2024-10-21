<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://covid-19-statistics.p.rapidapi.com/provinces?iso=CHN",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: covid-19-statistics.p.rapidapi.com",
		"X-RapidAPI-Key: 7aa4df44a9msh9a4a17c38d679cap1aa232jsn4c60fe59e2a8"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$data1 = json_decode($response,true);

    $data = $data1['data'];
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Provinces details in china </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <scripscriptt src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
     
<div class="container mt-5">
    <h3><b><u><center> Provinces details in china </center> </u></b></h3>
    <hr />
    <table class="table">
        <thead>
            <tr>
                <th>Province</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $pro) : ?>
                <tr>
                    <td><?php echo $pro  ['province']; ?></td>
                    <td><?php echo $pro ['lat']; ?></td>
                    <td><?php echo $pro  ['long']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    </body>

</html>