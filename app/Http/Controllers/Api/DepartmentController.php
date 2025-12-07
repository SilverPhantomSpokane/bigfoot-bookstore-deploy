<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Validators\DepartmentValidator;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
         $departments = Department::with('products')->paginate(10);

        return response()->json(
            data: $departments,
            status: Response::HTTP_OK
        );
    }


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request): JsonResponse
{
    try {
        //check policy

        $this->authorize('create', Department::class);

        // 1. Validate input
        $validated = DepartmentValidator::validate($request->all());

        // 2. Create model manually 
        $department = new Department();
        $department->name = $validated['name'];
        $department->user_id = $request->user()->id;  
        $department->save();

        // 3. Response
        return response()->json(
            data: $department,
            status: Response::HTTP_CREATED
        );

    } catch (\Illuminate\Validation\ValidationException $e) {

        return response()->json(
            data: ['errors' => $e->errors()],
            status: Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}

    /**
     * Display the specified resource.
     */
  public function show(Department $department): JsonResponse
{
    // 1) Policy check
    $this->authorize('view', $department);

    // 2) Return department with products
    return response()->json(
        data: $department->load('products'),
        status: Response::HTTP_OK
    );
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Department $department): JsonResponse
{
    // 1) Policy check
    $this->authorize('update', $department);

    try {
        // 2) Validate
        $validated = DepartmentValidator::validate($request->all());

        // 3) Update
        $department->update($validated);

        return response()->json(
            data: $department,
            status: Response::HTTP_OK
        );

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(
            data: ['errors' => $e->errors()],
            status: Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
    /**
     * Remove the specified resource from storage.
     */
  public function destroy(Department $department): JsonResponse
{
    // 1) Policy check
    $this->authorize('delete', $department);

    // 2) Delete
    $department->delete();

    return response()->json(
        data: ['message' => 'Department deleted'],
        status: Response::HTTP_OK
    );
}
}
