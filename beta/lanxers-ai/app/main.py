from fastapi import FastAPI
from app.models import ATSRequest, JobDescriptionRequest
from app.gemini_service import analyze_resume
from app.gemini_service import generate_job_description

app = FastAPI()


@app.post("/analyze")
def analyze(data: ATSRequest):
    return analyze_resume(
        data.resume,
        data.job_description
    )
    
@app.get("/")
def home():
    return {
        "status": "running",
        "service": "Lanxers AI"
    }


@app.post("/generate-job-description")
def generate_job(data: JobDescriptionRequest):

    return generate_job_description(
        data.employer_input
    )