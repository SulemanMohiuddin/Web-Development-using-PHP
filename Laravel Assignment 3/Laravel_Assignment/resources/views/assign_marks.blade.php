@extends('faculty_sidebar')



@section('content')
<form action="{{ route('assign.marks.stud') }}" method="get">
    <select id="cid">
        <option>Select course id</option>
        @foreach ($courses as $course)
            <option>{{ $course->cid }}</option>
        @endforeach
    </select>
    <button id="sbt" class="btn">Add Marks</button>
</form>
@endsection

