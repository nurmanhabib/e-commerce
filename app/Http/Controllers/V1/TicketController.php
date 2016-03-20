<?php 

namespace App\Http\Controllers\V1;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return [
            'status'    => 'success',
            'tickets'   => Ticket::all()
        ];
    }

    public function store(Request $request)
    {
        $this->middleware('auth');

        $this->validate($request, [
            'subject'   => 'required',
            'content'   => 'required',
            'ticket_department_id'  => 'required|exists:ticket_departments,id'
        ]);

        $ticket = new Ticket;
        $ticket->fill([
            'subject'   => $request->get('subject'),
            'content'   => $request->get('content'),
            'status'    => 'open'
        ]);
        $ticket->department()->associate($request->get('ticket_department_id'));
        $ticket->user()->associate(Auth::user());
        $ticket->save();

        return [
            'status'    => 'success',
            'ticket'    => $ticket
        ];
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);

        if ($ticket) {
            return [
                'status'    => 'success',
                'ticket'    => $ticket
            ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Ticket tidak tersedia.'
            ];
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'subject'   => 'required',
            'content'   => 'required',
            'ticket_department_id'  => 'required|exists:ticket_departments,id'
        ]);

        $ticket = Ticket::find($id);

        if ($ticket) {
            $ticket->fill([
                'subject'   => $request->get('subject'),
                'content'   => $request->get('content')
            ]);
            $ticket->department()->associate($request->get('ticket_department_id'));
            $ticket->save();

            return [
                'status'            => 'success',
                'ticket' => $ticket
            ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Ticket tidak tersedia.'
            ];
        }
    }

    public function destroy($id)
    {
        $ticket = TicketDeparment::find($id);

        if ($ticket) {

            if ($ticket->delete()) {
                return [
                    'status'    => 'success',
                    'message'   => 'Ticket berhasil dihapus.'
                ];
            } else {
                return [
                    'status'    => 'failed',
                    'message'   => 'Ticket gagal dihapus.'
                ];
            }

        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Ticket tidak tersedia.'
            ];
        }
    }
}