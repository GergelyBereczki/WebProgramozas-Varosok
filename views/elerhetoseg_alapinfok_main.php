<h1 class="centered-title">API teszt</h1>
<h6>(gorest.co.in webszolgáltatás segítségével)</h6>
<h2>GET metódus:</h2>
<?php
$url = "https://gorest.co.in/public-api/users";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$adat = curl_exec($ch);
$tmb = json_decode($adat, TRUE);
$data = $tmb["data"];
$kimenet = "";
foreach ($data as $adatok) {
	$kimenet .= "<tr ><td>" . $adatok["id"] . "</td>" . "<td>" . $adatok["name"] . "</td>" . "<td>" . $adatok["email"] . "</td>" . "<td>" . $adatok["gender"] . "</td>" . "<td>" . $adatok["status"] . "</td></tr>";
}
$valasz = "";
$valasz2 = "";
$valasz3 = "";
$kimenet2 = "";
$kimenet3 = "";
$kimenet4 = "";
$delresp = "";
?>
<style>
    tr,
    th,
    td {
        border-style: double;
        text-align: center;
        padding: 15px;
        width: 50%;
        margin-left: auto;
        margin-right: auto;
    }

    h1, h2, h3 {
        width: 100%;
        text-align: center;
    }

    h3 {
        color: red;
    }
</style>
<table>
    <tr>
        <th>Azonosító</th>
        <th>Név</th>
        <th>E-mail</th>
        <th>Nem</th>
        <th>Státusz</th>
    </tr>
	<?php echo $kimenet; ?>
</table>
<br>
<h2>POST metódus:</h2>
<form action="#" method="post">
    <fieldset>
        <div class="form-group" style="max-width: 500px; margin:auto; ">
            <label for="csaladi_nev" class="form-label">Name</label>
            <input type="text" name="name" id="name" required inputmode="text">
            <br>
            <label for="email" class="form-label">E-mail</label>
            <input type="text" name="email" id="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
            <h6 for="female">Gender</h6>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female" class="form-label">Female</label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male" class="form-label">Male</label>
            <h6 for="utonev">Status</h6>
            <input type="radio" id="active" name="stat" value="active">
            <label for="active" class="form-label">Active</label>
            <input type="radio" id="inacive" name="stat" value="inactive">
            <label for="active" class="form-label">Inactive</label>
            <input class="btn btn-warning btn-lg btn-block" type="submit" name="submit" value="Submit">
        </div>
    </fieldset>
</form>
<?php
if (isset($_POST['submit']) && $_POST['name'] != "" && $_POST['gender'] != "" && $_POST['email'] != "" && $_POST['stat'] != "") {
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://gorest.co.in/public/v2/users?access-token=cbf8633e50404c8f5dc26712470b4bc2abe910c96b3cf7ffdad002bbc766053c',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{"name":"' . $_POST["name"] . '", "gender":"' . $_POST["gender"] . '", "email":"' . $_POST["email"] . '", "status":"' . $_POST["stat"] . '"}',
		CURLOPT_HTTPHEADER => array('Content-Type: application/json')
	));

	$response = curl_exec($curl);
	curl_close($curl);
	$valasz = $response;
	$adatok2 = json_decode($response, TRUE);

	if (array_key_exists('id', $adatok2)) {
		$kimenet2 .= "<h2>Hozzáadva a felhasználókhoz:</h2><br><br><table><tr><td>" . $adatok2["id"] . "</td>" . "<td>" . $adatok2["name"] . "</td>" . "<td>" . $adatok2["email"] . "</td>" . "<td>" . $adatok2["gender"] . "</td>" . "<td>" . $adatok2["status"] . "</td></tr></table>";
	} else {
		$kimenet2 = "<h3>Név vagy e-mail cím foglalt!</h3><br><br>";
	}
} else {
	$valasz = "Minden mező kitöltése kötelező!";
}
?>
<?php echo $kimenet2; ?>


<h2>PUT metódus:</h2>
<form action="#" method="post">
    <div class="form-group" style="max-width: 500px; margin-left:auto; margin-right: auto; ">
        <label for="id" class="form-label">ID</label>
        <input type="text" name="id" id="id" required inputmode="text">
        <h6>Status</h6>
        <input type="radio" id="active2" name="stat2" value="active">
        <label for="active2" class="form-label">Active</label>
        <input type="radio" id="inactive2" name="stat2" value="inactive">
        <label for="inactive2" class="form-label">Inactive</label>
        <input class="btn btn-warning btn-lg btn-block" type="submit" name="submit2" value="Submit">
    </div>
</form>
<?php
if (isset($_POST['submit2']) && $_POST['stat2'] != "") {
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://gorest.co.in/public/v2/users/' . $_POST["id"] . '?access-token=cbf8633e50404c8f5dc26712470b4bc2abe910c96b3cf7ffdad002bbc766053c',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'PUT',
		CURLOPT_POSTFIELDS => '{"status":"' . $_POST["stat2"] . '"}',
		CURLOPT_HTTPHEADER => array('Content-Type: application/json')
	));

	$response = curl_exec($curl);
	curl_close($curl);
	$valasz2 = $response;
	$adatok3 = json_decode($response, TRUE);

	if (array_key_exists('id', $adatok3)) {

		$kimenet3 .= "<h2>Felhasználói státusz módosítva:</h2><br><br><table><tr><td>" . $adatok3["id"] . "</td>" . "<td>" . $adatok3["name"] . "</td>" . "<td>" . $adatok3["email"] . "</td>" . "<td>" . $adatok3["gender"] . "</td>" . "<td>" . $adatok3["status"] . "</td></tr></table>";

	} else {
		$kimenet3 = "<h3>Nem található adat a megadott ID alapján!</h3><br><br>";
	}
} else {
	$valasz2 = "Kérjük válasszon egy státuszt!";
}
?>
<?php echo $kimenet3; ?>


<h2>DELETE metódus:</h2>


<form action="#" method="post">
    <div class="form-group" style="max-width: 500px; margin-left:auto; margin-right: auto; ">
        <label for="id" class="form-label">ID</label>
        <input type="text" name="id" id="id" required inputmode="text">
        <input class="btn btn-warning btn-lg btn-block" type="submit" name="submit3" value="Submit">
    </div>
</form>
<?php
if (isset($_POST['submit3'])) {
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://gorest.co.in/public/v2/users/' . $_POST["id"] . '?access-token=cbf8633e50404c8f5dc26712470b4bc2abe910c96b3cf7ffdad002bbc766053c',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'DELETE',
		CURLOPT_HTTPHEADER => array('Content-Type: application/json')
	));

	$delresp = curl_exec($curl);
	curl_close($curl);

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://gorest.co.in/public/v2/users/' . $_POST["id"] . '?access-token=cbf8633e50404c8f5dc26712470b4bc2abe910c96b3cf7ffdad002bbc766053c',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array('Content-Type: application/json')
	));

	$getresp = curl_exec($curl);
	curl_close($curl);
//  $adatok4 = json_decode($response, TRUE);
	if ($getresp == '{"message":"Resource not found"}') {
		$valasz3 = "<h2>Sikeres törlés!</h2>";
	}


	//$kimenet3 .= "<h2>Felhasználói státusz módosítva:</h2><br><br><table><tr><td>" . $adatok3["id"] . "</td>" . "<td>" . $adatok3["name"] . "</td>" . "<td>" . $adatok3["email"] . "</td>" . "<td>" . $adatok3["gender"] . "</td>" . "<td>" . $adatok3["status"] . "</td></tr></table>";


}
?>
<?php echo $valasz3; ?>