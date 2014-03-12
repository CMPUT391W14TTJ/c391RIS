CREATE INDEX rad_rec_diagnosis on radiology_record(diagnosis)
INDEXTYPE IS CTXSYS.CONTEXT;

CREATE INDEX rad_rec_description on radiology_record(description)
INDEXTYPE IS CTXSYS.CONTEXT;

CREATE INDEX rad_rec_test_type on radiology_record(test_type)
INDEXTYPE IS CTXSYS.CONTEXT;

CREATE INDEX person_first_name on persons(first_name)
INDEXTYPE is CTXSYS.CONTEXT;

CREATE INDEX person_last_name on persons(last_name)
INDEXTYPE is CTXSYS>CONTEXT;
