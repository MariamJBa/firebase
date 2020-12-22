<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

use Kreait\Firebase;

use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
    public function index(){

//        echo __DIR__.'/FirebaseKey.json';
//        exit;
        $serviceAccount = ServiceAccount::fromJasonFile(__DIR__.'\FirebaseKey.json');

        echo "from: ";
        var_dump($serviceAccount);
        exit;


        $firebase 		  = (new Factory)

            ->withServiceAccount($serviceAccount)

            ->withDatabaseUri('https://fir-crud-27150.firebaseio.com')

            ->create();

        $database 		= $firebase->getDatabase();

        $newPost 		  = $database

            ->getReference('blog/posts')

            ->push(['title' => 'Post title','body' => 'This should probably be longer.']);

        echo"<pre>";

        print_r($newPost->getvalue());


//        $serviceAccount = ServiceAccount::fromJasonFile(__DIR__.'/FirebaseKey.json');
//
//        $firebase 		  = (new Factory)
//
//            ->withServiceAccount($serviceAccount)
//
//            ->withDatabaseUri('https://fir-crud-27150.firebaseio.com')
//
//            ->create();

//        $factory = (new Factory)->withServiceAccount(__DIR__.'/FirebaseKey.json');
//
//        $firebase = $factory->createDatabase();
//return $firebase;

//        $database 		= $firebase->getDatabase();
//
//        $newPost 		  = $database
//
//            ->getReference('blog/posts')
//
//            ->push(['title' => 'Post title','body' => 'This should probably be longer.']);
//
//        echo"<pre>";
//
//        print_r($newPost->getvalue());



//        $serviceAccount = ServiceAccount::fromJasonFile(__DIR__.'Auth/FirebaseKey.json');
//        $firebase = (new Factory)
//        ->withServiceAccount($serviceAccount)
//        ->create();
//
//        $database = $firebase->getDatabase();
//        $ref = $database->getReference('Subject');
//
//        $key = $ref->push()->getKey();
//        return $key;
//        return 'FirebaseController';
    }
}
