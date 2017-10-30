<?php

use App\Component\Routing\Route;


/**
 * 
 * Route Register
 * Author : harrieanto31@yahoo.com | Web:http://youreinspire.com
 * -------------------------------------------------------------------------------------------------
 * Created : 3/July/2017
 * As Repsoitoriey Framework Components 1.7.0-dev
 * This is for registering all router and you'll able to use following methods:
 * GET | POST | PATCH | OPTIONS | HEAD | DELETE | PUT | GROUP
 * You may want filter your incoming route and you'll end up easily with:
 * :alpha, :alnum, :any, :digit or you may want customize your need with your own regular expresson just write it down in place.
 * -------------------------------------------------------------------------------------------------
 * Email: harrie@youreinspire.com | harrieanto31@yahoo.com
 * 
 */
//simple route through function
route('greeting/:alpha/:digit',  function($name,  $old){
	echo "My name is {$name} today my old {$old} year old";
}); // you may want specify some http verbose like GET, POST, DELETE, PATCH, PUT, OPTIONS, HEAD THROUGH PARAMETERS #3

//Route through static method
Route::get('greeting',  function() {
    echo 'Hello, I am just First greeting!';
});

//route through defined controller
Route::get('greeting/controller',  'HelloController@index');

//route authorization
//this is very useful when we working on user scalable
//you may want user that access your page truly authorized before they access your entire site.$_COOKIE
//so, here you can easily dividing your free user, premium user or whatever is.
//you just need replace your path name on parameter #1 with paired array that have to  contain "auth" key name
//and your path name as value of "auth" key name.
//by default auth determine as admin
//you may want custom your auth just following simple tagline below:
//auth:admin -> admin setup with your own maybe user, free, premium, gold and so on.
//or
//auth:admin:harrieanto -> also, you may want customize your authorized page just for user that have name harrieanto and roled as admin.
Route::get(array('auth' => 'greeting/auth'),  function() { 
    echo "Welcome back, ".$this->auth->get('credentials');
});

Route::group(array( 'domain' => 'harrie.repositoriey.com',  'root' => '/'),  function( $res ) {
    Route::get(array('auth' => 'greeting/auth'),  function() { 
        echo "Welcome back, ".$this->auth->get('credentials');
    }); 

    Route::get('greeting',  function() { 
        echo "Hello, I am just Second greeting!";
    }); 

});

Route::group(array( 'domain' => '{user}.repositoriey.com',  'root' => '/'),  function( $res,  $req ) {
	Route::get('greeting',  function(){
		echo "Welcome, ".$this->getVar();
	});

    Route::get('greetingv2',  function() use ($res,  $req){ 
        echo "Hello, I am ".$this->user."<br>";
        echo "Hello, I am ".$res->getVar()."<br>";
		echo "<br>Hello, {$res->user} <code>\$res->user</code><br>";
        $req->setHeader(function($req) {
            $req->state(503);
			$req->influence();
			echo var_dump($req->getHeader())."<code>\$req->getHeader()</code><br>";
        });
    });

    Route::get(array('auth:user' => 'greetingv3'),  function() { 
        echo "Welcome back, ".$this->auth->get('credentials');
    }); 
});

Route::group(array( 'domain' => 'harrie.repositoriey.com',  'root' => 'me'),  function( $res,  $req ) {
	Route::get('greeting',  function() {
		echo "Welcome, ".$this->getVar();
	});
});

Route::group(array( 'domain' => 'harrie.repositoriey.com',  'root' => 'just/for/fun'),  function( $res,  $req ) {
    Route::get('/triangle',  function(){
    	echo "<center>".implode(' ', array_map(function($i,$j='*',$t=1,$y=1,$n="\n"){return($i%2===$y)?($i===1)?nl2br($j.$n):$n:nl2br(str_pad('', $i+$t, $j).$n);},array_merge_recursive(range(100,2),range(1,100))))."</center>";
    });
});

