<?php

namespace App\Http\Controllers\Type;

use App\Constants\ResponseConstants\TypeResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Type\TypeRequest;
use App\Http\Requests\Type\UpdateTypeRequest;
use App\Http\Resources\Type\TypeResource;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->execute(function (){
            $type = Type::all();
            return TypeResource::collection($type);
        }, TypeResponseEnum::TYPE_INDEX);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {

        return $this->execute(function () use ($request){
            $validated = $request->validated();
            if (!isset($request['slug'])){
                $validated['slug'] = str()->slug($request['name']);
            }
            $type = Type::query()->create($validated);
            return TypeResource::make($type);
        }, TypeResponseEnum::TYPE_STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return $this->execute(function () use($type){
            return TypeResource::make($type->load('projects'));
        }, TypeResponseEnum::TYPE_SHOW);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        return $this->execute(function () use($request, $type){
            $validated = $request->validated();
            if (!isset($request['slug'])){
                $validated['slug'] = str()->slug($request['name']);
            }
            $type->update($validated);
            return TypeResource::make($type);
        }, TypeResponseEnum::TYPE_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        return $this->execute(function () use ($type){
            $type->delete();
        }, TypeResponseEnum::TYPE_DELETE);
    }
}
