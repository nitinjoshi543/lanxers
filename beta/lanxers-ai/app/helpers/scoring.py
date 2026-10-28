def calculate_skill_score(resume,job):
    rs=set(resume["skills"])
    js=set(job["skills"])
    matched=sorted(list(rs & js))
    missing=sorted(list(js-rs))
    score=100 if not js else round(len(matched)/len(js)*100,2)
    return {"score":score,"matched":matched,"missing":missing}

def calculate_experience_score(resume,job):
    req=job["experience"]
    got=resume["experience"]
    if req<=0: return 100
    if got>=req: return 100
    return round(got/req*100,2)

def calculate_education_score(resume,job):
    if not job["education"]:
        return 100
    return 100 if resume["education"]==job["education"] else 60

def calculate_final_score(semantic,skill,experience,education):
    return round(
        semantic*0.20+
        skill*0.50+
        experience*0.20+
        education*0.10,2)
