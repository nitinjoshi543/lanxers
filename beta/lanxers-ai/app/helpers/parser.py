import re

KNOWN_SKILLS=[
"laravel","php","mysql","redis","docker","git","linux","aws",
"javascript","vue","nginx","supervisor","microservices","python",
"java","c++","node","flutter","firebase","rest","api"
]

def _extract(text):
    t=text.lower()
    skills=[s.title() for s in KNOWN_SKILLS if s in t]
    exp=0
    m=re.search(r'(\d+)\+?\s*(?:years|year)',t)
    if m: exp=int(m.group(1))
    edu="Bachelor" if ("bachelor" in t or "b.tech" in t or "computer science" in t) else ""
    return {"skills":skills,"experience":exp,"education":edu}

def extract_resume_information(text):
    return _extract(text)

def extract_job_information(text):
    return _extract(text)
