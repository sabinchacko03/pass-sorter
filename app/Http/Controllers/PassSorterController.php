<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassSorterController extends Controller
{
    public function home(Request $req){
        return view('welcome');
    }

    /* --- API function to receive the input JSON --- */
    function sort(Request $req){
        $input = json_decode($req->getContent());
        shuffle($input);        // ------- Shuffle the input list
        $output = $this->sortFunction($input);
        return $output;
    }

    /* --- Function to Sort the Unordered routes --- */
    function sortFunction($input){
        $from = array_column($input, 'from');
        $to = array_column($input, 'to');
        $start = array_diff($from, $to);

        $sorted = [$input[key($start)]];
        $current = $input[key($start)];
        $start = $input[key($start)]->to;        
        $counter = 1;
        while(true){            
            $step = $counter++ .'. ';
            if($current->type == 'airplane'){
                $step .= 'From '. $current->from .', take '.$current->number.' to '.$current->to.'. Gate '. $current->gate.', seat '. $current->seat .'. ';

                if($current->counter){
                    $step .= 'Baggage drop at ticket counter '. $current->counter .'.';
                }else{
                    $step .= 'Baggage will be automatically transferred from your last leg.';
                }
            }else{
                if($current->type == 'bus'){
                    $step .= 'Take the '. $current->number . ' ' . $current->type;                    
                }else{
                    $step .= 'Take train '. $current->number;
                }

                $step .= ' from '.$current->from. ' to '. $current->to .'. ';
                if($current->seat){
                    $step .= 'Sit in seat '. $current->seat.'. ';
                }else{
                    $step .= 'No seat assignment.';
                }
            }                        
            $output[] = $step;

            $key = array_search($start, $from);
            if($key === false)
                break;
            $sorted[] = $input[$key];
            $start = $input[$key]->to;
            $current = $input[$key];
        }
        $output[] = $counter .'. You have arrived at your final destination.';
        return $output;
    }
    
    public function uploadFile(Request $req){
        $req->validate([
            'file' => 'required|mimes:pdf,xlx,csv,sql,json,JSON,txt|max:2048'
            ]);
        $content = $req->file('file')->get();
        $input = json_decode($content);
        shuffle($input);
        $output = $this->sortFunction($input);
        return back()
            ->with('success','Route has been found.')
            ->with('result', $output);
    }

    public function jsonForm(Request $req){
        $json = $req->json;
        $input = json_decode($json);
        shuffle($input);
        $output = $this->sortFunction($input);
        return back()
            ->with('success','Route has been found.')
            ->with('result', $output);
    }
}
