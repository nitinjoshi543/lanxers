import json

from google import genai

from app.config import GEMINI_API_KEY, GEMINI_MODEL
from app.prompts import SYSTEM_PROMPT
from app.jdprompts import JOB_DESCRIPTION_PROMPT

client = genai.Client(api_key=GEMINI_API_KEY)


def analyze_resume(resume, job_description):

    prompt = f"""
{SYSTEM_PROMPT}

Resume:

{resume}

----------------------------------------

Job Description:

{job_description}
"""

    response = client.models.generate_content(
        model=GEMINI_MODEL,
        contents=prompt
    )

    text = response.text.strip()

    # Remove markdown code fences if present
    if text.startswith("```json"):
        text = text[7:]
    if text.endswith("```"):
        text = text[:-3]

    return json.loads(text.strip())
    
    
def generate_job_description(employer_input):

    prompt = f"""
{JOB_DESCRIPTION_PROMPT}

Employer Input:

{employer_input}
"""

    response = client.models.generate_content(
        model=GEMINI_MODEL,
        contents=prompt
    )

    text = response.text.strip()

    if text.startswith("```json"):
        text = text[7:]

    if text.endswith("```"):
        text = text[:-3]

    return json.loads(text.strip())