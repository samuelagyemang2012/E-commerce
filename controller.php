<?php

session_start();

//include_once 'edit.php';

if (isset($_REQUEST['cmd'])) {

    $command = $_REQUEST['cmd'];

    switch ($command) {

        case 1:
            searchForWines();
            break;

        case 2:
            allWines();
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
            logData();
            break;

        case 7:
            advancedSearch();
            break;

        case 8:
            allWineries();
            break;

        case 9:
            forWUpdates();
            break;

        case 10:
            forTUpdates();
            break;

        case 11:
            update();
            break;

        case 12:
            add();
            break;

        case 13:
            logOut();
            break;

        case 14:
            upload();
            break;

        default :
            echo '{"result":0, "message":"error"}';
            break;
    }
}

/**
 *
 */
function allWines()
{
    include_once 'Wine.php';

    $object = new Wine();

    if ($results = $object->getAllWines()) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wines": [';

        while ($row) {
            echo '{"result":1,"wine_id":"' . $row["wine_id"] . '","wine_name":"' . $row["wine_name"] . '","winery_name":"' . $row["winery_name"] . '","winery_id":"' . $row["winery_id"] . '","wine_type":"' . $row["wine_type"] . '","year":"' . $row["year"] . '","cost":"' . $row["cost"] . '"}';

            if ($row = $results->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"message": "An error occurred for display wines."}';
    }
}

/**
 *
 */
function searchForWines()
{

    include_once 'Wine.php';

    $object = new Wine();

    $name = $_GET['name'];

    if ($results = $object->searchWine($name)) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wines": [';

        while ($row) {
            echo '{"result":1, "wine_id":"' . $row["wine_id"] . '", "wine_name":"' . $row["wine_name"] . '","winery_name":"' . $row["winery_name"] . '","winery_id":"' . $row["winery_id"] . '","wine_type":"' . $row["wine_type"] . '","year":"' . $row["year"] . '","cost":"' . $row["cost"] . '"}';
            if ($row = $results->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"message": "An error occurred for search wines."}';
    }
}

/**
 *
 */
function searchForTypes()
{
    include_once 'Wine.php';

    $object = new Wine();

    $type = $_GET['type'];

    if ($results = $object->searchByType($type)) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wines": [';

        while ($row) {
            echo '{"result":1, "wine_id":"' . $row["wine_id"] . '", "wine_name":"' . $row["wine_name"] . '","winery_name":"' . $row["winery_name"] . '","winery_id":"' . $row["winery_id"] . '","wine_type":"' . $row["wine_type"] . '","year":"' . $row["year"] . '","cost":"' . $row["cost"] . '"}';
            if ($row = $results->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"message": "An error occurred for display wines."}';
    }
}

/**
 *
 */
function sortPrice()
{
    include_once 'Wine.php';

    $object = new Wine();

    if ($results = $object->sortByPrice()) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wines": [';

        while ($row) {
            echo '{"result":1, "wine_id":"' . $row["wine_id"] . '", "wine_name":"' . $row["wine_name"] . '","winery_name":"' . $row["winery_name"] . '","winery_id":"' . $row["winery_id"] . '","wine_type":"' . $row["wine_type"] . '","year":"' . $row["year"] . '","cost":"' . $row["cost"] . '"}';
            if ($row = $results->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"message": "An error occurred for display wines."}';
    }
}

/**
 *
 */
function getWineDetails()
{
    include_once 'Wine.php';

    $object = new Wine();

    $id = $_GET['id'];
//    $var = $_GET['variety'];

    if ($results = $object->getDetails($id)) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wine_id":"' . $row["wine_id"] . '", "wine_name":"' . $row["wine_name"] . '","winery_name":"' . $row["winery_name"] . '","winery_id":"' . $row["winery_id"] . '","wine_type":"' . $row["wine_type"] . '","year":"' . $row["year"] . '","cost":"' . $row["cost"] . '"}';
    } else {
        echo '{"result":0,"message": "An error occurred for display wines."}';
    }
}

