create database if not exists `mvc` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT CHARSET utf8mb4;

create table if not exists `tasks` (
    `id` bigint(20) unsigned not null auto_increment primary key
    , `username` varchar(255) not null
    , `email` varchar(255) not null
    , `description` varchar(255)
    , `ready` tinyint(1) not null default '0'
    , `changed` tinyint(1) not null default '0'
);

drop trigger `tasks-update`;
delimiter $$
create trigger `tasks-update` before update on `tasks` for each row
begin
    if (OLD.description <> NEW.description AND OLD.changed = 0)
    then
        set NEW.changed = 1;
    end if;
end$$
delimiter ;