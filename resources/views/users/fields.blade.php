<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Role Id Field -->

{{ Form::hidden('role_id', null, ['class'=>'form-control']) }}
@if (Auth::user()->role_id < 3)
    
<div class="form-group col-sm-6">
    <label for="sel1">User Levels:</label>
    <select class="form-control" id="sel1">
      <option value="{{$user->role['id'] }}">{{ $user->role['name'] }}</option>
  @foreach ($roles as $role )
   <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
  @endforeach
</select>
</div>

@endif
<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#email_verified_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  
</div>
