
SELECT first_name, last_name, address, phone, MIN(test_date)
FROM radiology_record r, persons p
WHERE contains(r.diagnosis, 'bi polar', 1) > 0 AND r.patient_id = p.person_id AND
(r.test_date BETWEEN TO_DATE('03-10-2014', 'MM-DD-YYYY') AND TO_DATE('03-11-2014', 'MM-DD-YYYY'))
GROUP BY first_name, last_name, address, phone;


