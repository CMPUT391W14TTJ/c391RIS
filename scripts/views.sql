/*
DROP VIEW searchView;
CREATE VIEW searchView as 
SELECT r.record_id, p.first_name || ' ' || p.last_name as patient_name, 
d.first_name || ' ' || d.last_name as doctor_name, r.first_name ||
' ' || r.last_name as radiologist_name, r.test_type, r.prescribing_date,
r.test_date, r.diagnosis, r.description
FROM radiology_record r, persons p, persons d, persons r
WHERE r.patient_id = p.person_id AND r.doctor_id = d.person_id
AND r.radiologist_id = r.person_id;
*/
DROP VIEW facts;
CREATE VIEW facts as
SELECT full_name, test_type, test_date, 1 as num_images
FROM persons p, radiology_record r, pacs_images i
WHERE r.patient_id = p.person_id AND r.record_id = i.record_id;
