<?php

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pages = Page::paginate(30);
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        $pages = Page::All();
        $images = Image::All();
        return view('pages.create', compact('pages', 'images'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string', 'image_id' => 'nullable']);
        $page = new Page(['title' => $request->get('title'), 'image_id' => $request->get('image_id')]);
        $page->save();
        return redirect('/pages')->with('success', 'Page er opprettet');
    }

    public function show(Page $page)
    {
        $page->menu;
        $components = $page->components;
        foreach ($components as $component) {
            $component->fields;
        }

        return view('pages.show', compact('page'));
    }

    public function edit($id)
    {
        $page = Page::find($id);
        $images = Image::All();
        return view('pages.edit', compact('page', 'images'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['title' => 'required|string', 'image_id' => 'nullable']);
        $page = Page::find($id);
        $page->title = $request->get('title');
        $page->image_id = $request->get('image_id');
        $page->save();
        return redirect('/pages')->with('success', 'Page er oppdatert');
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect('/pages')->with('success', 'Page er slettet');
    }
}
