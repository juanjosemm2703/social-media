
INSERT INTO User (name) VALUES
    ('Alice'),
    ('Bob'),
    ('Charlie'),
    ('David');


INSERT INTO Post (user_id, title, message, date) VALUES
    (1, 'Post 1', 'This is the first post.', '2023-09-01'),
    (2, 'Post 2', 'Hello, everyone!', '2023-09-02'),
    (3, 'Post 3', 'Just testing the app.', '2023-09-03'),
    (4, 'Post 4', 'Feeling great today!', '2023-09-04');


INSERT INTO Post_likes (user_id, post_id) VALUES
    (2, 1),
    (3, 1),
    (1, 2),
    (4, 2),
    (1, 3),
    (2, 4);


INSERT INTO Comment (user_id, parent_comment_id, post_id, message, date) VALUES
    (1, NULL, 1, 'Nice post!', '2023-09-01'),
    (2, NULL, 1, 'I agree!', '2023-09-01'),
    (3, NULL, 2, 'Hello, Bob!', '2023-09-02'),
    (4, NULL, 3, 'Testing comments.', '2023-09-03'),
    (1, 1, 1, 'Thank you, Alice!', '2023-09-01'),
    (2, 1, 1, "You're welcome, Bob!", '2023-09-01');