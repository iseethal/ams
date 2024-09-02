@include('template')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<div class="container" style="padding-top: 30px">

    <h3>Attendance Data</h3>
    <table id="attendanceTable" class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Employee</th>
                <th scope="col">Date</th>
                <th scope="col">SignIn Time</th>
                <th scope="col">SignOut Time</th>
                <th scope="col">Total Hour</th>


            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
                $difference = 0;
                foreach ($attendance_data as $item) {
                    if ($item->sign_in_time && $item->sign_out_time) {
                        $signInTime = Carbon\Carbon::parse($item->sign_in_time);
                        $signOutTime = Carbon\Carbon::parse($item->sign_out_time);

                        // $item->difference = $signInTime->diff($signOutTime)->format('%H:%I');

                        $totalMinutes = $signInTime->diffInMinutes($signOutTime);
                        $hours = floor($totalMinutes / 60);
                        $minutes = $totalMinutes % 60;

                        if ($hours > 0) {
                            $item->difference = sprintf('%d:%02d', $hours, $minutes);
                        } else {
                            $item->difference = sprintf('%d minutes', $minutes);
                        }
                    } else {
                        $item->difference = null;
                    }
                }
            @endphp


            @foreach ($attendance_data as $item)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->sign_in_time }}</td>
                    <td>{{ $item->sign_out_time }}</td>
                    <td>{{ $item->difference }}</td>


                </tr>
            @endforeach


        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#attendanceTable').DataTable({
                "searching": true,
                "ordering": true,
                "paging": true,
            });
        }, 100);
    });
</script>
