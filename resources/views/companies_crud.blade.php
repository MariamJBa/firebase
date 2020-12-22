<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


    <title>Laravel RealTime CRUD Using Google Firebase</title>
</head>
<body>

<div class="container" style="margin-top: 50px">
    <h4 class="text-center">Laravel RealTime CRUD Using Google Firebase</h4><br>

    <h5># Add Company</h5>
    <div class="card card-default">
        <div class="card-body">
            <form id="addCompany" class="form-inline" method="POST" action="">
                <div class="form-group mb-2">
                    <label for="name" class="sr-only">Name</label>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Name"
                           required autofocus>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                           required autofocus>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="phone" class="sr-only">Phone</label>
                    <input id="phone" type="phone" class="form-control" name="phone" placeholder="Phone"
                           required autofocus>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" type="password" class="form-control" name="address" placeholder="Password"
                           required autofocus>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="address" class="sr-only">Address</label>
                    <input id="address" type="text" class="form-control" name="address" placeholder="Address"
                           required autofocus>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="isFavorate" class="sr-only">Is Favorate</label>
                    <input id="isFavorate" type="checkbox" class="form-control isFavorate" name="isFavorate" placeholder="Is Favorate"
                           required autofocus>
                </div>

                <br/>

                <button id="submitCompany" type="button" class="btn btn-primary mb-2">Submit</button>
            </form>
        </div>
    </div>

    <br/>

    <h5># Companies</h5>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>address</th>
            <th>is favorate</th>
            <th width="180" class="text-center">Action</th>
        </tr>
        <tbody id="tbody">

        </tbody>
    </table>
</div>



<form action="" method="POST" class="users-remove-record-model">
    <div id="remove-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this company?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-danger waves-effect waves-light deleteRecord">Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

{{--Firebase Tasks--}}
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
<script>
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyAawNsAkW17Zt9s659cmHZm_kMk0W7DHpQ",
        authDomain: "fir-crud-27150.firebaseapp.com",
        databaseURL: "https://fir-crud-27150.firebaseio.com",
        // projectId: "fir-crud-27150",
        storageBucket: "fir-crud-27150.appspot.com",
        // messagingSenderId: "754861664354",
        // appId: "1:754861664354:web:e8de5fe58074563881c93b",
        // measurementId: "G-KH1F2FY4CS"
    };

    firebase.initializeApp(config);

    var database = firebase.database();
    var lastIndex = 0;

    // Get Data
    firebase.database().ref('company/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
        		<td>' + value.name + '</td>\
        		<td>' + value.email + '</td>\
        		<td>' + value.phone + '</td>\
        		<td>' + value.address + '</td>\
        		<td><input id="isFavorate" type="checkbox" class="form-control" name="isFavorate" placeholder="Is Favorate" required autofocus></td>\
        		<td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="' + index + '">Update</button>\
        		<button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button></td>\
        	</tr>');
            }
            lastIndex = index;
        });
        $('#tbody').html(htmls);
        $("#submitUser").removeClass('desabled');
    });

    // Add data
    $('#submitCompany').on('click', function () {
        var values = $("#addCompany").serializeArray();
        var name = values[0].value;
        var email = values[1].value;
        var phone = values[2].value;
        var password = values[3].value;
        var address = values[4].value;
        var userID = lastIndex + 1;
        var checkedValue = $('.isFavorate:checked').val();
        alert('checkedValue: '+checkedValue)
        alert ('values: '+JSON.stringify(values));

        firebase.database().ref('company/'+ userID).set({
            name: name,
            email: email,
            phone: phone,
            password: password,
            address: address,
        });

        //Reassing lastId value
        lastIndex = userID
        $("#addCompany input").val("");

    });

    // Remove Data
    $("body").on('click','.removeData', function () {
        var id = $(this).attr('data-id');
        $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });
    $('.deleteRecord').on('click', function () {
        var values = $(".users-remove-record-model").serializeArray();
        var id = values[0].value;
        firebase.database().ref('company/' + id).remove();
        $('body').find('.users-remove-record-model').find("input").remove();
        $("#remove-modal").modal('hide');
    });
    $('.remove-data-from-delete-form').click(function () {
        $('body').find('.users-remove-record-model').find("input").remove();
    });
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
