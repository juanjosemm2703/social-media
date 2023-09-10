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

/*
Define Web Routes
including home page, user profiles, posts, comments, likes, and more.
*/

// Define a route for the home page
Route::get('/', function () {
    $user = get_session_user();
    $errors = session('errors');
    $data = [
        ...$user,
        'active_page' => 'Home',
        'errors' => $errors
    ];

    $posts = get_posts();
    return view('home_page')->with('data', $data)->with('posts', $posts)->with('active_page', $active_page = "Home");
});

// Define a route for the 'users' page
Route::get('users', function () {
    $users = get_users();
    return view('users_page')->with('users', $users)->with('active_page', $active_page = "Users");
});

// Define a route for viewing a specific post(post_id)
Route::get('post/{post_id}', function ($postId) {
    $user = get_session_user();
    $errors = session('errors');
    $data = [
        ...$user,
        'errors' => $errors
    ];

    $post = get_posts(null,$postId);
    $post = $post[0];
    $userLiked = get_like($postId, $user['userId']);
    $post->userLiked = $userLiked;
    $comments = get_comments($postId);
    $sorted_comments = sort_comments($comments);
    return view('details_page')->with('data', $data)->with('post', $post)->with('comments', $sorted_comments);
});

// Define a route for deleting a post (post_id)
Route::get('delete_post/{post_id}', function($postId){
    delete_like($postId);
    delete_comments($postId);
    delete_post($postId);
    return redirect(url("/"));
});

// Define a route for viewing a user's posts (user_id)
Route::get('user/{user_id}', function ($userId) {
    $posts = get_posts($userId);
    return view('user_posts')->with('posts', $posts);
});

// Define a route for submitting a new post
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
        $user = set_session_name($name);
        $userId = $user["userId"];
        add_post($userId, $postTitle, $post, $date );
        return redirect(url("/"));
    }else{
        return redirect(url("/"))->with('errors', $errors);
    }
   
    
});

// Define a route for liking/unliking a post 
Route::post('like_action', function () {
    $errors = [];
    $name = request('uname');
    $postId =  request('post_id');
    $letters = str_split($name);
    foreach($letters as $letter){
        if(ctype_digit($letter)){
            $errors[] = "User name must not have numeric characters";
            break;
        }
    }
    if (strlen($name) < 3){
        $errors[] = "User name need to have at least 3 characters";
    }
    if (empty($errors)){
        $user = set_session_name($name);
        $userId = $user["userId"];
        $like = get_like($postId, $userId);
        if(empty($like)){
            add_like($postId, $userId);
        }else{
            delete_like($postId, $userId);
        }
        return redirect(url("post/$postId"));
    }else{
        return redirect(url("post/$postId"))->with('errors', $errors);
    }
});

// Define a route for editing a post
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

// Define a route for submitting a new comment
Route::post('new_comment_action', function () {
    $name = request('uname');
    $postId =  request('post_id');
    $message = request('message');
    $date =new DateTime(null, new DateTimeZone("Australia/Brisbane"));
    $letters = str_split($name);
    foreach($letters as $letter){
        if(ctype_digit($letter)){
            $errors[] = "User name must not have numeric characters";
            break;
        }
    }
    if (strlen($name) < 3){
        $errors[] = "User name need to have at least 3 characters";
    }
    if (empty($errors)){
        $user = set_session_name($name);
        $userId = $user["userId"];
        add_comment($userId, $postId, $message, $date);
        return redirect(url("post/$postId"));
    }else{
        return redirect(url("post/$postId"))->with('errors', $errors);
    }
});

// Define a route for submitting a new reply to a comment
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
        $userId = $user["userId"];
        add_comment($userId, $postId, $message, $date, $parentCommentId);
        return redirect(url("post/$postId"));
    }else{
        return redirect(url("post/$postId"))->with('errors', $errors);
    }
    // $post_id = request('post_id');
    // $parent_comment = request('parent_comment_id');

});

// Function to set the session name and id for a user
/*
Functionality: This function sets the session name and ID for a user. 
It checks if the user is already in session and adds them if not.
*/
function set_session_name($name){
    if (session()->has('user')) {
        return $user = session('user');
    }else{
        $user = get_user_by_name($name);
        if ($user == null){
            $user_id = add_user($name);
            $user = [
                "userId" => $user_id,
                "userName" => $name
            ];
        }else{
            $user = [
                "userId" => $user->user_id,
                "userName" => $user->name
            ];
        }
        session()->put('user', $user );
        return $user;
    }
}

// Function to get the user from the session
/*
Functionality: This function retrieves the user from the session, 
returning an empty user if the session does not contain user data
*/
function get_session_user(){
    $user=[
        "userId" => "",
        "userName" => ""
    ];
    if (session()->has('user')) {
        $user = session('user');
    }
    return $user;
}

