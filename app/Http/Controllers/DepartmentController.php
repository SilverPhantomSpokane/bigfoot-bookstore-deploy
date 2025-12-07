<?php

namespace App\Http\Controllers;
use App\Http\Requests\DepartmentRequest;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function show(Department $department)
    {
        $products = $department->products()->paginate(10);
        return view('departments.show', compact('department', 'products'));
    }

    public function create()
    {
        $this->authorize('create', Department::class);

        $department = new Department();
        return view('departments.create', compact('department'));
    }

  public function store(DepartmentRequest $request)
{
    $this->authorize('create', Department::class);

    $data = $request->validated();
    $data['user_id'] = $request->user()->id; // added user_id

    Department::create($data);

    return redirect()
        ->route('departments.index')
        ->with('success', 'Department created successfully.');
}

    public function edit(Department $department)
    {
        $this->authorize('update', $department);

        return view('departments.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $this->authorize('update', $department);

        $department->update($request->validated());
        return redirect()
            ->route('departments.show', $department)
            ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);

        $department->delete();
        return redirect()
            ->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
