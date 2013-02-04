SELECT *
FROM course
NATURAL JOIN course_assignment
NATURAL JOIN `assignment`
WHERE professor_ = :prof_
