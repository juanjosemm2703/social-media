SELECT user.name as author, post.post_id, post.title, post.message, post.date, 
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
        AND post_likes.user_id = ""
    ) AS user_liked
    FROM user, post, post_likes 
    WHERE post.post_id = 3
    AND user.user_id = post.user_id
    GROUP BY post.post_id