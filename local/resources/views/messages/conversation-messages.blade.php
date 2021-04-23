{{--

    * Created by   :  Muhammad Yasir
    * Project Name : local
    * Product Name : PhpStorm
    * Date         : 06-1-16 2:28 PM
    * File Name    :

--}}

@extends('layouts.default')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="pro-header">
                <h1>Conversation Messages</h1>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            @include('includes.inner-sidebar')

            <div class="col-md-9">
                <div class="row">
                    <div class="order-link-wrapper">
                        <div class="name-box">{{$title}}</div>
                    </div>

                    <div class="messages-wrapper">
                        <div class="msg-detial-box" id="messageBox" style="overflow: auto;">
                            @foreach($messages as $msg)
                                @if($msg['content'] != '?-empty-?')
                                    <div class="@if($msg['sender_id'] == $user->id) my-messages @else user-messages  @endif">
                                        <div class="col-md-2">
                                            @if($msg['sender_id'] != $user->id)
                                                <div class="user-name">
                                                    {{$msg['sender_name']}}
                                                </div>
                                                <div class="msg-date">
                                                    {{getTimeByTZ($msg['created_at'], 'M d | H:i A')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="text-message">
                                                @if(isset($msg['file_name']) && !empty($msg['file_name']))
                                                    <span class="attachment-icon"></span>

                                                    <div class="linkDownload mar-bt-10">
                                                        <span class="attachment-name">
                                                           <img src=" {{$msg['file_meta']['placeholder']}}" width="100"/>
                                                        </span>
                                                        <span class="attachment-url">
                                                            <a href="{{url('photo/'.$msg['url'])}}" download="">Download</a>
                                                        </span>
                                                    </div>
                                                @endif
                                                {{$msg['content']}}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            @if($msg['sender_id'] == $user->id)
                                                <div class="user-name">
                                                    Me
                                                </div>
                                                <div class="msg-date">
                                                    {{getTimeByTZ($msg['created_at'], 'M d | H:i A')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        {!! Form::open(['url' => 'messages/store', 'id' => 'msg-form']) !!}
                        <input type="file" accept="" id="postFiles" name="attachment"
                               style="position: fixed; top: -30px;"/>

                        <div class="write-msg-box">
                            <input type="hidden" value="{{$msg['conv_id']}}" name="conv_id">

                            <div class="col-md-10">
                                <textarea placeholder="Type your message ..." name="body" rows="1" id="msg-body"></textarea>
                            </div>
                            <div class="col-md-2">
                                <a class="send-msg" type="button" id="send-msg" href="javascript:void(0)">send</a>
                                <a class="attachment" href="javascript:void(0)" id="chat-attachment">attach</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    {!! HTML::script('local/public/assets/js/pages/messages.js') !!}
@stop
