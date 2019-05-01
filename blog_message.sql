create table message
(
  id         varchar(36)   not null
    primary key,
  title      text          null,
  content    text          null,
  userId     varchar(36)   not null,
  hasRead    int default 0 null,
  createTime int           null,
  updateTime int           null
);

INSERT INTO blog.message (id, title, content, userId, hasRead, createTime, updateTime) VALUES ('0189aefd-437f-42cb-a4f7-f6a6826ba545', '你的文章《test》被点击了', '你的文章《test》被点击了，当前总的点击数19', 'xxxx', 0, 1556739156, 1556739156);
INSERT INTO blog.message (id, title, content, userId, hasRead, createTime, updateTime) VALUES ('59cc7d5b-1b27-46fe-b0fe-d183364980ce', '你的文章《test》被点击了', '你的文章《test》被点击了，当前总的点击数18', 'xxxx', 0, 1556739155, 1556739155);
INSERT INTO blog.message (id, title, content, userId, hasRead, createTime, updateTime) VALUES ('e0f47496-01c5-4b86-bedd-a4d79c070143', '你的文章《test》被点击了', '你的文章《test》被点击了', 'xxxx', 0, 1556739103, 1556739103);