@extends('faculty_sidebar')

@section('content')
    <select id="cid">
        <option>Select course id</option>
        @foreach ($courses as $course)
            <option>{{ $course->courseid }}</option>
        @endforeach
    </select>

    <select id="tid">
        <option>Select teacher id</option>
        @foreach ($students as $student)
            <option>{{ $student->id }}</option>
        @endforeach
    </select>

    <button id="sbt" class="btn">Assign</button>
@endsection
@section('scrpt')
<script>
    document.getElementById("sbt").addEventListener('click', function() {
        window.location.href = "{{ route('assign.courses.submit') }}";
    });
</script>
@endsection
