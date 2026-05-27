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

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="text-left">
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">ID</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">Title</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">Image</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">#{{ $category->id }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">{{ $category->title }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                        @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}" class="w-16 h-16 object-cover rounded">
                                        @else
                                        <span class="text-sm text-gray-500">No Image</span>
                                        @endif
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
                        {{ $categories->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
