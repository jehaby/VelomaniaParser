CREATE TABLE User (
user_id INTEGER PRIMARY KEY,
username TEXT NOT NULL,
password TEXT NOT NULL
);

CREATE TABLE Keyword (
keyword_id INTEGER PRIMARY KEY,
keyword TEXT NOT NULL
);

CREATE TABLE UserKeyword (
user_id INTEGER REFERENCES User(user_id),
keyword_id INTEGER REFERENCES Keyword(keyword_id),
PRIMARY KEY(user_id, keyword_id)
);
