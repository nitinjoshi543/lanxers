<h5>User Details</h5>
<table class="table table-bordered mb-4">
    <tr>
        <th>User ID</th>
        <td>{{ $user->users_id }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $user->phone ?? 'N/A' }}</td>
    </tr>
</table>

<h5>Referred Course Purchases</h5>
@if($referrals->count())
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Purchaser Name</th>
                <th>Purchaser Email</th>
                <th>Course Title</th>
                <th>Purchase Date</th>
                <th>Commission</th>
            </tr>
        </thead>
        <tbody>
            @foreach($referrals as $ref)
                <tr>
                    <td>{{ $ref->purchaser_name }}</td>
                    <td>{{ $ref->purchaser_email }}</td>
                    <td>{{ $ref->course_title }}</td>
                    <td>{{ $ref->created_on ?? '-' }}</td>
                    <td>{{ $ref->commission }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-warning">No referred course purchases found.</div>
@endif
