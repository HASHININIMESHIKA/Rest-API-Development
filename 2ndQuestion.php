<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://restcountries.com/v3.1/all",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: rest-countries10.p.rapidapi.com",
		"X-RapidAPI-Key: 7aa4df44a9msh9a4a17c38d679cap1aa232jsn4c60fe59e2a8"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$data=json_decode($response,true);
}

//var_dump($data[0]);
?>
<html>
	<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
	rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
	crossorigin="anonymous">
	<link rel="stylesheet" href="style2.css">
	<script>
function getCountry(str) {
  if (str == "") {
    document.getElementById("show").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("show").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "getCountry.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>

</head>
	<body>
		<div class="container">
		<table>
			<tr>
				<td><h3>Country Name : </td>
				<td>
				<select class="form-select" name="countries" onchange="getCountry(this.value)">
    <option value="">Select a Country</option>
    <?php foreach ($data as $v) { ?>
        <option value="<?php echo $v['cca2']; ?>"><?php echo $v['name']['common']; ?></option>
    <?php } ?>
</select>
					</td>
			</tr>
		</table>
		<hr >
		<div id="show"></div>
</div>
	</body>
</html>