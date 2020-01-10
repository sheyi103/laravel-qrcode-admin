
<div class="col-md-6">
 <!-- Product Name Field -->
        <div class="form-group">
            <h3>
            {{ $qrcode->product_name }}
            <br/>
            @if(isset( $qrcode->company_name ))
            <small>By {{ $qrcode->company_name }} </small>
                @endif
            </h3>
        </div>

         <!-- Amount Field -->
        <div class="form-group">
           
            <h4> Amount : &#8358; {{ $qrcode->amount }}</h4>
        </div>

         <!-- Product Url Field -->
        <div class="form-group">
            {!! Form::label('product_url', 'Product Url:') !!}
            <p>
             <a class="link-info" href="{{$qrcode->product_url }}" target="_blank"> 
            {{ $qrcode->product_url }}
            </a>
            </p>
        </div>

        
        @if ($qrcode->user_id == Auth::user()->id || Auth::user()->role_id < 3 ) 
        <hr/>

        <!-- User Id Field -->
        <div class="form-group">
            {!! Form::label('user_id', 'User Name:') !!}
            <p>{{ $qrcode->user_id }}</p>
        </div>

        <!-- Website Field -->
        <div class="form-group">
            {!! Form::label('website', 'Website:') !!}
            <p>{{ $qrcode->website }}</p>
        </div>

       
       

        <!-- Qrcode Path Field -->
       

        <!-- Callback Url Field -->
        <div class="form-group">
            {!! Form::label('callback_url', 'Callback Url:') !!}
            <p>{{ $qrcode->callback_url }}</p>
        </div>
  <div class="form-group">
            {!! Form::label('created_at', 'Created At') !!}
            <p>
       {{ $qrcode->created_at}}
        </p>
        </div>


 <div class="form-group">
            {!! Form::label('updated_at', 'Updated At') !!}
            <p>
        {{ $qrcode->updated_at}}
        </p>
        </div>

       
        <!-- Status Field -->
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            <p>
            @if ($qrcode->status == 1)
                Active
            @else
               Inactive 
            @endif
            </p>
        </div>

</div>

   @endif    


<div class="col-md-3">
 <div class="form-group pull-right">
            {!! Form::label('qrcode_path', 'Scan QRcode and Pay') !!}
            <p>
        <img src="{{ asset($qrcode->qrcode_path)}}" alt="">
        </p>
        </div>
</div>