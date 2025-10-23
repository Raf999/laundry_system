@php use App\Enum\CompanyStatus;use Carbon\Carbon; use Illuminate\Support\Str;  @endphp
<div>
    <div class="bg-theme-primary rounded-lg shadow broder dark:border-gray-700">
        <!-- Header -->
        <div class="px-6 py-4 border-b dark:border-gray-700 border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Companies List</h2>
        </div>

        <!-- Filters -->
        <div class="px-6 py-4 border-b dark:border-gray-700 border-gray-100">
            <div class="flex flex-wrap gap-4 items-end">
                <!-- Date Range Filter -->
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium dark:text-white text-gray-700 mb-1">Date Range</label>
                    <div class="flex gap-2">
                        <input type="date" wire:model.live="startDate"
                               class="flex-1 px-3 py-2 border text-gray-700 dark:text-white dark:border-gray-600  bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Start date">
                        <input type="date" wire:model.live="endDate"
                               class="flex-1 px-3 py-2 border text-gray-700 dark:text-white dark:border-gray-600  bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="End date">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="w-48">
                    <label class="block text-sm font-medium dark:text-white text-gray-700 mb-1">Status</label>
                    <select wire:model.live="status"
                            class="w-full px-3 py-2 border text-gray-700 dark:text-white dark:border-gray-600  bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value=""></option>
                        @foreach(CompanyStatus::cases() as $status)
                            <option value="{{$status->value}}">{{$status->value}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Search -->
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium dark:text-white text-gray-700 mb-1">Search</label>
                    <input type="text" wire:model.live.debounce.300ms="search"
                           class="w-full px-3 py-2 border text-gray-700 dark:text-white dark:border-gray-600  bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Search...">
                </div>

                <!-- Reset Button -->
                @if($search || $status || $startDate || $endDate)
                    <button wire:click="resetFilters"
                            class="px-4 py-2 bg-red-600 font-bold text-gray-100 rounded-lg hover:bg-gray-300 transition">
                        Reset
                    </button>
                @endif

                <!-- Export Button -->
                {{--                <button--}}
                {{--                    class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition flex items-center gap-2">--}}
                {{--                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
                {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
                {{--                              d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>--}}
                {{--                    </svg>--}}
                {{--                    Export--}}
                {{--                </button>--}}
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-theme-primary">
                <tr class="text-gray-500 dark:text-white text-left text-xs font-medium uppercase tracking-wider border-b border-gray-100 dark:border-gray-700">
                    <th class="px-6 py-3">Company Name
                    </th>
                    <th class="px-6 py-3">Address
                    </th>
                    <th class="px-6 py-3">Phone No.
                    </th>
                    <th class="px-6 py-3">Email
                    </th>
                    <th class="px-6 py-3">Status
                    </th>
                    <th class="px-6 py-3">Date Created</th>
                    <th class="px-6 py-3">Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-theme-primary divide-y dark:divide-gray-700 divide-gray-100">
                @forelse($companies as $company)
                    <tr class="dark:hover:bg-gray-700 dark:text-white">
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $company->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $company->address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $company->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $company->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $company->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $company->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $company->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $company->status === 'banned' ? 'bg-gray-100 text-gray-800' : '' }}
                                    {{ $company->status === 'suspended' ? 'bg-orange-100 text-orange-800' : '' }}">
                                    {{ Str::pascal($company->status) }}
                                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">
                            {{ Carbon::parse($company->created_at)->format('M d Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex gap-2">
                                <button
                                    class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                                    View
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="px-6 py-4 text-center text-gray-500">
                            No Companies Yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t dark:border-gray-700 border-gray-100">
            {{ $companies->links() }}
        </div>
    </div>
</div>
