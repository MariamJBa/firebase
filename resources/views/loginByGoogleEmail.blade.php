<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags
     Specify the client ID you created for your app in the Google Developers Console with the google-signin-client_id meta element.'-->
    <meta name="google-signin-client_id" content="750041701748-h2qprdv8svbdns4td6ntnsbhcu8tpqrl.apps.googleusercontent.com">


    <title>Laravel RealTime CRUD Using Google Firebase</title>

</head>
<body>

<div class="container" style="margin-top: 50px;">

    <h4 class="text-center">Laravel login Using Google email</h4><br>


    <div class="card card-default">
        <div class="card-body">
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>
    </div>

    <br>

</div>






{{--Firebase Tasks--}}

<!-- You must include the Google Platform Library on your web pages that integrate Google Sign-In.-->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    }
</script>
</body>
</html>

