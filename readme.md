# 📬 JobFlow - Job Opportunity Tracker with Gmail Sync & AI Insights

JobFlow helps you gain full control over your job hunting process. Track opportunities from job boards, sync relevant
Gmail threads, and get personalized AI-powered recommendations to stay organized and ahead.

## 🚀 Features

- 📥 Gmail sync for centralized opportunity tracking
- 📄 Smart parsing and deduplication of job messages
- 🤖 Gemini integration for intelligent job insights
- ⚙️ Laravel + Livewire + Tailwind + Vite
- 🐳 Dockerized environment with MySQL service

---

## 🐳 Getting Started with Docker

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/jobflow.git
cd jobflow
```

### 2. Create .env file

```bash
cp .env.example .env
```

Update the .env file with:

* Gmail API credentials:

```ini
GOOGLE_CLIENT_ID = your_google_client_id
GOOGLE_CLIENT_SECRET = your_google_client_secret
```

* Gemini API (for job recommendations):

```ini
GEMINI_API_KEY = your_gemini_api_key
```

### 3. Build and start containers

```bash
docker-compose up --build
```

This will:

* Start Laravel, MySQL, and Nginx containers
* Run migrations and install dependencies
* Build assets using Vite

### 4. Access your app:

* Frontend: http://localhost
* MySQL: Connect via localhost:3306 (use root/root if needed)
