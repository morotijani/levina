<?php 

    require dirname(__DIR__)  . '/bootstrap.php';
	
    $driver = $_ENV['DB_DRIVER'];
    $hostname = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $database = $_ENV['DB_DATABASE'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];

    try {
        $string = $driver . ":host=" . $hostname . ";charset=utf8mb4;dbname=" . $database;
        $dbConnection = new \PDO(
            $string, $username, $password
        );
    } catch (\PDOException $e) {
        exit($e->getMessage());
    }
    session_start();


    if (isset($_SESSION['XPUser'])) {
        $user_id = $_SESSION['XPUser'];
        $data = array($user_id);
        $sql = "
            SELECT * FROM xpto_users 
            WHERE user_id = ? 
            LIMIT 1
        ";
        $statement = $dbConnection->prepare($sql);
        $statement->execute($data);
        if ($statement->rowCount() > 0) {
            $user_data = $statement->fetchAll();
            $user_data = $user_data[0];
            $user_name = '';
            if ($user_data['user_firstname'] == '' && $user_data['user_lastname'] == '') {
                $user_name = $user_data['user_email'];
            } else {
                $user_name = ucwords($user_data['user_firstname'] . " " . $user_data['user_lastname']);
            }
        } else {
            unset($_SESSION['XPUser']);
            redirect(PROOT . 'app/');
        }

    }

    require_once ("Functions.php");
    require_once ("helpers.php");
    require_once dirname(__DIR__) . "/config.php";

    // Display on Messages on Errors And Success for users
 	$flash_user = '';
 	if (isset($_SESSION['flash_success'])) {
 	 	$flash_user = '
			<div aria-live="polite" aria-atomic="true" class="position-fixed top-0 start-50 translate-middle-x rounded-3" style="z-index: 9999;">
				<div class="p-3">
					<div class="toast show alert-success" id="temporary">
                        <div class="toast-body">
                            ' . $_SESSION['flash_success'] . '
                        </div>
					</div>
				</div>
			</div>
		';
 	 	unset($_SESSION['flash_success']);
 	}

 	if (isset($_SESSION['flash_error'])) {
 	 	$flash_user = '
            <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 start-50 translate-middle-x rounded-3" style="z-index: 9999;">
                <div class="p-3">
                    <div class="toast show alert-danger" id="temporary">
                        <div class="toast-body">
                            ' . $_SESSION['flash_error'] . '
                        </div>
                    </div>
                </div>
            </div>
        ';
 	 	unset($_SESSION['flash_error']);
 	}

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'X-CMC_PRO_API_KEY: ' . COINCAP_APIKEY,
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $coin_data = json_decode($response, true);
    // dnd($coin_data);
    // Generate scrolling content with icons
    // if (is_array($coin_data)) {
    //     if (isset($coin_data['data'])) {
    //         foreach (array_slice($coin_data['data'], 0, 10) as $crypto) {
    //             $icon = "https://s2.coinmarketcap.com/static/img/coins/64x64/{$crypto['id']}.png";
    //             echo "<div class='crypto-item'>";
    //             echo "<img src='$icon' alt='{$crypto['name']}'>";
    //             echo "{$crypto['name']} ({$crypto['symbol']}): $" . number_format($crypto['quote']['USD']['price'], 2);
    //             echo "</div>";
    //         }
    //     }
    // } else {
    //     // echo "Error fetching data.";
    // }

