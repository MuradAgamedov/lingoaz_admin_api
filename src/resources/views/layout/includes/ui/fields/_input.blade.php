<div class="mb-4">
    <label for="firstNameInput2" class="inline-block mb-2 font-medium">
        {{$label}} <span class="text-danger">@if ($required) * @endif</span>
    </label>
    <input type="{{$type}}" id="firstNameInput2" name="{{$name}}"
        class="form-input" placeholder="{{$placeholder}}"
        @if (isset($value)) value="{{$value}}" @endif
        @if (isset($accept)) accept="{{$accept}}" @endif
        @if (isset($multiple) && $multiple) multiple @endif>
    @include('layout.includes.alerts._error', ['field' => $name])
</div>

