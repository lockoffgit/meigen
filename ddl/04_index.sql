create index idx_members_01 on members( unit_id );

create index idx_meigens_01 on meigens( member_id );

create index idx_iotws_01 on iotws( meigen_id );

create index idx_iotws_02 on iotws( member_id );

create index idx_deletes_01 on deletes( meigen_id );

create index idx_deletes_02 on deletes( member_id );

create index idx_tries_01 on tries( meigen_id );

create index idx_tries_02 on tries( member_id );


