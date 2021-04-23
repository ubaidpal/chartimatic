<?php
namespace Cartimatic\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Cartimatic\Admin\Repositories\ContactRequestRepository;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class ContactRequestController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * @var \Cartimatic\Admin\Repositories\ContactRequestRepository
     */
    private $contact;

    /**
     * ContactRequestController constructor.
     */
    public function __construct(Request $request, ContactRequestRepository $contact) {
        $this->request = $request;
        $this->contact = $contact;
    }

    public function index() {

        $data[ 'requests' ] = $this->contact->getAllRequests();
        //echo '<tt><pre>'; print_r($data);
        return view('Admin::ContactRequest.index', $data);
    }

    public function createUser($id) {
        $data[ 'id' ] = $id;
        return view('Admin::ContactRequest.contact-form', $data);
    }

    public function reject($id) {
        $id = Hashids::connection('main')->decode($id)[ 0 ];

        $data = $this->contact->updateStatus($id, 1);
        return redirect()->back()->with($data[ 'type' ], $data[ 'message' ]);
    }

    public function saveUser() {
        $this->validate($this->request, [
            'contact_id' => 'required',
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|unique:users',
            'address'    => 'required',
            'phone'      => 'required',
            'city'       => 'required',
            'post_code'  => 'required',
            'country'    => 'required',
            'state'      => 'required',
        ]);

        $data = $this->contact->saveUser($this->request->all());
        return redirect()->route('contact.contact-request')->with($data[ 'type' ], $data[ 'message' ]);
    }

}
