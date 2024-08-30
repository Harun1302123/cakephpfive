<?php
return [
    'nextActive' => '<li class="page-item next m-1"><a rel="next" href="{{url}}" class="page-link"><i class="next"></i></a></li>',
    'nextDisabled' => '<li class="page-item next m-1 disabled"><a class="page-link" href="" onclick="return false;"></a></li>',
    'prevActive' => '<li class="page-item previous active m-1"><a rel="prev" href="{{url}}" class="page-link"><i class="previous"></i></a></li>',
    'prevDisabled' => '<li class="page-item previous disabled m-1"><a class="page-link" href="" onclick="return false;"></a></li>',
    'counterRange' => '{{start}} - {{end}} of {{count}}',
    'counterPages' => '{{page}} of {{pages}}',
    'first' => '<li class="first"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'last' => '<li class="last"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item m-1"><a href="{{url}}" class="page-link">{{text}}</a></li>',
    'current' => '<li class="page-item active m-1"><a class="page-link" href="">{{text}}</a></li>',
    'ellipsis' => '<li class="ellipsis">&hellip;</li>',
    'sort' => '<a href="{{url}}">{{text}}</a>',
    'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
    'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
    'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
    'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
];
