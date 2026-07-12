# Architecture Rules

Architecture:

Controller
↓
Form Request
↓
Service
↓
Model

Rules:

- Keep controllers thin.
- Put business logic into Service classes.
- Models should contain relationships, scopes, casts and accessors.
- Use transactions for operations involving multiple database writes.
- Do not place business logic inside Blade views.
- Avoid unnecessary Repository classes.
- Follow SOLID principles where practical.
