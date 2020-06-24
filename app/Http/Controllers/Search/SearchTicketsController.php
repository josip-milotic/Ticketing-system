<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\State;
use App\Ticket;
use Illuminate\Http\Request;

class SearchTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->get('search');
        $states= State::all();
        if ($search){
            $tickets= Ticket::where('title','like', '%'.$search.'%')
                ->orWhere('body', 'like', '%'.$search.'%')
                ->latest('created_at')
                ->paginate(10);
        }else{

            $tickets = Ticket::latest('created_at')
                ->paginate(10);
        }
        return view ('tickets.index', compact('tickets','states'));
    }

    function indexAjax()
    {
        return view('tickets.index');
    }

    function action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '')
            {
                $data= Ticket::where('title','like', '%'.$query.'%')
                    ->orWhere('body', 'like', '%'.$query.'%')
                    ->latest('created_at')
                    ->paginate(10);

            }
            else
            {
                $data = Ticket::latest('created_at')
                    ->paginate(10);
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
        <tr>
         <td>'.$row->id.'</td>
         <td>'.$row->title.'</td>
         <td>'.$row->state->state.'</td>
         <td>'.$row->client->name.'</td>
         <td>'.$row->user->username.'</td>
        </tr>
        ';
                }
            }
            else
            {
                $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }

}
