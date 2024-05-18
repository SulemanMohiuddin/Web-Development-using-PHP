@extends('faculty_sidebar')

@section('sidebar')
@php
$type = session('type');
@endphp

@if(isset($type))
    
        <div style='margin-top: 50px;'>
            <button class='made-with-love' id='btn6'>View Details</button><br>
            <button class='made-with-love' id='btn7'>View Marks</button><br>
            <button class='made-with-love' id='btn8'>View Attendance</button><br>
            <button class='made-with-love' id='btn9'>Register Course</button><br>
        </div>
    @endif
@endsection


@section('content')
    <form action="{{ route('subCourse') }}" method="get">
        <select id="cid">
            <option>Select course id</option>
            @foreach ($courses as $course)
                <option>{{ $course->cid }}</option>

            @endforeach
        </select>
        <button id="sbt" class="btn">Register Course</button>
    </form>

@endsection

@section('scripts')
@yield('scrpt')
<script>
    document.getElementById("btn6").addEventListener('click', function() {
        window.location.href = "{{ route('info') }}";
    });
    document.getElementById("btn7").addEventListener('click', function() {
        window.location.href = "{{ route('viewMarks') }}";
    });
    document.getElementById("btn8").addEventListener('click', function() {
        window.location.href = "{{ route('viewAtten') }}";
    });
    document.getElementById("btn9").addEventListener('click', function() {
       window.location.href = "{{ route('regCourse') }}";
    });
</script>
@endsection