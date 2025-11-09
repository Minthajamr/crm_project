<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Proposals') }}</h2>
            <a href="{{ route('proposals.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Proposal</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Valid Until</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($proposals as $proposal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->customer->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${{ number_format($proposal->amount, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->valid_until ? $proposal->valid_until->format('M d, Y') : 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('proposals.status', $proposal) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="rounded border-gray-300
                                            @if($proposal->status == 'accepted') bg-green-100 text-green-800
                                            @elseif($proposal->status == 'rejected') bg-red-100 text-red-800
                                            @elseif($proposal->status == 'sent') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            <option value="draft" {{ $proposal->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="sent" {{ $proposal->status == 'sent' ? 'selected' : '' }}>Sent</option>
                                            <option value="accepted" {{ $proposal->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                            <option value="rejected" {{ $proposal->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ route('proposals.show', $proposal) }}" class="text-blue-600 hover:text-blue-900 mr-2">View</a>
                                    <a href="{{ route('proposals.edit', $proposal) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('proposals.destroy', $proposal) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">No proposals found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $proposals->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>