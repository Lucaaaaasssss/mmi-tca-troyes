from transformers import AutoModelForSequenceClassification, AutoTokenizer
import torch

# Charger le modèle DistilBERT de base (non fine-tuné)
model_name = "distilbert-base-uncased"
tokenizer = AutoTokenizer.from_pretrained(model_name)

# Ajouter une tête de classification (non entraînée)
model = AutoModelForSequenceClassification.from_pretrained(model_name, num_labels=2)

def predict_sentiment(text):
    inputs = tokenizer(text, return_tensors="pt", truncation=True, padding=True)
    with torch.no_grad():
        outputs = model(**inputs)
    logits = outputs.logits
    predicted_class = torch.argmax(logits, dim=1).item()
    return "Positif" if predicted_class == 1 else "Négatif"

# Tester avec des phrases
examples = [
    "This movie was fantastic! I really enjoyed it.",
    "I hated this film, it was so bad.",
    "The plot was interesting, but the acting was terrible.",
    "An absolute masterpiece, one of the best movies I have ever seen.",
    "It was okay, nothing special but not the worst either.",
    "I fell asleep halfway through, it was so boring.",
    "Amazing cinematography and great performances from the cast."
]
for sentence in examples:
    print(f"Texte: {sentence}")
    print(f"Sentiment prédit: {predict_sentiment(sentence)}\n")