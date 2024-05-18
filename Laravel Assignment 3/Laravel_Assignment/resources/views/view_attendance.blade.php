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

<table>
    <thead>
        <tr>
            <th>Course</th>
            <th>Date</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attends as $attend)
        <tr>
            <td>{{$attend->cid}}</td>
            <td>{{$attend->date}}</td>
            <td>{{$attend->value}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

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