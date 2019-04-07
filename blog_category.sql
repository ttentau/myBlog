create table category
(
    id          varchar(36)            not null
        primary key,
    parentId    varchar(36) default '' null,
    name        text                   null,
    description text                   null,
    createTime  int                    not null,
    status      int         default 0  null
);

create index status
    on category (status);

INSERT INTO blog.category (id, parentId, name, description, createTime, status) VALUES ('9cd70c69-cc0b-417b-b492-1161aeaf28ff', '', '324', null, 1554563109, 0);
INSERT INTO blog.category (id, parentId, name, descriptionœ, createTime, status) VALUES ('a4190e4a-8c5f-44d2-b33c-aae650fb673a', '', '666', null, 1554562505, 0);