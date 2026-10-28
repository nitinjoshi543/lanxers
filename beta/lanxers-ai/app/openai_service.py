import json

from openai import OpenAI

from app.config import OPENAI_API_KEY
from app.config import OPENAI_MODEL
from app.prompts import SYSTEM_PROMPT


client = OpenAI(api_key=OPENAI_API_KEY)


def analyze_resume(resume, job_description):

    user_prompt = f"""
Resume

{resume}

--------------------------------

Job Description

{job_description}
"""

    response = client.responses.create(

        model=OPENAI_MODEL,

        input=[
            {
                "role": "system",
                "content": SYSTEM_PROMPT
            },
            {
                "role": "user",
                "content": user_prompt
            }
        ],

        temperature=0.2
    )

    result = response.output_text.strip()

    return json.loads(result)