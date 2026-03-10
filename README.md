🎯 Overview
The Scam & Threat Detection Platform is a web-based security tool designed to empower non-technical users to verify suspicious online content before engagement. With approximately 2,200 cyberattacks occurring daily worldwide, and phishing/scam tactics becoming increasingly sophisticated, there is a critical need for accessible verification tools that don't require cybersecurity expertise.
This project combines rule-based detection with transparent risk communication to help users make informed decisions about suspicious URLs, emails, and phone numbers.
🎓 Academic Context:
This is a research-driven project completed for Pearson BTEC Level 5 HND in Computing, focusing on the Cyber Security theme (2025-2026). The project demonstrates the application of security principles, research methodologies, and user-centered design.

🚨 The Problem
Statistics & Context

84.2% of surveyed users report encountering suspected phishing/scam content
28.1% of users admit they would provide information immediately if an email seems "urgent"
Traditional spam filters fail against modern social engineering attacks that use psychological manipulation rather than malicious code
Mobile users are particularly vulnerable due to limited screen space making verification difficult

Target Vulnerabilities

Phishing emails with perfect grammar and legitimate-looking domains
Scam websites that mimic trusted brands
Fraudulent phone numbers using social engineering tactics
Zero-day threats not yet in traditional blacklists

The Gap
Most existing solutions either:

Require technical expertise to interpret warnings
Operate as "black boxes" without explaining why content is risky
Focus on enterprise environments, not everyday users
Are unavailable or inaccessible to non-technical populations


💡 Our Solution
The Scam & Threat Detection Platform provides three core detection modules:
1. 🔗 URL/Website Scam Detection
Analyzes suspicious links for indicators including:

HTTPS protocol verification
Domain structure anomalies
Suspicious keywords (e.g., "verify", "urgent", "account-update")
URL shortener detection
Known scam domain patterns

2. ✉️ Email Phishing Detection
Examines email content for red flags such as:

Sender address verification
Urgency/threatening language
Requests for sensitive information
Suspicious embedded links
Grammar and formatting inconsistencies

3. 📞 Phone Number Verification
Checks phone numbers against:

Format validation
Country code analysis
Known scam number databases (simulated)
Common fraud patterns

🎯 Risk Scoring Engine
Each check provides:

Risk Level: Low / Medium / High (color-coded: Green / Yellow / Red)
Risk Score: Percentage-based assessment
Clear Explanations: Plain-language descriptions of detected indicators
Actionable Recommendations: What users should do next


✨ Key Features
For Users

✅ No Account Required - Basic checking features work without registration
🎨 Traffic Light UI - Instant visual risk assessment (Red/Yellow/Green)
📖 Plain Language Explanations - No technical jargon
🔒 Privacy-First Design - No permanent storage of checked content
📱 Mobile-Responsive - Works on desktop, tablet, and smartphone
🌐 Bilingual Support - English and Vietnamese

For Researchers

📊 Transparent Detection Logic - Rule-based approach allows understanding of how decisions are made
🔬 OWASP Top 10 Compliance - Security-by-design principles
📈 Performance Metrics - Accuracy, precision, recall tracking
🎓 Educational Value - Demonstrates cybersecurity concepts in practice


🛠️ Technology Stack
Frontend

HTML5, CSS3 - Structure and styling
JavaScript (ES6+) - Client-side logic
Tailwind CSS / Bootstrap - Responsive design framework

Backend

Node.js + Express.js (Recommended) or Python + Flask
RESTful API - Modular architecture

Detection Engine

Rule-based Pattern Matching - Heuristic analysis
Regular Expressions - Text pattern detection
Domain Verification - DNS/WHOIS checks (optional with API)

Security

Input Validation - XSS prevention
Secure Session Management - No persistent sensitive data
HTTPS/TLS - Encrypted transmission
CORS Configuration - Cross-origin security

Optional Enhancements

Google Safe Browsing API - URL reputation checking
VirusTotal API - Multi-engine threat analysis
PhishTank API - Known phishing URL database


🔬 Research Foundation
This project is grounded in extensive research combining:
Secondary Research

OWASP Top 10 security guidelines
NCSC (National Cyber Security Centre) guidance
APWG (Anti-Phishing Working Group) threat reports
Academic research on phishing detection methodologies
Government cybersecurity standards

Primary Research

User Survey (n=50-100) - Understanding user needs and security awareness
Expert Interviews - Validation of detection approaches
Usability Testing - Interface design validation
Technical Simulation - Detection accuracy benchmarking

Key Findings

Transparency builds trust: Users prefer systems that explain why content is risky
Simplicity is essential: 66.7% of users want clear risk levels over technical details
Privacy is paramount: 21.4% fear AI-based tools might leak personal data
Rule-based detection is viable: Achieves 70-80% accuracy for known threat patterns

📄 Full research methodology and findings available in project documentation

🏗️ Architecture
┌─────────────────────────────────────────────────────────────┐
│                      User Interface (Web)                    │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │ URL Check    │  │ Email Check  │  │ Phone Check  │      │
│  └──────┬───────┘  └──────┬───────┘  └──────┬───────┘      │
└─────────┼──────────────────┼──────────────────┼─────────────┘
          │                  │                  │
          └──────────────────┼──────────────────┘
                             │
                    ┌────────▼────────┐
                    │   API Gateway   │
                    └────────┬────────┘
                             │
          ┌──────────────────┼──────────────────┐
          │                  │                  │
    ┌─────▼─────┐     ┌─────▼─────┐     ┌─────▼─────┐
    │   URL     │     │   Email   │     │   Phone   │
    │ Detection │     │ Detection │     │ Detection │
    │  Module   │     │  Module   │     │  Module   │
    └─────┬─────┘     └─────┬─────┘     └─────┬─────┘
          │                  │                  │
          └──────────────────┼──────────────────┘
                             │
                    ┌────────▼────────┐
                    │ Risk Scoring    │
                    │    Engine       │
                    └────────┬────────┘
                             │
                    ┌────────▼────────┐
                    │ Results Display │
                    │  (Low/Med/High) │
                    └─────────────────┘
