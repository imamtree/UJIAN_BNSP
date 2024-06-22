<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {

        return Employee::all();
    }

    public function getEmployeeCount()
    {
        $employeeCount = Employee::count();
        return response()->json(['employeeCount' => $employeeCount]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'position' => 'required',


        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->position = $request->position;
        $employee->save();

        return response()->json(["message" => "employee updated."], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Employee::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'position' => 'required',

        ]);

        if (Employee::where('id', $id)->exists()) {
            $employee = Employee::find($id);
            $employee->name = $request->input('name', $employee->name);
            $employee->email = $request->input('email', $employee->email);
            $employee->phone = $request->input('phone', $employee->phone);
            $employee->address = $request->input('address', $employee->address);
            $employee->position = $request->input('position', $employee->position);
            $employee->save();

            return response()->json(["message" => "employee updated."], 201);
        } else {
            return response()->json(["message" => "employee not found."], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Employee::where('id', $id)->exists()) {
            $employee = Employee::find($id);
            $employee->delete();
            return response()->json(["message" => "employee deleted."], 201);
        } else {
            return response()->json(["message" => "employee not found."], 404);
        }
    }
}
