<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Http\Resources\SectionResource;
use App\Section;
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
        return SectionResource::collection(Section::with('users')->latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionRequest $request)
    {
        
        $data = $request->validated();

    
        $data['logo'] = $this->saveImage($data['logo']);

        
        try {
            $section = new Section();
            $section->fill($data);
            $section->save();

            if (isset($data['users'])) {
        
                // $users = $data['users'];
                // unset($data['users']);
                $section->users()->attach(explode(',', $data['users']));
            }
            
            
        } catch (Exception $e) {
            return response()->json(['error' => 'Error occurred!'], 422);
        }

        return response()->json([
            'message' => 'Successfully created!', 
            'data' => $section
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        $users = $section->users->pluck('id')->toArray();
        return [
            'section' => new SectionResource($section), 
            'users' => $users
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSectionRequest  $request
     * @param  \App\Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $data = $request->validated();
        
        
        if (isset($data['logo'])) {
            $data['logo'] = $this->saveImage($data['logo']);
        } else {
            unset($data['logo']);
        }

        
        try {
            $section->update($data);
            if (isset($data['users'])) {
                $users = explode(',', $data['users']);
                $section->users()->sync($users);
            } else {
                $section->users()->sync([]);
            }
            
        } catch (Exception $e) {            
            return response()->json(['message' => 'Error occurred!' . $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return response()->json(['message' => 'Deleted successfully!']);
    }

    private function saveImage($img) {
        $filename = uniqid('section-logo') . '-' . date('YmdHis') . '.' . $img->getClientOriginalExtension();
        $img->storeAs('public/logo', $filename);
        return $filename;
    }
}
