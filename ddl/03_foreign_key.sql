alter table members add constraint fk_members_01 foreign key( unit_id ) references units( unit_id );

alter table meigens add constraint fk_meigens_01 foreign key( member_id ) references members( member_id );

alter table iotws add constraint fk_iotws_01 foreign key( meigen_id ) references meigens( meigen_id );

alter table iotws add constraint fk_iotws_02 foreign key( member_id ) references members( member_id );

alter table deletes add constraint fk_deletes_01 foreign key( meigen_id ) references meigens( meigen_id );

alter table deletes add constraint fk_deletes_02 foreign key( member_id ) references members( member_id );

alter table tries add constraint fk_tries_01 foreign key( meigen_id ) references meigens( meigen_id );

alter table tries add constraint fk_tries_02 foreign key( member_id ) references members( member_id );

alter table deviceTokens add constraint fk_deviceTokens_01 foreign key( device_token_id ) references deviceTokens( device_token_id );
