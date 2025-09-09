@extends('dashboard')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">

            {{-- Notification --}}
            @if(session('success') || session('error'))
                <div class="mb-4">
                    <div class="flex items-center p-4 rounded-lg shadow-sm
                        {{ session('success') ? 'bg-green-50 text-green-800 border border-green-200' : 'bg-red-50 text-red-800 border border-red-200' }}">

                        <svg class="w-5 h-5 mr-2 flex-shrink-0
                            {{ session('success') ? 'text-green-500' : 'text-red-500' }}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="{{ session('success')
                                    ? 'M5 13l4 4L19 7'
                                    : 'M6 18L18 6M6 6l12 12' }}" />
                        </svg>

                        <div class="flex-1">
                            {{ session('success') ?? session('error') }}
                        </div>

                        <button onclick="this.parentElement.parentElement.remove()"
                                class="ml-4 text-gray-400 hover:text-gray-600">
                            ✕
                        </button>
                    </div>
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Products</h1>
                <a href="{{ route('products.create') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Add New
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categories</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr onclick="window.location='{{ route('products.show', $product->id) }}'"
                            class="hover:bg-gray-50 cursor-pointer">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->slug }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ $product->price }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->categories->pluck('name')->join(', ') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2"
                                onclick="event.stopPropagation()">
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <button type="button"
                                        onclick="openDeleteModal({{ $product->id }})"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Delete
                                </button>

                                <!-- Delete Form -->
                                <form id="delete-form-{{ $product->id }}"
                                      action="{{ route('products.destroy', $product->id) }}"
                                      method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $products->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal"
         class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Delete</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this product? This action cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </button>
                <button id="confirmDeleteBtn"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        let productIdToDelete = null;

        function openDeleteModal(id) {
            productIdToDelete = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            productIdToDelete = null;
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (productIdToDelete) {
                document.getElementById('delete-form-' + productIdToDelete).submit();
            }
        });
    </script>
@endsection
