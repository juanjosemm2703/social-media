<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    $user = get_session_user();
    $errors = session('errors');
    $data = [
        'userName' => $user['name'],
        'userId' => $user['user_id'],
        'active_page' => 'Home',
        'errors' => $errors
    ];
    $posts = get_posts();
    return view('home_page')->with('data', $data)->with('posts', $posts)->with('active_page', $active_page = "Home");
});

Route::get('users', function () {
    $users = get_users();
    return view('users_page')->with('users', $users)->with('active_page', $active_page = "Users");
});

Route::get('post/{id}', function ($id) {
    $user = get_session_user();
    $errors = session('errors');
    $data = [
        'userName' => $user['name'],
        'userId' => $user['user_id'],
        'errors' => $errors
    ];

    $post = get_post( $user['user_id'], $id);
    $comments = get_comments($id);
    $sorted_comments = sort_comments($comments);
    // dump($sorted_comments);
    return view('details_page')->with('data', $data)->with('post', $post)->with('comments', $sorted_comments);
});

Route::get('delete_post/{id}', function($id){
    delete_post($id);
    return redirect(url("/"));
});

Route::get('like/{id}', function($id){
    $errors = [];
    $user = get_session_user();
    $userId = $user["user_id"];
    if($userId !== ""){
            $like = get_like($id, $userId);
            if(empty($like)){
                like($id, $userId);
            }else{
                unlike($id, $userId);
            }
    }else{
        $errors[] = "User not in the session";
    }
    return redirect(url("post/$id"))->with('errors', $errors);
});

Route::get('user/{id}', function ($id) {
    $user = get_session_user();
    $posts = get_user_posts($id);
    return view('user_posts')->with('posts', $posts);
});

Route::post('new_post_action', function () {
    $errors = [];
    $name = request('uname');
    $postTitle = request('postTitle');
    $post = request('post');
    $date =new DateTime(null, new DateTimeZone("Australia/Brisbane"));
    if(strlen($postTitle)<3){
        $errors[] = "Post title need to have at least 3 characters";
    }
    $letters = str_split($name);
    foreach($letters as $letter){
        if(ctype_digit($letter)){
            $errors[] = "Author name must not have numeric characters";
            break;
        }
    }
    if (strlen($name) < 3){
        $errors[] = "Author name need to have at least 3 characters";
    }
    $postWords = explode(" ", $post);
    if(count($postWords)<5){
        $errors[] = "Post must have at least 5 words";
    }

    if (empty($errors)){
        set_session_name($name);
        add_post(session('user.user_id'), $postTitle, $post, $date );
        return redirect(url("/"));
    }else{
        return redirect(url("/"))->with('errors', $errors);
    }
   
    
});

Route::post('edit_post_action', function(){
    $errors = [];
    $postId =  request('post_id');
    $postTitle = request('postTitle');
    $date =new DateTime(null, new DateTimeZone("Australia/Brisbane"));
    $post = request('post');
    if(strlen($postTitle)<3){
        $errors[] = "Post title need to have at least 3 characters";
    }
    $postWords = explode(" ", $post);
    if(count($postWords)<5){
        $errors[] = "Post must have at least 5 words";
    }

    if (empty($errors)){
        edit_post($postTitle, $post, $date, $postId);
        return redirect(url("post/$postId"));
    }else{
        return redirect(url("post/$postId"))->with('errors', $errors);
    }
   

});

Route::post('new_comment_action', function () {
    $name = request('uname');
    $postId =  request('post_id');
    $message = request('message');
    $date =new DateTime(null, new DateTimeZone("Australia/Brisbane"));
    $letters = str_split($name);
    foreach($letters as $letter){
        if(ctype_digit($letter)){
            $errors[] = "Author name must not have numeric characters";
            break;
        }
    }
    if (strlen($name) < 3){
        $errors[] = "Author name need to have at least 3 characters";
    }
    if (empty($errors)){
        $user = set_session_name($name);
        $userId = $user["user_id"];
        add_comment($userId, $postId, $message, $date);
        return redirect(url("post/$postId"));
    }else{
        return redirect(url("post/$postId"))->with('errors', $errors);
    }
});

Route::post('new_reply_action', function () {
    $name = request('uname');
    $postId =  request('post_id');
    $message = request('message');
    $parentCommentId = request('parent_comment_id');
    $date =new DateTime(null, new DateTimeZone("Australia/Brisbane"));
    $letters = str_split($name);
    foreach($letters as $letter){
        if(ctype_digit($letter)){
            $errors[] = "Author name must not have numeric characters";
            break;
        }
    }
    if (empty($errors)){
        $user = set_session_name($name);
        $userId = $user["user_id"];
        add_comment($userId, $postId, $message, $date, $parentCommentId);
        return redirect(url("post/$postId"));
    }else{
        return redirect(url("post/$postId"))->with('errors', $errors);
    }
    // $post_id = request('post_id');
    // $parent_comment = request('parent_comment_id');

});



function set_session_name($name){
    if (session()->has('user')) {
        return $user = session('user');
    }else{
        $user = get_user_name($name);

        if ($user == null){
            $user_id = add_user($name);
            $user = [
                "user_id" => $user_id,
                "name" => $name
            ];
        }else{
            $user = [
                "user_id" => $user->user_id,
                "name" => $user->name
            ];
        }
        session()->put('user', $user );
        return $user;
    }
}

