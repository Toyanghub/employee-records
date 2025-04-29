<x-layouts.app.sidebar>
    <div class="py-6 px-6 lg:ml-64">
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

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-300">
                        <thead class="text-xs text-white uppercase bg-zinc-700">
                            <tr>
                                <th scope="col" class="py-3 px-6">ID</th>
                                <th scope="col" class="py-3 px-6">Name</th>
                                <th scope="col" class="py-3 px-6">Gender</th>
                                <th scope="col" class="py-3 px-6">Birthday</th>
                                <th scope="col" class="py-3 px-6">Monthly Salary</th>
                                <th scope="col" class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $employee)
                                <tr class="border-b border-zinc-700 hover:bg-zinc-700">
                                    <td class="py-4 px-6">{{ $employee->id }}</td>
                                    <td class="py-4 px-6 font-medium text-white whitespace-nowrap">
                                        {{ $employee->first_name }} {{ $employee->last_name }}
                                    </td>
                                    <td class="py-4 px-6">{{ $employee->gender }}</td>
                                    <td class="py-4 px-6">
                                        {{ $employee->birthday instanceof \Carbon\Carbon ? $employee->birthday->format('M d, Y') : $employee->birthday }}
                                    </td>
                                    <td class="py-4 px-6">₱{{ number_format($employee->monthly_salary, 2) }}</td>
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