from fastapi import FastAPI
from pydantic import BaseModel
import os
from groq import Groq
from dotenv import load_dotenv
from fastapi.middleware.cors import CORSMiddleware

load_dotenv()
app = FastAPI(title="VayuShek AI Service",
              description="This is an AI service for VayuShek CRM, providing insights and summaries for quotations and other business data.",
              version="1.0.0")
app.add_middleware(CORSMiddleware, allow_origins=["*"], allow_methods=["*"], allow_headers=["*"])
client = Groq(api_key=os.getenv("GROQ_API_KEY"))

class QuotationData(BaseModel):
    client_name: str
    total: float
    items: list
    due_date: str
    status: str

@app.post("/summarize-quotation")
def summarize(q: QuotationData):
    items_str = ", ".join(q.items) if isinstance(q.items, list) else str(q.items)

    prompt = f"""
    You are a Senior Business Analyst for VayuShek CRM. Analyze this quotation deeply and give actionable insights.

    DATA:
    Client: {q.client_name}
    Total Value: ₹{q.total}
    Items: {items_str}
    Due Date: {q.due_date}
    Status: {q.status}

    Return ONLY valid JSON in this exact format, no extra text:
    {{
      "verdict": "GO / NO-GO / NEGOTIATE - 2 words me",
      "score": "1-100 tak profitability score",
      "amount": "₹{q.total}",
      "summary": "Client {q.client_name} ke liye {items_str} ka deal hai, total ₹{q.total}. 1 line me business sense batao English me, jaise 'Badhiya deal hai, margin accha hai'",
      "risk": "Risk kya hai? Payment delay? Low margin? Status {q.status} aur due {q.due_date} ke hisab se 1 line English me",
      "opportunity": "Is deal me upsell ya negotiation ka chance hai? 1 line me",
      "next_action": "Abhi turant kya karna chahiye? Approve karna hai ya client se baat karni hai? 1 line me clear action English me"
    }}
    """

    chat = client.chat.completions.create(
        messages=[{"role": "user", "content": prompt}],
        model="openai/gpt-oss-20b",
        response_format={"type": "json_object"},
        temperature=0.7
    )

    import json
    try:
        raw = chat.choices[0].message.content
        # kabhi kabhi model markdown me deta hai ```json... ```
        if "```" in raw:
            raw = raw.split("```")[1].replace("json","").strip()
        json.loads(raw) # validate
        return {"summary": raw}
    except:
        return {"summary": chat.choices[0].message.content}

@app.get("/")
def home():
    return {"message": "AI Service is running with Groq"}