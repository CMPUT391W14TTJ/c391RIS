default:
	find ./ -type d -exec chmod 755 {} +
	find ./ -type f -exec chmod 644 {} +
	sqlplus jhodgson/qwer1234 @scripts/setup_new.sql
	sqlplus jhodgson/qwer1234 @scripts/table_updates.sql
	sqlplus jhodgson/qwer1234 @scripts/views.sql
	sqlplus jhodgson/qwer1234 @scripts/inverted_index.sql
	sqlplus jhodgson/qwer1234 @scripts/admin.sql
	
dev:
	find ./ -type d -exec chmod 755 {} +
	find ./ -type f -exec chmod 644 {} +
	sqlplus jhodgson/qwer1234 @scripts/setup_new.sql
	sqlplus jhodgson/qwer1234 @scripts/table_updates.sql
	sqlplus jhodgson/qwer1234 @scripts/views.sql
	sqlplus jhodgson/qwer1234 @scripts/inverted_index.sql
	sqlplus jhodgson/qwer1234 @scripts/admin.sql
	sqlplus jhodgson/qwer1234 @scripts/table_data.sql

