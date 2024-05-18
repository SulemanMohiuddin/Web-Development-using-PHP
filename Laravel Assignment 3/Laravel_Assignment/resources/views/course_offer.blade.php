@extends('faculty_sidebar')

@section('content')
    <!-- Display success message -->
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class='tbl'>
        <thead class='tbl'>
            <th colspan='2'>Offer Course</th>
        </thead>
        <tr class='tbl'>
            <td>Course ID:</td>
            <td>
                <form action="{{ route('course.offer') }}" method="post">
                    @csrf
                    <input class='inp' type='text' name='id'>
            </td>
        <tr class='tbl'>
            <td>Name:</td>
            <td>
                <input class='inp' type='text' name='name'></td>
        </tr>
        <tr>
            <td colspan='2'>
                <button type='submit' class='btn' id='sbt'>Offer</button>
            </td>
        </tr>
        </form>
    </table>
@endsection
