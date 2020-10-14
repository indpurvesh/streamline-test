@extends('layouts.app')

@section('content')
<div class="container p-4 m-auto">
    <div class="flex justify-center">
        <h1 class="flex-1 font-semibold text-xl text-indigo-800 leading-tight">
            {{ __('Edit Directory') }}
        </h1>
    </div>

    <div class="py-5">
        <div class="bg-white">
            <div class="mt-3 ">
                <form action="{{ route('directory.update', $directory) }}" method="post">
                    @csrf
                    @method('put')

                    @include('directory._fields')
                    
                    <div class="mt-3 py-3">
                        <button type="submit" class="px-3 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded"> 
                            {{ __('Save') }}
                        </button>
                        
                        <a href="{{ route('directory.index') }}"
                            class="px-3 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded"
                        >
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
        </div>        
    </div>
</div>
    
@endsection
