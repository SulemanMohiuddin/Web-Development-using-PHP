@extends('faculty_sidebar')

@section('content')
<div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th colspan='2'>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <form action="{{ route('update.submit', ['id' => $student->id]) }}" method="post">
                    @csrf
                    <td><input type="text" name="id" disabled value='{{ $student->id }}'></td>
                    <td><input type="text" name="email" value='{{ $student->email }}'></td>
                    <td><input type="text" name="password" value='{{ $student->password }}'></td>
                    <td>
                        <button type="submit">Update</button>
                    </td>
                </form>
                <form action="{{ route('delete', ['id' => $student->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <td>
                        <input type="submit" value="Delete">
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
