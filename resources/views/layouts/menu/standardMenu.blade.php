<ul>
    @foreach ($menuPositions as $p)
        <li class="menu-list-li">
            <p>{{$p->nazwa}}</p>
            <p class="url">Url: {{$p->url}}</p>
            <a href="">
                @if($p->czy_submenu)
                    <a class="add-submenu" href="{{url()->route('cms.menu.addPosition',array('id'=>$id_menu,'id_parent'=>$p->id))}}?id_projektu={{$id_projektu}}">
                        <img src="/img/plus.png" width="20"/>
                    </a>
                @endif
                    <a class="edit-submenu" href="{{url()->route('cms.menu.editPosition',array('id'=>$p->id))}}?id_projektu={{$id_projektu}}&id_menu={{$id_menu}}">
                        <img src="/img/edit.png" width="20"/>
                    </a>
                <a class="delete-submenu" href="{{url()->route('cms.menu.removePosition',array('id'=>$p->id))}}?id_projektu={{$id_projektu}}">
                    <img src="/img/delete.png" width="20"/>
                </a>
            </a>
        </li>
        @if($p->childs)
            <ul>
                @foreach ($p->childs as $r)
                    <li class="menu-list-li">
                        <p>{{$r->nazwa}}</p>
                        <p class="url">Url: {{$p->url}}</p>
                        <a href="">
                            @if($r->czy_submenu)
                                <a class="add-submenu" href="{{url()->route('cms.menu.addPosition',array('id'=>$id_menu,'id_parent'=>$r->id))}}?id_projektu={{$id_projektu}}">
                                    <img src="/img/plus.png" width="20"/>
                                </a>
                            @endif
                                <a class="edit-submenu" href="{{url()->route('cms.menu.editPosition',array('id'=>$p->id))}}?id_projektu={{$id_projektu}}&id_menu={{$id_menu}}">
                                    <img src="/img/edit.png" width="20"/>
                                </a>
                            <a class="delete-submenu" href="{{url()->route('cms.menu.removePosition',array('id'=>$r->id))}}?id_projektu={{$id_projektu}}">
                                <img src="/img/delete.png" width="20"/>
                            </a>
                        </a>
                    </li>
                    @if($r->childs)
                        <ul>
                            @foreach ($r->childs as $r)
                                <li class="menu-list-li">
                                    <p>{{$r->nazwa}}</p>
                                    <p class="url">Url: {{$p->url}}</p>
                                    <a href="">
                                        @if($r->czy_submenu)
                                            <a class="add-submenu" href="{{url()->route('cms.menu.addPosition',array('id'=>$id_menu,'id_parent'=>$r->id))}}?id_projektu={{$id_projektu}}">
                                                <img src="/img/add.svg" width="20"/>
                                            </a>
                                        @endif
                                            <a class="edit-submenu" href="{{url()->route('cms.menu.editPosition',array('id'=>$p->id))}}?id_projektu={{$id_projektu}}&id_menu={{$id_menu}}">
                                                <img src="/img/edit.png" width="20"/>
                                            </a>
                                        <a class="delete-submenu" href="{{url()->route('cms.menu.removePosition',array('id'=>$r->id))}}?id_projektu={{$id_projektu}}">
                                            <img src="/img/delete.svg" width="20"/>
                                        </a>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </ul>
        @endif
    @endforeach
</ul>