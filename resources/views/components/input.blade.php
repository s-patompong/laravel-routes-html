<input
    type="text"
    @if(isset($model))
    x-model="{{ $model }}"
    @endif
    placeholder="{{ $placeholder ?? '' }}"
    name="{{ $name }}"
    class="rounded-md px-2 py-1 md:w-full shadow focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 focus:outline-none border border-transparent focus:border-blue-600"
>
