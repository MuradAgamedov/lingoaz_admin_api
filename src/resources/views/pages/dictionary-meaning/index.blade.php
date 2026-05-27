@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "Meanings for: " . $dictionary->word, "links" => [
    ["name" => "Home", "route" => "home"],
    ["name" => "Dictionary", "route" => "dictionary.index"],
    ["name" => "Meanings", "route" => "dictionary.meaning.index", "params" => [$dictionary->id]]
    ]])

    <div class="container-fluid">
        <div class="w-full">
            <div class="card w-full">
                <div class="card-body">

                    <div class="flex justify-between items-center mb-4">
                        <h6 class="card-title">Meanings List</h6>
                        <a href="{{ route('dictionary.meaning.create', $dictionary->id) }}" class="btn btn-primary">Add Meaning</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="text-left">
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">Part of Speech</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">Definitions</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($meanings as $meaning)
                                <tr>
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">{{ $meaning->part_of_speech }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                        <ul class="list-disc pl-5">
                                            @foreach($meaning->definitions as $definition)
                                                <li>
                                                    <strong>{{ $definition->definition }}</strong>
                                                    @if($definition->example)
                                                        <br><small class="text-default-500 italic">Example: {{ $definition->example }}</small>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                        <div class="flex gap-2">
                                            <a href="{{ route('dictionary.meaning.edit', [$dictionary->id, $meaning->id]) }}" class="text-primary hover:text-primary-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M5 18.89h1.414l9.314-9.314l-1.414-1.414L5 17.476zm16 2H3v-4.243L16.435 3.212a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414L9.243 18.89H21zM15.728 6.748l1.414 1.414l1.414-1.414l-1.414-1.414z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('dictionary.meaning.destroy', [$dictionary->id, $meaning->id]) }}" method="POST" onsubmit="return confirm('Silmək istədiyinizə eminsiniz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M17 6h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1zm1 2H6v12h12zm-4.586 6l1.768 1.768l-1.414 1.414L12 15.414l-1.768 1.768l-1.414-1.414L10.586 14l-1.768-1.768l1.414-1.414L12 12.586l1.768-1.768l1.414 1.414zM9 4v2h6V4z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
