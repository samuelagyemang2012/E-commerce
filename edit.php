<?php

include_once ('adminClass.php');
include_once ('controller.php');
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/modified.css" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/admin.js"></script>

</head>

<script>
    $(document).ready(function() {
        admin_load_wines();
    });

    $(document).ready(function() {
        $('select').material_select();
    });

</script>

<body>

<!--    <div class="col s12">-->
<ul id="dropdown1" class="dropdown-content">
    <li><a onclick="admin_load_wines()" style="color:#00695c">All</a></li>
    <li><a onclick="load_by_type('Sparkling')" style="color:#00695c">Sparkling</a></li>
    <li><a onclick="load_by_type('Fortified')" style="color:#00695c">Fortified</a></li>
    <li><a onclick="load_by_type('Sweet')" style="color:#00695c">Sweet</a> </li>
    <li><a onclick="load_by_type('White')" style="color:#00695c">White</a> </li>
    <li><a onclick="load_by_type('Red')" style="color:#00695c">Red</a> </li>
</ul>

<ul id="dropdown2" class="dropdown-content">
    <li><a onclick="admin_load_wines()" style="color:#00695c">Name</a></li>
    <li><a onclick="sort_price()" style="color:#00695c">Price</a></li>

</ul>

<div>
    <nav id="student_nav">
        <div class="nav-wrapper" style="background-color: #00695c ">
            <a id="nav_heading" style="text-align :center">The Happy Drunkard</a>
            <ul class="right hide-on-med-and-down">
                <li><a style="color: #ffffff" class= "dropdown-button" data-activates="dropdown2">Sort Wine By</a></li>
                <li><a style="color: #ffffff" class="dropdown-button" data-activates="dropdown1">Wine Type</a></li>

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

<div>
    <div class="row">
        <div id="results" class="col s6"></div>

        <div class="col s1">
            <p> </p>
        </div>

        <div class="col s5" id="inputs">
            <!--                <div class="input-field i">-->
            <!--                    <input id="id" type="number" min="0">-->
            <!--                    <label for="id"> Wine ID</label>-->

            <!--                </div>-->
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
                    <option id="2" value="Sparkling">Sparkling</option>
                    <option id="3" value="Fortified">Fortified</option>
                    <option id="4" value="Sweet">Sweet</option>
                    <option id="5" value="White">White</option>
                    <option id="6" value="Red">Red</option>
                </select>

                <label for="wt">Wine Type</label>
            </div>

            <div class="input-field i">
                <select id="vary">
                    <option id="" value="" disabled selected>Select Variety</option>
                    <option id="1" value="Reisling">Reisling</option>
                    <option id="2" value="Chardonnay">Chardonnay</option>
                    <option id="3" value="Sauvignon">Sauvignon</option>
                    <option id="4" value="Blanc">Blanc</option>
                    <option id="5" value="Semillon">Semillon</option>
                    <option id="6" value="Pinot">Pinot</option>
                    <option id="7" value="Gris">Gris</option>
                    <option id="8" value="Verdelho">Verdelho</option>
                    <option id="9" value="Grenache">Grenache</option>
                    <option id="10" value="Noir">Noir</option>
                    <option id="11" value="Carbernet">Cabernet</option>
                    <option id="12" value="Shiraz">Shiraz</option>
                    <option id="13" value="Merlot">Merlot</option>
                    <option id="14" value="Dessert">Dessert</option>
                    <option id="15" value="Muscat">Muscat</option>
                    <option id="16" value="Sherry">Sherry</option>
                    <option id="17" value="Port">Port</option>
                    <option id="18" value="Champagne">Champagne</option>
                    <option id="18" value="Sparkling">Sparkling</option>
                    <option id="20" value="Red">Red</option>
                    <option id="21" value="White">White</option>
                </select>

                <label for="vary">Variety</label>
            </div>

            <div class="input-field i">
                <input id="winery" type="text" placeholder=" " required>
                <label for="winery">Winery</label>
            </div>

            <div class="input-field i">
                <input id="cost" type="number" placeholder=" " min="0" required>
                <label for="cost">Cost</label>
            </div>

            <div class="input-field i">
                <select id="reg">
                    <option id="" value="" disabled selected>Select Region</option>
                    <option id="2" value="Goulburn Valley">Goulburn Valley</option>
                    <option id="3" value="Rutherglen">Rutherglen</option>
                    <option id="4" value="Coonawarra">Coonawarra</option>
                    <option id="5" value="Upper Hunter Valley">Upper Hunter Valley</option>
                    <option id="6" value="Lower Hunter Valley">Lower Hunter Valley</option>
                    <option id="7" value="Barossa Valley">Barossa Valley</option>
                    <option id="8" value="Riverland">Riverland</option>
                    <option id="9" value="Margaret River">Margaret River</option>
                    <option id="10" value="Swan Valley">Swan Valley</option>
                </select>

                <label for="reg">Winery</label>
            </div>


            <div class="input-field i">
                <input id="qty" type="number" placeholder=" " min="0" required>
                <label for="qty">Qty</label>
            </div>

            <div class="file-field input-field i">
                <div class="btn">
                    <span>Image</span>
                    <input type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>

            <div id="forbutton">

            </div>

        </div>
    </div>

</div>

<div class="fixed-action-btn horizontal" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large" id="add" onclick="insert()">
        <i class="large material-icons">add</i>
    </a>
</div>

<center>
    <a class="btn medium waves-effect waves-light mbb" href="javascript:prevPage()" id="btn_prev">Prev</a>

    <a class="btn medium waves-effect waves-light mbb" href="javascript:nextPage()" id="btn_next">Next</a> Page: <span id="page"></span>
</center>
</body>

</html>
