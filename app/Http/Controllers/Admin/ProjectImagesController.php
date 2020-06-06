<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectImagesResource;
use App\Repositories\ProjectImagesRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectImagesController extends Controller
{
    /**
     * Projects repository.
     *
     * @var App\Repositories\ProjectImagesRepository
     */
    protected $projectImages;

    /**
     * Create new instance of project controller.
     *
     * @param ProjectRepository project Project repository
     */
    public function __construct(ProjectImagesRepository $projectImages)
    {
        $this->projectImages = $projectImages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! $data = ProjectImagesResource::collection($this->projectImages->paginateWithFilters(request(), request()->per_page, request()->order_by))) {
            return response()->json([
                'message'  => 'Failed to retrieve resource'
            ], 400);
        }

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'image'   => 'required|max:2000',
            'image_caption' => 'required|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 400);
        }
        // foreach ($request->image as $photo) {
        //     $data = [$photo];

        //     $validator = Validator::make($data, [
        //         'photo' => 'mimes:jpeg,png,jpg|max:3000'
        //     ]);

        //     if ($validator->fails()) {
        //         return response()->json([
        //             'message' => 'Validation failed',
        //             'errors'  => $validator->errors()
        //         ], 400);
        //     }
        // }

        if (! $this->projectImages->store($request)) {
            return response()->json([
                'message' => 'Failed to store resource'
            ], 500);
        }

        return response()->json([
            'message' => 'Resource successfully stored'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'project_id'              => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 400);
        }

        if (! $this->projectImages->update($request, $id)) {
            return response()->json([
                'message' => 'Failed to update resource'
            ], 500);
        }

        return response()->json([
            'message' => 'Resource successfully updated'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! $projectImages = $this->projectImages->findOrFail($id)) {
            return response()->json([
                'message' => 'Resource does not exist'
            ], 400);
        }

        return response()->json([
            'response' => true,
            'message'  => 'Resource successfully retrieve',
            'project'    => $projectImages
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectImages  $projectImages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $this->projectImages->findOrFail($id)->delete()) {
            return response()->json([
                'message' => 'Failed to delete resource'
            ], 400);
        }

        return response()->json([
            'message' => 'Resource successfully deleted'
        ], 200);
    }
}
