<div class="mt-3">
    <label for="name" class="block w-full">{{ __('Name') }}</label>
    <input type="text" id="name" 
        class="form-input block w-full" 
        value="{{ $directory->name ?? '' }}"
        name="name" />
    @if($errors->has('name'))
        <p class="mt-3 text-xs text-red-500">{{ $errors->first('name') }}</p>
    @endif
</div>


<div class="mt-3">
    <label for="parent_id" class="block w-full">{{ __('Parent Directory') }}</label>
    
    <select name="parent_id" class="block w-full form-select">
        <option value="">{{ __('Please Select') }}</option>
        @foreach ($directoryOptions as $value => $label)
            <option 
                {{ (isset($directory->parent_id) && $directory->parent_id === $value) ? 'selected'  : '' }}
                value="{{ $value }}">
                {{ $label }}
            </option>
        @endforeach
    </select>
    @if($errors->has('parent_id'))
        <p class="mt-3 text-xs text-red-500">{{ $errors->first('parent_id') }}</p>
    @endif
</div>
