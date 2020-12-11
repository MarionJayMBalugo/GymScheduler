@extends('layouts.app')

@section('content')
<dashboard-component :user ="{{auth()->user()}}"/>
@endsection
