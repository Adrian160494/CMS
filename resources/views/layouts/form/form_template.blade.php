<?php echo Form::open(['url' => $url]) ?>
@foreach($form as $f)
    <div class="form-group text-left">
        @foreach($f as $k => $v)
            @if($v['type'] == 'label')
                {{ Form::label($v['name'],$v['hint'],['class'=>$v['class']]) }}
                @elseif($v['type'] == 'text')
                {{ Form::text($v['name'],$v['hint'],['class'=>$v['class']]) }}
                @elseif($v['type'] == 'password')
                {{ Form::password($v['name'],['class'=>$v['class']]) }}
                @elseif($v['type'] == 'textarea')
                {{ Form::textarea($v['name'],['class'=>$v['class']]) }}
                @elseif($v['type'] == 'submit')
                {{ Form::submit($v['name'],['class'=>$v['class']]) }}
                @elseif($v['type'] == 'checkbox')
                {{ Form::checkbox($v['name'],'false') }}
            @elseif($v['type'] == 'hidden')
                    {{ Form::hidden($v['name'],$v['value']) }}
                @endif
        @endforeach
    </div>
@endforeach
<div class="errors">
    @foreach($errors->all() as $error)
        <span>{{$error}}</span>
    @endforeach
</div>
<?php echo Form::close() ?>