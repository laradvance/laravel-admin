<div class="{{$viewClass['form-group']}} {!! ($errors->has($errorKey['start'].'start') || $errors->has($errorKey['end'].'end')) ? 'has-error' : ''  !!}">

    <label for="{{$id['start']}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            <input type="text" name="{{$name['start']}}" value="{{ old($column['start'], $value['start']) }}" class="form-control {{$class['start']}}" {!! $attributes !!} />
            <span class="input-group-addon" style="border-left: 0; border-right: 0;">-</span>
            <span class="input-group-addon" style="border-right: 0;"><i class="fa fa-clock-o"></i></span>
            <input type="text" name="{{$name['end']}}" value="{{ old($column['end'], $value['end']) }}" class="form-control {{$class['end']}}" {!! $attributes !!} />
        </div>

        @include('admin::form.help-block')

    </div>
</div>
