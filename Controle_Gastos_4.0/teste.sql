create table log_cliente(
	id_log integer primary key autoincrement,
    id_cliente integer,
    data_log date,
    hora_log time,
    tipo_operacao varchar(10),
);

'trigger de insert'
create trigger grava_log_cliente after insert on cliente
for each row
    insert into log_cliente(id_cliente, data_log, hora_log, tipo_operacao)
    values(new.id_cliente, date(current_date()), time(current_time()), 'insert');

'trigger de delete'
create trigger grava_log_cliente_deleta after delete on cliente
for each row
    insert into log_cliente(id_cliente, data_log, hora_log, tipo_operacao)
    values(old.id_cliente, date(current_date()), time(current_time()), 'delete');
