<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\TicketDepartment;
use Illuminate\Http\Request;

class TicketDepartmentController extends Controller
{
    public function index()
    {
        return [
            'status'                => 'success',
            'ticket_departments'    => TicketDepartment::all()
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|unique:ticket_departments'
        ]);

        $ticket_department = TicketDepartment::create(['name' => $request->get('name')]);

        return [
            'status'            => 'success',
            'ticket_department' => $ticket_department
        ];
    }

    public function show($id)
    {
        $ticket_department = TicketDepartment::find($id);

        if ($ticket_department) {
            return [
                'status'            => 'success',
                'ticket_department' => $ticket_department
            ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Ticket Department tidak tersedia.'
            ];
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required|unique:ticket_departments,name,' . $id
        ]);

        $ticket_department = TicketDepartment::find($id);

        if ($ticket_department) {
            $ticket_department->name = $request->get('name');
            $ticket_department->save();

            return [
                'status'            => 'success',
                'ticket_department' => $ticket_department
            ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Ticket Department tidak tersedia.'
            ];
        }
    }

    public function destroy($id)
    {
        $ticket_department = TicketDeparment::find($id);

        if ($ticket_department) {

            if ($ticket_department->delete()) {
                return [
                    'status'    => 'success',
                    'message'   => 'Ticket Department berhasil dihapus.'
                ];
            } else {
                return [
                    'status'    => 'failed',
                    'message'   => 'Ticket Department gagal dihapus.'
                ];
            }

        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Ticket Department tidak tersedia.'
            ];
        }
    }
}