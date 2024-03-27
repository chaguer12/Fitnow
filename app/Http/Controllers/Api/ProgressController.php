<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgressRequest;
use App\Http\Requests\ProgressUpdateRequest;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $progresses = Progress::where('user_id',Auth::user()->id)->get();
            return response()->json([
                'status' => true,
                'message' => 'progresses are accessible',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgressRequest $request)
    {
        try{
            $validated = $request->validated();
            $validated['user_id'] = auth()->user()->id;
            $progress = Progress::create($validated);
            return response()->json([
                'status' => true,
                'message' => 'Progress made successfully',
            ],200);
            

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Progress $progress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Progress $progress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProgressUpdateRequest $request,$id)
    {
        try {
            $validated = $request->validated();
            $progress = Progress::where('id',$id)->first();
            if($progress->status !== 'Non términé'){
                return response()->json([
                    'status' => false,
                    'message' => "you can't update an unfinished progress",
                ]);
            }
            $progress->update($validated);
            return response()->json([
                'status' => true,
                'message' => 'progress updated successfully',
            ],200);
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $progress = Progress::where('id',$id)->first();
            $progress->delete();
            return response()->json([
                'status' => true,
                'message' => 'Progress deleted successfully',

            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function status($id){
        try {
            $progress = Progress::where('id',$id)->first();
            $progress->delete();
            if($progress->status == 'Non términé'){
                $progress->update([
                    'status' => 'términé',
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'your session is complete !',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }


    }
}
