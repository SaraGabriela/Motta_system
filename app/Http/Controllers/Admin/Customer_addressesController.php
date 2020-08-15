<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Customer_address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCustomer_addressesRequest;
use App\Http\Requests\Admin\UpdateCustomer_addressesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class Customer_addressesController extends Controller
{
    
    use FileUploadTrait;

    /**
     * Display a listing of Customer_address.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('manifiestos')) {
                return abort(401);
            }

            $customer_addresses = Customer_address::onlyTrashed()->get();
        } else {
            $customer_addresses = Customer_address::all();
        }

        return view('admin.customer_addresses.index', compact('customer_addresses'));
    }
    
   /**
     * Show the form for creating new Customer_address.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $manifestcustomer = \App\ManifestCustomer::select(
            DB::raw("CONCAT(name,' ',ruc) AS nameruc"),'id')
            ->pluck('nameruc', 'id');

        return view('admin.customer_addresses.create', compact('manifestcustomer'));
    }

    

        /**
     * Store a newly created Customer_address in storage.
     *
     * @param  \App\Http\Requests\StoreCustomer_addressesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomer_addressesRequest $request)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $customer_addresses = Customer_address::create($request->all());

        return redirect()->route('admin.customer_addresses.index');
    }
    
    /**
     * Show the form for editing Customer_address.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $manifestcustomer = \App\ManifestCustomer::get()->pluck('name', 'id');

        $customer_address   = Customer_address::findOrFail($id);

        return view('admin.customer_addresses.edit', compact('customer_address', 'manifestcustomer'));
    }

    /**
     * Update Customer_address in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomer_addressesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomer_addressesRequest $request, $id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $customer_address = Customer_address::findOrFail($id);
        $customer_address->update($request->all());

        return redirect()->route('admin.customer_addresses.index');
    }


    /**
     * Display Customer_address.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $customer_address  = Customer_address::findOrFail($id);

        return view('admin.customer_addresses.show', compact('customer_address'));
    }


    /**
     * Remove Customer_address from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $customer_address = Customer_address::findOrFail($id);
        $customer_address->delete();

        return redirect()->route('admin.customer_addresses.index');
    }

    /**
     * Delete all selected Customer_address at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Customer_address::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    
    /**
     * Delete all selected Customer_address at once.
     *
     * @param Request $request
     */
    public function massQR(Request $request)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Customer_address::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry = QrCode::size(300)->generate("$customer_address->code_qr");
               download($entry, 'filename.png');
            }
        }
    }


    /**
     * Restore Customer_address from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $customer_address = Customer_address::onlyTrashed()->findOrFail($id);
        $customer_address->restore();

        return redirect()->route('admin.customer_addresses.index');
    }

    /**
     * Permanently delete Customer_address from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $customer_address = Customer_address::onlyTrashed()->findOrFail($id);
        $customer_address->forceDelete();

        return redirect()->route('admin.customer_addresses.index');
    }


}
