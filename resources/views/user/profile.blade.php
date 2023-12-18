@extends('layout.layout')
@section('content')
@error('error')
      <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="container db-social">
    <div class="jumbotron jumbotron-fluid"></div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="widget head-profile has-shadow">
                    <div class="widget-body pb-0">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-4 col-md-4 d-flex justify-content-lg-start justify-content-md-start justify-content-center">
                                <ul>
                                    <li>
                                        <div class="counter">{{ count($user->following_users) }}</div>
                                        <div class="heading">Follows</div>
                                    </li>
                                    <li>
                                        <div class="counter">{{ count($user->followers) }}</div>
                                        <div class="heading">Followers</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-4 col-md-4 d-flex justify-content-center">
                                <div class="image-default">
                                    <img src="{{ $user->profile_picture ? asset('images/'. $user->profile_picture) : asset('images/default.jpeg')}}" class="d-block rounded-circle" alt="profile avater">
                                </div>
                                <div class="infos">
                                    <h2>{{ $user->name }}</h2>
                                    <div class="location">{{ $user->email }}</div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 d-flex justify-content-lg-end justify-content-md-end justify-content-center">
                                <div class="follow">
                                    
                                    @if(Auth::user()->id == $user->id)
                                    <div class="actions dark">
                                        
                                        <a class="btn btn-shadow" href="{{ route('profileEdit') }}"><i class="la la-user-plus"></i>Edit</a>
                                        
                                    </div>
                                    @else
                                    
                                        

                                        @if (!$user->isFollow->isEmpty())
                                        <form action="{{ route('unfollow' , ['user' => $user]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-shadow" type=""><i class="la la-user-plus"></i>Unfollow</button>
                                        </form>
                                        @else
                                        <form action="{{ route('follow' , ['user' => $user]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-shadow" type="submit"><i class="la la-user-plus"></i>Follow</button>
                                        </form>
                                        @endif
                                        
                                    
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@forelse ($posts as $post)
<div class="container d-flex justify-content-center">
  

    
  <div class="container posts-content">
    <div class="row">
            <div class="card mb-4">
              <div class="card-body">
                <div class="media mb-3">
                  <div class="d-flex gap-1">
                    <img src="{{ $post->user->profile_picture ? asset('images/'. $post->user->profile_picture) : asset('images/default.jpeg')}}" class="d-block ui-w-40 rounded-circle" alt="profile avater">
                   <a class="text-decoration-none" href="{{ route('viewProfile', ['user' => $post->user->id]) }}"> <h4>{{ $post->user->name }}</h4> </a>
                   @if(Auth::user() == $post->user)
                   
                   
                   <a href="{{ route('post.edit', ['post' => $post]) }}" class="ms-auto me-1">Edit</a>
                  

                   @endif
                   
                  </div>
                  
                  <div class="media-body ml-3">
                    <div class="text-muted small">{{ $post->created_at }}</div>
                  </div>
                </div>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->body }} </p>
                @if(isset($post->post_image))
                <div class="container">
                  <img src="{{ asset('images/' . $post->post_image) }}" style="width: 100%; height: auto;" class= "fluid-image object-fit-contain" alt="">
                </div>
               
                @endif
              </div>
              <div class="container">
                <a href="javascript:void(0)" class="d-inline-block text-muted">
                  <small class="align-middle">
                    <strong>{{ count($post->likes) }}</strong> Likes</small>
                </a>
                <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">
                  <small class="align-middle">
                    <strong>{{ count($post->comments) }}</strong> Comments</small>
                </a>
                @auth
                
                  
                                     
                    
                    @if (!$post->isAuthUserLikedPost->isEmpty())
                    <form action="{{ route('unlikePost', ['post' => $post, 'user' => Auth::user()]) }}" class="d-inline-block" method="POST">
                      @csrf
                    <button class="btn btn-link text-decoration-none" type="submit">    
                    <i class="fa-solid fa-thumbs-up"></i>                    
                  </button>
                </form>

                  @else
                  <form action="{{ route('likePost', ['post' => $post, 'user' => Auth::user()]) }}" class="d-inline-block" method="POST">
                    @csrf
                      <button class="btn btn-link text-decoration-none" type="submit">
                        <i class="fa-regular fa-thumbs-up"></i> 
                      </button>
                  </form>
                  @endif
                
              
                @endauth
               
              </div>
              
              @if(isset($post->comments))
              @foreach ($post->comments as $comment)
              <div class="p-3">

                  <div class="card mb-4">
                    <div class="card-body">
                  <p>{{ $comment->body }}</p>
          
                      <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                          <img class="rounded-circle shadow-1-strong me-3" src="{{ asset('images/' . $comment->user->profile_picture) }}" alt="avatar" width="25"
                            height="25" />
                          <p class="small mb-0 ms-2">{{ $comment->user->name }}</p>
                        </div>
                        <div>
                          <span>Posted at:<time class="d-inline-block ms-2">{{ $comment->created_at }}</time></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                  @endif
             @auth
             <form action="{{ route('commentPost', ['post_id' => $post->id, 'user_id' => Auth::user()->id ]) }}" method="POST" class="p-3">
              @csrf
              <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
          
                <div class="d-flex flex-start w-100">

                  <img class="rounded-circle shadow-1-strong me-3"
                    src="{{ asset(Auth::user()->profile_picture ? 'images/'. Auth::user()->profile_picture : 'images/default.jpeg') }}" alt="avatar" width="40"
                    height="40" />

                  <div class="form-outline w-100">
                    <textarea class="form-control" id="comment_body" rows="4"
                      style="background: #fff;" name="body"></textarea>
                    <label class="form-label" for="comment_body">Message</label>
                  </div>

                </div>

                <div class="float-end mt-2 pt-1">

                  <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                </div>
              </div>

            </form>
             @endauth
                  
              
            </div>
        </div>
  </div>
  
    
</div>
    @empty
    <div class="contaner d-flex justify-content-center">
      <h2>No Posts! Create a post now.</h2>
    </div>
    
    @endforelse
    <div class="container d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
@endsection