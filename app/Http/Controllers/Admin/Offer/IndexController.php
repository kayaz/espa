<?php

namespace App\Http\Controllers\Admin\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferFormRequest;
use App\Models\Offer;
use App\Repositories\OfferRepository;
use App\Services\OfferService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $repository;
    private $service;

    public function __construct(OfferRepository $repository, OfferService $service)
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
        return view('admin.offer.index', ['list' => $this->repository->allSort('ASC')]);
    }

    public function create()
    {
        return view('admin.offer.form', [
            'cardTitle' => 'Dodaj ofertę',
            'backButton' => route('admin.box.index')
        ])->with('entry', Offer::make());
    }

    public function store(OfferFormRequest $request)
    {
        $entry = $this->repository->create($request->validated());
        if ($request->hasFile('file')) {
            $this->service->upload($request->title, $request->file('file'), $entry);
        }
        return redirect(route('admin.offer.index'))->with('success', 'Nowa oferta dodana');
    }

    public function edit(int $id)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        return view('admin.offer.form', [
            'entry' => $this->repository->find($id),
            'cardTitle' => 'Edytuj ofertę',
            'backButton' => route('admin.offer.index')
        ]);
    }

    public function update(OfferFormRequest $request, int $id)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        $entry = $this->repository->find($id);
        $this->repository->update($request->validated(), $entry);

        if ($request->hasFile('file')) {
            $this->service->upload($request->title, $request->file('file'), $entry, 1);
        }

        return redirect(route('admin.offer.index'))->with('success', 'Oferta zaktualizowana');
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
