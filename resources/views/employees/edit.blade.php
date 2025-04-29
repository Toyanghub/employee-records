<x-layouts.app.sidebar>
    <div class="py-6 px-6 lg:ml-64">
        <div class="max-w-7xl mx-auto">
            <div class="bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-white">Edit Employee</h1>
                    <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                        Back to List
                    </a>
                </div>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-300 mb-1">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $employee->first_name) }}" required
                                   class="mt-1 bg-zinc-800 border border-zinc-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm rounded-md p-2.5">
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-300 mb-1">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $employee->last_name) }}" required
                                   class="mt-1 bg-zinc-800 border border-zinc-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm rounded-md p-2.5">
                        </div>
                        
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-300 mb-1">Gender</label>
                            <select name="gender" id="gender" required
                                    class="mt-1 bg-zinc-800 border border-zinc-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm rounded-md p-2.5">
                                <option value="Male" {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="birthday" class="block text-sm font-medium text-gray-300 mb-1">Birthday</label>
                            <input type="date" name="birthday" id="birthday" 
                                   value="{{ old('birthday', $employee->birthday instanceof \Carbon\Carbon ? $employee->birthday->format('Y-m-d') : $employee->birthday) }}" 
                                   required
                                   class="mt-1 bg-zinc-800 border border-zinc-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm rounded-md p-2.5">
                        </div>
                        
                        <div>
                            <label for="monthly_salary" class="block text-sm font-medium text-gray-300 mb-1">Monthly Salary</label>
                            <input type="number" name="monthly_salary" id="monthly_salary" value="{{ old('monthly_salary', $employee->monthly_salary) }}" step="0.01" required
                                   class="mt-1 bg-zinc-800 border border-zinc-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm rounded-md p-2.5">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Update Employee
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app.sidebar>