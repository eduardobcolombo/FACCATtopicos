<div class="row">
    <div class="col-md-2">
        <div class="'form-group">
            {!! Form::label('lb_name','Name:') !!}
            {!! Form::text( 'name',null,['class'=>'form-control', 'id'=>'name']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('lb_phone','Phone:') !!}
            {!! Form::text( 'phone',null,['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('lb_email','email:') !!}
            {!! Form::text( 'email',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>


<div class="'form-group">
    {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
</div>