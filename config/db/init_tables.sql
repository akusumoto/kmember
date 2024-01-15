DROP TABLE IF EXISTS matomes;
DROP TABLE IF EXISTS users;
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
INSERT INTO settings (name, value, created) VALUES ('mail.full.subject', 'Welcome to THANKS!K ORCHESTRA!!', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.full.body', 'Thanks!K オーケストラへようこそ！\n入団ありがとうございます！\n\n・メンバーズサイト： Redmine\nhttp://private.thanks-k.com/redmine\n\n・ファイル置き場： OwnCloud\nhttp://private.thanks-k.com/owncloude\n\n・まとめサイト\nhttp://private.thanks-k.com/member/matome\n\n== 入力情報 ====================\nパート：((#part#))\nニックネーム：((#nickname#))\n名前：((#name#))\nメールアドレス：((#email#))\nRedmine アカウント：((#account#))\n住所：((#home_address#))\n 勤務先住所：((#work_address#))\n社会人・学生：((#member_type#))\n特筆事項：((#note#))\n== 入力情報 ====================\n', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.from', 'notice@thanks-k.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.to', 'gkusumoto@gmail.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.cc', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.bcc', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.subject', '【通知】((#nickname#))さんが入団されました', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.abst.body', '((#nickname#))さんが入団されました\n\nパート：((#part#))\nニックネーム：((#nickname#))\n名前：((#name#))\nRedmine アカウント：((#account#))\nメールアドレス：((#email#))', NOW());
INSERT INTO settings (name, value, created) VALUES ('member.join.password', 'kanno123', NOW());
INSERT INTO settings (name, value, created) VALUES ('member.rule', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leavetemp.from', 'notice@thanks-k.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leavetemp.to', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leavetemp.cc', 'managers@thanks-k.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leavetemp.bcc', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leavetemp.subject', '休団通知', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leavetemp.body', '((#nickname#))様\n\n休団承りました。\n\nThanks!Kオーケストラ運営', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.rejoin.from', 'notice@thanks-k.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.rejoin.to', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.rejoin.cc', 'managers@thanks-k.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.rejoin.bcc', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.rejoin.subject', '復団通知', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.rejoin.body', '((#nickname#))様\n\n復団承りました。\n\nThanks!Kオーケストラ運営', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leave.from', 'notice@thanks-k.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leave.to', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leave.cc', 'managers@thanks-k.com', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leave.bcc', '', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leave.subject', '退団通知', NOW());
INSERT INTO settings (name, value, created) VALUES ('mail.leave.body', '((#nickname#))様\n\n退団承りました。\n\nThanks!Kオーケストラ運営', NOW());


-- parts
--   1 ... Vn1 ... 1st violin
--   2 ... Vn2 ... 2nd violin
--   3 ... Va  ... viola
--   4 ... Vc  ... chello
--   5 ... Cb  ... contrabass
--   6 ... Fl  ... flute
--   7 ... Cl  ... clarinet
--   8 ... Sax  ... Saxophone
--   9 ... Fg  ... fagot
--   10 ... Hr  ... Horn
--   11 ... Tp  ... Trumpet
--   12 ... Tb  ... Tronbone
--   13 ... Tu  ... Tuba
--   14 ... Perc ... Percassion
--   15 ... Syn ... Synthesizer
--   16 ... Gt  ... Guiter
--   17 ... Pf  ... Piano
--   18 ... ChoSp ... Chorus Soprano
--   19 ... ChoAt ... Chorus Alto
--   20 .... ChoTn ... Chorus Tenor
--   21 .... ChoBs ... Chorus Bass
--   22 .... Cond ... conductor
--   23 ... staff
--   24 ... Hp ... Harp
CREATE TABLE parts (
    id          INT             UNSIGNED PRIMARY KEY,
    name        VARCHAR(50)     NOT NULL UNIQUE
--    created     DATETIME        DEFAULT NULL,
--    modified    DATETIME        DEFAULT NULL
);

INSERT INTO parts (id, name) VALUES ('1', 'Vn1'); -- 1
INSERT INTO parts (id, name) VALUES (2, 'Vn2'); -- 2
INSERT INTO parts (id, name) VALUES (3, 'Va');
INSERT INTO parts (id, name) VALUES (4, 'Vc');
INSERT INTO parts (id, name) VALUES (5, 'Cb');
INSERT INTO parts (id, name) VALUES (11, 'Fl');
INSERT INTO parts (id, name) VALUES (12, 'Cl');
INSERT INTO parts (id, name) VALUES (13, 'Sax');
INSERT INTO parts (id, name) VALUES (14, 'Fg');
INSERT INTO parts (id, name) VALUES (15, 'Ob');
INSERT INTO parts (id, name) VALUES (21, 'Hr');
INSERT INTO parts (id, name) VALUES (22, 'Tp');
INSERT INTO parts (id, name) VALUES (23, 'Tb');
INSERT INTO parts (id, name) VALUES (24, 'Tu');
INSERT INTO parts (id, name) VALUES (31, 'Perc');
INSERT INTO parts (id, name) VALUES (32, 'Hp');
INSERT INTO parts (id, name) VALUES (41, 'Gt');
INSERT INTO parts (id, name) VALUES (42, 'Syn');
INSERT INTO parts (id, name) VALUES (43, 'Bs');
INSERT INTO parts (id, name) VALUES (45, 'Pf');
INSERT INTO parts (id, name) VALUES (51, 'Cho Sp');
INSERT INTO parts (id, name) VALUES (52, 'Cho Al');
INSERT INTO parts (id, name) VALUES (53, 'Cho Tn');
INSERT INTO parts (id, name) VALUES (54, 'Cho Bs');
INSERT INTO parts (id, name) VALUES (90, 'Cond');
INSERT INTO parts (id, name) VALUES (99, 'Staff');


-- statuses
--   1 ... active
--   2 ... resting
--   3 ... left
CREATE TABLE statuses (
    id          INT             UNSIGNED PRIMARY KEY,
    name        VARCHAR(50)     NOT NULL UNIQUE
--    created     DATETIME        DEFAULT NULL,
--    modified    DATETIME        DEFAULT NULL
);

INSERT INTO statuses (id, name) VALUES (1, '在籍'); -- 1
INSERT INTO statuses (id, name) VALUES (2, '休団中'); -- 2
INSERT INTO statuses (id, name) VALUES (3, '退団'); -- 3

CREATE TABLE member_types (
    id          INT             UNSIGNED PRIMARY KEY,
    name        VARCHAR(50)     NOT NULL
--    created  DATETIME        DEFAULT NULL,
--    modified DATETIME        DEFAULT NULL
);

INSERT INTO member_types (id, name) VALUES (1, '社会人');    -- 1
INSERT INTO member_types (id, name) VALUES (2, '学生');  -- 2


CREATE TABLE members ( 
    id              INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    part_id         INT             UNSIGNED NOT NULL,
    nickname        VARCHAR(50)     NOT NULL UNIQUE,
    name            VARCHAR(50)     NOT NULL UNIQUE,
    account         VARCHAR(50)     NOT NULL UNIQUE,
    email           VARCHAR(255)    NOT NULL UNIQUE,
    home_address    TEXT            DEFAULT NULL,
    work_address    TEXT            DEFAULT NULL,
    emergency_phone VARCHAR(20)     DEFAULT NULL,
    note            TEXT            DEFAULT NULL,
    member_type_id  INT             UNSIGNED NOT NULL,
    status_id       INT             UNSIGNED NOT NULL DEFAULT 1,
    created         DATETIME        DEFAULT NULL,
    modified        DATETIME        DEFAULT NULL,

    FOREIGN KEY part_key(part_id) REFERENCES parts(id),
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
    email       VARCHAR(255)    NOT NULL,
    home_address TEXT           NOT NULL,
    work_address TEXT           DEFAULT NULL,
    emergency_phone VARCHAR(20) DEFAULT NULL,
    note        TEXT            DEFAULT NULL,
    member_type_id  INT         UNSIGNED NOT NULL,
    status_id   INT             UNSIGNED NOT NULL,
    created     DATETIME        DEFAULT NULL,
    modified    DATETIME        DEFAULT NULL,

    FOREIGN KEY member_key(member_id) REFERENCES members(id),
    FOREIGN KEY part_key(part_id) REFERENCES parts(id),
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

INSERT INTO users (username, password) VALUES ('kmanage', '$2y$10$uuRM76LYjw5BFaFoUjGiJuXud.DoVW4QxGcQ/sLbe.IEwxDZnAqV2');

CREATE TABLE matomes (
    id          INT             UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    parent_id   INT             UNSIGNED DEFAULT NULL,
    name        VARCHAR(255)    NOT NULL UNIQUE,
    body        TEXT
);

INSERT INTO matomes (name) VALUES ('TOP'); -- top page id=1 name=top


