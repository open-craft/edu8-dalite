SELECT *
FROM student
NATURAL JOIN student_course
NATURAL JOIN course_assignment
NATURAL JOIN assignment
NATURAL JOIN course
WHERE student_ = :student_