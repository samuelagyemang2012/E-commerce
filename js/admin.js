/* Samuel Agyemang */
/*global $, document*/

var current_page = 1;
var records_per_page = 10;
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

    "use strict";

    var btn_next = document.getElementById("btn_next");
    var btn_prev = document.getElementById("btn_prev");
    var div; // = document.getElementById("results");
    var page_span = document.getElementById("page");
    var num;

    // Validate page
    if (page < 1) page = 1;
    if (page > numPages()) page = numPages();

    var div = "";
    div += '<table class="highlight bordered centered" >';
    div += '<thead>';
    div += '<tr>';
    div += '<th data-field="name" style="color: #00695c"> Wine</th>';
    div += '<th data-field="id"   style="color: #00695c"> Year</th>';
    div += '<th data-field="id"   style="color: #00695c"> Wine Type</th>';
    div += '<th data-field="id"   style="color: #00695c"> Winery</th>';
    div += '<th data-field="id"   style="color: #00695c"> Variety</th>';
    div += '<th data-field="id"   style="color: #00695c"> Cost</th>';
    //    div += '<th data-field="id"   style="color: #00695c"> </th>';
    //    div += '<th data-field="id"></th>';
    //    div += '<th data-field="id"></th>';
    div += '</tr>';
    div += '</thead>';
    div += '<tbody>';

    for (var i = (page - 1) * records_per_page; i < (page * records_per_page) && i < myArray.length; i++) {
        div += '<tr>';
        div += '<td>' + myArray[i].wine_name + '</td>';
        div += '<td>' + myArray[i].year + '</td>';
        div += '<td>' + myArray[i].wine_type + '</td>';
        div += '<td>' + myArray[i].winery_name + '</td>';
        div += '<td>' + myArray[i].variety + '</td>';
        div += '<td> $' + myArray[i].cost + '</td>';
        div += '<td><a onclick="get_details(this,' + myArray[i].wine_id + ')" value="' + myArray[i].variety + '" class="btn btn-floating btn-small waves-effect waves-light teal"><i class="material-icons">mode_edit</i></a></td>';
        div += '<td><a class="btn-floating btn-samll waves-effect waves-light red"><i class="material-icons">delete</i></a></td>';
        div += '</tr>';
    }

    div += '</tbody>';
    div += '</table>';
    document.getElementById("results").innerHTML = div;
    //    $("#results").html(div);

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

//function load_details(id, price) {
//
//    "use strict";
//    //
//    var url, result;
//    //
//    url = "controller.php?cmd=5&price=" + price + "&id=" + id;
//    result = send_request(url);
//
//    //build_tutorial(result.wine_name, result.on_hand, result.region, result.wine_type, result.price, result.winery);
//
//}

function admin_load_wines() {
    "use strict";

    var url, result;
    url = "controller.php?cmd=2";
    result = send_request(url);
    myArray = result.wines;
    //alert(result.wines[89].variety);
    change_page(1);

}

function search_wines(name) {
    "use strict";

    var url, wine, result;
    wine = name;
    url = "controller.php?cmd=1&name=" + wine;
    result = send_request(url);
    myArray = result.wines;
    change_page(1);
}

function load_by_type(type) {
    "use strict";

    var url, result;
    //wine = name;
    url = "controller.php?cmd=3&type=" + type;
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

function get_details(vr, id) {

    "use strict";

    var url, result, vary;

    vary = $(vr).attr("value");

    url = "controller.php?cmd=5&id=" + id + "&variety=" + vary;
    result = send_request(url);

    document.getElementById("name").value = result.wine_name;
    document.getElementById("year").value = result.year;
    $("#wt").val(result.wine_type);
    $("#wt").material_select();
    $("#vary").val(result.variety);
    $("#vary").material_select();
    document.getElementById("winery").value = result.winery_name;
    document.getElementById("cost").value = result.cost;
    $("#reg").val(result.region_name);
    $("#reg").material_select();
    document.getElementById("qty").value = result.on_hand;
    //document.getElementById("var").value = result.variety;

    var but = "";
    but = '<a class="waves-effect waves-light btn" onclick="update()">Update</a>';
    $("#forbutton").html(but);

}

function update(){
    //var url, result, name, year, wine_type,winery;

    //vary = $(vr).attr("value");

    //url = "controller.php?cmd=6&id=" + id + "&variety=" + vary;
    //result = send_request(url);
    //
    //var name =document.getElementById("name").value;
    //var yeardocument.getElementById("year").value = result.year;
    //$("#wt").val(result.wine_type);
    //$("#wt").material_select();
    //document.getElementById("winery").value = result.winery_name;
    //document.getElementById("cost").value = result.cost;
    //$("#reg").val(result.region_name);
    //$("#reg").material_select();
    //document.getElementById("qty").value = result.on_hand;
    //document.getElementById("var").value = result.variety;



    Materialize.toast('Updated!', 3000, 'rounded')
}

function insert() {
    //    clear();

    var but = "";
    but = '<a class="waves-effect waves-light btn">Add</a>';
    $("#forbutton").html(but);
}

function login(){
    var url, result, u,p;

    u = document.getElementById("username").value;
    p = document.getElementById("password").value;

    url = 'controller.php?cmd=6&username='+u+'&password='+p;

    result = send_request(url);
        //alert(result.result);
    if(result.result==1){
        $("#adminform").fadeOut(1000);
        //$("#adminform").slideUp();
        window.location.replace('edit.php');
    }
}


//function build_tutorial(wine_name, on_hand, region, wine_type, price, winery) {
//
//    "use strict";
//    var div;
//    div = "";
//
//    // div+='<div id="modals" class="modal modal-fixed-footer my_modal">';
//    div += '<div class = "modal-content">';
//
//    div += '<center> <h5 style = "color: #558b2f"> Name </h5> </center>';
//
//    div += '<center> <p>' + wine_name + '</p> <center>';
////    div += '<hr>';
//    div += '<h5 style = "color: #558b2f"> Winery </h5>';
//    div += '<p>' + winery + '</p>';
//    //
//    div += '<h5 style = "color: #558b2f"> Region </h5>';
//    div += '<p>' + region + '</p>';
//    //
//    div += '<h5 style = "color: #558b2f"> Wine Type </h5>';
//    div += '<p>' + wine_type + '</p>';
//    //
//    div += '<h5 style = "color: #558b2f"> Price </h5>';
//    div += '<p> $' + price + '</p>';
//    //
//    div += '<h5 style = "color: #558b2f"> Quantity on Hand </h5>';
//    div += '<p>' + on_hand + ' bottles' + '</p>';
//    //
//    div += '</div>';
//    //
//    div += '<div class = "modal-footer">';
//    div += '<a id="but" class="modal-action modal-close waves-effect waves-green btn-flat">Buy</a>';
//    div += '</div>';
//    div += '</div>';
//
//    $('.my_modal').html(div);
//
//   // $('.modal-trigger').leanModal();
//
//}
