/*Adds a virtual column to the persons table*/
ALTER TABLE persons ADD (full_name varchar(50)
GENERATED ALWAYS AS (first_name || ' ' || last_name) VIRTUAL);
