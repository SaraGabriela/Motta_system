<?php

namespace App\Http\Controllers\Admin;

use App\Pension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePensionsRequest;
use App\Http\Requests\Admin\UpdatePensionsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class PensionsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Pension.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('planilla')) {
                return abort(401);
            }
            $pensions = Pension::onlyTrashed()->get();
        } else {
            $pensions = Pension::all();
        }

        return view('admin.pensions.index', compact('pensions'));
    }
    
   /**
     * Show the form for creating new Pension.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }
        return view('admin.pensions.create');
    }

        /**
     * Store a newly created Pension in storage.
     *
     * @param  \App\Http\Requests\StorePensionsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePensionsRequest $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);

        $pensions = Pension::create($request->all());

        return redirect()->route('admin.pensions.index');
    }
    
    /**
     * Show the form for editing Pension.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $pension = Pension::findOrFail($id);

        return view('admin.pensions.edit', compact('pension'));
    }

    /**
     * Update Pension in storage.
     *
     * @param  \App\Http\Requests\UpdatePensionsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePensionsRequest $request, $id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $pension = Pension::findOrFail($id);
        $pension->update($request->all());

        return redirect()->route('admin.pensions.index');
    }


    /**
     * Display Pension.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $pension  = Pension::findOrFail($id);

        return view('admin.pensions.show', compact('pension'));
    }


    /**
     * Remove Pension from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $pension = Pension::findOrFail($id);
        $pension->delete();

        return redirect()->route('admin.pensions.index');
    }

    /**
     * Delete all selected Pension at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Pension::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Delete all selected Pension at once.
     *
     * @param Request $request
     */
    public function massQR(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Pension::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry = QrCode::size(300)->generate("$pension->code_qr");

               // <td field-key='codigo_qr'>{!!QrCode::size(300)->generate("$pension->code_qr") !!}
               download($entry, 'filename.png');
                
               //return Response::download( $file , 'logo.png' , array( 'Content-Type' => 'image/png' ) )->setContentDisposition('inline');

            }
        }
    }
    /**
     * Restore Pension from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $pension = Pension::onlyTrashed()->findOrFail($id);
        $pension->restore();

        return redirect()->route('admin.pensions.index');
    }

    /**
     * Permanently delete Pension from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $pension = Pension::onlyTrashed()->findOrFail($id);
        $pension->forceDelete();

        return redirect()->route('admin.pensions.index');
    }


}
