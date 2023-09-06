DROP TABLE IF EXISTS Comment;

DROP TABLE IF EXISTS Post_likes;

DROP TABLE IF EXISTS Post;

DROP TABLE IF EXISTS User;

CREATE TABLE User (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT UNIQUE NOT NULL
);

CREATE TABLE Post (
    post_id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    title VARCHAR(80) NOT NULL,
    message VARCHAR(160) NOT NULL,
    date TEXT,
    FOREIGN KEY (user_id) REFERENCES User(user_id)
);

CREATE TABLE Post_likes (
    like_id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    post_id INTEGER,
    FOREIGN KEY (user_id) REFERENCES User(user_id),
    FOREIGN KEY (post_id) REFERENCES Post(post_id)
);

CREATE TABLE Comment (
    comment_id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    parent_comment_id INTEGER,
    post_id INTEGER,
    message VARCHAR(160) NOT NULL,
    date TEXT,
    FOREIGN KEY (user_id) REFERENCES User(user_id),
    FOREIGN KEY (parent_comment_id) REFERENCES Comment(comment_id),
    FOREIGN KEY (post_id) REFERENCES Post(post_id)
);