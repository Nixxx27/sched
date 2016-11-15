<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\employees;
use App\rank;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function get_dom_counter_employee()
    {
        $employees_shift = employees::where('shift','=', $_GET['selected_shift'])->get();
        foreach ($employees_shift as $shifts)
        {
            echo "<tr><td>". ucwords($shifts->name) . "</td><td>" . strtoupper($shifts->code) . "</td></tr>";
        }
    }

    public function add_counter_unassigned()
    {
    	echo 'nikko';// $_GET['selected_counter'];
    }

}
