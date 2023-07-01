@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2 block border">
            <div class="wrapper-progressBar">
                <ul class="progressBar">
                    <li class="active">Choose package</li>
                    <li class="active">Create subject</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="row">
            <div class="col-sm-6 col-md-7">
                <div class="row">
                    <div class="col-xs-6 col-sm-12 col-md-6 col-0">
                        <div class="box">
                            <div class="item">
                                <div class="item-overlay active p-a">
                                    <p class="pull-left text-u-c label label-md primary">Package</p>
                                </div>
                                <img src="{{asset($package->image ?: 'images/no-image.jpg')}}" class="img-responsive">
                            </div>
                            <div class="p-a">
                                <div class="pull-right text-muted m-b-xs">
                                    <a href="#"><i class="fa fa-edit"></i></a>
                                </div>
                                <div class="text-center text-md m-b h-2x _800">{{$package->name}}</div>
                                <p class="text-center _800">Starts at : {{$package->start_date}}</p>
                                <p class="text-center _800">Ends at : {{$package->end_date}}</p>
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="col-xs-6 col-sm-12 col-md-6">--}}
                    {{--                        <div class="box">--}}
                    {{--                            <div class="item">--}}
                    {{--                                <div class="item-bg">--}}
                    {{--                                    <img src="{{asset($package->image ?: 'images/no-image.jpg')}}" class="blur">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="p-a-lg pos-rlt text-center">--}}
                    {{--                                    <img src="{{asset($package->image)}}" class="img-circle w-56" style="margin-bottom: -7rem">--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="p-a text-center">--}}
                    {{--                                <a href class="text-md m-t block">{{$package->name}}</a>--}}
                    {{--                                <p><small>Designer, Blogger</small></p>--}}
                    {{--                                <p><a href class="btn btn-sm primary">Follow</a></p>--}}
                    {{--                                <div class="text-xs">--}}
                    {{--                                    <em>Photos: <strong>32</strong>, Videos: <strong>50</strong></em>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="col-xs-6 col-sm-12 col-md-6 col-0">
                        <div class="box">
                            <div class="item">
                                <div class="item-bg primary h6" style="height: 3rem">
                                    <p class="p-a text-center">{{$package->name}}’s subjects</p>
                                </div>
                                <div class="p-a pos-rlt">
                                </div>
                            </div>
                            <div class="p-a">
                                <div class="table-responsive">
                                    <table class="table table-striped b-t">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Cost</th>
                                            <th>Created at</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($package->subjects as $subject)
                                            <tr>
                                                <td>{{$subject->name}}</td>
                                                <td>{{$subject->cost}}</td>
                                                <td>{{$subject->created_at}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--                    <div class="col-xs-6 col-sm-12 col-md-6">--}}
                    {{--                        <div class="box text-center">--}}
                    {{--                            <div class="box-tool">--}}
                    {{--                                <ul class="nav">--}}
                    {{--                                    <li class="nav-item inline dropdown">--}}
                    {{--                                        <a class="nav-link text-muted" data-toggle="dropdown">--}}
                    {{--                                            <i class="material-icons md-18">&#xe164;</i>--}}
                    {{--                                        </a>--}}
                    {{--                                        <div class="dropdown-menu dropdown-menu-scale pull-right dark">--}}
                    {{--                                            <a class="dropdown-item" href>Activities</a>--}}
                    {{--                                            <a class="dropdown-item" href>Feed</a>--}}
                    {{--                                            <a class="dropdown-item" href>Photo</a>--}}
                    {{--                                            <div class="dropdown-divider"></div>--}}
                    {{--                                            <a class="dropdown-item">Follow</a>--}}
                    {{--                                        </div>--}}
                    {{--                                    </li>--}}
                    {{--                                </ul>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="p-a-md">--}}
                    {{--                                <p><img src="../assets/images/a1.jpg" class="img-circle w-56"></p>--}}
                    {{--                                <a href class="text-md block">Jason Warren</a>--}}
                    {{--                                <p><small>London, UK</small></p>--}}
                    {{--                                <div>--}}
                    {{--                                    <a href="" class="btn btn-icon btn-social rounded white btn-sm">--}}
                    {{--                                        <i class="fa fa-facebook"></i>--}}
                    {{--                                        <i class="fa fa-facebook indigo"></i>--}}
                    {{--                                    </a>--}}
                    {{--                                    <a href="" class="btn btn-icon btn-social rounded white btn-sm">--}}
                    {{--                                        <i class="fa fa-twitter"></i>--}}
                    {{--                                        <i class="fa fa-twitter light-blue"></i>--}}
                    {{--                                    </a>--}}
                    {{--                                    <a href="" class="btn btn-icon btn-social rounded white btn-sm">--}}
                    {{--                                        <i class="fa fa-google-plus"></i>--}}
                    {{--                                        <i class="fa fa-google-plus red"></i>--}}
                    {{--                                    </a>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="row no-gutter b-t">--}}
                    {{--                                <div class="col-xs-4 b-r">--}}
                    {{--                                    <a class="p-a block text-center" ui-toggle-class>--}}
                    {{--                                        <i class="material-icons md-24 text-muted m-v-sm inline">&#xe7fc;</i>--}}
                    {{--                                        <i class="material-icons md-24 text-danger m-v-sm none">&#xe7fb;</i>--}}
                    {{--                                        <span class="block">Group</span>--}}
                    {{--                                    </a>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col-xs-4 b-r">--}}
                    {{--                                    <a class="p-a block text-center" ui-toggle-class>--}}
                    {{--                                        <i class="material-icons md-24 text-muted m-v-sm none">&#xe87e;</i>--}}
                    {{--                                        <i class="material-icons md-24 text-danger m-v-sm inline">&#xe87d;</i>--}}
                    {{--                                        <span class="block">Like</span>--}}
                    {{--                                    </a>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col-xs-4">--}}
                    {{--                                    <a class="p-a block text-center" ui-toggle-class>--}}
                    {{--                                        <i class="material-icons md-24 text-muted m-v-sm inline">&#xe0cb;</i>--}}
                    {{--                                        <i class="material-icons md-24 text-danger m-v-sm none">&#xe0b7;</i>--}}
                    {{--                                        <span class="block">Chat</span>--}}
                    {{--                                    </a>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-xs-6 col-sm-12 col-md-6">--}}
                    {{--                        <div class="box text-center">--}}
                    {{--                            <div class="box-tool">--}}
                    {{--                                <ul class="nav">--}}
                    {{--                                    <li class="nav-item inline dropdown">--}}
                    {{--                                        <a class="nav-link text-muted" data-toggle="dropdown">--}}
                    {{--                                            <i class="material-icons md-18">&#xe164;</i>--}}
                    {{--                                        </a>--}}
                    {{--                                        <div class="dropdown-menu dropdown-menu-scale pull-right dark">--}}
                    {{--                                            <a class="dropdown-item" href>Activities</a>--}}
                    {{--                                            <a class="dropdown-item" href>Feed</a>--}}
                    {{--                                            <a class="dropdown-item" href>Photo</a>--}}
                    {{--                                            <div class="dropdown-divider"></div>--}}
                    {{--                                            <a class="dropdown-item">Follow</a>--}}
                    {{--                                        </div>--}}
                    {{--                                    </li>--}}
                    {{--                                </ul>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="p-a-md">--}}
                    {{--                                <p><img src="../assets/images/a4.jpg" class="img-circle w-56"></p>--}}
                    {{--                                <a href class="text-md block">Kyle Kelley</a>--}}
                    {{--                                <p><small>London, UK</small></p>--}}
                    {{--                                <a href class="btn btn-sm btn-outline rounded b-accent">Follow</a>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="row row-col no-gutter b-t warn">--}}
                    {{--                                <div class="col-xs-4 b-r">--}}
                    {{--                                    <a class="p-y block text-center" ui-toggle-class>--}}
                    {{--                                        <strong class="block">796</strong>--}}
                    {{--                                        <span class="block">Friends</span>--}}
                    {{--                                    </a>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col-xs-4 b-r">--}}
                    {{--                                    <a class="p-y block text-center" ui-toggle-class>--}}
                    {{--                                        <strong class="block">342</strong>--}}
                    {{--                                        <span class="block">Videos</span>--}}
                    {{--                                    </a>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col-xs-4">--}}
                    {{--                                    <a class="p-y block text-center" ui-toggle-class>--}}
                    {{--                                        <strong class="block">20</strong>--}}
                    {{--                                        <span class="block">Photos</span>--}}
                    {{--                                    </a>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-xs-6 col-sm-12 col-md-6 col-0">--}}
                    {{--                        <div class="box">--}}
                    {{--                            <div class="item">--}}
                    {{--                                <div class="item-overlay active p-a">--}}
                    {{--                                    <span class="pull-right label dark-white text-color"><i class="fa fa-plane fa-fw"></i> 5:30</span>--}}
                    {{--                                    <a href class="pull-left text-u-c label label-md info">Travel</a>--}}
                    {{--                                </div>--}}
                    {{--                                <img src="../assets/images/c2.jpg" class="w-full">--}}
                    {{--                            </div>--}}
                    {{--                            <div class="p-a">--}}
                    {{--                                <div class="text-muted m-b-xs">--}}
                    {{--                                    <span class="m-r">May 12</span>--}}
                    {{--                                    <a href class="m-r"><i class="fa fa-heart-o"></i> 34</a>--}}
                    {{--                                    <a href><i class="fa fa-share"></i></a>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="m-b h-2x"><a href class="_800">20 Beaches That Are Better in the Off-Season</a></div>--}}
                    {{--                                <p class="h-3x">Titudin venenatis ipsum ac feugiat. Vestibulum ullamcorper quam.</p>--}}
                    {{--                                <div><a href class="btn btn-xs white">Read More</a></div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-xs-6 col-sm-12 col-md-6">--}}
                    {{--                        <div class="box">--}}
                    {{--                            <div class="item dark">--}}
                    {{--                                <a href><img src="../assets/images/c6.jpg" class="w-full"></a>--}}
                    {{--                                <div class="item-overlay black-overlay w-full">--}}
                    {{--                                    <a href class="center text-md"><i class="fa fa-plus"></i></a>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="bottom gd-overlay p-a-xs">--}}
                    {{--                                    <a href class="text-md block p-x-sm">San Francisco</a>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="top item-overlay text-right p-x-xs">--}}
                    {{--                                    <a href ui-toggle-class class="text-md p-a-sm inline">--}}
                    {{--                                        <i class="fa fa-heart-o inline"></i>--}}
                    {{--                                        <i class="fa fa-heart text-danger none"></i>--}}
                    {{--                                    </a>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <a class="md-btn md-raised md-fab md-mini m-r pos-rlt md-fab-offset pull-right white"><i class="material-icons md-24">&#xe145;</i></a>--}}
                    {{--                            <div class="p-a">--}}
                    {{--                                <div class="text-muted m-b-xs">--}}
                    {{--                                    <span class="m-r">May 10</span>--}}
                    {{--                                    <a href class="m-r"><i class="fa fa-heart-o"></i> 4</a>--}}
                    {{--                                    <a href><i class="fa fa-bookmark-o"></i> 20</a>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="m-b h-2x"><a href class="_800">Travel in USA</a></div>--}}
                    {{--                                <p class="h-3x">Titudin venenatis ipsum ac feugiat. Vestibulum ullamcorper quam.</p>--}}
                    {{--                                <div><a href class="btn btn-xs white">Read More</a></div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-xs-12 col-sm-12 col-md-6">--}}
                    {{--                        <div class="box">--}}
                    {{--                            <div class="box-header">--}}
                    {{--                                <h3>Who to follow</h3>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="box-divider m-0"></div>--}}
                    {{--                            <ul class="list no-border p-b">--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="list-left">--}}
                    {{--			                	<span class="w-40 avatar">--}}
                    {{--				                  <img src="../assets/images/a4.jpg" alt="...">--}}
                    {{--				                  <i class="on b-white bottom"></i>--}}
                    {{--				                </span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="list-body">--}}
                    {{--                                        <div><a href>Chris Fox</a></div>--}}
                    {{--                                        <small class="text-muted text-ellipsis">Designer, Blogger</small>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="list-left">--}}
                    {{--			                	<span class="w-40 avatar">--}}
                    {{--				                  <img src="../assets/images/a5.jpg" alt="...">--}}
                    {{--				                  <i class="on b-white bottom"></i>--}}
                    {{--				                </span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="list-body">--}}
                    {{--                                        <div><a href>Mogen Polish</a></div>--}}
                    {{--                                        <small class="text-muted text-ellipsis">Writter, Mag Editor</small>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="list-left">--}}
                    {{--			                	<span class="w-40 avatar">--}}
                    {{--				                  <img src="../assets/images/a6.jpg" alt="...">--}}
                    {{--				                  <i class="busy b-white bottom"></i>--}}
                    {{--				                </span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="list-body">--}}
                    {{--                                        <div><a href>Joge Lucky</a></div>--}}
                    {{--                                        <small class="text-muted text-ellipsis">Art director, Movie Cut</small>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="list-left">--}}
                    {{--			                	<span class="w-40 avatar">--}}
                    {{--				                  <img src="../assets/images/a7.jpg" alt="...">--}}
                    {{--				                  <i class="away b-white bottom"></i>--}}
                    {{--				                </span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="list-body">--}}
                    {{--                                        <div><a href>Folisise Chosielie</a></div>--}}
                    {{--                                        <small class="text-muted text-ellipsis">Musician, Player</small>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="list-left">--}}
                    {{--			                	<span class="w-40 circle green avatar">--}}
                    {{--				                  P--}}
                    {{--				                  <i class="away b-white bottom"></i>--}}
                    {{--				                </span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="list-body">--}}
                    {{--                                        <div><a href>Peter</a></div>--}}
                    {{--                                        <small class="text-muted text-ellipsis">Musician, Player</small>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-xs-12 col-sm-12 col-md-6">--}}
                    {{--                        <div class="box">--}}
                    {{--                            <div class="box-header">--}}
                    {{--                                <h3>Feeds</h3>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="box-divider m-0"></div>--}}
                    {{--                            <ul class="list no-border">--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="pull-left m-r">--}}
                    {{--			                	<span class="w-40">--}}
                    {{--			                  		<img src="../assets/images/b1.jpg" class="w-full" alt="...">--}}
                    {{--			                 	</span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="clear">--}}
                    {{--                                        <a href class="_500 text-ellipsis">The people who party before work</a>--}}
                    {{--                                        <small class="text-muted">May 12</small>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="pull-left m-r">--}}
                    {{--				                <span class="w-40">--}}
                    {{--			                  		<img src="../assets/images/b2.jpg" class="w-full" alt="...">--}}
                    {{--			                 	</span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="clear">--}}
                    {{--                                        <a href class="_500 text-ellipsis">Robot steal your job</a>--}}
                    {{--                                        <small class="text-muted">May 9, 2015</small>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="pull-left m-r">--}}
                    {{--			                    <span class="w-40">--}}
                    {{--			                  		<img src="../assets/images/b3.jpg" class="w-full" alt="...">--}}
                    {{--			                 	</span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="clear">--}}
                    {{--                                        <a href class="_500 text-ellipsis">Reservoir dogs and furious rabies</a>--}}
                    {{--                                        <small class="text-muted">Jan 9, 2015</small>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="pull-left m-r">--}}
                    {{--			                    <span class="w-40">--}}
                    {{--			                  		<img src="../assets/images/b4.jpg" class="w-full" alt="...">--}}
                    {{--			                 	</span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="clear">--}}
                    {{--                                        <a href class="_500 text-ellipsis">Changing the world</a>--}}
                    {{--                                        <small class="text-muted">Jan 5, 2015</small>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="pull-left m-r">--}}
                    {{--			                    <span class="w-40">--}}
                    {{--			                  		<img src="../assets/images/b5.jpg" class="w-full" alt="...">--}}
                    {{--			                 	</span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="clear">--}}
                    {{--                                        <a href class="_500 text-ellipsis">See stars</a>--}}
                    {{--                                        <small class="text-muted">Jan 2, 2015</small>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-xs-12">--}}
                    {{--                        <div class="box">--}}
                    {{--                            <div class="box-header">--}}
                    {{--                                <h3>Comments <span class="label success">5</span></h3>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="box-body">--}}
                    {{--                                <div class="streamline m-b m-l">--}}
                    {{--                                    <div class="sl-item">--}}
                    {{--                                        <div class="sl-left">--}}
                    {{--                                            <img src="../assets/images/a0.jpg" class="img-circle">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="sl-content">--}}
                    {{--                                            <div class="sl-date text-muted">2 minutes ago</div>--}}
                    {{--                                            <div class="sl-author">--}}
                    {{--                                                <a href>Peter Joo</a>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div>--}}
                    {{--                                                <p>Check your Internet connection</p>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="sl-footer">--}}
                    {{--                                                <a href data-toggle="collapse" data-target="#reply-1">--}}
                    {{--                                                    <i class="fa fa-fw fa-mail-reply text-muted"></i> Reply--}}
                    {{--                                                </a>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="box collapse m-0 b-a" id="reply-1">--}}
                    {{--                                                <form>--}}
                    {{--                                                    <textarea class="form-control no-border" rows="3" placeholder="Type something..."></textarea>--}}
                    {{--                                                </form>--}}
                    {{--                                                <div class="box-footer clearfix">--}}
                    {{--                                                    <button class="btn btn-info pull-right btn-sm">Post</button>--}}
                    {{--                                                    <ul class="nav nav-pills nav-sm">--}}
                    {{--                                                        <li class="nav-item"><a class="nav-link" href><i class="fa fa-camera text-muted"></i></a></li>--}}
                    {{--                                                        <li class="nav-item"><a class="nav-link" href><i class="fa fa-video-camera text-muted"></i></a></li>--}}
                    {{--                                                    </ul>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="sl-item">--}}
                    {{--                                        <div class="sl-left">--}}
                    {{--                                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="sl-content">--}}
                    {{--                                            <div class="sl-date text-muted">8:30</div>--}}
                    {{--                                            <div class="sl-author">--}}
                    {{--                                                <a href>Moke</a>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div>--}}
                    {{--                                                <p>Call to customer <a href class="text-info">Jacob</a> and discuss the detail.</p>--}}
                    {{--                                                <p>--}}
                    {{--				                      <span class="inline p-a-xs b dark-white">--}}
                    {{--				                        <img src="../assets/images/c1.jpg" class="img-responsive">--}}
                    {{--				                      </span>--}}
                    {{--                                                </p>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="sl-item">--}}
                    {{--                                        <div class="sl-left">--}}
                    {{--                                            <img src="../assets/images/a3.jpg" class="img-circle">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="sl-content">--}}
                    {{--                                            <div class="sl-date text-muted">Sat, 5 Mar</div>--}}
                    {{--                                            <div class="sl-author">--}}
                    {{--                                                <a href>Moke</a>--}}
                    {{--                                            </div>--}}
                    {{--                                            <blockquote>--}}
                    {{--                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante soe aiea ose dos soois.</p>--}}
                    {{--                                                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>--}}
                    {{--                                            </blockquote>--}}


                    {{--                                            <div class="sl-item">--}}
                    {{--                                                <div class="sl-left">--}}
                    {{--                                                    <img src="../assets/images/a2.jpg" class="img-circle">--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="sl-content">--}}
                    {{--                                                    <div class="sl-date text-muted">Sun, 11 Feb</div>--}}
                    {{--                                                    <p><a href class="text-info">Jessi</a> assign you a task <a href class="text-info">Mockup Design</a>.</p>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="sl-item">--}}
                    {{--                                                <div class="sl-left">--}}
                    {{--                                                    <img src="../assets/images/a5.jpg" class="img-circle">--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="sl-content">--}}
                    {{--                                                    <div class="sl-date text-muted">Thu, 17 Jan</div>--}}
                    {{--                                                    <p>Follow up to close deal</p>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}

                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>

            <div class="col-sm-6 col-md-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                <span class="label success pull-right">5</span>
                                <h3>Add subject</h3>
                            </div>
                            <div class="box-body">
                                <form onsubmit="validateEndTime()" role="form" method="POST" id="myForm"
                                      action="{{ route('store-subject') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $package->id }}"
                                           name="package_id">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                               value="{{ old('name') }}"
                                               placeholder="Enter Name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cost</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1"
                                               value="{{ old('cost') }}"
                                               placeholder="Enter Cost" name="cost" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Day</label>
                                        <div class="btn-group dropdown ">
                                            <div class="col-auto my-1 text-center">
                                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect"
                                                        name="day" required>
                                                    <option selected value="sunday">Sunday</option>
                                                    <option value="monday">Monday</option>
                                                    <option value="tuesday">Tuesday</option>
                                                    <option value="wednesday">Wednesday</option>
                                                    <option value="thursday">Thursday</option>
                                                    <option value="friday">Friday</option>
                                                    <option value="saturday">Saturday</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                            <div class="dropdown-menu dropdown-menu-scale">--}}
                                    {{--                                                <option class="dropdown-item" href>Action</option>--}}
                                    {{--                                                <option class="dropdown-item" href>Another action</option>--}}
                                    {{--                                                <option class="dropdown-item" href>Something else here</option>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <button class="btn white dropdown-toggle" data-toggle="dropdown">Day</button>--}}


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Start time</label>
                                        <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                     format: 'LT',
                    disabledHours:[
                    @foreach($notAllowedTimes as $innerArray)
                                        @foreach($innerArray as $item)
                                        {{ $item }},
                        @endforeach
                                        @endforeach
                                            ],
                                           icons: {
                                             time: 'fa fa-clock-o',
                                             date: 'fa fa-calendar',
                                             up: 'fa fa-chevron-up',
                                             down: 'fa fa-chevron-down',
                                             previous: 'fa fa-chevron-left',
                                             next: 'fa fa-chevron-right',
                                             today: 'fa fa-screenshot',
                                             clear: 'fa fa-trash',
                                             close: 'fa fa-remove'
                                           }
                                           }">
                                            <input type='text' class="form-control" name="start_time" id="start_time"
                                                   value="{{ old('start_time') }}" required / >
                                            <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">End time</label>
                                        <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'LT',
                disabledHours:[
                 @foreach($notAllowedTimes as $innerArray)
                                        @foreach($innerArray as $item)
                                        {{ $item }},
                                        @endforeach
                                        @endforeach
                                            ],
               icons: {
                 time: 'fa fa-clock-o',
                 date: 'fa fa-calendar',
                 up: 'fa fa-chevron-up',
                 down: 'fa fa-chevron-down',
                 previous: 'fa fa-chevron-left',
                 next: 'fa fa-chevron-right',
                 today: 'fa fa-screenshot',
                 clear: 'fa fa-trash',
                 close: 'fa fa-remove'
               }
             }">
                                            <input type='text' class="form-control" name="end_time" id="end_time"
                                                   value="{{ old('end_time') }}" onchange="validateEndTime()" required/>
                                            <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                        </div>
                                        @foreach($errors->all() as $er)
                                            <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn primary m-b" id="submit-btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{--                    <div class="col-sm-12">--}}
                    {{--                        <div class="box">--}}
                    {{--                            <div class="box-header">--}}
                    {{--                                <h3>Tasks</h3>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="box-tool">--}}
                    {{--                                <ul class="nav">--}}
                    {{--                                    <li class="nav-item inline dropdown">--}}
                    {{--                                        <a class="nav-link text-muted p-x-xs" data-toggle="dropdown">--}}
                    {{--                                            <i class="fa fa-ellipsis-v"></i>--}}
                    {{--                                        </a>--}}
                    {{--                                        <div class="dropdown-menu dropdown-menu-scale pull-right">--}}
                    {{--                                            <a class="dropdown-item" href>New task</a>--}}
                    {{--                                            <a class="dropdown-item" href>Make all finished</a>--}}
                    {{--                                            <a class="dropdown-item" href>Make all unfinished</a>--}}
                    {{--                                            <div class="dropdown-divider"></div>--}}
                    {{--                                            <a class="dropdown-item">Settings</a>--}}
                    {{--                                        </div>--}}
                    {{--                                    </li>--}}
                    {{--                                </ul>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="box-body">--}}
                    {{--                                <div class="streamline b-l m-l">--}}
                    {{--                                    <div class="sl-item b-success">--}}
                    {{--                                        <div class="sl-icon">--}}
                    {{--                                            <i class="fa fa-check"></i>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="sl-content">--}}
                    {{--                                            <div class="sl-date text-muted">8:30</div>--}}
                    {{--                                            <div>Call to customer <a href class="text-info">Jacob</a> and discuss the detail.</div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="sl-item b-info">--}}
                    {{--                                        <div class="sl-content">--}}
                    {{--                                            <div class="sl-date text-muted">Sat, 5 Mar</div>--}}
                    {{--                                            <div>Prepare for presentation</div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="sl-item b-warning">--}}
                    {{--                                        <div class="sl-content">--}}
                    {{--                                            <div class="sl-date text-muted">Sun, 11 Feb</div>--}}
                    {{--                                            <div><a href class="text-info">Jessi</a> assign you a task <a href class="text-info">Mockup Design</a>.</div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="box-footer">--}}
                    {{--                                <a href class="btn btn-sm btn-block info text-u-c">Load More</a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-sm-12">--}}
                    {{--                        <div class="box">--}}
                    {{--                            <div class="item">--}}
                    {{--                                <div class="item-overlay active p-a">--}}
                    {{--                                    <a class="pull-right text-white _800">$ 4.99</a>--}}
                    {{--                                    <a href class="pull-left text-u-c label label-md danger">Food</a>--}}
                    {{--                                </div>--}}
                    {{--                                <img src="../assets/images/c7.jpg" class="w-full">--}}
                    {{--                            </div>--}}
                    {{--                            <div class="p-a">--}}
                    {{--                                <div class="text-muted m-b-xs">--}}
                    {{--                                    <a href class="m-r"><i class="fa fa-heart-o"></i> 34</a>--}}
                    {{--                                    <a href><i class="fa fa-bookmark-o"></i> 20</a>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="m-b h-2x"><a href class="_800">15 Recipes to Make the Most of Tomatoes</a></div>--}}
                    {{--                                <div class="m-b h-3x">--}}
                    {{--                                    <div class="m-b-sm">Liked:</div>--}}
                    {{--                                    <a href><img src="../assets/images/a0.jpg" class="w-32 rounded"></a>--}}
                    {{--                                    <a href><img src="../assets/images/a1.jpg" class="w-32 rounded"></a>--}}
                    {{--                                    <a href><img src="../assets/images/a2.jpg" class="w-32 rounded"></a>--}}
                    {{--                                    <a href><img src="../assets/images/a3.jpg" class="w-32 rounded"></a>--}}
                    {{--                                    <a class="btn btn-sm danger rounded"><i class="fa fa-plus"></i> 99</a>--}}
                    {{--                                </div>--}}
                    {{--                                <div><a href class="btn btn-xs white">Read More</a></div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-sm-12">--}}
                    {{--                        <div class="box">--}}
                    {{--                            <div class="box-header">--}}
                    {{--                                <h3>Friends</h3>--}}
                    {{--                            </div>--}}
                    {{--                            <ul class="list inset m-0">--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="list-left">--}}
                    {{--			                  <span class="w-40 avatar">--}}
                    {{--				                  <img src="../assets/images/a7.jpg" alt="...">--}}
                    {{--				                  <i class="on b-white left"></i>--}}
                    {{--			                  </span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="list-body">--}}
                    {{--                                        <div class="m-t-sm text-ellipsis"><a href>Chris Fox</a></div>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="list-left">--}}
                    {{--			                  <span class="w-40 avatar">--}}
                    {{--				                  <img src="../assets/images/a8.jpg" alt="...">--}}
                    {{--				                  <i class="on b-white left"></i>--}}
                    {{--				              </span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="list-body">--}}
                    {{--                                        <div class="m-t-sm text-ellipsis"><a href>Mogen Polish</a></div>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="list-left">--}}
                    {{--			                  <span class="w-40 avatar">--}}
                    {{--				                  <img src="../assets/images/a9.jpg" alt="...">--}}
                    {{--				                  <i class="busy b-white left"></i>--}}
                    {{--				              </span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="list-body">--}}
                    {{--                                        <div class="m-t-sm text-ellipsis"><a href>Joge Lucky</a></div>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="list-item">--}}
                    {{--                                    <a herf class="list-left">--}}
                    {{--			                  <span class="w-40 avatar">--}}
                    {{--				                  <img src="../assets/images/a6.jpg" alt="...">--}}
                    {{--				                  <i class="away b-white left"></i>--}}
                    {{--				              </span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="list-body">--}}
                    {{--                                        <div class="m-t-sm text-ellipsis"><a href>Folisise Chosielie</a></div>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                            <div class="box-footer">--}}
                    {{--                                <span class="label text-sm success">560</span>--}}
                    {{--                                <a href class="text-u-c btn btn-xs info pull-right">More</a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-sm-12">--}}
                    {{--                        <div class="box row-col" style="min-height:450px">--}}
                    {{--                            <div class="box-header b-b">--}}
                    {{--                                <strong>Chat</strong>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="row-row dker">--}}
                    {{--                                <div class="row-body">--}}
                    {{--                                    <div class="row-inner">--}}
                    {{--                                        <div class="p-a-md">--}}
                    {{--                                            <div class="m-b">--}}
                    {{--                                                <a href class="pull-left w-40 m-r-sm">--}}
                    {{--                                                    <img src="../assets/images/a2.jpg" alt="..." class="w-full img-circle">--}}
                    {{--                                                </a>--}}
                    {{--                                                <div class="clear">--}}
                    {{--                                                    <div>--}}
                    {{--                                                        <div class="p-a p-y-sm dark-white inline r">--}}
                    {{--                                                            Hi John, What's up...--}}
                    {{--                                                        </div>--}}
                    {{--                                                    </div>--}}
                    {{--                                                    <div class="m-t-xs">--}}
                    {{--                                                        <div class="p-a p-y-sm dark-white inline r">--}}
                    {{--                                                            hmm...--}}
                    {{--                                                        </div>--}}
                    {{--                                                    </div>--}}
                    {{--                                                    <div class="text-muted text-xs m-t-xs"><i class="fa fa-ok text-success"></i> 2 minutes ago</div>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="m-b">--}}
                    {{--                                                <a href class="pull-right w-40 m-l-sm">--}}
                    {{--                                                    <img src="../assets/images/a3.jpg" class="w-full img-circle" alt="...">--}}
                    {{--                                                </a>--}}
                    {{--                                                <div class="clear text-right">--}}
                    {{--                                                    <div class="p-a p-y-sm info inline text-left r">--}}
                    {{--                                                        Lorem ipsum dolor soe rooke..--}}
                    {{--                                                    </div>--}}
                    {{--                                                    <div class="text-muted text-xs m-t-xs">1 minutes ago</div>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="m-b">--}}
                    {{--                                                <a href class="pull-left w-40 m-r-sm">--}}
                    {{--                                                    <img src="../assets/images/a2.jpg" alt="..." class="w-full img-circle">--}}
                    {{--                                                </a>--}}
                    {{--                                                <div class="clear">--}}
                    {{--                                                    <div class="p-a p-y-sm dark-white inline r">--}}
                    {{--                                                        Good!--}}
                    {{--                                                    </div>--}}
                    {{--                                                    <div class="text-muted text-xs m-t-xs"><i class="fa fa-ok text-success"></i> 5 seconds ago</div>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="m-b">--}}
                    {{--                                                <a href class="pull-right w-40 m-l-sm">--}}
                    {{--                                                    <img src="../assets/images/a3.jpg" class="w-full img-circle" alt="...">--}}
                    {{--                                                </a>--}}
                    {{--                                                <div class="clear text-right">--}}
                    {{--                                                    <div>--}}
                    {{--                                                        <div class="p-a p-y-sm info inline text-left r">--}}
                    {{--                                                            Dlor soe isep slie gosese..--}}
                    {{--                                                        </div>--}}
                    {{--                                                    </div>--}}
                    {{--                                                    <div class="m-t-xs">--}}
                    {{--                                                        <div class="p-a p-y-sm info inline text-left r">--}}
                    {{--                                                            Loris aspim..--}}
                    {{--                                                        </div>--}}
                    {{--                                                    </div>--}}
                    {{--                                                    <div class="text-muted text-xs m-t-xs">Just now</div>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="box-footer b-t">--}}
                    {{--                                <form>--}}
                    {{--                                    <div class="input-group">--}}
                    {{--                                        <input type="text" class="form-control" placeholder="Say something">--}}
                    {{--                                        <span class="input-group-btn">--}}
                    {{--					            <button class="btn white b-a no-shadow" type="button">SEND</button>--}}
                    {{--					          </span>--}}
                    {{--                                    </div>--}}
                    {{--                                </form>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    {{--    <script>--}}

    {{--        const startTime = document.getElementById('start_time');--}}
    {{--        const endTime = document.getElementById('end_time');--}}
    {{--        const submitBtn = document.getElementById('submit-btn');--}}

    {{--        function validateEndTime() {--}}
    {{--            const startTimeVal = new Date( "2023-01-01 " + startTime.value);--}}
    {{--            const endTimeVal = new Date("2023-01-01 " + endTime.value);--}}

    {{--            var starttimestamp = startTimeVal.getTime();--}}
    {{--            var endtimestamp = endTimeVal.getTime();--}}

    {{--            if (endtimestamp < starttimestamp) {--}}
    {{--                event.preventDefault();--}}
    {{--                submitBtn.disabled = true;--}}
    {{--            } else {--}}
    {{--                alert('fathom');--}}
    {{--                submitBtn.disabled = false;--}}
    {{--            }--}}
    {{--        }--}}
    {{--        endTime.addEventListener('change', validateEndTime);--}}

    {{--    </script>--}}
    <script>

        const startTime = document.getElementById('start_time');
        const endTime = document.getElementById('end_time');
        const submitBtn = document.getElementById('submit-btn');
        document.getElementById('myForm').addEventListener('submit', function (event) {
            // Prevent form submission
            event.preventDefault();
            const startTimeVal = new Date("2023-01-01 " + startTime.value);
            const endTimeVal = new Date("2023-01-01 " + endTime.value);

            var starttimestamp = startTimeVal.getTime();
            var endtimestamp = endTimeVal.getTime();
            // Check condition
            if (endtimestamp < starttimestamp) {
                // Display error message
                alert('Your error message here');
            } else {
                // Submit form
                this.submit();
            }
        });
    </script>
    <!-- ############ PAGE END-->


@endsection
