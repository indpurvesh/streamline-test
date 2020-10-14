@extends('layouts.app')

@section('content')
<directory-show :init-directory="{{ $directory }}"></directory-show>
@endsection
