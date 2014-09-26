CREATE TABLE User (
  user_id INTEGER PRIMARY KEY,
  username TEXT NOT NULL,
  password TEXT NOT NULL
);

CREATE TABLE Pattern (
  pattern_id INTEGER PRIMARY KEY,
  pattern TEXT NOT NULL
);

CREATE TABLE UserPattern (
  user_id INTEGER REFERENCES User(user_id),
  pattern_id INTEGER REFERENCES Pattern(pattern_id),
PRIMARY KEY(user_id, pattern_id)
);

CREATE TABLE Theme (
  theme_id INTEGER PRIMARY KEY,
  title TEXT NOT NULL,
  author TEXT NOT NULL
);

CREATE TABLE PatternTheme (
  pattern_id INTEGER REFERENCES Pattern(pattern_id),
  theme_id INTEGER REFERENCES Theme(theme_id)
  PRIMARY KEY
);

CREATE TABLE UselessTheme (
theme_id INTEGER PRIMARY KEY
);