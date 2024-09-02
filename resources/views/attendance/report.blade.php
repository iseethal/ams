@include('template')


<style>
    table {
        width: 100%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
</style>

<div class="container">
    <p style="font-size: 20px;font-weight:700">Attendance Report for August 2024</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Employee ID/Name</th>
                @foreach ($days as $day)
                    <th>{{ $day }}</th>
                @endforeach
                <th>Total Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    @foreach ($days as $day)
                        <td>
                            @php
                                $totalMinutesWorked = DB::table('attendance')
                                    ->where('user_id', $employee->id)
                                    ->whereDay('date', $day)
                                    ->sum(DB::raw('TIMESTAMPDIFF(MINUTE, sign_in_time, sign_out_time)'));

                                $hoursWorked = floor($totalMinutesWorked / 60);
                                $minutesWorked = $totalMinutesWorked % 60;

                                if ($totalMinutesWorked > 0) {
                                    $displayTime =
                                        $hoursWorked > 0
                                            ? sprintf('%d:%02d', $hoursWorked, $minutesWorked)
                                            : sprintf('%d minutes', $minutesWorked);
                                } else {
                                    $displayTime = '0';
                                }
                            @endphp
                            {{ $displayTime }}
                        </td>
                    @endforeach
                    <td>
                        @php
                            $totalMinutes = DB::table('attendance')
                                ->where('user_id', $employee->id)
                                ->whereBetween('date', ['2024-08-01', '2024-08-31'])
                                ->sum(DB::raw('TIMESTAMPDIFF(MINUTE, sign_in_time, sign_out_time)'));

                            $totalHours = floor($totalMinutes / 60);
                            $totalMinutesRemaining = $totalMinutes % 60;

                            $totalDisplayTime =
                                $totalHours > 0
                                    ? sprintf('%d:%02d', $totalHours, $totalMinutesRemaining)
                                    : sprintf('%d minutes', $totalMinutesRemaining);
                        @endphp
                        {{ $totalDisplayTime }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

<br><br>
@php
    use Illuminate\Support\Facades\DB;

    $chunkSize = 5;
    $results = [];

    foreach ($employees as $employee) {
        $chunks = collect($days)->chunk($chunkSize);
        $incompleteChunks = [];

        foreach ($chunks as $chunk) {
            $hasNineHourDay = false;

            foreach ($chunk as $day) {
                $totalMinutesWorked = DB::table('attendance')
                    ->where('user_id', $employee->id)
                    ->whereDay('date', $day)
                    ->sum(DB::raw('TIMESTAMPDIFF(MINUTE, sign_in_time, sign_out_time)'));

                $hoursWorked = floor($totalMinutesWorked / 60);
                $minutesWorked = $totalMinutesWorked % 60;

                if ($totalMinutesWorked >= 540) {
                    $hasNineHourDay = true;
                    break;
                }
            }

            if (!$hasNineHourDay) {
                $incompleteChunks[] = $chunk->implode(', ');
            }
        }

        if (!empty($incompleteChunks)) {
            $results[] = [
                'employee_name' => $employee->name,
                'incomplete_count' => count($incompleteChunks),
                'dates' => implode('<br>', $incompleteChunks),
            ];
        }
    }
@endphp


<div class="container">
    <p><b>Employees and the count of days they have not met the 9 - hour requirement for more than 5 days in August.</b>
    </p>

    <table class="table">

        <thead>
            <tr>
                <th>Employee Name</th>
                <th> Count </th>
                <th>Dates</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result['employee_name'] }}</td>
                    <td>{{ $result['incomplete_count'] }}</td>
                    <td>{!! $result['dates'] !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<br><br> <br>
