<?php

namespace App\Http\Controllers\Admin\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//CMS
use App\Http\Requests\TestimonialFormRequest;
use App\Repositories\TestimonialRepository;
use App\Services\TestimonialService;
use App\Models\Testimonial;

class IndexController extends Controller
{
    private $repository;
    private $service;

    public function __construct(TestimonialRepository $repository, TestimonialService $service)
    {
//        $this->middleware('permission:box-list|box-create|box-edit|box-delete', [
//            'only' => ['index','store']
//        ]);
//        $this->middleware('permission:box-create', [
//            'only' => ['create','store']
//        ]);
//        $this->middleware('permission:box-edit', [
//            'only' => ['edit','update']
//        ]);
//        $this->middleware('permission:box-delete', [
//            'only' => ['destroy']
//        ]);

        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.testimonial.index', ['list' => $this->repository->allSort('ASC')]);
    }

    public function create()
    {
        return view('admin.testimonial.form', [
            'cardTitle' => 'Dodaj wpis',
            'backButton' => route('admin.testimonial.index')
        ])->with('entry', Testimonial::make());
    }

    public function store(TestimonialFormRequest $request)
    {
        $entry = $this->repository->create($request->validated());

        if ($request->hasFile('file')) {
            $this->service->upload($request->name, $request->file('file'), $entry);
        }

        return redirect(route('admin.testimonial.index'))->with('success', 'Nowy wpis dodany');
    }

    public function edit(int $id)
    {
        return view('admin.testimonial.form', [
            'entry' => $this->repository->find($id),
            'cardTitle' => 'Edytuj wpis',
            'backButton' => route('admin.testimonial.index')
        ]);
    }

    public function update(TestimonialFormRequest $request, int $id)
    {
        $entry = $this->repository->find($id);
        $this->repository->update($request->validated(), $entry);

        if ($request->hasFile('file')) {
            $this->service->upload($request->name, $request->file('file'), $entry, 1);
        }

        return redirect(route('admin.testimonial.index'))->with('success', 'Wpis zaktualizowany');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }

    public function sort(Request $request)
    {
        $this->repository->updateOrder($request->get('recordsArray'));
    }
}
