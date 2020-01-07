<div class="table-responsive">
    <table class="table" id="qrcodes-table">
        <thead>
            <tr>
        <th>Website</th>
      
        <th>Product Name</th>
        <th>Amount</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($qrcodes as $qrcode)
            <tr>
            <td>{{ $qrcode->website }}</td>
            <td>{{ $qrcode->product_name }}</td>
            <td>&#8358;{{ $qrcode->amount }}</td>
            <td>
                @if ($qrcode->status == 1)
                <i class="fas fa-check-square text-green"></i>
                @else
                    <i class="fas fa-times-circle text-red"></i>
                    
                @endif
               
            
            </td>
                <td>
                    {!! Form::open(['route' => ['qrcodes.destroy', $qrcode->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('qrcodes.show', [$qrcode->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('qrcodes.edit', [$qrcode->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
