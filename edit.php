<?php
include_once('adminClass.php');
include_once('controller.php');

echo $_SESSION['username'];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/modified.css"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/admin.js"></script>

    </head>

    <script>
        $(document).ready(function () {
            admin_load_wines();
        });
        $(document).ready(function () {
            populateWineries();
        });
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>

    <body>

    <!--    <div class="col s12">-->
    <ul id="dropdown1" class="dropdown-content">
        <li><a onclick="admin_load_wines()" style="color:#00695c">All</a></li>
        <li><a onclick="load_by_type('Sparkling')" style="color:#00695c">Sparkling</a></li>
        <li><a onclick="load_by_type('Fortified')" style="color:#00695c">Fortified</a></li>
        <li><a onclick="load_by_type('Sweet')" style="color:#00695c">Sweet</a></li>
        <li><a onclick="load_by_type('White')" style="color:#00695c">White</a></li>
        <li><a onclick="load_by_type('Red')" style="color:#00695c">Red</a></li>
    </ul>

    <ul id="dropdown2" class="dropdown-content">
        <li><a onclick="admin_load_wines()" style="color:#00695c">Name</a></li>
        <li><a onclick="sort_price()" style="color:#00695c">Price</a></li>
    </ul>

    <ul id="dropdown3" class="dropdown-content">
        <li><a onclick="logout()" style="color:#00695c">Logout</a></li>
    </ul>

    <div>
        <nav id="student_nav">
            <div class="nav-wrapper" style="background-color: #00695c ">
                <a id="nav_heading" style="text-align :center">The Happy Drunkard</a>
                <ul class="right hide-on-med-and-down">
                    <li><a style="color: #ffffff" class="dropdown-button" data-activates="dropdown2">Sort Wine By</a></li>
                    <li><a style="color: #ffffff" class="dropdown-button" data-activates="dropdown1">Wine Type</a></li>
                    <li><a style="color: #ffffff" class="dropdown-button" data-activates="dropdown3">Actions</a></li>

                </ul>
            </div>
        </nav>

    </div>

    <div id="search">
        <nav>
            <div class="nav-wrapper">
                <form>
                    <div class="input-field" style="background:#1de9b6  ">
                        <input name="search" type="search" onkeyup="search_wines(this.value)">
                        <label for="search"><i class="material-icons">search</i></label>
                        <i class="material-icons">close</i>
                    </div>
                </form>
            </div>
        </nav>
    </div>

    <!--<div>-->
    <div class="row">
        <div id="results" class="col s6">

        </div>

        <div class="col s1">
            <p></p>
        </div>

        <div class="col s5" id="inputs">

            <div class="input-field i">
                <input id="name" type="text" placeholder=" " required>
                <label for="name">Name</label>
            </div>

            <div class="input-field i">
                <input id="year" type="number" placeholder=" " min="1800" max="2016" required>
                <label for="year">Year</label>
            </div>

            <div class="input-field i">
                <select id="wt">
                    <option value="0" disabled selected>Select Wine Type</option>
                    <option value="Sparkling">Sparkling</option>
                    <option value="Fortified">Fortified</option>
                    <option value="Sweet">Sweet</option>
                    <option value="White">White</option>
                    <option value="Red">Red</option>
                </select>
                <label for="wt">Wine Type</label>
            </div>


            <div class=" input-field i">
                <select id="winery">

                </select>
            </div>
            <!---->
            <div class="input-field i">
                <input id="cost" type="number" placeholder=" " min="0" required>
                <label for="cost">Cost</label>
            </div>

            <form action="edit.php" method="post" enctype="multipart/form-data">
                <div class="file-field input-field i">
                    <div class="btn">
                        <span>Image</span>
                        <input type="file" id="file" name="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>

                <div>
                    <button type="submit" id="submit" name="submit" class="btn btn">Upload</button>
                </div>
                <br>
            </form>

            <div id="forbutton">

            </div>
        </div>
    </div>

    </div>

    <div class="fixed-action-btn horizontal" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large" id="add" onclick="showAdd()">
            <i class="large material-icons">add</i>
        </a>
    </div>

    <center>
        <a class="btn medium waves-effect waves-light mbb" onclick="prev_page()" id="btn_prev">Prev</a>

        <a class="btn medium waves-effect waves-light mbb" onclick="next_page()" id="btn_next">Next</a> Page: <span
            id="page"></span>
    </center>
    </body>

    </html>

<?php

if (isset($_FILES['file'])) {
    if ($_FILES['file']['size'] > 0) {
        move_uploaded_file($_FILES['file']['tmp_name'], "images/" . $_FILES['file']["name"]);

        echo '<script>';
        echo 'Materialize.toast(\'Image Uploaded Successfully !\', 4000)';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'Materialize.toast(\'Error Uploading File !\', 4000)';
        echo '</script>';
    }
}
?>