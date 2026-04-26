# 🛡️ Security & Privacy Protocol

## Data Encryption Policy
- **At Rest**: Todos los campos PII (Nombre, Email, Teléfono, CV) se almacenan usando `Illuminate\Support\Facades\Crypt`.
- **Blind Indexing**: Para permitir búsquedas `WHERE`, se utiliza un hash HMAC con una clave distinta a la `APP_KEY`.

## Infrastructure Security
- **Docker**: Los contenedores corren bajo un usuario `non-root`.
- **Environment**: No se permiten secretos hardcodeados. Uso estricto de `.env` o Docker Secrets.
- **File Access**: Los archivos en Google Drive no son públicos. Laravel actúa como un proxy autenticado.

## Audit Logs
- Cada correo enviado se registra en `email_logs`.
- Los cambios de estado en el Kanban generan un log de actividad con el ID del reclutador responsable.
