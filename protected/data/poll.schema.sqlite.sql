DROP TABLE IF EXISTS tbl_admin;
CREATE TABLE tbl_admin(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name TEXT,
	login TEXT,
	passwrd TEXT
);

DROP INDEX IF EXISTS uq_idx_admin_login;
CREATE UNIQUE INDEX uq_idx_admin_login 
				ON tbl_admin(login); 

DROP TABLE IF EXISTS tbl_user;
CREATE TABLE tbl_user(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name TEXT DEFAULT 'Guest',
	age INTEGER DEFAULT 18,
	reg_date TEXT DEFAULT (date('now'))
);

DROP TABLE IF EXISTS tbl_question;
CREATE TABLE tbl_question(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	lv_text TEXT NOT NULL,
	ru_text TEXT NOT NULL
);

DROP TABLE IF EXISTS tbl_answer_variant;
CREATE TABLE tbl_answer_variant(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	lv_text TEXT NOT NULL,
	ru_text TEXT NOT NULL,
	is_custom BOOLEAN DEFAULT 0,
	q_id INTEGER NOT NULL,
	FOREIGN KEY (q_id) 
		REFERENCES tbl_question(id)
		ON DELETE CASCADE 
		ON UPDATE CASCADE 
);

DROP INDEX IF EXISTS tbl_fk_q_id;
CREATE INDEX tbl_fk_q_id 
			ON tbl_answer_variant(q_id);
			
DROP TABLE IF EXISTS tbl_custom_content;
CREATE TABLE tbl_custom_content(
	av_id INTEGER NOT NULL PRIMARY KEY,
	custom_content TEXT DEFAULT 'No answer',
	FOREIGN KEY (av_id) 
		REFERENCES tbl_answer_variant(id)
		ON DELETE CASCADE 
		ON UPDATE CASCADE
);

DROP TABLE IF EXISTS tbl_user_answers;
CREATE TABLE tbl_user_answers(
	u_id INTEGER NOT NULL,
	av_id INTEGER NOT NULL,
	FOREIGN KEY (u_id) 
		REFERENCES tbl_user(id)
		ON DELETE CASCADE 
		ON UPDATE CASCADE,
	FOREIGN KEY (av_id) 
		REFERENCES tbl_answer_variant(id)
		ON DELETE CASCADE 
		ON UPDATE CASCADE,
	PRIMARY KEY (u_id, av_id)
);