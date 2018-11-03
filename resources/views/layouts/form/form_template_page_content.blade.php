    <div class="col-md-12 page-content">
        <?php echo Form::open(['url' => $url]) ?>
        @foreach($form as $f)
            <?php //dump($form);die; ?>
            <div class="form-group text-center col-md-12">
                @foreach($f as $k => $v)
                    @if($v['type'] == 'label')
                        <div class="col-md-2">
                            {{ Form::label($v['name'],$v['hint'],['class'=>$v['class']]) }}
                        </div>
                    @elseif($v['type'] == 'text')
                        <div class="col-md-10">
                            {{ Form::text($v['name'],$v['value'],['class'=>$v['class']]) }}
                        </div>
                    @elseif($v['type'] == 'submit')
                        <div class="col-md-12">
                            {{ Form::submit($v['name'],['class'=>$v['class']]) }}
                        </div>
                    @elseif($v['type'] == 'select')
                        <div class="col-md-10">
                            {{ Form::select($v['name'], $v['values'],$v['default'],['class'=>$v['class']]) }}
                        </div>
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
    </div>

    <script>
        CKEDITOR.replace( 'content' );
    </script>
