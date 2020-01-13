<!-- Qrcode Id Field -->
<div class="form-group">
    {!! Form::label('qrcode_id', 'Product Name:') !!}
    <p><a href="/qrcodes/{{ $transaction->qrcode['id'] }}">
    <b>{{ $transaction->qrcode['product_name'] }}</b>
    </a>
    </p>
</div>

<!-- Amount Field -->
<div class="form-group">
    <p><b>Amount :</b> &#8358;{{ $transaction->amount }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Buyer Name:') !!}
    <p><a href="/users/{{ $transaction->qrcode_owner['id'] }}"><b>{{ $transaction->user['name'] }} | {{ $transaction->user['email'] }}</b></a> </p>
</div>

<!-- Qrcode Owner Id Field -->
<div class="form-group">
    {!! Form::label('qrcode_owner_id', 'Qrcode Owner Name:') !!}
    <p><a href="/users/{{ $transaction->qrcode_owner['id'] }}"><b>{{ $transaction->qrcode_owner['name'] }}</b>
    </a></p>
</div>



<!-- Payment Method Field -->
<div class="form-group">
    {!! Form::label('payment_method', 'Payment Method:') !!}
    <p>{{ $transaction->payment_method }}</p>
</div>

<!-- Message Field -->
<div class="form-group">
    {!! Form::label('message', 'Message:') !!}
    <p>{{ $transaction->message }}</p>
</div>



<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $transaction->status }}</p>
</div>

<div class="form-group">
     {!! Form::label('created_at', 'Created At') !!}
     <p>{{ $transaction->created_at -> format('D d, M, Y h:i')}}</p>
 </div>