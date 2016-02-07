<?php

if (isset($_REQUEST['cmd'])) {

    $command = $_REQUEST['cmd'];

    switch ($command) {

        case 1:
            searchForWines();
            break;

        case 2:
            allWines();
//            displayWines();

            break;

        case 3:
            searchForTypes();
            break;

        case 4:
            sortPrice();
            break;

        case 5:
            getWineDetails();
            break;

        case 6:
            logdata();
            break;

        default :
            echo '{"result":0, "message","error"}';
            break;
    }
}

/**
 *
 */
function allWines(){
    include_once 'Wine.php';

    $object = new Wine();

    if ($results = $object->getAllWines()) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wines": [';

        while ($row){
            echo '{"wine_id":"'.$row["wine_id"].'","wine_name":"'.$row["wine_name"].'","winery_name":"'.$row["winery_name"].'","region_name":"'.$row["region_name"].'","wine_type":"'.$row["wine_type"].'","variety":"'.$row["variety"].'","variety_id":"'.$row["variety_id"].'","year":"'.$row["year"].'","on_hand":"'.$row["on_hand"].'","cost":"'.$row["cost"].'"}';

            if($row = $results->fetch_assoc()){
                echo ',';
            }
        }
        echo ']}';
    }
    else{
        echo '{"result":0,"message": "An error occurred for display wines."}';
    }
}

/**
 *
 */
function searchForWines() {

    include_once 'Wine.php';

    $object = new Wine();

    $name = $_GET['name'];

    if ($results = $object->searchWine($name)) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wines": [';

        while ($row){
            echo '{"wine_id":"'.$row["wine_id"].'","wine_name":"'.$row["wine_name"].'","winery_name":"'.$row["winery_name"].'","region_name":"'.$row["region_name"].'","wine_type":"'.$row["wine_type"].'","variety":"'.$row["variety"].'","variety_id":"'.$row["variety_id"].'","year":"'.$row["year"].'","on_hand":"'.$row["on_hand"].'","cost":"'.$row["cost"].'"}';

            if($row = $results->fetch_assoc()){
                echo ',';
            }
        }
        echo ']}';
    }
    else{
        echo '{"result":0,"message": "An error occurred for display wines."}';
    }
}

/**
 *
 */
function searchForTypes(){
    include_once 'Wine.php';

    $object = new Wine();

    $type = $_GET['type'];

    if ($results = $object->searchByType($type)) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wines": [';

        while ($row){
            echo '{"wine_id":"'.$row["wine_id"].'","wine_name":"'.$row["wine_name"].'","winery_name":"'.$row["winery_name"].'","region_name":"'.$row["region_name"].'","wine_type":"'.$row["wine_type"].'","variety":"'.$row["variety"].'","variety_id":"'.$row["variety_id"].'","year":"'.$row["year"].'","on_hand":"'.$row["on_hand"].'","cost":"'.$row["cost"].'"}';

            if($row = $results->fetch_assoc()){
                echo ',';
            }
        }
        echo ']}';
    }
    else{
        echo '{"result":0,"message": "An error occurred for display wines."}';
    }
}

/**
 *
 */
function sortPrice(){
    include_once 'Wine.php';

    $object = new Wine();

    if ($results = $object->sortByPrice()) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wines": [';

        while ($row){
            echo '{"wine_id":"'.$row["wine_id"].'","wine_name":"'.$row["wine_name"].'","winery_name":"'.$row["winery_name"].'","region_name":"'.$row["region_name"].'","wine_type":"'.$row["wine_type"].'","variety":"'.$row["variety"].'","variety_id":"'.$row["variety_id"].'","year":"'.$row["year"].'","on_hand":"'.$row["on_hand"].'","cost":"'.$row["cost"].'"}';

            if($row = $results->fetch_assoc()){
                echo ',';
            }
        }
        echo ']}';
    }
    else{
        echo '{"result":0,"message": "An error occurred for display wines."}';
    }
}

/**
 *
 */
function getWineDetails(){
    include_once 'Wine.php';

    $object = new Wine();

    $id = $_GET['id'];
    $var = $_GET['variety'];

    if ($results = $object->getDetails($id,$var)) {
        $row = $results->fetch_assoc();
        echo '{"result":1,"wine_id":"'.$row["wine_id"].'","wine_name":"'.$row["wine_name"].'","winery_name":"'.$row["winery_name"].'","region_name":"'.$row["region_name"].'","wine_type":"'.$row["wine_type"].'","variety":"'.$row["variety"].'","variety_id":"'.$row["variety_id"].'","year":"'.$row["year"].'","on_hand":"'.$row["on_hand"].'","cost":"'.$row["cost"].'"}';
    }
    else{
        echo '{"result":0,"message": "An error occurred for display wines."}';
    }
}

function logdata(){
    include_once 'adminClass.php';

    $object = new User();

    $username = $_GET['username'];
    $password = $_GET['password'];

    if($result = $object->login($username,$password)){
        $row = $result->fetch_assoc();

        $_SESSION['username'] = $row['user_name'];
        $_SESSION['id'] = $row['cust_id'];

        echo '{"result": 1}';


//        window.location.replace('edit.php');
    }
    else{
        echo '{"result":"0"}';
    }
}
