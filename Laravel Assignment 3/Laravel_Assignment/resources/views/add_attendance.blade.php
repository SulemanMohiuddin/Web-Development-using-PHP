@extends('faculty_sidebar')

@section('content')

<table>
    <thead>
        <tr>
            <th>Rollno</th>
            <th>Attendance</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($enrolledStudents as $student)
        <tr>
            <td>{{ $student->sid }}</td>
            <td>
                <select class="attendance-select" data-student="{{ $student->sid }}">
                    <option>Present</option>
                    <option>Absent</option>
                </select>
            </td>
            <td>
                <button class="update btn" data-id="{{ $student->sid }}">Submit</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('scrpt')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.update').forEach(button => {
        button.addEventListener('click', function() {
            let studentId = this.getAttribute('data-id');
            let attendanceSelect = document.querySelector(`.attendance-select[data-student="${studentId}"]`);
            let attendance = attendanceSelect.value;
            fetch('/update-attendance', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    student_id: studentId,
                    attendance: attendance
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Attendance updated successfully!');
                } else {
                    alert('Failed to update attendance!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>
@endsection