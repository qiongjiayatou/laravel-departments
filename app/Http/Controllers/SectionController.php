<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Section;
use App\User;
use Exception;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::with(['users'])->latest()->paginate(10);

        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('sections.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionRequest $request)
    {

        
        $data = $request->validated();

        // $logo = $data['logo'];
        // $filename = uniqid('section-logo') . '-' . date('YmdHis') . '.' . $logo->getClientOriginalExtension();
        // $logo->storeAs('public/images', $filename);
        $data['logo'] = $this->saveImage($data['logo']);

        $users = $data['users'];
        unset($data['users']);


        try {
            $section = new Section();
            $section->fill($data);
            $section->save();
            $section->users()->attach($users);
        } catch (Exception $e) {
            return back()->with('message-error', 'Error occurred!');
        }

        return back()->with('message-success', 'Saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $section->load('users');
        $users = User::all();
        return view('sections.edit', compact('section', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $data = $request->validated();
        
        // dd($data);

        $users = $data['users'];
        if ($data['logo']) $data['logo'] = $this->saveImage($data['logo']);

        try {
            $section->update($data);
            $section->users()->sync($users);
        } catch (Exception $e) {            
            return back()->with('message-error', 'Error occurred!');
        }
        

        return back()->with('message-success', 'Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return back()->with('message-success', 'Deleted successfully!');
    }

    private function saveImage($img) {
        $filename = uniqid('section-logo') . '-' . date('YmdHis') . '.' . $img->getClientOriginalExtension();
        $img->storeAs('public/logo', $filename);
        return $filename;
    }
}
