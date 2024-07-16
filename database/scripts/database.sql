drop schema if exists "commission_data" cascade;

create schema "commission_data";

create table if not exists "commission_data"."employee" (
	id varchar(4),
	name varchar(50) unique not null,

	primary key(id)
);

create table if not exists "commission_data"."marketing_job" (
	id varchar(4),
	employee_id varchar(50) not null,
	employee_job_count smallint not null,
	employee_job_gross_profit double precision not null,
	employee_job_Date date not null,

	primary key(id),
	constraint employee_id_data foreign key(employee_id) references "commission_data"."employee"(id)
);
