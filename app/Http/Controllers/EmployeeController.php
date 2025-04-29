<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();

        // Get counts by gender
        $maleCount = Employee::where('gender', 'Male')->count();
        $femaleCount = Employee::where('gender', 'Female')->count();
        
        // Calculate average age
        $averageAge = Employee::selectRaw('AVG(TIMESTAMPDIFF(YEAR, birthday, CURDATE())) as avg_age')->value('avg_age') ?? 0;
        
        // Get total monthly salary
        $totalSalary = Employee::sum('monthly_salary');

        return view('employees.index', compact('employees', 'maleCount', 'femaleCount', 'averageAge', 'totalSalary'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'birthday' => 'required|date',
            'monthly_salary' => 'required|numeric|min:0',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'birthday' => 'required|date',
            'monthly_salary' => 'required|numeric|min:0',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }

    /**
     * Display a summary of employees.
     */
    public function summary()
    {
        // Get counts by gender
        $maleCount = Employee::where('gender', 'Male')->count();
        $femaleCount = Employee::where('gender', 'Female')->count();
        
        // Calculate average age
        $averageAge = Employee::selectRaw('AVG(TIMESTAMPDIFF(YEAR, birthday, CURDATE())) as avg_age')->value('avg_age') ?? 0;
        
        // Get total monthly salary
        $totalSalary = Employee::sum('monthly_salary');
    
        return view('employees.summary', compact('maleCount', 'femaleCount', 'averageAge', 'totalSalary'));
    }
}