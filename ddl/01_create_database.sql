create database meigen_db
    default character set utf8;

grant
    create,
    drop,
    insert,
    update,
    delete,
    select,
    alter,
    index,
    create view,
    -- execute,             プロシージャは利用しない
    -- create routine,      プロシージャは利用しない
    -- alter routine,       プロシージャは利用しない
    lock tables
on meigen_db.*
    to meigen_user@localhost
    identified by 'vwzJ7F4u';

flush privileges;

// alter user meigen_user quota unlimited on USERS;


