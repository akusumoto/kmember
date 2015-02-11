DROP TABLE IF EXISTS activities;
DROP TABLE IF EXISTS member_histories;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS member_types;
DROP TABLE IF EXISTS statuses;
DROP TABLE IF EXISTS parts;
DROP TABLE IF EXISTS sexes;
DROP TABLE IF EXISTS bloods;
DROP TABLE IF EXISTS settings;



CREATE TABLE settings (
    id       INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(50)     NOT NULL,
    value    TEXT            DEFAULT NULL,
    created  DATETIME        DEFAULT NULL,
    modified DATETIME        DEFAULT NULL
);

INSERT INTO settings (name, value, created) VALUES ('mail.full.from', 'notice@thanks-k.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.full.to', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.full.cc', 'thanksk.orch@gmail.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.full.bcc', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.full.subject', 'Welcome to THANKS!K ORCHESTRA!! ((#nickname#))さん', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.full.body', 'Thanks!K オーケストラへようこそ！\n入団ありがとうございます！\n\n・メンバーズサイト： Redmine\nhttp://private.thanks-k.com/redmine\n\n・ファイル置き場： OwnCloud\nhttp://private.thanks-k.com/owncloude\n\n・まとめサイト\nhttp://private.thanks-k.com/member/matome\n\n== 入力情報 ====================\nパート：((#part#))\nニックネーム：((#nickname#))\n名前：((#name#))\nメールアドレス：((#email#))\n電話番号：((#phone#))\nRedmine アカウント：((#account#))\n性別：((#sex#))\n血液型：((#blood#))\n誕生日：((#birth#))\n住所：((#home_address#))\n 勤務先：((#work_name#))\n勤務先住所：((#work_address#))\n勤務先電話番号：((#work_phone#))\n社会人・学生：((#member_type#))\n特筆事項：((#note#))\n== 入力情報 ====================\n', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.from', 'notice@thanks-k.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.to', 'gkusumoto@gmail.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.cc', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.bcc', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.subject', '【通知】((#nickname#))さんが入団されました', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.body', '((#nickname#))さんが入団されました\n\nパート：((#part#))\nニックネーム：((#nickname#))\n名前：((#name#))\nRedmine アカウント：((#account#))\nメールアドレス：((#email#))', NOW());
INSERT INTO settings (name, value, created) VALUES ('member.join.password', 'kanno123', NOW());


-- parts
--   1 ... Vn1 ... 1st violin
--   2 ... Vn2 ... 2nd violin
--   3 ... Va  ... viola
--   4 ... Vc  ... chello
--   5 ... Cb  ... contrabass
--   6 ... Fl  ... flute
--   7 ... Cl  ... clarinet
--   8 ... Fg  ... fagot
--   9 ... Hr  ... Horn
--   10 ... Tp  ... Trumpet
--   11 ... Tb  ... Tronbone
--   12 ... Tu  ... Tuba
--   13 ... Perc ... Percassion
--   14 ... Gt  ... Guiter
--   15 ... Pf  ... Piano
--   16 ... ChoSp ... Chorus Soprano
--   17 ... ChoAt ... Chorus Alto
--   18 .... ChoTn ... Chorus Tenor
--   19 .... ChoBs ... Chorus Bass
--   20 .... Cond ... conductor
--   0 ... staff
CREATE TABLE parts (
    id          INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50)     NOT NULL UNIQUE
--    created     DATETIME        DEFAULT NULL,
--    modified    DATETIME        DEFAULT NULL
);

INSERT INTO parts (name) VALUES ('Vn1'); -- 1
INSERT INTO parts (name) VALUES ('Vn2'); -- 2
INSERT INTO parts (name) VALUES ('Va');
INSERT INTO parts (name) VALUES ('Vc');
INSERT INTO parts (name) VALUES ('Cb');
INSERT INTO parts (name) VALUES ('Fl');
INSERT INTO parts (name) VALUES ('Cl');
INSERT INTO parts (name) VALUES ('Fg');
INSERT INTO parts (name) VALUES ('Hr');
INSERT INTO parts (name) VALUES ('Tp');
INSERT INTO parts (name) VALUES ('Tb');
INSERT INTO parts (name) VALUES ('Tu');
INSERT INTO parts (name) VALUES ('Perc');
INSERT INTO parts (name) VALUES ('Gt');
INSERT INTO parts (name) VALUES ('Pf');
INSERT INTO parts (name) VALUES ('Cho Sp');
INSERT INTO parts (name) VALUES ('Cho Al');
INSERT INTO parts (name) VALUES ('Cho Tn');
INSERT INTO parts (name) VALUES ('Cho Bs');
INSERT INTO parts (name) VALUES ('Cond');
INSERT INTO parts (name) VALUES ('Staff');


-- statuses
--   1 ... active
--   2 ... resting
--   3 ... left
CREATE TABLE statuses (
    id          INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50)     NOT NULL UNIQUE
--    created     DATETIME        DEFAULT NULL,
--    modified    DATETIME        DEFAULT NULL
);

INSERT INTO statuses (name) VALUES ('在籍'); -- 1
INSERT INTO statuses (name) VALUES ('休団中'); -- 2
INSERT INTO statuses (name) VALUES ('退団'); -- 3

