<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSys extends Controller
{
    public function stopservice(){
        //This function will stop the services
    }
    public function startservice(){
        //This function will sent signal to start the service
    }
    public function os_restart(){
        //OS restarting signal will sent to machine
    }
}
