/*
* Creates a view for use in the data analysis module
*/
DROP VIEW facts;
CREATE VIEW facts as
SELECT full_name, test_type, test_date, 1 as num_images
FROM persons p, radiology_record r, pacs_images i
WHERE r.patient_id = p.person_id AND r.record_id = i.record_id;