/**
 *
 */
function logData()
{
    include_once 'adminClass.php';

    $object = new User();

    $username = $_GET['username'];
    $password = $_GET['password'];
    $result = $object->login($username, $password);

    if (mysqli_num_rows($result) > 0) {
//
        $row = $result->fetch_assoc();

        $_SESSION['username'] = $row['user_name'];

        $_SESSION['id'] = $row['cust_id'];

        echo '{"result": 1}';

    } else {
        echo '{"result":"0"}';
    }
}

function logout()
{

    unset($_SESSION['username']);

    unset($_SESSION['id']);

    session_destroy();

    echo '{"result":1}';

}

/**
 *
 */
function update()
{
    include_once 'adminClass.php';

    $object = new User();

    $name = $_GET['name'];
    $year = $_GET['year'];
    $winery = $_GET['woo'];
    $type = $_GET['type'];
    $cost = $_GET['cost'];
    $id = $_GET['id'];

    $result = $object->update($name, $type, $winery, $year, $cost, $id);

    if ($result === true) {
        echo '{"result": 1}';
    } else {
        echo '{"result": 0}';
    }
}

/**
 *
 */
function add()
{
    include_once 'adminClass.php';

    $object = new User();

    $name = $_GET['name'];
    $year = $_GET['year'];
    $type = $_GET['type'];
    $winery = $_GET['winery'];
    $qty = $_GET['qty'];
    $cost = $_GET['cost'];
    $id = $_GET['id'];

    $result = $object->add($id, $name, $type, $year, $winery, $cost, $qty);
//    $id,$name,$type,$year,$winery,$cost,$qty

    if ($result === true) {
        echo '{"result": 1}';
    } else {
        echo '{"result": 0}';
    }

}

/**
 *
 */
function advancedSearch()
{
    include_once 'Wine.php';

    $object = new Wine();

    $name = $_GET["name"];
    $year = $_GET['year'];
    if ($results = $object->advancedSearch($name, $year)) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wines": [';

        while ($row) {
            echo '{"result":1,"wine_id":"' . $row["wine_id"] . '", "wine_name":"' . $row["wine_name"] . '","winery_name":"' . $row["winery_name"] . '","winery_id":"' . $row["winery_id"] . '","wine_type":"' . $row["wine_type"] . '","year":"' . $row["year"] . '","cost":"' . $row["cost"] . '"}';
            if ($row = $results->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"message": "An error occurred for search wines."}';
    }
}

/**
 *
 */
function allWineries()
{
    include_once 'adminClass.php';

    $object = new User();

    if ($results = $object->allWineries()) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "wineries": [';

        while ($row) {
            echo '{"result":1,"winery_id":"' . $row["winery_id"] . '", "winery_name":"' . $row["winery_name"] . '"}';
            if ($row = $results->fetch_assoc()) {
                echo ',';
            }
        }
        echo ']}';
    } else {
        echo '{"result":0,"message": "An error occurred for search wines."}';
    }
}

/**
 *
 */
function forWUpdates()
{
    include_once 'adminClass.php';

    $object = new User();

    $name = $_GET['name'];

    if ($results = $object->forWinery($name)) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "winery":' . $row['winery_id'] . '}';
    } else {
        echo '{"result":0}';
    }
}

/**
 *
 */
function forTUpdates()
{
    include_once 'adminClass.php';

    $object = new User();

    $type = $_GET['type'];

    if ($results = $object->forType($type)) {
        $row = $results->fetch_assoc();
        echo '{"result":1, "type":' . $row['wine_type_id'] . '}';
    } else {
        echo '{"result":0}';
    }
}


function upload()
{
    if ($_FILES['file']['size']) {
        move_uploaded_file($_FILES['file']['tmp_name'], "images/" . $_FILES['file']["name"]);
    }
}
