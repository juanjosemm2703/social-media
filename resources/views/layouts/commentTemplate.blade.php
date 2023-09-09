@foreach($comments as $comment)
        <div @if($comment->parent_comment_id == null) class="post-card__comments" @endif>
        <p class="comment_reply">{{$comment->message}}</p>
        <a class="hide-replyForm"> 
            <div class="users__card-footer">
                <i class="fa-solid fa-reply fa-lg"></i>              
            </div>
        </a>
        @if($comment->reply_count>0)
        <a class="hide-replies">
            <div class="users__card-footer">
                <i class="fa-regular fa-comment fa-lg"></i>
                <p>{{$comment->reply_count}}</p>              
            </div>
        </a>
        @endif
        <div class="post-card__comments-footer hidden">
            <table class="form-row">
                <form action="{{url("new_reply_action")}}" method="post" id="form{{$comment->comment_id}}">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$comment->post_id}}">
                    <input type="hidden" name="parent_comment_id" value="{{$comment->comment_id}}">
                    <tr>
                        <td><input type="text" id="uname" name="uname" placeholder="Your name..." 
                        @if($data['userName'] !== "")
                            value="{{$data['userName']}}"
                            readonly
                        @endif
                        ><br></td>
                        <td class="no-wrap"><input type="text" id="message" name="message" placeholder="Write a comment..."><br></td>
                    </tr>
                </form>
            </table>
            <button type="submit" form="form{{$comment->comment_id}}" value="submit">
                <i class="fa-regular fa-paper-plane fa-lg"></i>
            </button> 
        </div>
        @if($comment->reply_count > 0)
        <div class="reply hidden">
            @include('layouts.commentTemplate', ['comments' => $comment->replies])
        </div>
        @endif
    </div> 

@endforeach