@extends('dashboard')

@section('title', 'Product Details')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Product Details</h1>

        <dl class="space-y-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">ID</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $product->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Name</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $product->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Description</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $product->description }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Slug</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $product->slug }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Price</dt>
                <dd class="mt-1 text-lg text-gray-900">${{ number_format($product->price, 2) }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Categories</dt>
                <dd class="mt-1 text-lg text-gray-900">
                    {{ $product->categories->pluck('name')->join(', ') }}
                </dd>
            </div>
        </dl>

        <div class="mt-6 flex space-x-3">
            <a href="{{ route('products.edit', $product->id) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Edit
            </a>

            <!-- Delete Button triggers modal -->
            <button type="button"
                    onclick="openDeleteModal({{ $product->id }})"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                Delete
            </button>

            <!-- Hidden Delete Form -->
            <form id="delete-form-{{ $product->id }}"
                  action="{{ route('products.destroy', $product->id) }}"
                  method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

            <a href="{{ route('products.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
                Back
            </a>
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
