--Data Tables__
CREATE TABLE famusers (
    user_pk SERIAL      NOT NULL PRIMARY KEY,
	username            TEXT NOT NULL UNIQUE,
	password_hash       TEXT NOT NULL,
	fname               TEXT NOT NULL,
	lname               TEXT NOT NULL,
    family_fk           INT REFERENCES family(family_pk),
    family_title        TEXT --Mother, Father, Child
);

CREATE TABLE family (
    family_pk SERIAL    NOT NULL PRIMARY KEY,
    family_name         TEXT NOT NULL
);

CREATE TABLE project (
    project_pk SERIAL   NOT NULL PRIMARY KEY,
    project_name        TEXT NOT NULL  UNIQUE,
    deadline            DATE,
    date_completed      DATE,
    date_created        DATE NOT NULL DEFAULT current_date,
    created_by          TEXT NOT NULL DEFAULT current_user,
    family_fk           INT NOT NULL REFERENCES family(family_pk)
);

CREATE TABLE task (
    task_pk SERIAL      NOT NULL PRIMARY KEY,
    task_title          TEXT NOT NULL  UNIQUE,
    task_description    TEXT,
    has_task_deadline   BOOLEAN,
    task_deadline       DATE,
    assignee            TEXT,
    date_completed      DATE,
    completed_by        TEXT,
    date_added          DATE NOT NULL DEFAULT current_date,
    added_by            TEXT NOT NULL DEFAULT current_user,
    project_fk          INT NOT NULL REFERENCES project(project_pk)
);
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-- ADD TEST USERS --
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-- Insert Vader --
INSERT INTO famusers (username, password_hash, fname, lname) VALUES (
    'DarthVader',
    'VaderRocks',
    'Anakin',
    'Skywalker'
);

-- Insert Padme --
INSERT INTO famusers (username, password_hash, fname, lname) VALUES (
    'Queenie',
    'littleAnnie',
    'Padme',
    'Skywalker'
);

-- Insert Luke --
INSERT INTO famusers (username, password_hash, fname, lname) VALUES (
    'JediMan',
    'TheForce',
    'Luke',
    'Skywalker'
);

-- Insert Leia --
INSERT INTO famusers (username, password_hash, fname, lname) VALUES (
    'Princess',
    'Alderaan',
    'Leia',
    'Skywalker'
);
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------


-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-- ADD TEST FAMILY --
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
INSERT INTO family (family_name) VALUES (
    'Skywalker'
);
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-- SELECT STATEMENTS --
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-- Select user --
SELECT * FROM famusers WHERE username='DarthVader' AND password_hash = 'VaderRocks';

-- get family members --
SELECT fname, lname FROM famusers WHERE family_fk=(SELECT family_fk FROM famusers WHERE username='DarthVader');
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------

ALTER TABLE famusers ADD COLUMN family_fk INT REFERENCES family(family_pk);

UPDATE famusers SET family_fk = 1 WHERE username = 'DarthVader';

UPDATE famusers SET family_fk =(SELECT family_pk FROM family WHERE family_name ='') WHERE username = '';

INSERT INTO project (project_name, date_created, created_by, family_fk) VALUES ('Test', current_date, current_user, 7);

DELETE FROM task WHERE project_fk=(SELECT project_pk FROM project WHERE project_name='$project');

INSERT INTO task (task_title, task_description, task_deadline, assignee, date_added, added_by, project_fk)VALUES ('$taskName','$desc','$deadline','$assignee',current_date,'$username',(SELECT project_pk FROM project WHERE project_name='$project'));