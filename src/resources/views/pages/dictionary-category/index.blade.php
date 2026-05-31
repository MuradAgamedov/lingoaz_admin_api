@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "Dictionary Category", "links" => [
    ["name" => "Home", "route" => "home"],
    ["name" => "Dictionary Category", "route" => "dictionary-category.index"],
    ]])

    <div class="container-fluid">
        <div class="w-full">
            <div class="card w-full">
                <div class="card-body">

                    @include('layout.includes.pages._index_top', ["create" => "dictionary-category"])

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('dictionary-category.index') }}" class="mb-4 flex items-center gap-2 max-w-sm">
                        <div class="relative w-full">
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search category..." class="form-input w-full pr-10">
                            @if(request('search'))
                                <a href="{{ route('dictionary-category.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <button type="submit" class="btn bg-primary text-white px-4 py-2 rounded-md">Search</button>
                    </form>

                    <!-- Bulk Delete Form (outside table to avoid nested forms) -->
                    <form id="bulk-delete-form" method="POST" action="{{ route('dictionary-category.bulk-delete') }}">
                        @csrf
                    </form>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="text-left">
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14 w-12">
                                        <input type="checkbox" id="select-all" class="form-checkbox rounded text-primary">
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">ID</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">Title</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">Image</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                        <input type="checkbox" name="ids[]" value="{{ $category->id }}" form="bulk-delete-form" class="category-checkbox form-checkbox rounded text-primary">
                                    </td>
                                        <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">#{{ $category->id }}</td>
                                        <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">{{ $category->title }}</td>
                                        <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                            @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}" class="w-16 h-16 object-cover rounded">
                                            @else
                                            <span class="text-sm text-gray-500">No Image</span>
                                            @endif
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                            <div class="flex">
                                                @include('layout.includes.ui._edit_button', [
                                                'route' => 'dictionary-category.edit',
                                                'id' => $category->id
                                                ])

                                                @include('layout.includes.ui._delete_button', [
                                                'route' => 'dictionary-category.destroy',
                                                'id' => $category->id
                                                ])
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    <div class="mt-4">
                        {{ $categories->appends(request()->input())->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.category-checkbox');

        if (selectAll) {
            selectAll.addEventListener('change', function () {
                checkboxes.forEach(cb => {
                    cb.checked = selectAll.checked;
                });
            });
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                if (!cb.checked) {
                    selectAll.checked = false;
                } else {
                    const allChecked = Array.from(checkboxes).every(c => c.checked);
                    selectAll.checked = allChecked;
                }
            });
        });
    });
</script>
@endsection
