@extends('layouts.master')
@section('title')
    Users Meda Media
@endsection
@section('content')

    <section class="posts">
      
        <div class="post-form">
            <h2>Edit Post</h2>
            <form method="post" action="{{url("edit_post_action")}}">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->post_id}}">
                <label for="postTitle">Post Title:</label><br>
                <input type="text" id="postTitle" name="postTitle" value="{{$post->title}}"><br>
                <label for="post">Post:</label><br>
                <textarea id="post" name="post" rows="4" cols="50">{{$post->message}}</textarea><br>
                <input type="submit" value="Edit">
            </form>
            @isset($data['errors'])
                @foreach ($data['errors'] as $error)
                    <div class="error">{{$error}}</div>
                @endforeach
            @endisset
        </div>
        <div class="post-list">
        <div class="post-card">
            <div class="post-card__title">
                <h2>{{$post->title}}</h2>
            </div>
            <div class="post-card__message">
                <p>{{$post->message}}</p>
            </div>
            <div class="post-card__footer">
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>{{$post->comment_count}}</p>              
                </div>
                <div class="users__card-footer">    
                    @if($post->user_liked == 1)
                        <i class="fa-solid fa-thumbs-up fa-lg"></i>
                    @elseif($data['userName'] == "")
                        <i class="fa-regular fa-thumbs-up fa-lg"></i>
                    @else
                        <a href="{{url("like/$post->post_id")}}">
                        <i class="fa-regular fa-thumbs-up fa-lg"></i>
                        </a>
                    @endif    
                    <p>{{$post->likes}}</p>              
                </div>
                <div class="users__card-footer">
                <a href="{{url("delete_post/$post->post_id")}}"> 
                        <i class="fa-solid fa-trash fa-lg"></i>
                    </a>             
                </div>
                <h4>@ {{$post->author}}</h4>
                <p class="post-card__footer-date">{{date_format(date_create($post->date),"F d, Y")}}</p>
            </div>
            <div class="post-form">
                <h2>New comment</h2>
                <form action="{{url("new_comment_action")}}" method="post">
                    @csrf
                    <label for="fname">User Name:</label><br>
                    <input type="text" id="uname" name="uname" placeholder="Your name..." 
                    @if($data['userName'] !== "")
                        value="{{$data['userName']}}"
                        readonly
                    @endif
                    ><br>
                    <label for="comment">Comment:</label><br>
                    <input type="text" id="comment" name="comment" placeholder="Write a comment..."><br>
                    <input type="submit" value="Submit">
                </form>
                
            </div>
            <div class="post-card__comments">
                <p class = "comment_reply">This is a comment</p>
                <a class="hide-replyForm"> 
                    <div class="users__card-footer">
                        <i class="fa-solid fa-reply fa-lg"></i>              
                    </div>
                </a>
                <a class="hide-replies">
                    <div class="users__card-footer">
                        <i class="fa-regular fa-comment fa-lg"></i>
                        <p>25</p>              
                    </div>
                </a>
                <div class="post-card__comments-footer hidden">
                    <table class="form-row">
                        <form action="{{url("new_reply_action")}}" method="post" id="form1">
                            @csrf
                            <tr>
                                <td><input type="text" id="uname" name="uname" placeholder="Your name..." 
                                @if($data['userName'] !== "")
                                    value="{{$data['userName']}}"
                                    readonly
                                @endif
                                ><br></td>
                                <td class="no-wrap"><input type="text" id="comment" name="comment" placeholder="Write a comment..."><br></td>
                            </tr>
                        </form>
                    </table>
                    <button type="submit" form="form1" value="submit">
                        <i class="fa-regular fa-paper-plane fa-lg"></i>
                    </button> 
                </div> 

                <div class="reply hidden">
                </div>
            
            </div>
           
        </div>
        </div>
    </section>
@endsection