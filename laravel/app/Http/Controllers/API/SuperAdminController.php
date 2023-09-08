<?php

namespace App\Http\Controllers\API;

use App\Models\SuperAdmin;
use App\Http\Controllers\Controller;
use App\Http\Resources\SuperAdminResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $superadmin = SuperAdmin::all();
        return response([
            'super_admin' => SuperAdminResource::collection($superadmin),
            'message' => 'Retrieved successfully'
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
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:100',
            'year' => 'required|max:50',
            'company_headquarters' => 'required|max:255',
            'what_company_does' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'Validation Error'
            ]);
        }

        $superAdmin = SuperAdmin::create($data);
        return response([
            'super_admin' => new SuperAdminResource($superAdmin),
            'message' => 'Created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuperAdmin  $superAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(SuperAdmin $superadmin)
    {
        return response([
            'super_admin' => new SuperAdminResource($superadmin),
            'message' => 'Retrieved successfully'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuperAdmin  $superAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuperAdmin $superadmin)
    {
        $superadmin->update($request->all());
        return response([
            'super_admin' => new SuperAdminResource($superadmin),
            'message' => 'Updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuperAdmin  $superAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuperAdmin $superadmin)
    {
        $superadmin->delete();
        return response([
            'message' => 'Deleted'
        ], 204);
    }
}
