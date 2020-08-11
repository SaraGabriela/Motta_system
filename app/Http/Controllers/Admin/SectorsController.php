<?php

namespace App\Http\Controllers\Admin;

use App\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSectorsRequest;
use App\Http\Requests\Admin\UpdateSectorsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class SectorsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Sector.
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
            $sectors = Sector::onlyTrashed()->get();
        } else {
            $sectors = Sector::all();
        }

        return view('admin.sectors.index', compact('sectors'));
    }

    /**
     * Show the form for creating new Sector.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        return view('admin.sectors.create');
    }

    /**
     * Store a newly created Sector in storage.
     *
     * @param  \App\Http\Requests\StoreSectorsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectorsRequest $request)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $sector = Sector::create($request->all() + ['user_id' => auth()->user()->id]);

        return redirect()->route('admin.sectors.index');
    }


    /**
     * Show the form for editing Sector.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $sector = Sector::findOrFail($id);

        return view('admin.sectors.edit', compact('sector'));
    }

    /**
     * Update Sector in storage.
     *
     * @param  \App\Http\Requests\UpdateSectorsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectorsRequest $request, $id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $sector = Sector::findOrFail($id);
        $sector->update($request->all());

        return redirect()->route('admin.sectors.index');
    }


    /**
     * Display Sector.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $sector  = Sector::findOrFail($id);

        return view('admin.sectors.show', compact('sector'));
    }


    /**
     * Remove Sector from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $sector = Sector::findOrFail($id);
        $sector->delete();

        return redirect()->route('admin.sectors.index');
    }

    /**
     * Delete all selected Sector at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Sector::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Sector from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $sector = Sector::onlyTrashed()->findOrFail($id);
        $sector->restore();

        return redirect()->route('admin.sectors.index');
    }

    /**
     * Permanently delete Sector from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $sector = Sector::onlyTrashed()->findOrFail($id);
        $sector->forceDelete();

        return redirect()->route('admin.sectors.index');
    }
}
