Select * from response join response as r2 on response.student_ = r2.student_ and response.question_ = r2.question_ and response.attempt < r2.attempt join student on response.student_ = student.student_
WHERE response.assignment_ = :assignment order by response.student_, response.question_
