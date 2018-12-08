<?php

namespace Alexa\Http\Controllers;

use Develpr\AlexaApp\Facades\Alexa;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Develpr\AlexaApp\Request;
use Illuminate\Http;

use Develpr\AlexaApp;

use Develpr\AlexaApp\Device;





class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function hello() {

    	//dd("sadf");

	    $yo = new Request\AlexaRequest();

	    $h = new Device\GenericDevice();
$hi = new AlexaApp\Alexa($yo, $h);


$hi->say("hello");




//	    return Alexa::
//
//
//	    say("Why was the little boy crying? Because he had a frog stapled to his face!");

    }
}
