<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/jquery.fullpage.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <style>
            body {
                background: url("img/back.png") repeat;
            }
            p,a {
                color: #FFFFFF;
            }
        </style>
        <!-- Styles -->
    </head>
    <body>
        <div id="dowebok">
            <div class="section">
                <div style="text-align:center;">
                    <img src="{{ empty($group->url)?asset("../storage/app/public/group/default.jpg"):asset("../storage/app/public/group/")."/".$group->url }}" class="img-circle" >
                    <h3 style="text-align:center; color: #FFFFFF">{{ $group->name }}</h3>
                    <a href="#about" style="font-size: 20px">关于</a>&nbsp;&nbsp;| &nbsp;
                    <a href="#blog" style="font-size: 20px">博客</a>
                </div>
            </div>
            <div class="section">
                <div class="container">
                    <div id="team" style="height: 60%">
                        <h2 style="color: #FFFFFF"><u>团队介绍</u></h2>
                        @foreach(explode("\n",$group->desc) as $each_p)
                            <p style="font-size: 20px">{{ $each_p }}</p>
                        @endforeach
                    </div>
                    <div id="member">
                        <h2 style="color: #FFFFFF"><u>团队部分成员</u></h2>
                        @foreach($user as $each_user)
                            <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
                                    <p style="font-size: 18px">&nbsp;&nbsp;{{ $each_user->name }}</p>
                                    <figure style="width: 80px;height: 80px">
                                        <img class="img-circle img-responsive"  src="{{ empty($each_user->url)?asset('../storage/app/public/user/default.jpg'):asset("../storage/app/public/user/")."/".$each_user->url }}" data-toggle="tooltip" data-placement="top" title="{{ empty($each_user->sign)?"":$each_user->sign }}" >
                                    </figure>
                                    <p style="font-size: 15px">{{ empty($each_user->key_word)?"":$each_user->key_word }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="section {{ (isset($_GET['page']) or !empty($tag_name))?"active":"" }} fp-auto-height-responsive">
                <div class="container">
                    <div class="row">
                        <ul class="nav nav-pills">
                            <li><a style="font-size: 18px" href="{{route('welcome')."?page=1"}}">{{ $group->name }}</a></li>
                            @foreach($tag as $each_tag)
                                <li><a style="font-size: 18px" href="{{ route('welcome')."/?tag_id=$each_tag->id" }}">{{ $each_tag->name }}</a></li>
                                @if($loop->index == 4)
                                    @break
                                @endif
                            @endforeach
                        </ul>
                        <div class="col-md-7 col-lg-7 col-sm-7 col-xs-7">
                            <h2 style="color: #add8e6" >{{ empty($tag_name)?"文章列表":$tag_name }}</h2>
                            <ol>
                                @foreach($posts as $each_post)
                                    <li>
                                        <h3>
                                            <a href="{{ route('article',['id'=>$each_post->id]) }}" target="_blank">{{ $each_post->title }}</a>&nbsp;&nbsp;
                                        </h3>
                                        <img class="img-circle img-responsive" style="width: 35px;height: 35px" src="{{ empty($each_post->user->url)?asset("../storage/app/public/user/default.jpg"):asset("../storage/app/public/user/")."/".$each_post->user->url }}" >
                                        <p style="font-size: 10px">{{ $each_post->user->name }}</p>
                                        <p>
                                            <span>
                                                <i class="glyphicon glyphicon-calendar"></i>&nbsp;{{ $each_post->created_at }}&nbsp;&nbsp;
                                                <i class="glyphicon glyphicon-tag"></i>&nbsp;{{ $each_post->tag->name }}&nbsp;&nbsp;
                                                <i class="glyphicon glyphicon-eye-open"></i>&nbsp;{{ $each_post->view }}
                                            </span>
                                        </p>
                                    </li>
                                @endforeach
                            </ol>
                            <ul>
                                @if ($posts->hasPages())
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($posts->onFirstPage())
                                            <li class="disabled"><span>@lang('pagination.previous')</span></li>
                                        @else
                                            <li><a href="{{ $posts->previousPageUrl()."#blog" }}" rel="prev">@lang('pagination.previous')</a></li>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($posts->hasMorePages())
                                            <li><a href="{{ $posts->nextPageUrl()."#blog" }}" rel="next">@lang('pagination.next')</a></li>
                                        @else
                                            <li class="disabled"><span>@lang('pagination.next')</span></li>
                                        @endif
                                    </ul>
                                @endif
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                            <h3 style="color: #add8e6">热门文章</h3>
                            <ul id="hot_list" style="padding: 0px 0px 0px 0px">
                                @foreach($hot_posts as $each_post)
                                    <li style="padding: 5px">
                                        <div class="col-sm-10 col-md-10 col-lg-10 col-xs-10">
                                            <a href="{{ route('article',['id'=>$each_post->id]) }}" style="font-size: 15px;" target="_blank">{{ $each_post->title }}</a>&nbsp;&nbsp;
                                        </div>
                                        <span class="badge">{{ $each_post->view }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                            <h3 style="color: #add8e6">标签汇总</h3>
                            <div class="col-sm-10 col-md-10 col-lg-10 col-xs-10">
                                @foreach($tag as $each_tag)
                                    <a href="{{ route('welcome')."/?tag_id=$each_tag->id" }}"><span style="font-size: 15px">{{ $each_tag->name }}</span></a>&nbsp;&nbsp;&nbsp;
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                            <h3 style="color: #add8e6">友情链接</h3>
                            <ul id="link_list" style="padding: 0px 0px 0px 0px">
                                @foreach($link as $each_link)
                                    <li style="padding: 5px">
                                        <div class="col-sm-10 col-md-10 col-lg-10 col-xs-10">
                                            <a href="{{ $each_link->href }}" style="font-size: 15px;" target="_blank">{{ $each_link->name }}</a>&nbsp;&nbsp;
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/scrolloverflow.min.js') }}"></script>
    <script src="{{ asset('js/jquery.fullpage.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $(function(){
            $('#dowebok').fullpage({
                anchors: ['index','about', 'blog'],
                resize: true,
                scrollOverflow: true
            });
        });
    </script>
</html>
