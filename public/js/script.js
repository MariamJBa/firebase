// Initialize Firebase


// Initialize Firebase
var config = {
    apiKey: "AIzaSyAawNsAkW17Zt9s659cmHZm_kMk0W7DHpQ",
    authDomain: "fir-crud-27150.firebaseapp.com",
    databaseURL: "https://fir-crud-27150.firebaseio.com",
    projectId: "fir-crud-27150",
    storageBucket: "fir-crud-27150.appspot.com",
    messagingSenderId: "754861664354",
    appId: "1:754861664354:web:e8de5fe58074563881c93b",
    measurementId: "G-KH1F2FY4CS"
};
firebase.initializeApp(config);

var database = firebase.database();

var lastIndex = 0;

// Get Data
firebase.database().ref('customers/').on('value', function (snapshot) {
    var value = snapshot.val();
    var htmls = [];
    $.each(value, function (index, value) {
        if (value) {
            htmls.push('<tr>\
        		<td>' + value.name + '</td>\
        		<td>' + value.email + '</td>\
        		<td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="' + index + '">Update</button>\
        		<button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button></td>\
        	</tr>');
        }
        lastIndex = index;
    });
    $('#tbody').html(htmls);
    $("#submitUser").removeClass('desabled');
});


// Add Data
$('#submitCustomer').on('click', function () {
    var values = $("#addCustomer").serializeArray();
    var name = values[0].value;
    var email = values[1].value;
    var userID = lastIndex + 1;

    console.log(values);
    alert('userID: '+userID);
    alert ('values: '+JSON.stringify(values));
    firebase.database().ref('customers/' + userID).set({
        name: name,
        email: email,
    });

    // Reassign lastID value
    lastIndex = userID;
    $("#addCustomer input").val("");
});

// Remove Data
$("body").on('click', '.removeData', function () {

    var id = $(this).attr('data-id');
    alert('removeData id: '+id);
    $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
});

$('.deleteRecord').on('click', function () {
    alert('deleteRecord id: ');
    var values = $(".users-remove-record-model").serializeArray();
    var id = values[0].value;
    firebase.database().ref('customers/' + id).remove();
    $('body').find('.users-remove-record-model').find("input").remove();
    $("#remove-modal").modal('hide');
});
$('.remove-data-from-delete-form').click(function () {
    $('body').find('.users-remove-record-model').find("input").remove();
});
