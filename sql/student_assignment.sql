SELECT *
FROM student
NATURAL JOIN student_course
NATURAL JOIN course_assignment
NATURAL JOIN assignment
WHERE student_ = :student_ AND assignment.published = 1
