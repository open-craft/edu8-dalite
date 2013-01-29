Select firstname, lastname, student.student_, `order`, response.answer = question.answer as correct from response 
join student on student.student_ = response.student_
join assignment_question on assignment_question.assignment_ = response.assignment_ and assignment_question.question_ = response.question_
join question on question.question_ = response.question_
WHERE response.assignment_ = :assignment 
ORDER BY response.student_, assignment_question.`order`, response.attempt