# ai-service/main.py
from fastapi import FastAPI
from pydantic import BaseModel
import os
from groq import Groq
from dotenv import load_dotenv
from fastapi.middleware.cors import CORSMiddleware

load_dotenv()

app = FastAPI()


app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_methods=["*"],
    allow_headers=["*"],
)

client = Groq(api_key=os.getenv("GROQ_API_KEY"))

class QuotationData(BaseModel):
    client_name: str
    total: float
    items: list
    due_date: str
    status: str
    suggested_action: str = None

@app.post("/summarize-quotation")
def summarize(q: QuotationData):
    prompt = f"""
    You are a business assistant. Summarize this quotation in 5 lines in Hindi+English mix:
    Client: {q.client_name}
    Total: {q.total}, Status: {q.status}, Due: {q.due_date}
    Items: {q.items}
    Give: 1) Short summary 2) Risk if any 3) Next action suggestion
    Keep it short and professional.
    """

    chat_completion = client.chat.completions.create(
        messages=[
            {
                "role": "user",
                "content": prompt,
            }
        ],
        model="openai/gpt-oss-20b", # free and super fast model
    )

    return {"summary": chat_completion.choices[0].message.content}

@app.get("/")
def home():
    return {"message": "AI Service is running with Groq"}