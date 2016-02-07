/* Samuel Agyemang */
/*global $, document*/

var current_page = 1;
var records_per_page = 20;
var myArray;

function send_request(url) {
    "use strict";
    var obj, result;
    obj = $.ajax({
        url: url,
        async: false
    });
    result = $.parseJSON(obj.responseText);
    return result;
}


function change_page(page) {
    var btn_next = document.getElementById("btn_next");
    var btn_prev = document.getElementById("btn_prev");
    var listing_table; // = document.getElementById("results");
    var page_span = document.getElementById("page");
    var num;

    // Validate page
    if (page < 1) page = 1;
    if (page > numPages()) page = numPages();

    listing_table = "";
    listing_table += '<div class="row">';


    for (var i = (page - 1) * records_per_page; i < (page * records_per_page) && i < myArray.length; i++) {

        num = myArray[i].wine_id % 10;
        // alert(num);
        listing_table += '<div class="col s3">';
        listing_table += '<div class="card" style="height: 340px; width: 300px;">';
        listing_table += '<div class="card-image waves-effect waves-block waves-light">';
        listing_table += '<center><img class="activator" src="../E-Commerce/images/' + num + '.png" style="height: 200px; width: 80px"></center></div>';
        listing_table += '<div class="card-content">';
        listing_table += '<span class="card-title activator green-text text-darken-4">' + myArray[i].wine_name + '<i class="material-icons right">more_vert</i></span>';
        listing_table += '<p><a href="#">More Details</a></p>';
        listing_table += '</div>';
        listing_table += '<div class="card-reveal">';
        listing_table += '<span class="card-title grey-text text-darken-4">' + myArray[i].wine_name + '<i class="material-icons right">close</i>  </span>';
        listing_table += '<p>Id:' + myArray[i].wine_id + '</p>';
        listing_table += '<p>Year:' + myArray[i].year + '</p>';
        listing_table += '<p>Winery: ' + myArray[i].winery_name + '</p>';
        listing_table += '<p>Wine Type: ' + myArray[i].wine_type + '</p>';
        listing_table += '<p>Grape Variety: ' + myArray[i].variety + '</p>';
        listing_table += '<h5> $' + myArray[i].cost + '</h5>';
        listing_table += '<center></p><a class="waves-effect waves-light btn" style="background-color: #8bc34a">Add to Cart</a></p></center>';
        listing_table += ' </div>';
        listing_table += ' </div>';
        listing_table += ' </div>';
    }

    listing_table += '</div>';

    document.getElementById("results").innerHTML = listing_table;
    page_span.innerHTML = page;

    if (page == 1) {
        btn_prev.style.visibility = 'hidden';
    } else {
        btn_prev.style.visibility = 'visible';
    }

    if (page == numPages()) {
        btn_next.style.visibility = 'hidden';
    } else {
        btn_next.style.visibility = 'visible';
    }
}


function prevPage() {

    if (current_page > 1) {
        current_page--;
        change_page(current_page);
    }
}

function nextPage() {

    if (current_page < numPages()) {
        current_page++;
        change_page(current_page);
    }
}

function numPages() {
    return Math.ceil(myArray.length / records_per_page);
}

function load_wines() {
    "use strict";

    var url, result;
    url = "controller.php?cmd=2";
    result = send_request(url);
    //alert(result.message);
    myArray = result.wines;

    change_page(1);

}

function search_wines(name) {
    "use strict";

    var url, wine, result;
    wine = name;
    url = "controller.php?cmd=1&name=" + wine;
    result = send_request(url);
    myArray = result.wines;
    //alert(myArray[9].wine_name);
    change_page(1);
}

function load_by_type(wine) {
    "use strict";

    var url, result;
    //wine = name;
    url = "controller.php?cmd=3&type=" + wine;
    result = send_request(url);
    myArray = result.wines;
    change_page(1);

}

function sort_price() {
    "use strict";

    var url, result;
    //wine = name;
    url = "controller.php?cmd=4";
    result = send_request(url);
    myArray = result.wines;
    change_page(1);
}

