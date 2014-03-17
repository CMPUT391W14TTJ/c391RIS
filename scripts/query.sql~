/*
SELECT first_name, last_name, address, phone, MIN(test_date)
FROM radiology_record r, persons p
WHERE contains(r.diagnosis, 'bi polar', 1) > 0 AND r.patient_id = p.person_id AND
(r.test_date BETWEEN TO_DATE('03-10-2014', 'MM-DD-YYYY') AND TO_DATE('03-11-2014', 'MM-DD-YYYY'))
GROUP BY first_name, last_name, address, phone;
*/
/*
SELECT r.record_id, p.first_name || ' ' || p.last_name as patient_name, d.first_name || ' ' || d.last_name as doctor_name
FROM radiology_record r, persons p, persons d
WHERE r.patient_id = p.person_id AND r.doctor_id = d.person_id;
*/
/*
SELECT patient_name 
FROM searchView
WHERE contains(patient_name, 'Tyler', 1) > 0;
*/
