<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\IntroRepository;
use App\Http\Resources\IntroResource;

class IntroController extends Controller
{
    /**
     * Intro repository.
     *
     * @var App\Repositories\IntroRepository
     */
    protected $intro;

    /**
     * Create new instance of intro controller.
     *
     * @param IntroRepository intro Intro repository
     */
    public function __construct(IntroRepository $intro)
    {
        $this->intro = $intro;
    }

    /**
     * Display the first resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! $intro = $this->intro->getIntro()) {
            return response()->json([
                'message' => 'Resource does not exist'
            ], 400);
        }

        return response()->json([
            'response' => true,
            'message'  => 'Resource successfully retrieve',
            'intro'  => $intro
        ], 200);
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
            'image'          => 'max:2000',
            'name'           => 'required|min:2',
            'body'           => 'required|min:2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 400);
        }

        if (! $this->intro->store($request)) {
            return response()->json([
                'message' => 'Failed to store resource'
            ], 500);
        }

        return response()->json([
            'message' => 'Resource successfully stored'
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
        if (! $intro = $this->intro->findOrFail($id)) {
            return response()->json([
                'message' => 'Resource does not exist'
            ], 400);
        }

        return response()->json([
            'response' => true,
            'message'  => 'Resource successfully retrieve',
            'intro'  => $intro
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
        $validator = Validator::make($request->all(), [
            'image'          => 'max:2000',
            'name'           => 'required|min:2',
            'body'           => 'required|min:2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 400);
        }

        if (! $this->intro->update($request, $id)) {
            return response()->json([
                'message' => 'Failed to update resource'
            ], 500);
        }

        return response()->json([
            'message' => 'Resource successfully updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $this->intro->findOrFail($id)->delete()) {
            return response()->json([
                'message' => 'Failed to delete resource'
            ], 400);
        }

        return response()->json([
            'message' => 'Resource successfully deleted'
        ], 200);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! $this->intro->restore($id)) {
            return response()->json([
                'message' => 'Failed to restore resource'
            ], 400);
        }

        return response()->json([
            'message' => 'Resource successfully restored'
        ], 200);
    }

    /**
     * Forcefully remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy($id)
    {
        if (! $this->intro->forceDestroy($id)) {
            return response()->json([
                'message' => 'Failed to permanently delete resource'
            ], 400);
        }

        return response()->json([
            'message' => 'Resource successfully deleted permanently'
        ], 200);
    }
}
