@extends('layouts.employee.whole')
@section('content')

    <management :trvlmodes="{{ json_encode($modes) }}" :trvlstatuses="{{ json_encode($statuses) }}" :docactions="{{ json_encode($docactions) }}" :doctypes="{{ json_encode($doctypes) }}" :profile="{{ json_encode($profile) }}" ref="showm"></management>

@endsection