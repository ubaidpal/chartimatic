@extends('layouts.main')

@section('content')
    <section>

        <div class="row">
            <div class="col-sm-12">
                <div class="blog-post-area">
                    <h2 class="title text-center">{{$page->title}}</h2>
                    <p>{!!nl2br($page->content)!!}</p>
                </div>
            </div>
        </div>

    </section>
@endsection