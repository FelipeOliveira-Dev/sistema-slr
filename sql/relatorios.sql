/*Relatórios sistema de locadora de Carros*/
/*Relatório de funcionários*/
select * from aluguel;

create view quantidade_alug as
select funcionarios_id, count(funcionarios_id) as quant_alug
from aluguel
group by funcionarios_id
;
 select * from quantidade_alug;
 
create view maior_quant_alug as
select max(quant_alug) as maior
from quantidade_alug
;
select * from maior_quant_alug;

/* Funcionários com maior número de aluguéis realizados */
create view func_max_num_alug as
select funcionarios_id, quant_alug
from quantidade_alug
where quant_alug = (select maior from maior_quant_alug)
order by funcionarios_id asc
;
 
select * from func_max_num_alug;