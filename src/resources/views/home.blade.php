@extends('layouts.app')

@section('content')
<div class="md:flex container m-auto p-4">
    Hello Google Drive

    <div class="mt-5">
        <dashboard-widget :init-directories="{{ $rootDirectories }}"></dashboard-widget>
    </div>
</div>
@endsection
