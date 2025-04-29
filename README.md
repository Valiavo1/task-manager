# Task Manager API - Laravel 11

Une API pour gérer une liste de tâches, développée avec Laravel 11.

## Configuration requise

- PHP 8.2.28 ou supérieur
- Laravel 11.6.1
- Composer
- SQLite

## Installation

1. Clonez le dépôt :
```bash
git clone https://github.com/Valiavo1/task-manager.git
cd task-manager
```

2. Installez les dépendances :
```bash
composer install
```

3. Configurez le fichier d'environnement :
```bash
cp .env.example .env
```

4. Générez la clé d'application :
```bash
php artisan key:generate
```

5. Configurez la base de données SQLite :
```bash
touch database/database.sqlite
```

6. Mettez à jour le fichier `.env` :
```
DB_CONNECTION=sqlite
```

7. Exécutez les migrations et le seeder :
```bash
php artisan migrate --seed
```

8. Lancez le serveur de développement :
```bash
php artisan serve
```

9. Accédez à la documentation Swagger :
```
http://localhost:8000/api/documentation
```

## Architecture du projet

- **API v1** : Points d'accès

## Points d'accès API

### API v1

| Méthode | URI | Description |
|---------|-----|-------------|
| GET | /api/v1/tasks | Liste toutes les tâches |
| POST | /api/v1/tasks | Crée une nouvelle tâche |
| GET | /api/v1/tasks/{id} | Affiche une tâche spécifique |
| PUT/PATCH | /api/v1/tasks/{id} | Met à jour une tâche existante |
| DELETE | /api/v1/tasks/{id} | Supprime une tâche |

## Format des requêtes

### Création/mise à jour d'une tâche
```json
{
  "title": "Nom de la tâche",
  "description": "Description détaillée de la tâche (optionnel)"
}
```

## Développement

### Tests

Pour exécuter les tests :
```bash
php artisan test
```

### Documentation Swagger

La documentation de l'API est générée avec Swagger. Pour reconstruire la documentation :
```bash
php artisan l5-swagger:generate
```
