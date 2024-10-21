<?php
$c=$_GET['q'];
$url="https://restcountries.com/v3.1/alpha/$c";
$data=file_get_contents($url);
$data=json_decode($data,true);
$ofname=$data[0]['name']['official'];
$flag=$data[0]['flags']['png'];
$la=$data[0]['latlng'];
$lati=$la[0]; $long=$la[1];

?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">

    

</head>
    <body>
        <div class="container">
    <table width="100%" class="table">
        <tr><th colspan="2">
            <img src="<?php echo $flag; ?>" height="100" />
        </th>
    </tr>
    <tr>
            <td><h4>Country Name :</h4></td>
            <th><h4><?php echo $ofname; ?></h4></th>
        </tr>
    <tr><td>Capital City</td><td> 
        <?php  echo join(",",$data[0]['capital']); ?> 
    </td></tr>
    <tr><td>Region</td><td> 
        <?php  echo $data[0]['region']; ?> 
    </td></tr>
    <tr><td>Sub Region</td><td> 
    <?php  echo $data[0]['subregion']; ?> 
    </td></tr>
    <tr>
    <td>Currencies</td>
    <td>
        <?php
        foreach ($data[0]['currencies'] as $currency) {
            echo $currency['name'];
            echo ' (' . $currency['symbol'] . '), ';
        }
        ?>
    </td>
    <tr><td>Country Code</td><td> 
        <?php  echo $data[0]['ccn3']; ?> 
    </td></tr>
    <tr><td>Population</td><td> <?php  echo number_format($data[0]['population']); ?> 
    </td></tr>
    <tr><td>Area</td><td> 
        <?php  echo number_format($data[0]['area']); ?> 
    </td></tr>
    <tr><td>Borders</td><td> 
        <?php  
        if(!empty($data[0]['borders'])){
        echo join(", ",$data[0]['borders']);
     } ?> 
    </td></tr>
    <tr><td>Google Map Link</td>

    <td>
     <?php
        $gMap=$data[0]['maps']['googleMaps'];        
     ?>
     <a href="<?php echo $gMap; ?>" target="_blank">Google Map Link</a>
    </td>
    </tr>
    <tr><td colspan="2">
     <div id="map" style="height:400; width:100%"> </div>

     <script>
function myMap() {
    const myLatLng = { lat: <?php echo $lati; ?>, lng: <?php echo $long; ?>};
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: myLatLng,
    });

new google.maps.Marker({
    position: myLatLng,map,title: "<?php echo $ofname; ?>",
});
}
</script>
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJRyGWXkENs2oIQ3UK7atSo_tLkbRpYAI&callback=myMap"></script>
    </td></tr>
    </table>
</div>
    </body>
</html>
