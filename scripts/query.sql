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


SELECT r.record_id, p.full_name, d.full_name as doctor_name, r.full_name as radiologist_name, r.test_type, r.prescribing_date, r.test_date, r.diagnosis, r.description FROM radiology_record r, persons p, persons d, persons r WHERE r.patient_id = p.person_id AND r.doctor_id = d.person_id AND r.radiologist_id = r.person_id AND( (contains(p.first_name, 'random', 1) > 0) OR (contains(p.last_name, 'random', 2) > 0) OR (contains(r.diagnosis, 'random', 3) > 0) OR (contains(r.description, 'random',4 ) > 0));
*/

SELECT full_name, test_type, EXTRACT(MONTH from test_date), SUM(num_images) from facts GROUP BY CUBE(full_name, test_type, EXTRACT(MONTH from test_date));

