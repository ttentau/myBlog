drop database if exists blog;
create database blog;
use blog;
drop table if exists article;
create table article
(
    id         varchar(36)            not null
        primary key,
    title      text                   null,
    summary    text                   null,
    content    text                   null,
    createTime int                    not null,
    updateTime int                    not null,
    author     varchar(15) default '' null,
    status     int         default 0  null,
    isComment  int         default 0  null,
    clickCount int         default 0  null,
    categoryId varchar(36) default '' null
);

create index createTime
    on article (createTime);

create index status
    on article (status);

create index updateTime
    on article (updateTime);

INSERT INTO blog.article (id, title, summary, content, createTime, updateTime, author, status, isComment, clickCount,
                          categoryId)
VALUES ('0eee0c84-4668-4255-8829-781ca8f801ba', '122', '12', '<p>132</p>', 1554572183, 1554580505, '1', 0, 0, 0,
        '9cd70c69-cc0b-417b-b492-1161aeaf28ff');
INSERT INTO blog.article (id, title, summary, content, createTime, updateTime, author, status, isComment, clickCount,
                          categoryId)
VALUES ('65c0d492-1373-42f6-80c7-1f38ca1e0e74', '这些名字，习近平常思之念之',
        '有一些人，虽已离去，却永被铭记；有一种精神，穿越时空，却历久弥新。又到一年清明时。在历史烟云与现实光影中穿行，我们一起走近习近平深情缅怀过的他们，感悟伟大情怀，汲取前行力量。追思，奉献牺牲的人民英雄2016年2月2日，习近平在井冈山革命烈士陵园向革命烈士敬献花篮。烽火硝烟的岁月里，华北平原一个普通庄...',
        '<div><div><p>有一些人，虽已离去，却永被铭记；</p><p>有一种精神，穿越时空，却历久弥新。</p><p>又到一年清明时。在历史烟云与现实光影中穿行，我们一起走近习近平深情缅怀过的他们，感悟伟大情怀，汲取前行力量。</p><p><strong>追思，奉献牺牲的人民英雄</strong></p><p></p><div><img src="http://p1.pstatp.com/large/pgc-image/671b41a445f741af90c893e89c7635a9" img_width="500" img_height="370" alt="这些名字，习近平常思之念之" inline="0"><p></p></div><p><br></p><p>2016年2月2日，习近平在井冈山革命烈士陵园向革命烈士敬献花篮。</p><p>烽火硝烟的岁月里，华北平原一个普通庄户人家门口写着这样一副对联：万众一心保障国家独立，百折不挠争取民族解放。</p><p>横批：抗战到底。</p><p>这短短二十四个字，穿越半个多世纪的沧海桑田，如今依旧苍劲有力，熠熠生辉。</p><p>“这是中华儿女同日本侵略者血战到底的怒吼，是中华民族抗战必胜的宣言。”</p><p>犹记得狼牙山上，弹尽粮绝，殊死反抗；乌斯浑河畔，八女英灵，荡气回肠；英雄母亲，舍家纾难，感天动地......</p><p>一寸山河一寸血，一抔热土一抔魂。</p><p>无论处于何种境遇，先烈们的大无畏革命精神都犹如长风出谷、雷霆万钧，迸发出的力量穿越峥嵘岁月，支撑起中华民族的脊梁。</p><p>2019年3月底，四川省凉山州木里县境内发生森林火灾。由于扑火行动中突发林火爆燃，30名扑火人员壮烈牺牲。</p><p>山火无情，能够夺走生命，却烧不掉英雄气概！</p><p></p><div><img src="http://p1.pstatp.com/large/pgc-image/795e520c5682410e86a1437df0ad2578" img_width="500" img_height="350" alt="这些名字，习近平常思之念之" inline="0"><p></p></div><p><br></p><p>多支森林消防队伍举行默哀仪式，悼念四川凉山木里火灾中牺牲的30名扑火英雄。</p><p>“长期以来，消防队伍作为同老百姓贴得最近、联系最紧的队伍，有警必出、闻警即动，奋战在人民群众最需要的地方，特别是在重大灾害事故面前，你们不畏艰险、冲锋在前，作出了突出贡献。”</p><p>诚哉斯言，英雄不孤。</p><p>习近平对消防队伍的评价不仅是对英雄的慰藉，更是对英雄精神的鼓舞。</p><p>当地时间2016年7月10日，南苏丹首都朱巴市区交火持续进行，中国维和步兵营外勤分队执行维和任务时突遭袭击，杨树朋、李磊两名维和战士牺牲，另有5人受伤。</p><p>第一时间，统帅一声令下，中国军队派出工作组赶赴当地，飞越一万多公里，把英雄接回了家。以国之名，祭奠铭记。</p><p>英雄走好，祖国不会忘记你。就在此前一年，习近平在纽约联合国总部出席联合国维和峰会时，特别讲述了中国维和女警察和志虹的故事：“5年前，中国维和女警察和志虹在海地执行联合国维和任务时不幸殉职，留下年仅4岁的幼子和年逾花甲的父母。”</p><p>一字一句，饱含深情。</p><p>2016年春节前夕，习近平赴江西看望革命烈士后代和先进人物代表时强调：“对一切为党、为国家、为人民作出奉献和牺牲的英雄模范人物，我们都要发扬他们的精神，从他们身上汲取奋发的力量，共同为推进中国特色社会主义伟大事业、实现中华民族伟大复兴的中国梦而顽强奋斗、艰苦奋斗、不懈奋斗。”</p><p><strong>缅怀，一心为民的好干部</strong></p><p>习近平念念不忘的，还有为党和人民服务一生的好干部。</p><p>焦裕禄，就是其中之一。习近平形容他：“一生都在为党分忧、为党添彩”“心里只装着群众，只想着群众，唯独没有他自己”“铸就了亲民爱民、艰苦奋斗、科学求实、迎难而上、无私奉献的焦裕禄精神”。</p><p></p><div><img src="http://p1.pstatp.com/large/pgc-image/4aee4ce20d734a40bc40617c2d9eefd7" img_width="500" img_height="354" alt="这些名字，习近平常思之念之" inline="0"><p></p></div><p><br></p><p>2014年3月17日，习近平重访河南省兰考县，参观焦裕禄同志纪念馆。</p><p>读初中一年级时，习近平听了焦裕禄肝癌晚期用棍子顶着肝部坚持工作，把藤椅顶出一个大窟窿的故事，“受到深深震撼”。后来，“无论是上山下乡、上大学、参军入伍，还是做领导工作”，焦裕禄这个名字始终在习近平心中闪烁。</p><p>“焦裕禄同志是一个很高很高的标杆，虽不可及，但我们要见贤思齐。”</p><p>“焦裕禄精神跨越时空，永远不会过时。”</p><p>……</p><p>恳切的话语凝结着习近平对焦裕禄的深切思念和对焦裕禄精神发自内心的呼唤。</p><p>习近平常提起的好干部，还有谷文昌。他带领福建东山县人民苦干14年，把一座荒岛变成了宝岛。谷文昌病逝后，有当地百姓自愿为他守墓一生。</p><p></p><div><img src="http://p3.pstatp.com/large/pgc-image/f7b8b8f7382d48e2a33badd75a50a3b5" img_width="500" img_height="377" alt="这些名字，习近平常思之念之" inline="0"><p></p></div><p><br></p><p>谷文昌同志1958年在福建省东山县坑北村参加播种。</p><p>2005年，时任浙江省委书记的习近平在浙江日报《之江新语》专栏发表了一篇题为《“潜绩”与“显绩”》的文章，以谷文昌为例谈正确的政绩观：“不追求轰轰烈烈的‘显绩’，而是默默无闻地奉献”“在老百姓心中树起了一座不朽的丰碑”。</p><p>10年后，身为党和国家最高领导人，习近平在会见全国优秀县委书记时再一次深情地谈起谷文昌，叮嘱大家要以这些好干部为榜样，始终做到心中有党、心中有民、心中有责、心中有戒，努力成为党和人民信赖的好干部。</p><p>学有榜样，赶有目标。习近平再三强调，要见贤思齐。</p><p>从淋着雨同工人交谈，到走遍中国所有集中连片特困区，从考察时在简陋的活动板房中住宿，到自我介绍“我是人民的勤务员”……习近平以身作则，“我将无我，不负人民”，并要求广大党员领导干部“更好为人民服务，更好干事创业”。</p><p><strong>崇敬，至诚报国追梦人</strong></p><p>心有大我、至诚报国的追梦人，在习近平心中同样有着极重的分量。</p><p></p><div><img src="http://p3.pstatp.com/large/pgc-image/ec190d272738401484b01c00f190a43d" img_width="500" img_height="276" alt="这些名字，习近平常思之念之" inline="0"><p></p></div><p><br></p><p>罗阳在航母“辽宁舰”上。</p><p>忠于事业、甘于奉献，“航空报国英模”罗阳就是其中之一。</p><p>2012年11月25日，我国首艘航母“辽宁舰”成功起降歼-15舰载机，这是具有里程碑意义的时刻。就在这一天，研制现场总指挥罗阳突发疾病抢救无效，在任务完成那一刻永远倒在了工作岗位上，年仅51岁。</p><p>消息传出，习近平对罗阳用一生践行“航空报国”理想的功绩高度肯定，并惋惜道：“他的英年早逝是党和国家的一个重大损失。”</p><p>罗阳等人“身上所具有的信念的能量、大爱的胸怀、忘我的精神、进取的锐气，正是我们民族精神的最好写照”。数月之后的全国两会上，习近平再一次号召大家学习罗阳的优秀品质和可贵精神。</p><p></p><div><img src="http://p3.pstatp.com/large/pgc-image/5afa6839aac04c3289f8c5aa630d57b8" img_width="450" img_height="295" alt="这些名字，习近平常思之念之" inline="0"><p></p></div><p><br></p><p>习近平和贾大山(右)合影。</p><p>心怀家国、肩担道义，作家贾大山也是这样一个让习近平深情怀念着的故人。“大山是一位非党民主人士，但他从来也没有把自己的命运与党和国家、人民的命运割裂开。”</p><p>贾大山因病去世一年后，《当代人》杂志刊发了习近平的一篇悼念长文《忆大山》，字字泪目、句句情真：他那忧国忧民的情愫，清正廉洁、勤政敬业的作风，襟怀坦荡、真挚善良的品格，刚正不阿、疾恶如仇的精神，都将与他不朽的作品一样，长留人间……</p><p>斯人往矣，精神永存。</p><p></p><div><img src="http://p1.pstatp.com/large/pgc-image/19c8e2bb203249a3848493e89174c091" img_width="500" img_height="283" alt="这些名字，习近平常思之念之" inline="0"><p></p></div><p><br></p><p>几名学生在黄大年同志先进事迹教育基地参观。</p><p>海归科学家黄大年，“把为祖国富强、民族振兴、人民幸福贡献力量作为毕生追求，为我国教育科研事业作出了突出贡献”。习近平作出重要指示，“我们要以黄大年同志为榜样”，“把爱国之情、报国之志融入祖国改革发展的伟大事业之中、融入人民创造历史的伟大奋斗之中”。</p><p>诸君风骨，后继有人。</p><p>纪念，是为了更好地前行。</p><p>习近平对于逝者的哀思与深情，正滋润着广大追梦人的心田，激发出无穷力量。（中央广播电视总台央视网）</p></div></div><p><br></p><div><div><i></i></div></div>',
        1554531350, 1554580475, '', 0, 0, 0, '9cd70c69-cc0b-417b-b492-1161aeaf28ff');