// Function to sort comments recursively
/*
Functionality: This function recursively sorts comments, 
organizing them into a structure based on parent-child relationships.
*/
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

//Raw SQL queries. 

//Post table queries.

// Function to add a new post. 
//Adds a new post to the database with the specified user ID, title, message, and date.
function add_post($user_id, $title, $message, $date){
    $sql = "INSERT INTO Post (user_id, title, message, date)
            values(?, ?, ?, ? )";
    DB::insert($sql, array($user_id, $title, $message, $date));
}

// Function to get posts
// SQL query to retrieve posts with optional author and post ID filters.
function get_posts($authorId = null, $postId = null){
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
    WHERE user.user_id = post.user_id
    ";

    $params = [];

    if ($authorId !== null) {
        $sql .= " AND user.user_id = ?";
        $params[] = $authorId;
    }

    if ($postId !== null) {
        $sql .= " AND post.post_id = ?";
        $params[] = $postId;
    }

    $sql .= "  ORDER BY post.date DESC";

    $post = DB::select($sql, $params);
    if ($postId !== null && count($post) != 1){
       return null;
    }
    return $post;
}

// Function to delete a post
//Deletes a post from the database based on the given post ID.
function delete_post($post_id){
    $sql = "DELETE FROM post 
            WHERE post_id = ?;";
    DB::delete($sql, array($post_id));
}

// Function to edit a post
// Edits an existing post in the database with the specified title, message, and date.
function edit_post($title, $message, $date, $post_id){
    $sql ="update post set title = ? ,message = ?, date = ? where post_id = ?";
    DB::update($sql,array($title, $message, $date, $post_id));
}

//User table queries.

// Function to add a new user
// Adds a new user to the database with the given name and returns the user's ID.
function add_user($name){
    $sql = "INSERT INTO User (name) values(?);";
    DB::insert($sql, array($name));
    $id = DB::getPdo()->lastInsertId();
    return $id;
}

// Function to retrieve users
// Retrieves a list of distinct users from the database
function get_users(){
    $sql = "SELECT DISTINCT user.user_id, user.name, COUNT(*) AS post_count
    FROM user, post
    WHERE user.user_id = post.user_id
    GROUP BY user.user_id 
    ORDER BY COUNT(*) DESC;";
    $users = DB::select($sql);
    return $users;
}

// Function to get a user by name
// Retrieves a user from the database by their name and returns their information
function get_user_by_name($name){
    $sql = "SELECT * FROM user where name = ?;";
    $user = DB::select($sql, array($name));
    if (count($user) != 1){
       return null;
    }
    return $user[0];
}

//Comment table queries.

// Function to add a new comment or a comment reply.
// Adds a new comment or a reply to a comment in the database 
// with the specified user ID, post ID, message, and date.
function add_comment($userId, $postId, $message, $date, $parentCommentId =null){
    $sql = "INSERT INTO Comment (user_id,parent_comment_id, post_id,message,date) 
            values(?, ?, ?, ?, ?);";
    DB::insert($sql, array($userId,$parentCommentId, $postId, $message, $date));
}

// Function to retrieve comments for a specific post
// Retrieves comments for a specific post from the database, ordered by date.
function get_comments($post_id){
    $sql = "SELECT comment.comment_id, user.name as author, comment.parent_comment_id, comment.post_id, comment.message, comment.date
    FROM comment, user 
    WHERE post_id = ? 
    AND comment.user_id = user.user_id
    ORDER BY date DESC;";
    $comments = DB::select($sql, array($post_id));
    return $comments;
}

// Function to delete comments for a post
// Deletes all comments for a specific post from the database.
function delete_comments($post_id){
    $sql = "DELETE FROM comment 
            WHERE post_id = ?;";
    DB::delete($sql, array($post_id));
}

// Function to add a like for a post
// Adds a like for a post in the database, associating it with the user.
function add_like($post_id, $user_id){
    $sql = "INSERT INTO Post_likes (post_id, user_id)
            VALUES(?, ?)";
    DB::insert($sql, array($post_id, $user_id));
}

// Function to delete a like for a post
// Deletes a like for a post from the database, optionally specifying a user.
function delete_like($post_id, $user_id=null){
    $sql = "DELETE FROM Post_likes 
            WHERE post_id = ?";

    $params = [];
    $params[] = $post_id;
    if ($user_id !== null) {
        $sql .= " AND user_id = ?";
        $params[] = $user_id;
    }

    DB::delete($sql, $params);
}

// Function to retrieve information about a user's like on a post
// Retrieves information about a user's like on a specific post from the database.
function get_like($post_id, $user_id){
    $sql = "SELECT like_id
    FROM post_likes
    WHERE post_likes.post_id = ?
    AND post_likes.user_id = ?;
    ";
    $like = DB::select($sql, array($post_id, $user_id));
    return $like;
}
