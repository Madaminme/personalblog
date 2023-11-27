<?php

namespace App\Http\Controllers\Project;

use App\Constants\ResponseConstants\ProjectResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\Project\ProjectIndexResource;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->execute(function (){
            $projects = Project::paginate(5);
            return ProjectIndexResource::collection($projects);
        }, ProjectResponseEnum::PROJECT_LIST);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        return $this->execute(function () use ($request){
           $project = $this->projectService->store($request->validated());
            return ProjectResource::make($project);
        }, ProjectResponseEnum::PROJECT_CREATE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return $this->execute(function () use ($project){
            return ProjectResource::make($project->load('types', 'tags'));
        }, ProjectResponseEnum::PROJECT_SHOW);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        return $this->execute(function () use ($request, $project){
            $project = $this->projectService->update($request->validated(), $project);
            return ProjectResource::make($project);
        }, ProjectResponseEnum::PROJECT_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        return $this->execute(function () use ($project){
            $project->types()->detach();
            $project->clearMediaCollection('project-images');
            $project->delete();
        }, ProjectResponseEnum::PROJECT_DELETE);
    }
}
