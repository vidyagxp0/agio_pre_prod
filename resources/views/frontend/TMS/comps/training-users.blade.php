<table class="table table-bordered">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Trainees Name</th>
            <th>Department</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $temp)
            <tr>
                <td class="text-center"><input type="checkbox" id="trainee" name="trainees[]"
                        value="{{ $temp->id }}"></td>
                <td>{{ $temp->name }}</td>
                <td>{{ $temp->department }}</td>
            </tr>
        @endforeach
        <p id="TraineeType" style="color: red">
            ** Please Select atliest one Trainee...
        </p>
    </tbody>
</table>