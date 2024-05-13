<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//CMS
use App\Http\Requests\ClientFormRequest;
use App\Repositories\ClientRepository;
use App\Services\ClientService;
use App\Models\Client;

class IndexController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ClientRepository $repository, ClientService $service)
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
        return view('admin.client.index', ['list' => $this->repository->allSort('ASC')]);
    }

    public function create()
    {
        return view('admin.client.form', [
            'cardTitle' => 'Dodaj klienta',
            'backButton' => route('admin.client.index')
        ])->with('entry', Client::make());
    }

    public function store(ClientFormRequest $request)
    {
        $entry = $this->repository->create($request->validated());

        if ($request->hasFile('file')) {
            $this->service->upload($request->name, $request->file('file'), $entry);
        }

        return redirect(route('admin.client.index'))->with('success', 'Nowy klient dodany');
    }

    public function edit(int $id)
    {
        return view('admin.client.form', [
            'entry' => $this->repository->find($id),
            'cardTitle' => 'Edytuj klienta',
            'backButton' => route('admin.client.index')
        ]);
    }

    public function update(ClientFormRequest $request, int $id)
    {
        $entry = $this->repository->find($id);
        $this->repository->update($request->validated(), $entry);

        if ($request->hasFile('file')) {
            $this->service->upload($request->name, $request->file('file'), $entry, 1);
        }

        return redirect(route('admin.client.index'))->with('success', 'Klient zaktualizowany');
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
