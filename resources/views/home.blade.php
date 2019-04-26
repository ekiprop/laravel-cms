@extends('layouts.app')

<style type ="text/css">
    .avatar{
        border-radius: 100%;
        max-width: 100px;
    }
    .avatars{
        border-radius: 200%;
        max-width: 200px;
    }

</style>
@section('content')
<div class="container">
        @if(count($errors)>0)
        @foreach ($errors->all() as $error)
            <div class="alert-danger">{{$error}}</div>
            
        @endforeach

    @endif

    @if(session('response'))
    <div class="alert-success">{{session('response')}}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-header">
                    <form method="POST" action='{{ url("/search") }}'>
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search for ...">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    Go!
                                </button>
                            </span>
                        </div>
                    
                    </form>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                </div>
                <div class = "col-md-4">
                    @if(!empty($profile))
                    <img src="{{ $profile->profile_img }}" class = "avatar" alt=""/>

                    @else
                    <img src="{{ url('images/avatar.png') }}" class = "avatar" alt=""/>

                    @endif

                    @if(!empty($profile))
                    <p class="lead">{{ $profile->name}}</p>

                    @else
                    <p> </p>

                    @endif
                    @if(!empty($profile))
                    <p class="lead">{{ $profile->designation}}</p>

                    @else
                    <p> </p>

                    @endif
                       
                 </div>
                 <h3>Posts</h3>
                 <div class = "col-md-8">
                     @if (count($posts) > 0 )
                        @foreach ($posts->all() as $post)
                            <h4>{{ $post->post_title }}</h4>
                            <img src="{{ $post->post_img }}" class = "avatars" alt="">
                            <p>{{ substr($post->post_body, 0, 150 ) }}  . . . </p>
                            <ul class="nav nav-pills">
                                <li role="presentation">
                                    <a href='{{ url("/view/{$post->id}") }}'>
                                        <span class="fas fa-eye"> VIEW</span>
                                    </a>

                                </li>
                                @if(Auth::id() == 1)
                                    <li role="presentation">
                                        <a href='{{ url("/edit/{$post->id}") }}'>
                                            <span class="far fa-edit"> EDIT</span>
                                        </a>
    
                                    </li>
                                    <li role="presentation">
                                            <a href='{{ url("/delete/{$post->id}") }}'>
                                                <span class="fas fa-trash-alt"> DELETE</span>
                                            </a>
        
                                    </li>
                                @endif
                            </ul>
                            <cite style="float:left">Posted on: {{date('M j, Y H:i', strtotime($post->updated_at))}}
                            </cite>
                            <hr/>
                            
                        @endforeach
                         
                     @else
                        <p>No Posts Available!</p> 
                     @endif
                     {{$posts->links()}}
                 </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
