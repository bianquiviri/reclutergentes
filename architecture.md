# 🏗️ System Architecture

## Design Patterns
- **Service Layer**: Toda la lógica de Google Drive y OpenAI reside en `App\Services`.
- **DTOs (Data Transfer Objects)**: Para el paso de información entre el Parser de IA y la Base de Datos.
- **Events & Listeners**: Las notificaciones de Slack y correos se disparan mediante eventos asíncronos.

## Workflow de Postulación
1. **Candidato** -> Sube CV -> `ProcessCvJob` (Queue).
2. **IA Service** -> Procesa PDF -> Guarda JSON encriptado.
3. **Slack** -> Notifica "Nuevo Talento".
4. **Reclutador** -> Evalúa en **Kanban Board** (Livewire).

## Docker Stack
- `app`: PHP-FPM 8.3.
- `web`: Nginx (Proxy inverso).
- `worker`: Laravel Queue Worker (Redis).
- `db`: MySQL 8.0 con volúmenes persistentes.
