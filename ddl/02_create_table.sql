drop table if exists tries;
create table tries (
    try_id int not null auto_increment primary key,
    contributor varchar(255) not null,
    meigen_id int,
    unit_name varchar(255) not null,
    font text,
    member_id int not null,
    image_url text,
    created_at date default null,
    modified_at date default null
);

drop table if exists deletes;
create table deletes (
    delete_id int not null auto_increment primary key,
    meigen_id int not null,
    member_id int not null,
    created_at date default null,
    modified_at date default null
);

drop table if exists iotws;
create table iotws (
    iotw_id int not null auto_increment primary key,
    meigen_id int not null,
    member_id int not null,
    created_at date default null,
    modified_at date default null
);

drop table if exists members;
create table members (
    member_id int not null auto_increment primary key,
    name text,
    handle_name varchar(50) not null,
    image_url text,
    unit_id int not null,
    del_flag int not null,
    facebook_user_id varchar(255),
    created_at date default null,
    modified_at date default null
);

drop table if exists units;
create table units (
    unit_id int not null auto_increment primary key,
    unit_name varchar(255) not null,
    del_flag int not null,
    created_at date default null,
    updated date default null
);

drop table if exists meigens;
create table meigens (
    meigen_id int not null auto_increment primary key,
    contributor varchar(255) not null,
    speaker varchar(255) not null,
    meigen_text text,
    unit_name varchar(255) not null,
    situation text,
    font text,
    member_id int not null,
    image_url text,
    created_at date default null,
    modified_at date default null
);

drop table if exists graves;
create table graves (
    grave_id int not null auto_increment primary key,
    meigen_text text,
    speaker varchar(255) not null,
    contributor varchar(255),
    killer varchar(255) not null,
    together int not null,
    created_at date default null,
    modified_at date default null
);

drop table if exists deviceTokens;
create table deviceTokens (
    id int not null auto_increment primary key,
    device_token_id varchar(1024) not null,
    created_at date default null,
    modified_at date default null
);