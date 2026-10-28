from sentence_transformers.util import cos_sim

def calculate_semantic_score(model,resume,job):
    r=model.encode(resume,convert_to_tensor=True)
    j=model.encode(job,convert_to_tensor=True)
    return round(float(cos_sim(r,j))*100,2)