CREATE TABLE sexes (
    id          INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(10)      NOT NULL UNIQUE
--    created  DATETIME        DEFAULT NULL,
--    modified DATETIME        DEFAULT NULL
);

INSERT INTO sexes (name) VALUES ('男');  -- 1
INSERT INTO sexes (name) VALUES ('女');  -- 2

CREATE TABLE bloods (
    id          INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(4)      NOT NULL
--    created  DATETIME        DEFAULT NULL,
--    modified DATETIME        DEFAULT NULL
);

INSERT INTO bloods (name) VALUES ('A');   -- 1
INSERT INTO bloods (name) VALUES ('B');   -- 2
INSERT INTO bloods (name) VALUES ('O');   -- 3
INSERT INTO bloods (name) VALUES ('AB');  -- 4


CREATE TABLE member_types (
    id          INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50)     NOT NULL
--    created  DATETIME        DEFAULT NULL,
--    modified DATETIME        DEFAULT NULL
);

INSERT INTO member_types (name) VALUES ('社会人');    -- 1
INSERT INTO member_types (name) VALUES ('学生');  -- 2


CREATE TABLE members ( 
    id              INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    part_id         INT             UNSIGNED NOT NULL,
    nickname        VARCHAR(50)     NOT NULL,
    name            VARCHAR(50)     NOT NULL,
    account         VARCHAR(50)     NOT NULL,
    sex_id          INT             UNSIGNED NOT NULL,
    blood_id        INT             UNSIGNED NOT NULL,
    birth           DATE            NOT NULL,
    home_address    TEXT            NOT NULL,
    phone           VARCHAR(20)     NOT NULL, 
    email           VARCHAR(256)    NOT NULL,
    work_name       TEXT            DEFAULT NULL,
    work_address    TEXT            DEFAULT NULL,
    work_phone      VARCHAR(20)     DEFAULT NULL,
    member_type_id   INT             UNSIGNED NOT NULL,
    parent_phone    VARCHAR(20)     DEFAULT NULL,
    note            TEXT            DEFAULT NULL,
    status_id       INT             UNSIGNED NOT NULL DEFAULT 1,
    created         DATETIME        DEFAULT NULL,
    modified        DATETIME        DEFAULT NULL,

    FOREIGN KEY part_key(part_id) REFERENCES parts(id),
    FOREIGN KEY sex_key(sex_id) REFERENCES sexes(id),
    FOREIGN KEY blood_key(blood_id) REFERENCES bloods(id),
    FOREIGN KEY member_type_key(member_type_id) REFERENCES member_types(id),
    FOREIGN KEY status_key(status_id) REFERENCES statuses(id)
);



CREATE TABLE member_histories ( 
    id          INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    member_id   INT             UNSIGNED NOT NULL,
    reason      TEXT            DEFAULT NULL,

    part_id     INT             UNSIGNED NOT NULL,
    nickname    VARCHAR(50)     NOT NULL,
    name        VARCHAR(50)     NOT NULL,
    account     VARCHAR(50)     NOT NULL,
    sex_id      INT             UNSIGNED NOT NULL,
    blood_id    INT             UNSIGNED NOT NULL,
    birth       DATE            NOT NULL,
    home_address TEXT           NOT NULL,
    phone       VARCHAR(20)     NOT NULL, 
    email       VARCHAR(256)    NOT NULL,
    work_name   TEXT            DEFAULT NULL,
    work_address TEXT           DEFAULT NULL,
    work_phone  VARCHAR(20)     DEFAULT NULL,
    member_type_id  INT          UNSIGNED NOT NULL,
    parent_phone VARCHAR(20)    DEFAULT NULL,
    note        TEXT            DEFAULT NULL,
    status_id   INT             UNSIGNED NOT NULL,
    created     DATETIME        DEFAULT NULL,
    modified    DATETIME        DEFAULT NULL,

    FOREIGN KEY member_key(member_id) REFERENCES members(id),
    FOREIGN KEY part_key(part_id) REFERENCES parts(id),
    FOREIGN KEY sex_key(sex_id) REFERENCES sexes(id),
    FOREIGN KEY blood_key(blood_id) REFERENCES bloods(id),
    FOREIGN KEY member_type_key(member_type_id) REFERENCES member_types(id),
    FOREIGN KEY status_key(status_id) REFERENCES statuses(id)
);


CREATE TABLE activities (
    id       INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    member_id INT            UNSIGNED NOT NULL,
    action   TEXT            NOT NULL,
    created  DATETIME        DEFAULT NULL,
    modified DATETIME        DEFAULT NULL,

    FOREIGN KEY member_key(member_id) REFERENCES members(id)
);


CREATE TABLE users (
    id          INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(50)     NOT NULL UNIQUE,
    password    VARCHAR(255)    NOT NULL UNIQUE
);

INSERT INTO (username, password) VALUES ('kmanage', '$2y$10$uuRM76LYjw5BFaFoUjGiJuXud.DoVW4QxGcQ/sLbe.IEwxDZnAqV2');

CREATE TABLE matomes (
    id          INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    parent_id   INT             UNSIGNED DEFAULT NULL,
    name        VARCHAR(255)    NOT NULL UNIQUE,
    body        TEXT
);

INSERT INTO matomes (name) VALUES ('TOP'); -- top page id=1 name=top


