truncate "commission_data".employee cascade;
insert into "commission_data".employee(id, name) values ('0001', 'Diana Angel');
insert into "commission_data".employee(id, name) values ('0002', 'Brad Perkins');
insert into "commission_data".employee(id, name) values ('0003', 'Jonathan Dow');
insert into "commission_data".employee(id, name) values ('0004', 'Helen Marith');

truncate "commission_data".marketing_job cascade;
insert into "commission_data".marketing_job(id, employee_id, employee_job_count, employee_job_gross_profit, employee_job_Date)
values ('j001', '0001', 36, 20000, '2024-07-16');
insert into "commission_data".marketing_job(id, employee_id, employee_job_count, employee_job_gross_profit, employee_job_Date)
values ('j002', '0001', 70, 40000, '2024-07-16');
insert into "commission_data".marketing_job(id, employee_id, employee_job_count, employee_job_gross_profit, employee_job_Date)
values ('j003', '0001', 12, 6000, '2024-07-16');
insert into "commission_data".marketing_job(id, employee_id, employee_job_count, employee_job_gross_profit, employee_job_Date)
values ('j004', '0001', 122, 220000, '2024-07-16');
