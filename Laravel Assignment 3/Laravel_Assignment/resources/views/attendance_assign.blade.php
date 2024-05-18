@extends('faculty_sidebar')

@section('content')
<form action="{{ route('assign.attend.stud') }}" method="get">
    <select id="cid">
        <option>Select course id</option>
        @foreach ($courses as $course)
            <option>{{ $course->cid }}</option>
        @endforeach
    </select>
    <input type="text" name="date" id="">
    <button id="sbt" class="btn">Assign</button>
</form>
@endsection
