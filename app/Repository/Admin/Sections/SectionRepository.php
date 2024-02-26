<?php

namespace App\Repository\Admin\Sections;


use App\Interfaces\Admin\Sections\SectionRepositoryInterface;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface
{

    public function index()
    {
        $sections = Section::all();
        return view('Dashboard.Sections.index', compact('sections'));
    }
    public function store($request)
    {
        Section::create([
            'name' => $request->name,
            'description' => $request->description,
            ]);
            session()->flash('add');
            return to_route('Sections.index');
        }
        public function show($id)
        {
            $section = Section::findOrFail($id);
            $doctors = $section->doctors;
            return view('Dashboard.Sections.show_doctors', compact('section','doctors'));
    }
    public function update($request, $id)
    {
        Section::findOrFail($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            ]);
            session()->flash('edit');
            return to_route('Sections.index');
        }
        public function destroy($id)
        {
            Section::findOrFail($id)->delete();
            session()->flash('delete');
            return to_route('Sections.index');
    }
}
