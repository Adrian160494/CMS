    <div class="col-md-12 page-content">
        <?php echo Form::open(['url' => $url]) ?>
        @foreach($form as $f)
            <?php //dump($f); ?>
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
                    @elseif($v['type'] == 'textarea')
                        <div class="col-md-10">
                            <textarea name="{{$v['name']}}" class="{{$v['class']}}" cols="{{$v['cols']}}" rows="{{$v['rows']}}">
                                @if(!empty($content))
                                    {{$content}}
                                    @endif
                            </textarea>
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

    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

    <style>
        .nicEdit-main{
            background: #fff !important;
        }
    </style>
