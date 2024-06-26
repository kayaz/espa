<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;

// CMS
use App\Http\Requests\PageFormRequest;
use App\Models\Page;
use App\Repositories\PageRepository;
use App\Services\PageService;

class IndexController extends Controller
{
    private $repository;
    private $service;

    public function __construct(PageRepository $repository, PageService $service)
    {
//        $this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index','store']]);
//        $this->middleware('permission:page-create', ['only' => ['create','store']]);
//        $this->middleware('permission:page-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:page-delete', ['only' => ['destroy']]);

        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        //Page::fixTree();
        $tree = Page::withDepth()->defaultOrder()->get()->toTree();
        return view('admin.page.index', ['list' => $tree]);
    }

    public function create()
    {
        return view('admin.page.form', [
            'selectMenu' => Page::pluck('title', 'id')->prepend('Brak podstrony', 0),
            'cardTitle' => 'Dodaj stronę',
            'backButton' => route('admin.page.index')
        ])->with('entry', Page::make());
    }

    public function store(PageFormRequest $request)
    {
        $entry = $this->repository->create($request->validated());

        if ($request->hasFile('file')) {
            $this->service->upload($request->title, $request->file('file'), $entry);
        }

        return redirect(route('admin.page.index'))->with('success', 'Strona dodana');
    }

    public function edit(Page $page)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        return view('admin.page.form', [
            'entry' => $page,
            'selectMenu' => Page::where('id', '!=', $page->id)->pluck('title', 'id')->prepend('Brak podstrony', 0),
            'cardTitle' => 'Edytuj strone',
            'backButton' => route('admin.page.index')
        ]);
    }

    public function update(PageFormRequest $request, int $id)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        $page = $this->repository->find($id);
        $this->repository->update($request->validated(), $page);

        if ($request->hasFile('file')) {
            $this->service->upload($request->title, $request->file('file'), $page, 1);
        }

        return redirect(route('admin.page.index'))->with('success', 'Strona zaktualizowana');
    }

    public function up(Page $page)
    {
        $node = Page::findOrFail($page->id);
        $node->up();
        return redirect(route('admin.page.index'))->with('success', 'Strona zaktualizowana');
    }

    public function down(Page $page)
    {
        $node = Page::findOrFail($page->id);
        $node->down();
        return redirect(route('admin.page.index'))->with('success', 'Strona zaktualizowana');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }

    public function show(int $id)
    {
        //
    }
}
