<?php

namespace App\Http\Controllers\Admin;

use App\Job_title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJob_titlesRequest;
use App\Http\Requests\Admin\UpdateJob_titlesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class Job_titlesController extends Controller
{
    use FileUploadTrait;

    
    
    /**
     * Display a listing of Job_title.
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
            $job_titles = Job_title::onlyTrashed()->get();
        } else {
            $job_titles = Job_title::all();
        }

        return view('admin.job_titles.index', compact('job_titles'));
    }
    
   /**
     * Show the form for creating new Job_title.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        return view('admin.job_titles.create');
    }

        /**
     * Store a newly created Job_title in storage.
     *
     * @param  \App\Http\Requests\StoreJob_titlesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJob_titlesRequest $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $job_titles = Job_title::create($request->all());

        return redirect()->route('admin.job_titles.index');
    }
    
    /**
     * Show the form for editing Job_title.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $job_title = Job_title::findOrFail($id);

        return view('admin.job_titles.edit', compact('job_title'));
    }

    /**
     * Update Job_title in storage.
     *
     * @param  \App\Http\Requests\UpdateJob_titlesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJob_titlesRequest $request, $id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $job_title = Job_title::findOrFail($id);
        $job_title->update($request->all());

        return redirect()->route('admin.job_titles.index');
    }


    /**
     * Display Job_title.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $job_title  = Job_title::findOrFail($id);

        return view('admin.job_titles.show', compact('job_title'));
    }


    /**
     * Remove Job_title from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $job_title = Job_title::findOrFail($id);
        $job_title->delete();

        return redirect()->route('admin.job_titles.index');
    }

    /**
     * Delete all selected Job_title at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Job_title::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    
    /**
     * Delete all selected Job_title at once.
     *
     * @param Request $request
     */
    public function massQR(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Job_title::whereIn('id', $request->input('ids'))->get();

        }
    }







    /**
     * Restore Job_title from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $job_title = Job_title::onlyTrashed()->findOrFail($id);
        $job_title->restore();

        return redirect()->route('admin.job_titles.index');
    }

    /**
     * Permanently delete Job_title from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $job_title = Job_title::onlyTrashed()->findOrFail($id);
        $job_title->forceDelete();

        return redirect()->route('admin.job_titles.index');
    }


}
