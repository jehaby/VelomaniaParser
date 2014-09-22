PRAGMA foreign_keys=ON;
BEGIN TRANSACTION;

CREATE TABLE User (
user_id INTEGER PRIMARY KEY,
username TEXT NOT NULL,
password TEXT NOT NULL
);

INSERT INTO "User" VALUES(1,'urf','7e169b8d621f031e58ee5f5f7dca1401');

CREATE TABLE Pattern (
pattern_id INTEGER PRIMARY KEY,
pattern TEXT NOT NULL
);
INSERT INTO "Pattern" VALUES(1,'рюкзак');
INSERT INTO "Pattern" VALUES(2,'нож');
INSERT INTO "Pattern" VALUES(3,'баобаб бля');
INSERT INTO "Pattern" VALUES(4,'ёлка И иголка');

CREATE TABLE UserPattern (
user_id INTEGER REFERENCES User(user_id),
pattern_id INTEGER REFERENCES Pattern(pattern_id),
PRIMARY KEY(user_id, pattern_id)
);

INSERT INTO "UserPattern" VALUES(1,1);
INSERT INTO "UserPattern" VALUES(1,2);
INSERT INTO "UserPattern" VALUES(1,3);
INSERT INTO "UserPattern" VALUES(1,4);

CREATE TABLE Theme (
  theme_id INTEGER PRIMARY KEY,
  title TEXT NOT NULL,
  author TEXT NOT NULL
);
INSERT INTO "Theme" VALUES(1,'рюкзак','Врунгель');
INSERT INTO "Theme" VALUES(2,'Куплю нож','Сява');

CREATE TABLE PatternTheme (
  pattern_id INTEGER NOT NULL REFERENCES Pattern(pattern_id) ON DELETE CASCADE ,
  theme_id INTEGER NOT NULL REFERENCES Theme(theme_id ) ON DELETE CASCADE
);
INSERT INTO "PatternTheme" VALUES(1,1);
INSERT INTO "PatternTheme" VALUES(1,2);
COMMIT;
