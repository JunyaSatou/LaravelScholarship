<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Runner\ResultCacheExtension;

class ScholarshipController extends Controller{

    public function index(Request $request){
        // createSimulationへルーティング
        if ($request->pattern == 1) {
            createSimulation($request);
        } 
        
        // getSimulationHistoryへルーティング
        if ($request->pattern == 2) {
            getSimulationHistory($request);
        }
    }

    public function createSimulation(Request $request){

    }

    public function getSimulationHistory(Request $request){

    }
}
