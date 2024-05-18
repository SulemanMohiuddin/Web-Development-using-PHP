@extends('main_dashboard')

@section('sidebar')
@php
$type = session('type');
@endphp

@if(isset($type))
    @if($type == 'faculty')
        <div style='margin-top: 50px;'>
            <button class='made-with-love' id='btn4'>Add Attendance</button><br>
            <button class='made-with-love' id='btn5'>Add Marks</button><br>
        </div>
    @elseif($type == 'student')
        <div style='margin-top: 50px;'>
            <button class='made-with-love' id='btn6'>View Details</button><br>
            <button class='made-with-love' id='btn7'>View Marks</button><br>
            <button class='made-with-love' id='btn8'>View Attendance</button><br>
            <button class='made-with-love' id='btn9'>Register Course</button><br>
        </div>
    @endif
@endif
@endsection

@section('content')
@yield('content')
@endsection

@section('scripts')
@yield('scrpt')
<script>
    document.getElementById("btn4").addEventListener('click', function() {
        window.location.href = "{{ route('assign.attend') }}";
    });
    document.getElementById("btn5").addEventListener('click', function() {
        window.location.href = "{{ route('assign.marks') }}";
    });
    document.getElementById("btn6").addEventListener('click', function() {
        window.location.href = "{{ route('info') }}";
    });
</script>
@endsection
