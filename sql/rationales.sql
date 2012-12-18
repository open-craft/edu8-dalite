SELECT response.rationale, response_ FROM response
where response.question_ = :question and answer = :answer and LENGTH(response.rationale) > 20
order by votes DESC
limit 4
