<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Welcome to CRM System</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-blue-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-blue-800">Total Customers</h4>
                            <p class="text-3xl font-bold text-blue-900">{{ \App\Models\Customer::count() }}</p>
                        </div>
                        
                        <div class="bg-green-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-green-800">Total Proposals</h4>
                            <p class="text-3xl font-bold text-green-900">{{ \App\Models\Proposal::count() }}</p>
                        </div>
                        
                        <div class="bg-yellow-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-yellow-800">Total Invoices</h4>
                            <p class="text-3xl font-bold text-yellow-900">{{ \App\Models\Invoice::count() }}</p>
                        </div>
                        
                        <div class="bg-purple-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-purple-800">Total Transactions</h4>
                            <p class="text-3xl font-bold text-purple-900">{{ \App\Models\Transaction::count() }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold mb-4">Recent Invoices</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Invoice #</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse(\App\Models\Invoice::with('customer')->latest()->take(5)->get() as $invoice)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $invoice->invoice_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $invoice->customer->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($invoice->total, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($invoice->status == 'paid') bg-green-100 text-green-800
                                                @elseif($invoice->status == 'sent') bg-blue-100 text-blue-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($invoice->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No invoices found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>