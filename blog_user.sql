create table user
(
    id            varchar(36)            not null
        primary key,
    username      varchar(15) default '' not null,
    password      varchar(32)            not null,
    account       varchar(15) default '' not null,
    description   text                   null,
    phone         text                   null,
    sex           int                    null,
    email         text                   null,
    avatar        text                   null,
    createTime    int                    not null,
    updateTime    int                    not null,
    ip            varchar(20) default '' null,
    loginTime     int                    null,
    lastLoginTime int                    null,
    status        int         default 0  null,
    isAdmin       int         default 0  null
);

INSERT INTO blog.user (id, username, password, account, description, phone, sex, email, avatar, createTime, updateTime, ip, loginTime, lastLoginTime, status, isAdmin) VALUES ('1212', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'ttentau', null, '15928584225', 1, 'ttentau@163.com', '''''', 1554572777, 1554580207, '127.0.0.1', 1554580207, 1554580186, 0, 1);