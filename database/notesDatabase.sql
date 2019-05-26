--Data Tables__
CREATE TABLE famusers (
    user_pk SERIAL      NOT NULL PRIMARY KEY,
	username            TEXT NOT NULL UNIQUE,
	password_hash       TEXT NOT NULL,
	fname               TEXT NOT NULL,
	lname               TEXT NOT NULL
);

CREATE TABLE familymember (
    member_pk SERIAL    NOT NULL PRIMARY KEY,
    family_title        TEXT NOT NULL, --Mother, Father, Child
    family_fk           INT NOT NULL REFERENCES family(family_pk),
    user_pk             INT NOT NULL REFERENCES famusers(user_pk)
);

CREATE TABLE family (
    family_pk SERIAL    NOT NULL PRIMARY KEY,
    family_name         TEXT NOT NULL
);

CREATE TABLE project (
    project_pk SERIAL   NOT NULL PRIMARY KEY,
    project_name        TEXT NOT NULL  UNIQUE,
    has_deadline        BOOLEAN,
    deadline            DATE,
    is_completed        BOOLEAN NOT NULL,
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
    is_completed        BOOLEAN NOT NULL,
    is_assigned         BOOLEAN NOT NULL,
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
-- ADD TEST FAMILY--
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
-- ADD TEST FAMILY MEMBERS--
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------

-- ADD Vader TO THE Skywalker FAMILY --
INSERT INTO familymember (family_title, family_fk, user_pk) VALUES (
    'father',
    (SELECT family_pk FROM family WHERE family_name = 'Skywalker'),
    (SELECT user_pk FROM famusers WHERE username = 'DarthVader')
);

-- ADD Padme TO THE Skywalker FAMILY --
INSERT INTO familymember (family_title, family_fk, user_pk) VALUES (
    'mother',
    (SELECT family_pk FROM family WHERE family_name = 'Skywalker'),
    (SELECT user_pk FROM famusers WHERE username = 'Queenie')
);

-- ADD Luke TO THE Skywalker FAMILY --
INSERT INTO familymember (family_title, family_fk, user_pk) VALUES (
    'child',
    (SELECT family_pk FROM family WHERE family_name = 'Skywalker'),
    (SELECT user_pk FROM famusers WHERE username = 'JediMan')
);

-- ADD Leia TO THE Skywalker FAMILY --
INSERT INTO familymember (family_title, family_fk, user_pk) VALUES (
    'child',
    (SELECT family_pk FROM family WHERE family_name = 'Skywalker'),
    (SELECT user_pk FROM famusers WHERE username = 'Princess')
);

-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------

--Select user
SELECT * FROM famusers WHERE username='DarthVader' AND password_hash = 'VaderRocks';
SELECT user_pk FROM famusers WHERE username = 'DarthVader';


