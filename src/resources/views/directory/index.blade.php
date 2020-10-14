@extends('layouts.app')

@section('content')
<div class="container m-auto p-4">
    <div class="flex items-center">
      <h1 class="text-3xl block w-full text-indigo-700">
          {{ __('Directories') }}
      </h1>
      <a class="ml-auto px-3 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded" 
        href="{{ route('directory.create') }}">
        {{ __('Create') }}
      </a>
    </div>
    <div class="block mt-5 w-full">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      {{ __('Name') }}
                </th>
                
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      {{ __('User') }}
                </th>
                      
              <th class="px-6 py-3 bg-gray-50"></th>
            </tr>
          </thead>
          <tbody>
            <!-- Odd row -->
            @foreach ($directories as $directory)
                
                <tr class="bg-white">
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                    {{ $directory->name }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                    {{ $directory->user->name }}
                </td>
                
                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                    <a href="{{ route('directory.show', $directory) }}" 
                        class="text-indigo-600 hover:text-indigo-900">
                        {{ __('Show') }}
                    </a>
                    <span class="mx-1">{{ __('|') }}</span>
                    <a href="{{ route('directory.edit', $directory) }}" 
                        class="text-indigo-600 hover:text-indigo-900">
                        {{ __('Edit') }}
                    </a>
                </td>
                </tr>
            @endforeach
            <!-- More rows... -->
          </tbody>
        </table>
      </div>
      <div class="mt-5">
        {{ $directories->render() }}
      </div>
    </div>
  </div>
</div>
</div>
@endsection
