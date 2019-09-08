drop database if exists blog;
create database blog;
use blog;
drop table if exists article;
create table article
(
    id           varchar(36)                not null primary key,
    title        text                       null comment '名字',
    summary      text                       null comment '简介',
    mdContent    text                       null comment 'md格式的内容',
    htmlContent  text                       null comment 'html 格式的内容',
    author       varchar(15) default ''     null comment '作者',
    status       int         default 0      null comment '状态，0：正常，1：删除，2：置顶',
    isCanComment int         default 1      null comment '是否可评论，0：不可评论，1：可评论',
    sort         int         default 0      null comment '排序',
    clickCount   int         default 0      null comment '点击量',
    categoryId   varchar(36) default ''     null comment '分类 ID',
    year         varchar(4)  default '2019' null comment '年份',
    createTime   int                        not null comment '创建时间',
    updateTime   int                        not null comment '更新时间'
);


drop table if exists category;
create table category
(
    id          varchar(36)            not null primary key,
    name        varchar(20) default '' null comment '名字',
    description text                   null comment '描述',
    createTime  int                    not null comment '创建时间'
);
drop table if exists tag;
create table tag
(
    id         varchar(36)            not null primary key,
    name       varchar(20) default '' null comment '名字',
    createTime int                    not null comment '创建时间'
);

drop table if exists article_relation_tag;
create table article_relation_tag
(
    id         varchar(36) not null primary key,
    articleId  varchar(36) not null,
    tagId      varchar(36) not null,
    createTime int         not null comment '创建时间'
);


drop table if exists user;
create table user
(
    id            varchar(36)            not null primary key,
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

drop table if exists message;
create table message
(
    id         varchar(36)   not null primary key,
    title      text          null,
    content    text          null,
    toUserId     varchar(36)   not null,
    fromUserId     varchar(36)   not null,
    hasRead    int default 0 null,
    createTime int           null
);
