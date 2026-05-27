<div class="mb-4">
    <label for="{{ $name }}" class="inline-block mb-2 font-medium">
        {{ $label }} <span class="text-danger">@if (isset($required) && $required) * @endif</span>
    </label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select border-default-200 focus:ring-primary focus:border-primary block w-full rounded-md shadow-sm" {{ isset($multiple) && $multiple ? 'multiple' : '' }} {{ isset($required) && $required ? 'required' : '' }}>
        @foreach($options as $option)
            <option value="{{ $option->id }}" 
                @if(isset($selected))
                    @if(is_array($selected))
                        {{ in_array($option->id, $selected) ? 'selected' : '' }}
                    @else
                        {{ $option->id == $selected ? 'selected' : '' }}
                    @endif
                @endif
            >
                {{ $option->title ?? $option->name ?? $option->id }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-danger mt-1 text-xs">{{ $message }}</p>
    @enderror
</div>
