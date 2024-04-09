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

--Insert Users
INSERT INTO User (name) VALUES
    ('Alice Johnson'),
    ('Bob Smith'),
    ('Charlie Brown'),
    ('David Williams'),
    ('Emily Davis'),
    ('Fiona Miller'),
    ('George Clark'),
    ('Hannah Lee'),
    ('Isaac Wilson'),
    ('Jasmine Turner');

-- Insert Posts
INSERT INTO Post (user_id, title, message, date) VALUES
    (1, 'My Trip to Paris', 'I had an amazing time exploring Paris!', '2023-08-15'),
    (2, 'New Recipe: Chocolate Cake', 'Here is my favorite chocolate cake recipe.', '2023-08-16'),
    (3, 'Hiking in the Mountains', 'The view from the mountain peak was breathtaking.', '2023-08-17'),
    (4, 'Movie Recommendation', 'Just watched a fantastic movie last night.', '2023-08-18'),
    (5, 'Book Review: The Great Gatsby', 'A classic novel that everyone should read.', '2023-08-19'),
    (3, 'Beach Vacation', 'Just got back from a relaxing beach vacation!', '2023-08-25'),
    (7, 'Hiking Adventure', 'Explored a new hiking trail over the weekend.', '2023-08-26'),
    (8, 'Movie Night', 'Watched a classic movie with friends last night.', '2023-08-27'),
    (9, 'Book Review: Mystery Novel', 'This mystery novel kept me on the edge of my seat.', '2023-08-28'),
    (10, 'Cooking Experiment', 'Tried making sushi for the first time.', '2023-08-29'),
    (4, 'Road Trip to California', 'Just returned from an epic road trip to California!', '2023-08-20'),
    (6, 'Baking Adventure', 'Tried baking croissants for the first time.', '2023-08-21'),
    (1, 'Family Picnic', 'Had a wonderful picnic with my family in the park.', '2023-08-22'),
    (1, 'Book Recommendation: Sci-Fi Fantasy', 'If you love sci-fi and fantasy, you have to read this book.', '2023-08-23'),
    (10, 'Gardening Tips', 'Sharing some gardening tips and tricks.', '2023-08-24');

-- Insert Likes
INSERT INTO Post_likes (user_id, post_id) VALUES
    (5, 6),
    (1, 7),
    (6, 8),
    (3, 9),
    (2, 10),
    (4, 10),
    (8, 9),
    (3, 5),
    (2, 3),
    (5, 1),
    (1, 4),
    (4, 2),
    (10, 3),
    (10, 8),
    (7, 1),
    (2, 5);

-- Insert Comments
INSERT INTO Comment (user_id, parent_comment_id, post_id, message, date) VALUES
    (7, NULL, 6, 'Beach vacations are the best!', '2023-08-25'),
    (8, NULL, 7, 'Which trail did you hike?', '2023-08-26'),
    (9, NULL, 8, 'What movie did you watch?', '2023-08-27'),
    (10, NULL, 9, 'I love mystery novels. Tell me more!', '2023-08-28'),
    (6, NULL, 10, 'Sushi-making is fun but tricky!', '2023-08-29'),
    (5, 1, 6, 'We hiked the Pine Ridge Trail.', '2023-08-26'),
    (1, 6, 6, 'We watched "Casablanca." Classic!', '2023-08-27'),
    (2, 6, 6, 'It took some practice, but it was worth it!', '2023-08-29'),
    (4, NULL, 1, 'California is beautiful!', '2023-08-20'),
    (5, NULL, 12, 'How did the croissants turn out?', '2023-08-21'),
    (1, NULL, 3, 'Family time is precious.', '2023-08-22'),
    (3, NULL, 4, "I'm a fan of sci-fi. What's the book called?", '2023-08-23'),
    (2, NULL, 5, 'Looking forward to your gardening tips!', '2023-08-24'),
    (5, 10, 12, 'The croissants were delicious!', '2023-08-21'),
    (1, 11, 3, 'Agreed, family time is the best.', '2023-08-22'),
    (3, 12, 4, 'The book is called "Galactic Odyssey."', '2023-08-23'),
    (7, NULL, 1, 'I bet the scenery was breathtaking.', '2023-08-20');