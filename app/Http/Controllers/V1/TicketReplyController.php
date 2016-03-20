<?php 

namespace App\Http\Controllers\V1;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class TicketReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'store']);
    }

    public function index($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        
        return [
            'status'    => 'success',
            'replies'   => $ticket->replies
        ];
    }

    public function store(Request $request, $ticket_id)
    {
        $this->validate($request, [
            'content'   => 'required'
        ]);

        $ticket = Ticket::find($ticket_id);

        if ($ticket) {
            $reply  = [
                'subject'   => $request->get('subject'),
                'content'   => $request->get('content'),
                'user_id'   => Auth::user()->id
            ];

            $ticket->replies()->create($reply);

            return [
                'status'    => 'success',
                'message'   => 'Ticket berhasil ditambahkan.'
            ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Ticket tidak tersedia.'
            ];
        }
    }

    public function show($ticketd_id, $id)
    {
        $ticket = Ticket::find($id);

        if ($ticket) {
            $reply = $ticket->replies()->find($id);

            return [
                'status'    => 'success',
                'reply'     => $reply
            ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Ticket tidak tersedia.'
            ];
        }
    }

    public function update(Request $request, $ticket_id, $id)
    {
        $ticket = Ticket::find($id);

        if ($ticket) {
            $reply = $ticket->replies()->find($id);

            if ($reply) {
                $reply->subject = $request->get('subject');
                $reply->content = $request->get('content');
                $reply->save();

                return [
                    'status'    => 'success',
                    'reply'     => $reply
                ];                    
            } else {                
                return [
                    'status'    => 'failed',
                    'message'   => 'Ticket reply tidak tersedia.'
                ];
            }
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Ticket tidak tersedia.'
            ];
        }
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if ($ticket) {
            $reply = $ticket->replies()->find($id);

            if ($reply) {
                $reply->delete();

                return [
                    'status'    => 'success'
                ];                    
            } else {                
                return [
                    'status'    => 'failed',
                    'message'   => 'Ticket reply tidak tersedia.'
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