@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="clearfix">
            <div class="pro-header">
                <h1>Messages</h1>
            </div>
            <div class="col-md-3 col-md-offset-7 mt30">
                <div class="row">
                    <div class="input-group add-on pull-right">
                        <input type="text" class="form-control" placeholder="Search messages" name="srch-term" id="search-input">

                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    {{--<div class="order-link-wrapper">
                        <a href="#">All</a>
                        <a href="#">Unread</a>
                        <a href="#">Read</a>
                        <a href="#">Sent</a>
                    </div>--}}

                    <div class="messages-wrapper">
                        <?php
                        $page = 1;
                        $perPage = 10;
                        $l = 0;
                        ?>
                        @if(!empty($conversations))
                        @foreach($conversations as $row)
                            @if($l < $perPage)
                                <?php
                                $l++;
                                ?>
                            @else
                                <?php
                                $l = 0;
                                $page++;
                                ?>
                            @endif
                            <a href="{{url('messages/show/'.\Vinkla\Hashids\Facades\Hashids::connection('message')->encode($row['id']))}}"
                               class="conversation page-{{$page}}">
                                <div class="messages-list @if(isset($unread[$row['id']])) unread @endif" data-id="{{$row['id']}}">
                                    <div class="col-md-1">
                                        <span class="msg-icon"></span>
                                    </div>
                                    <div class="col-md-9">
                                        <?php ?>
                                        <div class="row">
                                            <div class="msg-title">{{$row['title']}}
                                                @if($row['conv_type'] == 'dispute')
                                                    (Dispute)
                                                @endif</div>
                                            <div class="msg-desc">
                                                {{$row['last_message']}}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="date">
                                            {{\Carbon\Carbon::parse($row['time'])->format('d M Y')}}
                                        </div>
                                    </div>
                                </div>
                            </a>

                        @endforeach
                        @else
                        <h5>No record found.</h5>
                        @endif
                    </div>
                    {{-- <div class="pagination-wrapper">
                         <div class="pages-limit">
                             <div class="input-group">
                                 <label>Show</label>
                                 <select class="form-control">
                                     <option>25</option>
                                     <option>50</option>
                                     <option>100</option>
                                 </select>
                                 <label>per page</label>
                             </div>
                         </div>

                         <div class="pagination-box">
                             <ul class="pagination">
                                 <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                 <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                 <li><a href="#">2</a></li>
                                 <li><a href="#">3</a></li>
                                 <li><a href="#">4</a></li>
                                 <li><a href="#">5</a></li>
                                 <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                             </ul>
                         </div>
                     </div>--}}
                    <div class="text-center">
                        <ul id="pagination" class="pagination-sm"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-scripts')
    {!! HTML::script('local/public/assets/js/pages/messages.js') !!}
    {!! HTML::script('local/public/js/jquery.twbsPagination.min.js') !!}
    <script>
        @if($page > 1)
        $(document).ready(function () {
            $('.conversation').hide();
            $('.page-1').show();
            $('#pagination').twbsPagination({
                totalPages: {{$page}},
                visiblePages: 5,
                onPageClick: function (event, page) {
                    $('.conversation').hide();
                    $('.page-' + page).show();
                    $('.messages-wrapperdd').text('Page ' + page);
                }
            });
        })
        @endif
    </script>
@stop
