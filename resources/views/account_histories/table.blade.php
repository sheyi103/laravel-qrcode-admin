<div class="table-responsive">
    <table class="table" id="accountHistories-table">
        <thead>
            <tr>
                
        <th>User Email</th>
        <th>Account Id</th>
        <th>Message</th>
               
            </tr>
        </thead>
        <tbody>
        @foreach($accountHistories as $accountHistory)
            <tr>
               
            <td>{{ $accountHistory->user['email'] }}</td>
             <td>{{ $accountHistory->account_id }}</td>
            <td>{{ $accountHistory->message }}</td>
               
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
