from pydantic import BaseModel

class ATSRequest(BaseModel):
    resume: str
    job_description: str
    
class JobDescriptionRequest(BaseModel):
    employer_input: str