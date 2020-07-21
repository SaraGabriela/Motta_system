<?php

namespace App\Http\Controllers\Admin;

use App\Bath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBathsRequest;
use App\Http\Requests\Admin\UpdateBathsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class BathsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Bath.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('administrador')) {
                return abort(401);
            }
            $baths = Bath::onlyTrashed()->get();
        } else {
            $baths = Bath::all();
        }

        return view('admin.baths.index', compact('baths'));
    }
    
   /**
     * Show the form for creating new Bath.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        return view('admin.baths.create');
    }

        /**
     * Store a newly created Bath in storage.
     *
     * @param  \App\Http\Requests\StoreBathsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBathsRequest $request)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $baths = Bath::create($request->all());

        return redirect()->route('admin.baths.index');
    }
    
    /**
     * Show the form for editing Bath.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $bath = Bath::findOrFail($id);

        return view('admin.baths.edit', compact('bath'));
    }

    /**
     * Update Bath in storage.
     *
     * @param  \App\Http\Requests\UpdateBathsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBathsRequest $request, $id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $bath = Bath::findOrFail($id);
        $bath->update($request->all());

        return redirect()->route('admin.baths.index');
    }


    /**
     * Display Bath.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $bath  = Bath::findOrFail($id);

        return view('admin.baths.show', compact('bath'));
    }


    /**
     * Remove Bath from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $bath = Bath::findOrFail($id);
        $bath->delete();

        return redirect()->route('admin.baths.index');
    }

    /**
     * Delete all selected Bath at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Bath::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    
    /**
     * Delete all selected Bath at once.
     *
     * @param Request $request
     */
    public function massQR(Request $request)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Bath::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry = QrCode::size(300)->generate("$bath->code_qr");

               // <td field-key='codigo_qr'>{!!QrCode::size(300)->generate("$bath->code_qr") !!}
               download($entry, 'filename.png');
                
               //return Response::download( $file , 'logo.png' , array( 'Content-Type' => 'image/png' ) )->setContentDisposition('inline');

            }
        }
    }







    /**
     * Restore Bath from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $bath = Bath::onlyTrashed()->findOrFail($id);
        $bath->restore();

        return redirect()->route('admin.baths.index');
    }

    /**
     * Permanently delete Bath from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $bath = Bath::onlyTrashed()->findOrFail($id);
        $bath->forceDelete();

        return redirect()->route('admin.baths.index');
    }


}
