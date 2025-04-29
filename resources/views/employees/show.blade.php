<x-layouts.app.sidebar>
    <div class="py-6 px-6 lg:ml-64">
        <div class="max-w-7xl mx-auto">
            <div class="bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-white">Employee Details</h1>
                    <div>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 mr-2">
                            Edit
                        </a>
                        <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                            Back to List
                        </a>
                    </div>
                </div>

                <div class="bg-zinc-800 p-6 rounded-lg">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 md:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-400">First Name</dt>
                            <dd class="mt-1 text-lg text-white">{{ $employee->first_name }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Last Name</dt>
                            <dd class="mt-1 text-lg text-white">{{ $employee->last_name }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Full Name</dt>
                            <dd class="mt-1 text-lg text-white">{{ $employee->first_name }} {{ $employee->last_name }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Gender</dt>
                            <dd class="mt-1 text-lg text-white">{{ $employee->gender }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Birthday</dt>
                            <dd class="mt-1 text-lg text-white">
                                {{ $employee->birthday instanceof \Carbon\Carbon ? $employee->birthday->format('F d, Y') : $employee->birthday }}
                            </dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Age</dt>
                            <dd class="mt-1 text-lg text-white">
                                {{ $employee->birthday instanceof \Carbon\Carbon ? $employee->birthday->age : 'N/A' }} years
                            </dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Monthly Salary</dt>
                            <dd class="mt-1 text-lg text-white">₱{{ number_format($employee->monthly_salary, 2) }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 pt-6 border-t border-zinc-700">
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                Delete Employee
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app.sidebar>