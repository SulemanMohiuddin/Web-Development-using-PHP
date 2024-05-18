@extends('faculty_sidebar')

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
    @endif
@endif
@endsection

@section('content')

<table>
    <thead>
        <tr>
            <th>Rollno</th>
            <th>Marks</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($enrolledStudents as $student)
        <tr>
            <form action="{{ route('assign.marks.add') }}" method="post">
            <td><input type="text" name="sid" id="" hidden disabled value='{{ $student->sid }}'></td>
            <td>
                <input type="text" name="cid" id="" hidden disabled value='{{$courseId}}'>
                <input type="text" name="marks" id="">
            </td>
            <td>
                <button class="update btn">Submit</button>
            </td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>

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