drop table if exists message;
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

INSERT INTO blog.message (id, title, content, userId, hasRead, createTime, updateTime)
VALUES ('0189aefd-437f-42cb-a4f7-f6a6826ba545', '你的文章《test》被点击了', '你的文章《test》被点击了，当前总的点击数19', 'xxxx', 0, 1556739156,
        1556739156);
INSERT INTO blog.message (id, title, content, userId, hasRead, createTime, updateTime)
VALUES ('59cc7d5b-1b27-46fe-b0fe-d183364980ce', '你的文章《test》被点击了', '你的文章《test》被点击了，当前总的点击数18', 'xxxx', 0, 1556739155,
        1556739155);
INSERT INTO blog.message (id, title, content, userId, hasRead, createTime, updateTime)
VALUES ('e0f47496-01c5-4b86-bedd-a4d79c070143', '你的文章《test》被点击了', '你的文章《test》被点击了', 'xxxx', 0, 1556739103, 1556739103);

drop table if exists user;
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

INSERT INTO blog.user (id, username, password, account, description, phone, sex, email, avatar, createTime, updateTime,
                       ip, loginTime, lastLoginTime, status, isAdmin)
VALUES ('1212', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'ttentau', null, '15928584225', 1, 'ttentau@163.com',
        '''''', 1554572777, 1554580207, '127.0.0.1', 1554580207, 1554580186, 0, 1);

drop table if exists category;
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

INSERT INTO blog.category (id, parentId, name, description, createTime, status)
VALUES ('9cd70c69-cc0b-417b-b492-1161aeaf28ff', '', '324', null, 1554563109, 0);
INSERT INTO blog.category (id, parentId, name, description, createTime, status)
VALUES ('a4190e4a-8c5f-44d2-b33c-aae650fb673a', '', '666', null, 1554562505, 0);