function get_session_user(){
    $user=[
        "user_id" => "",
        "name" => ""
    ];
    if (session()->has('user')) {
        $user = session('user');
    }
    return $user;
}

function sort_comments($comments, $parent_comment=null){
    $sorted_comments = [];
    foreach($comments as $comment){
        if($comment->parent_comment_id == $parent_comment){
            $comment->replies = sort_comments($comments, $comment->comment_id);
            $comment->reply_count = count($comment->replies);
            $sorted_comments[] = $comment;
        };
    }
   return $sorted_comments;
}


function get_posts(){
    $sql = "SELECT post.post_id, user.name as author, post.title, post.date,  
    (
        SELECT COUNT(comment_id)
        FROM comment
        WHERE comment.post_id = post.post_id
    ) AS comment_count
    FROM user, post
    WHERE user.user_id = post.user_id
    ORDER BY post.date DESC;";
    $posts = DB::select($sql);
    return $posts;
}

function get_user_posts($author_id){
    $sql = "SELECT user.name as author, post.post_id, post.title, post.message, post.date,
    (
        SELECT COUNT(*)
        FROM post_likes
        WHERE post_likes.post_id = post.post_id
    ) AS likes,
    (
        SELECT COUNT(*)
        FROM comment
        WHERE comment.post_id = post.post_id
    ) AS comment_count
    FROM user, post
    WHERE post.user_id = user.user_id
    AND user.user_id = ?
    GROUP BY post.post_id;";
    $posts = DB::select($sql, array($author_id));
    return $posts;
}

function get_like($post_id, $user_id){
    $sql = "SELECT like_id
    FROM post_likes
    WHERE post_likes.post_id = ?
    AND post_likes.user_id = ?;
    ";
    $like = DB::select($sql, array($post_id, $user_id));
    return $like;
}

function get_post($user_id, $post_id){
    $sql = "SELECT user.name as author, post.post_id, post.title, post.message, post.date,
    (
        SELECT COUNT(*)
        FROM post_likes
        WHERE post_likes.post_id = post.post_id
    ) AS likes,
    (
        SELECT COUNT(*)
        FROM comment
        WHERE comment.post_id = post.post_id
    ) AS comment_count,
    (
        SELECT COUNT(*)
        FROM post_likes
        WHERE post_likes.post_id = post.post_id
        AND post_likes.user_id = ? 
    ) AS user_liked
    FROM user, post
    WHERE post.post_id = ?
    AND user.user_id = post.user_id
    GROUP BY post.post_id";
    $post = DB::select($sql, array($user_id, $post_id));
    if (count($post) != 1){
       return null;
    }
    return $post[0];
}

function get_users(){
    $sql = "SELECT DISTINCT user.user_id, user.name, COUNT(*) AS post_count
    FROM user, post
    WHERE user.user_id = post.user_id
    GROUP BY user.user_id 
    ORDER BY COUNT(*) DESC;";
    $users = DB::select($sql);
    return $users;
}

function delete_post($post_id){
    $sql = "DELETE FROM post 
            WHERE post_id = ?;";
    DB::delete($sql, array($post_id));
}

function delete_comments($post_id){
    $sql = "DELETE FROM comment 
            WHERE post_id = ?;";
    DB::delete($sql, array($post_id));
}

function edit_post($title, $message, $date, $post_id){
    $sql ="update post set title = ? ,message = ?, date = ? where post_id = ?";
    DB::update($sql,array($title, $message, $date, $post_id));
}

function add_post($user_id, $title, $message, $date){
    $sql = "INSERT INTO Post (user_id, title, message, date)
            values(?, ?, ?, ? )";
    DB::insert($sql, array($user_id, $title, $message, $date));
}

function like($post_id, $user_id){
    $sql = "INSERT INTO Post_likes (post_id, user_id)
            values(?, ?)";
    DB::insert($sql, array($post_id, $user_id));
}

function unlike($post_id, $user_id){
    $sql = "DELETE FROM Post_likes 
            WHERE post_id = ? 
            AND user_id = ?";
    DB::delete($sql, array($post_id, $user_id));
}

function add_user($name){
    $sql = "INSERT INTO User (name) values(?);";
    DB::insert($sql, array($name));
    $id = DB::getPdo()->lastInsertId();
    return $id;
}

function add_comment($userId, $postId, $message, $date, $parentCommentId =null){
    $sql = "INSERT INTO Comment (user_id,parent_comment_id, post_id,message,date) 
            values(?, ?, ?, ?, ?);";
    DB::insert($sql, array($userId,$parentCommentId, $postId, $message, $date));
}

function get_comments($post_id){
    $sql = "SELECT * from Comment where post_id = ? ORDER BY date DESC;";
    $comments = DB::select($sql, array($post_id));
    return $comments;
}

function get_user_name($name){
    $sql = "SELECT * FROM user where name = ?;";
    $user = DB::select($sql, array($name));
    if (count($user) != 1){
       return null;
    }
    return $user[0];
}