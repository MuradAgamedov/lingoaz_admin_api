@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "Edit Meaning for: " . $dictionary->word, "links" => [
    ["name" => "Home", "route" => "home"],
    ["name" => "Dictionary", "route" => "dictionary.index"],
    ["name" => "Meanings", "route" => "dictionary.meaning.index", "params" => [$dictionary->id]],
    ["name" => "Edit Meaning", "route" => "dictionary.meaning.edit", "params" => [$dictionary->id, $meaning->id]]
    ]])

    <div class="container-fluid">
        <div class="grid grid-cols-1 gap-5">

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Edit Meaning</h6>

                    <form method="POST" action="{{ route('dictionary.meaning.update', [$dictionary->id, $meaning->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid lg:grid-cols-2 md:grid-cols-1 grid-cols-1 gap-x-5">
                            @include('layout.includes.ui.fields._input', ["label" => "Part of Speech", "name" => "part_of_speech", "placeholder" => "e.g. noun, verb", "type" => "text", "required" => false, "value" => old('part_of_speech', $meaning->part_of_speech)])
                        </div>

                        <div class="mt-8">
                            <div class="flex justify-between items-center mb-4">
                                <h6 class="font-semibold">Definitions</h6>
                                <button type="button" id="add-definition" class="btn btn-sm btn-success flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z"/></svg>
                                    Add Definition
                                </button>
                            </div>

                            <div id="definitions-container" class="space-y-4">
                                @foreach($meaning->definitions as $idx => $definition)
                                <div class="definition-row border p-4 rounded relative bg-default-50">
                                    <button type="button" class="remove-definition absolute" style="top: 10px; right: 10px; z-index: 10;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-red-500 hover:text-red-700">
                                            <path fill="currentColor" d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z"/>
                                        </svg>
                                    </button>
                                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                                        @include('layout.includes.ui.fields._input', ["label" => "Definition", "name" => "definitions[$idx][definition]", "placeholder" => "Enter definition", "type" => "text", "required" => true, "value" => $definition->definition])
                                        @include('layout.includes.ui.fields._input', ["label" => "Example", "name" => "definitions[$idx][example]", "placeholder" => "Enter example (optional)", "type" => "text", "required" => false, "value" => $definition->example])
                                    </div>
                                </div>
                                @endforeach
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('definitions-container');
        const addButton = document.getElementById('add-definition');
        let index = {{ count($meaning->definitions) }};

        addButton.addEventListener('click', function() {
            const row = document.createElement('div');
            row.className = 'definition-row border p-4 rounded relative bg-default-50';
            row.innerHTML = `
                <button type="button" class="remove-definition absolute" style="top: 10px; right: 10px; z-index: 10;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-red-500 hover:text-red-700">
                        <path fill="currentColor" d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z"/>
                    </svg>
                </button>
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                    <div class="mb-4">
                        <label class="inline-block mb-2 font-medium">Definition <span class="text-danger">*</span></label>
                        <input type="text" name="definitions[${index}][definition]" class="form-input" placeholder="Enter definition" required>
                    </div>
                    <div class="mb-4">
                        <label class="inline-block mb-2 font-medium">Example</label>
                        <input type="text" name="definitions[${index}][example]" class="form-input" placeholder="Enter example (optional)">
                    </div>
                </div>
            `;
            container.appendChild(row);
            index++;
        });

        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-definition')) {
                e.target.closest('.definition-row').remove();
            }
        });
    });
</script>
@endpush

@endsection
