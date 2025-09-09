@extends('dashboard')

@section('title', 'Category Details')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Category Details</h1>

        <dl class="space-y-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">ID</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $category->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Name</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $category->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Description</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $category->description }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Slug</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $category->slug }}</dd>
            </div>
        </dl>

        <div class="mt-6 flex space-x-3">
            <a href="{{ route('categories.edit', $category->id) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Edit
            </a>

            <!-- Delete Button triggers modal -->
            <button type="button"
                    onclick="openDeleteModal({{ $category->id }})"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                Delete
            </button>

            <!-- Hidden Delete Form -->
            <form id="delete-form-{{ $category->id }}"
                  action="{{ route('categories.destroy', $category->id) }}"
                  method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

            <a href="{{ route('categories.index') }}"
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
            <p class="text-gray-600 mb-6">Are you sure you want to delete this category? This action cannot be undone.</p>
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
        let categoryIdToDelete = null;

        function openDeleteModal(id) {
            categoryIdToDelete = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            categoryIdToDelete = null;
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (categoryIdToDelete) {
                document.getElementById('delete-form-' + categoryIdToDelete).submit();
            }
        });
    </script>
@endsection
