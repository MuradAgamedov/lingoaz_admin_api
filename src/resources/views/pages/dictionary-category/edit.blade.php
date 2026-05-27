@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "Edit Dictionary Category", "links" => [
    ["name" => "Home", "route" => "home"],
    ["name" => "Dictionary Category", "route" => "dictionary-category.index"],
    ["name" => "Edit", "route" => "dictionary-category.edit", "params" => [$category->id]]
    ]])

    <div class="container-fluid">
        <div class="grid grid-cols-1 gap-5">

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Edit Category</h6>

                    <form method="POST" action="{{ route('dictionary-category.update', $category->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid lg:grid-cols-2 md:grid-cols-1 grid-cols-1 gap-x-5">
                            @include('layout.includes.ui.fields._input', ["label" => "Title", "name" => "title", "placeholder" => "Enter category title", "type" => "text", "required" => true, "value" => old('title', $category->title)])

                            <div class="mb-4">
                                <label class="inline-block mb-2 font-medium">Image</label>
                                @if($category->image)
                                    <div class="flex items-center gap-4 mb-3">
                                        <img src="{{ asset('storage/' . $category->image) }}"
                                             alt="Category image"
                                             class="h-32 w-32 object-cover rounded-lg border border-default-200">
                                        <p class="text-sm text-default-400">Yeni şəkil yükləsəniz köhnəsi silinəcək.</p>
                                    </div>
                                @else
                                    <p class="text-default-400 text-sm mb-2">Şəkil yoxdur.</p>
                                @endif
                                <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp"
                                       class="form-input">
                                @include('layout.includes.alerts._error', ['field' => 'image'])
                            </div>
                        </div>

                        <div class="mt-6">
                            @include('layout.includes.ui._from_control_buttons')
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</main>
@endsection
