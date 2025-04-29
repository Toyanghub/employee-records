<x-layouts.app.sidebar>
    <div class="py-6 px-6 lg:pl-64"> <!-- Changed lg:ml-64 to lg:pl-64 to respect the sidebar -->
        <div class="max-w-7xl mx-auto">
            <div class="bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-white">Employees</h1>
                    <a href="{{ route('employees.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-150 ease-in-out">
                        Add New Employee
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Employee Summary Section -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-white mb-4">Employee Summary</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Gender Distribution Card -->
                        <div class="bg-zinc-800 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-white mb-3">Gender Distribution</h3>
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-gray-300">Male Employees:</p>
                                    <p class="text-gray-300">Female Employees:</p>
                                    <p class="text-gray-300">Total Employees:</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-medium">{{ $maleCount }}</p>
                                    <p class="text-white font-medium">{{ $femaleCount }}</p>
                                    <p class="text-white font-medium">{{ $maleCount + $femaleCount }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Average Age Card -->
                        <div class="bg-zinc-800 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-white mb-3">Average Age</h3>
                            <p class="text-3xl font-bold text-white">{{ number_format($averageAge, 1) }} years</p>
                        </div>
                        
                        <!-- Total Salary Card -->
                        <div class="bg-zinc-800 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-white mb-3">Total Monthly Salary</h3>
                            <p class="text-3xl font-bold text-white">₱{{ number_format($totalSalary, 2) }}</p>
                        </div>
                    </div>
                </div>
                <!-- End of Employee Summary Section -->

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-300">
                        <thead class="text-xs text-white uppercase bg-zinc-700">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-center">ID</th>
                                <th scope="col" class="py-3 px-6 text-center">Name</th>
                                <th scope="col" class="py-3 px-6 text-center">Gender</th>
                                <th scope="col" class="py-3 px-6 text-center">Birthday</th>
                                <th scope="col" class="py-3 px-6 text-center">Monthly Salary</th>
                                <th scope="col" class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $employee)
                                <tr class="border-b border-zinc-700 hover:bg-zinc-700">
                                    <td class="py-4 px-6 text-center">{{ $employee->id }}</td>
                                    <td class="py-4 px-6 text-center font-medium text-white whitespace-nowrap">
                                        {{ $employee->first_name }} {{ $employee->last_name }}
                                    </td>
                                    <td class="py-4 px-6 text-center">{{ $employee->gender }}</td>
                                    <td class="py-4 px-6 text-center">
                                        {{ $employee->birthday instanceof \Carbon\Carbon ? $employee->birthday->format('M d, Y') : $employee->birthday }}
                                    </td>
                                    <td class="py-4 px-6 text-center">₱{{ number_format($employee->monthly_salary, 2) }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('employees.show', $employee->id) }}" class="font-medium text-blue-400 hover:underline">
                                                View
                                            </a>
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="font-medium text-yellow-400 hover:underline">
                                                Edit
                                            </a>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-400 hover:underline" 
                                                        onclick="return confirm('Are you sure you want to delete this employee?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 px-6 text-center text-gray-400">
                                        No employees found. <a href="{{ route('employees.create') }}" class="text-blue-400 hover:underline">Add your first employee</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app.sidebar>