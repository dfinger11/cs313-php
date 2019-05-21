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

-- Insert examples --
INSERT INTO famusers (username, password_hash, fname, lname) VALUES (
  'TestDummy1',
  'test1',
  'John1',
  'Doe1'
);


