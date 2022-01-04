@extends('layouts.employee.whole')
@section('content')

    <employee 
        :trvlmodes="{{ json_encode($modes) }}" 
        :trvlstatuses="{{ json_encode($statuses) }}" 
        :profile="{{ json_encode($profile) }}" 
        :types="{{ json_encode($doctypes) }}" 
        :reqtypes="{{ json_encode($reqtypes) }}"
        :locations="{{ json_encode($locations) }}" 
        ref="showe"></employee>

@endsection