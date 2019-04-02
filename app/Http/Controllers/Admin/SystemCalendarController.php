<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public function index() 
    {
        $events = []; 

        foreach (\App\Ispiti::all() as $ispiti) { 
           $crudFieldValue = $ispiti->getOriginal('datum_izvrsavanja'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $ispiti->kalendarski_naziv; 
           $prefix         = ''; 
           $suffix         = ''; 
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.ispitis.edit', $ispiti->id)
           ]; 
        } 


       return view('admin.calendar' , compact('events')); 
    }

}
