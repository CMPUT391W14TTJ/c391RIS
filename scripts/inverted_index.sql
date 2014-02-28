CREATE INDEX rad_rec_diagnosis on radiology_record(diagnosis)
INDEXTYPE IS CTXSYS.CONTEXT;

CREATE INDEX rad_rec_description on radiology_record(description)
INDEXTYPE IS CTXSYS.CONTEXT;

CREATE INDEX rad_rec_test_type on radiology_record(test_type)
INDEXTYPE IS CTXSYS.CONTEXT;