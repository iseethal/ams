@include('template')


<div class="container" style="padding-top: 30px">

    <h3>Attendance Report </h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">User Name</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;

            @endphp


            @foreach ($users as $item)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->user_name }}</td>


                </tr>
            @endforeach


        </tbody>
    </table>
</div>
